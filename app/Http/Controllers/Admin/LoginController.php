<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// use Illuminate\Foundation\Auth\AuthenticatesUsers;
use illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Log;



class LoginController extends Controller
{

    // use AuthenticatesUsers;
    // // 上記のクラスの中に、login method やlogoutメソッドが記載してある。

    // // これ以降のメソッドはadmin専用にすべてオーバライドしている。


    // public function __construct()
    // {
    //     $this->middleware('guest:admin')->except('logout');
    // }

    // // adminのSessionGuardインスタンスを返す
    // protected function guard()
    // {
    //     return Auth::guard('admin');
    // }

    // protected $redirectTo = '/admin/home';


    // public function username()
    // {
    //     return 'name';
    // }

    // public function logout(Request $request)
    // {
    //     $this->guard()->logout();

    //     $request->session()->invalidate();

    //     $request->session()->regenerateToken();

    //     return $this->loggedOut($request) ?: redirect('/admin/login');
    // }

    public function login(Request $request)
    {
        Log::info('lkj');
        $credentials = $request->only('email', 'password');

        if (Auth::guard('admin')->attempt($credentials, false))
        {
            Log::info('self');
            // session hijacking countermeasure
            $request->session()->regenerate();

            return redirect()->route('admin.home');
        } else {

            return back()->withErrors([
                'err' => 'email or password is incorrect.'
            ]);
        }
    }





}
