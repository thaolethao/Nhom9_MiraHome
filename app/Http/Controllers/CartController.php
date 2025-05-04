<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\CartItem;

class CartController extends Controller
{
    public function index()
    {
        // Kiểm tra xem người dùng đã đăng nhập hay chưa
        if (Auth::check()) {
            // Nếu đã đăng nhập, lấy giỏ hàng của người dùng
            $cart = Cart::with('items.product')
                        ->where('user_id', Auth::id())
                        ->first();
        } else {
            // Nếu chưa đăng nhập, tạo một giỏ hàng mới cho khách
            $cart = Cart::create(['user_id' => null]);
        }

        // Lấy danh sách sản phẩm trong giỏ hàng
        $cartItems = CartItem::with('product')
            ->where('cart_id', $cart->id)
            ->get();

        // Tính tổng tiền của giỏ hàng
        $total = $cartItems->sum(function($item) {
            return $item->product->price * $item->quantity;
        });

        // Trả về view giỏ hàng với dữ liệu
        return view('mirahome.cart', compact('cart', 'cartItems', 'total'));

    }
}
