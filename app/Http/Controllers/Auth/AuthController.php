<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\verifyLinkEmail;
use App\Models\roles;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;

class AuthController extends Controller
{
 
public function login (){
    return view('auth.login');
}
public function register (){
    return view('auth.register');
}
public function handle_register (Request $request){
        $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:8',
        'password1' => 'required|string|min:8|same:password',
        ], [
        'name.required' => 'Tên không bỏ trống',
        'name.max' => 'Tên quá dài',
        'email.required' => 'Email không bỏ trống',
        'email.email' => 'Email không hợp lệ',
        'email.max' => 'Email quá dài',
        'email.unique' => 'Email đã có sẵn',
        'password.required' => 'Mật khẩu không bỏ trống',
        'password.min' => 'Mật khẩu ít nhất 8 kí tự',
         'password1.required' => 'Mật khẩu không bỏ trống',
        'password1.min' => 'Mật khẩu ít nhất 8 kí tự',
        'password1.same' => 'Xác thực mật khẩu không khớp',
        ]);

        $user = User::create($request->all());
        $role = roles::where('name', 'viewer')->first();
        // Attach the role to the user
        if ($role) {
            $user->roles()->attach($role->id);
        }
        if($user){
            return redirect('/login')->with('cuccess','Đăng kí thành công.');
        }
        else {
            return back()->with('error', 'Đăng ký thất bại');
        }
}
public function handle_login (Request $request){
    $user = User::where('email', $request->email);
    $credential = $request->validate([
        'email' => ['required','email'],
        'password' => 'required',
    ],[  
    'email.required' => 'Email không bỏ trống',
    'password.required' => 'Mật khẩu không bỏ trống',
    'email.email' => 'Email không hợp lệ'
    ]);
        
    if($user && Auth::attempt($credential,$request->boolean('remember_me'))){
            $request->session()->regenerate();
            return redirect()->intended('/')->with('cuccess','Đăng nhập thành công.');
    }
    return back()->with('error', 'Email hoặc mật khẩu không chính xác');
}
public function logout(){
        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();
        return redirect('/login')->with('cuccess','Đăng xuất thành công.');
}
public function forgot_password (){
    return view('auth.forgotpassword');
}
public function Reset_Pwd ($token){
        $user = User::where('remember_token', $token)->first();
        if($user){
            return view('verify.resetpwd', compact('token'));
        }
        else {
            return redirect('/forgotpassword')->with('error', 'Lỗi xác thực.');
        }
}public function handle_Reset_Pwd($token,Request $request) {
    // Validate the input
    $request->validate([
        'password' => ['required', 'min:8'],
        'password1' => 'required|same:password|min:8',
    ], [
        'password.required' => 'Mật khẩu không được bỏ trống',
        'password1.required' => 'Xác thực Mật khẩu không được bỏ trống',
        'password.min' => 'Mật khẩu phải có ít nhất 8 ký tự',
        'password1.min' => 'Xác thực Mật khẩu phải có ít nhất 8 ký tự',
        'password1.same' => 'Xác thực mật khẩu không khớp',
    ]);
    // Find the user with the matching token
    $user = User::where('remember_token', $token)->first();
    if (!$user) {
        return redirect()->back()->with(['error' => 'Token không hợp lệ.']);
    }
    // Hash the new password
    $newPassword = Hash::make($request->password);
    // Update the user's password and clear the token
    $user->update(['remember_token' => null, 'password' => $newPassword]);
    // Regenerate session token
    session()->invalidate();
    session()->regenerateToken();
    return redirect('login')->with('cuccess', 'Đổi mật khẩu thành công.');
}

public function send_Link_Verify_Email (Request $request){
    // check email exits
        $user = User::where('email', $request->email)->first();
        if(!$user){
            return redirect('/forgotpassword')->with('error', 'Email không có trên hệ thống');
        }
        session()->invalidate();
        session()->regenerateToken();
        $token = $request->_token;
        $email = $request->email;
        $user->update(['remember_token' => $token]);
        // create link for verification email address
        $linkverifyEmail = route('ResetPwd',['token'=>$token]);
        // send email
        Mail::to($email)->send(new verifyLinkEmail($linkverifyEmail));
        return view('verify.success', compact('email'));
}
public function Cuccess_Verify(){
    return view('verify.success');
}

}
