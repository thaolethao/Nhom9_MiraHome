<?php

namespace App\Http\Controllers\Clients;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\VariantAttribute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;



class OrdersController extends Controller
{
    public function show($id)
    {
        $order = Order::with('items.product', 'items.variant.attributes.attribute')->findOrFail($id);
    
        // Lấy tên tỉnh/thành phố, quận/huyện, và phường/xã từ API
        $province = Http::get("https://esgoo.net/api-tinhthanh/1/0.htm")->json();
        $district = Http::get("https://esgoo.net/api-tinhthanh/2/{$order->city}.htm")->json();
        $ward = Http::get("https://esgoo.net/api-tinhthanh/3/{$order->district}.htm")->json();
    
        // Tìm tên tỉnh/thành phố
        $provinceName = collect($province['data'])->firstWhere('id', $order->city)['full_name'] ?? 'N/A';
        // Tìm tên quận/huyện
        $districtName = collect($district['data'])->firstWhere('id', $order->district)['full_name'] ?? 'N/A';
        // Tìm tên phường/xã
        $wardName = collect($ward['data'])->firstWhere('id', $order->ward)['full_name'] ?? 'N/A';
    
        $title = 'Thanh toán đơn hàng';

        return view('pages.client.orderReceived', compact('order', 'title', 'provinceName', 'districtName', 'wardName'));
    }

 public function store(Request $request)
{
    $order = new Order();

    if (Auth::check()) {
        $order->user_id = Auth::id();
    } else {
        $order->session_id = session()->getId();
    }

    // Lấy giỏ hàng từ session
    $listCartBuy = session('cart') ?? [];

    // Tính tổng tiền
    $total = 0;
    foreach ($listCartBuy as $item) {
        $total += $item['quantity'] * $item['price'];
    }

    $discount = 0;

    // Áp dụng voucher nếu có
    if ($request->voucher_code) {
        $voucher = DB::table('vouchers')
            ->where('code', $request->voucher_code)
            ->where('start_date', '<=', now())
            ->where('end_date', '>=', now())
            ->whereColumn('used', '<', 'quantity')
            ->first();

        if ($voucher) {
            // Tính chiết khấu theo phần trăm
            $discount = ($voucher->discount_percentage / 100) * $total;
            $discount = min($discount, $voucher->max_discount_amount);
        }
    }

    $finalAmount = max(0, $total - $discount);
    
    $order = new Order(); // <-- dòng này BẮT BUỘC phải có

    // Gán thông tin đơn hàng
    $order->total = $total;
    $order->discount_amount = $discount;
    $order->final_amount = $finalAmount;
    $order->voucher_code = $request->voucher_code;
    $order->order_code = 'OD' . strtoupper(uniqid());
    $order->status = 'pending';
    $order->save();

    // Cập nhật số lần dùng voucher
    if ($request->voucher_code && isset($voucher)) {
        DB::table('vouchers')
            ->where('code', $request->voucher_code)
            ->increment('used');
    }

    // Duyệt qua giỏ hàng để gửi mail
    $listCartBuyObjects = [];
    foreach ($listCartBuy as $item) {
        $product = \App\Models\Product::find($item['product_id']);

        $listCartBuyObjects[] = (object)[
            'product' => $product,
            'quantity' => $item['quantity'],
            'price' => $item['price'],
            'color' => $item['color'] ?? '',
        ];
    }

    // Gửi mail xác nhận đơn hàng
    $totalAmount = $finalAmount;

    $sendMail = new \App\Http\Controllers\Clients\SendMailController();
    $sendMail->sendMailOrder(
        $order->order_code,
        $request->full_name,
        $request->email,
        $request->phone,
        $request->address,
        $listCartBuyObjects,
        $totalAmount,           // final_amount
        $order->status,
        $discount               // discount_amount
);


    return redirect()->route('orders.index')->with('success', 'Đặt hàng thành công!');
}



    public function myOrders()
    {
        $title = 'Đơn hàng của tôi';
        $userId = auth()->id();
        $sessionId = session()->getId();

        $orders = Order::where('status', '!=', 'cart') // hoặc điều kiện phù hợp
            ->where(function ($query) use ($userId, $sessionId) {
                if ($userId) {
                    $query->where('user_id', $userId);
                } else {
                    $query->where('session_id', $sessionId);
                }
            })
            ->orderBy('created_at', 'desc')
            ->get();

        return view('pages.client.myOrders', compact('orders', 'title'));
    }

}
