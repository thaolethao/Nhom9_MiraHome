<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    /**
     * Đăng ký user mới
     */
    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:50|unique:users',
            'fullname' => 'required|string|max:100',
            'email' => 'required|email|unique:users',
            'phone' => 'required|string|max:20',
            'password' => 'required|string|min:8|confirmed'
        ]);

        $user = User::create([
            'username' => $request->username,
            'fullname' => $request->fullname,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'role' => 'user' // mặc định
        ]);

        $token = JWTAuth::fromUser($user); // Sử dụng JWTAuth thay vì Auth guard
        return $this->respondWithToken($token);
    }

    /**
     * Đăng nhập và trả về JWT
     */
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (!$token = JWTAuth::attempt($credentials)) {
            return response()->json(['error' => 'Email hoặc mật khẩu không đúng'], 401);
        }

        return $this->respondWithToken($token);
    }

    /**
     * Lấy thông tin user đang đăng nhập
     */
    public function profile()
    {
        return response()->json(JWTAuth::user());
    }

    /**
     * Đăng xuất (Vô hiệu hóa token)
     */
    public function logout()
    {
        JWTAuth::invalidate(JWTAuth::getToken());
        return response()->json([
            'message' => 'Đăng xuất thành công']);
    }

    /**
     * Làm mới token
     */
    public function refresh()
    {
        return $this->respondWithToken(JWTAuth::refresh());
    }

    /**
     * Format trả về token
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => JWTAuth::factory()->getTTL() * 60,
        ]);
    }
}