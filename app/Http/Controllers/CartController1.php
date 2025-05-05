<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Models\Cart;
use App\Models\CartItem;

class CartController1 extends Controller
{
    // Xem giỏ hàng
    public function index()
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();

            $cart = Cart::firstOrCreate(['user_id' => $user->id]);

            $items = CartItem::with('product')
                ->where('cart_id', $cart->id)
                ->get();

            $total = $items->sum(fn($item) => $item->product->price * $item->quantity);

            return response()->json([
                'cart_id' => $cart->id,
                'items' => $items,
                'total' => $total,
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Unauthorized or token error'], 401);
        }
    }

    // Thêm sản phẩm
    public function addItem(Request $request)
{
    // Xác thực và lấy người dùng từ JWT
    try {
        $user = JWTAuth::parseToken()->authenticate();
    } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {
        return response()->json(['error' => 'Token is invalid or expired'], 401);
    }

    // Kiểm tra tính hợp lệ của request
    $request->validate([
        'product_id' => 'required|exists:products,id',
        'quantity' => 'required|integer|min:1'
    ]);

    // Tìm giỏ hàng của người dùng hoặc tạo mới nếu không tồn tại
    $cart = Cart::firstOrCreate(['user_id' => $user->id]);

    // Kiểm tra xem sản phẩm đã có trong giỏ hàng chưa
    $cartItem = CartItem::where('cart_id', $cart->id)
                        ->where('product_id', $request->product_id)
                        ->first();

    if ($cartItem) {
        // Nếu có, tăng số lượng sản phẩm
        $cartItem->quantity += (int) $request->quantity;
        $cartItem->save();
    } else {
        // Nếu không có, tạo mới một CartItem
        CartItem::create([
            'cart_id' => $cart->id,
            'product_id' => $request->product_id,
            'quantity' => (int) $request->quantity
        ]);
    }

    return response()->json(['message' => 'Thêm vào giỏ hàng thành công']);
}


}
