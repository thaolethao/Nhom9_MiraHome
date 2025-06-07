<?php

namespace App\Http\Controllers\Clients;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Models\User;
class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('pages.client.login', [
            'title' => 'Đăng nhập cửa hàng'
        ]);
    }

    public function login(Request $request)
    {
        // Validate dữ liệu đầu vào
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8|regex:/^(?=.*[A-Z])(?=.*\W)(?=.*\d).{8,}$/',
        ], [
            'email.required' => 'Email không được để trống.',
            'email.email' => 'Email phải có định dạng đúng.',
            'password.required' => 'Mật khẩu không được để trống.',
            'password.min' => 'Mật khẩu phải chứa ít nhất 8 ký tự.',
            'password.regex' => 'Mật khẩu phải chứa ít nhất một chữ hoa, một ký tự đặc biệt và một số.',
        ]);

        // Thử đăng nhập với thông tin người dùng được cung cấp
        if (Auth::attempt(['email' => $validated['email'], 'password' => $validated['password']], $request->input('remember'))) {
            $user = Auth::user();

            // Kiểm tra trạng thái tài khoản
            if ($user->status === 0) {
                Auth::logout();

                return redirect()->back()->with('error', 'Tài khoản của bạn chưa được xác minh. Vui lòng kiểm tra email.');
            } else
            // Nếu đăng nhập thành công, chuyển hướng người dùng đến trang mong muốn và gửi thông báo thành công
            Session::flash('success', 'Đăng nhập thành công.');
            return redirect()->intended('/');
        } else {
            // Nếu thông tin đăng nhập không chính xác, gửi thông báo lỗi và chuyển hướng người dùng trở lại trang đăng nhập
            Session::flash('error', 'Email hoặc Mật khẩu không đúng!!');
            return redirect('dang-nhap');
        }
    }
    public function showRegistrationForm()
    {
        return view('pages.client.register', [
            'title' => 'Đăng ký hệ thống'
        ]);
    }

    public function register(Request $request)
    {
         // Validate the form data
         $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => [
                        'required',
                        'string',
                        'min:8',
                        'confirmed',
                        'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]+$/',
                    ],
        ], [
            'name.required' => 'Tên không được bỏ trống.',
            'phone.required' => 'Số điện thoại không được bỏ trống.',
            'email.required' => 'Email không được để trống.',
            'email.email' => 'Email phải có định dạng đúng.',
            'email.unique' => 'Email đã tồn tại.',
            'password.required' => 'Mật khẩu không được để trống.',
            'password_confirmation.required' => 'Mật khẩu xác nhận không được để trống.',
            'password.min' => 'Mật khẩu phải chứa ít nhất 8 ký tự.',
            'password.regex' => 'Mật khẩu phải chứa ít nhất một chữ hoa, một ký tự đặc biệt và một số.',
            'password_confirmation.confirmed' => 'Mật khẩu xác nhận không chính xác.',
        ]);

        // Create a new user
        $user = User::create([
            'name' => $validated['name'],
            'phone' => $validated['phone'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
            'status' => 0,
            
        ]);
        event(new Registered($user));
        // Log the user in
        Session::flash('success', 'Đăng ký thành công');
        return redirect('/');
    }
    public function logout()
    {
        Auth::logout();
        Session::flash('success', 'Bạn đã đăng xuất thành công');
        return redirect()->route('home.index');
    }
}
