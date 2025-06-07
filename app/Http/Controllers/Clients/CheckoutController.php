<?php

namespace App\Http\Controllers\Clients;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Mail\OrderInvoiceMail;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\VariantAttribute;
use App\Models\Voucher;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;

class CheckoutController extends Controller
{
    public function index()
    {
        $userId = auth()->id();
        $sessionId = session()->getId();

        $cart = Cart::with(['items.product', 'items.variant.attributes.attribute'])
            ->where('status', 'active')
            ->where(function ($query) use ($userId, $sessionId) {
                if ($userId) {
                    $query->where('user_id', $userId);
                } else {
                    $query->where('session_id', $sessionId);
                }
            })
            ->first();

        // Kiểm tra nếu giỏ hàng không có sản phẩm
        if (!$cart || $cart->items->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Vui lòng thêm sản phẩm vào giỏ hàng trước khi thanh toán.');
        }

        return view('pages.client.checkout', [
            'title' => 'Thanh toán',
            'cart' => $cart,
        ]);
    }

    public function getProvinces()
    {
        $response = Http::get('https://esgoo.net/api-tinhthanh/1/0.htm');
        return response()->json($response->json());
    }

    public function getDistricts(Request $request)
    {
        $provinceId = $request->query('province_id');
        $response = Http::get("https://esgoo.net/api-tinhthanh/2/{$provinceId}.htm");
        return response()->json($response->json());
    }

    public function getWards(Request $request)
    {
        $districtId = $request->query('district_id');
        $response = Http::get("https://esgoo.net/api-tinhthanh/3/{$districtId}.htm");
        return response()->json($response->json());
    }

    public function vnpay_return(Request $request)
{
    $vnp_ResponseCode = $request->input('vnp_ResponseCode');

    if ($vnp_ResponseCode == "00") {
        $orderData = session()->get('order_data');

        if (!$orderData) {
            return redirect()->route('home.index')->with('error', 'Không tìm thấy thông tin đơn hàng.');
        }

        $fakeRequest = new \Illuminate\Http\Request($orderData);

        // Tạo đơn hàng trả về đối tượng Order
        $order = $this->storeOrder($fakeRequest, 'VNPay', $request->input('vnp_TransactionNo'), 'paid');

        if (!$order) {
            return redirect()->route('home.index')->with('error', 'Tạo đơn hàng không thành công.');
        }

        session()->forget('order_data');

        return redirect()->route('orderReceived', ['id' => $order->id])->with('success', 'Thanh toán thành công.');
    } else {
        return view('payment.payment_fail');
    }
}
private function storeOrder(Request $request, $paymentMethod, $transactionId = null, $status = 'pending')
{
    $userId = auth()->id();
    $sessionId = session()->getId();

    $cartQuery = Cart::where('status', 'active');

    if ($userId) {
        $cartQuery->where('user_id', $userId);
    } else {
        $cartQuery->where('session_id', $sessionId);
    }

    $cart = $cartQuery->first();

    if (!$cart) {
        return null;
    }

    // Tạo mã đơn hàng duy nhất
    $orderCode = date('YmdHis') . strtoupper(uniqid());

    // Kiểm tra và cập nhật voucher nếu có
    if ($request->voucher) {
        $voucher = Voucher::where('code', $request->voucher)->first();

        if (!$voucher) {
            return null;
        }

        if ($voucher->used >= $voucher->quantity) {
            return null;
        }

        $voucher->increment('used');
    }

    $discount = $request->discount_amount ?? 0;
// Tạo đơn hàng
    $order = Order::create([
        'user_id' => $userId,
        'order_code' => $orderCode,
        'full_name' => $request->fullName,
        'email' => $request->email,
        'phone' => $request->phone,
        'city' => $request->city,
        'district' => $request->district,
        'ward' => $request->ward,
        'address' => $request->address,
        'note' => $request->note,
        'total_amount' => $cart->items->sum(fn($item) => $item->price * $item->quantity),
        'discount_amount' => $discount,
        'final_amount' => $cart->items->sum(fn($item) => $item->price * $item->quantity) - $discount,
        'voucher_code' => $request->voucher,
        'payment_method' => $paymentMethod,
        'transaction_id' => $transactionId,
        'status' => $status,
    ]);
    // Tạo các chi tiết đơn hàng
    foreach ($cart->items as $item) {
        OrderItem::create([
            'order_id' => $order->id,
            'product_id' => $item->product_id,
            'variant_id' => $item->variant_id,
            'product_name' => $item->product->name,
            'quantity' => $item->quantity,
            'price' => $item->price,
            'total_price' => $item->price * $item->quantity,
            'color' => $item->variant_value ?? null,
        ]);
        // Trừ số lượng sản phẩm trong kho
        if ($item->variant_id) {
            // Nếu sản phẩm có biến thể
            $variant = ProductVariant::find($item->variant_id);
            if ($variant) $variant->decrement('stock', $item->quantity);
        } else {
            // Nếu sản phẩm không có biến thể
            $product = Product::find($item->product_id);
            if ($product) $product->decrement('stock', $item->quantity);
        }
    }
    // Xóa các mục trong giỏ hàng
    CartItem::where('cart_id', $cart->id)->delete();
    $cart->delete();

    return $order;
}

}
