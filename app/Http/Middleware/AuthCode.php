<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Log;

class AuthCode
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {

        // PasswordResetControllerでメール送信を行った場合
        // sessionに1が格納されて、以下ではそれを取得。
        $password_reset_flg =
            $request->session()->get('password_reset_flg', 'default');

        // $request->session()->forget('password_reset_flg');

        // redirect to login_form or mypage
        if ($password_reset_flg !== 1)
        {
            return redirect()->route('register_page');
        }

        return $next($request);
    }
}
