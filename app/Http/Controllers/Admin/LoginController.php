<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;


class LoginController extends Controller
{

    use AuthenticatesUsers;
    // 上記のクラスの中に、login method やlogoutメソッドが記載してある。

    // これ以降のメソッドはadmin専用にすべてオーバライドしている。


    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
    }

    // adminのSessionGuardインスタンスを返す
    protected function guard()
    {
        return Auth::guard('admin');
    }

    protected $redirectTo = '/admin/home';


    public function username()
    {
        return 'name';
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return $this->loggedOut($request) ?: redirect('/admin/login');
    }


}
