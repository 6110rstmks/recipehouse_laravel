<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\LoginFormRequest;
use illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Log;


class AuthController extends Controller
{
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * @return View
     *
     */
    public function showLogin()
    {
        return view('auth.login_form');
    }

    /**
     * @param App\Http\Request\LoginFormRequest
     */

    public function login(LoginFormRequest $request)
    {

        $credentials = $request->only('username', 'password');

        $user = $this->user->getUser($credentials['username']);


        if (!is_null($this->user))
        {

            // アカウントがロックされたら弾く処理
            if ($this->user->isAccountLocked($user))
            {
                return back()->withErrors([
                    'login_error' => 'account is being locked.'
                ]);
            }

            if (Auth::attempt($credentials))
            {
                $request->session()->regenerate();

                // ログインに成功したらエラーアカウントを0にする（次回のログイン時にまた使えるようにするため）
                if ($user->error_count > 0)
                {
                    $user->error_count = 0;
                    $user->save();
                }

                // recipehouseへ移動
                return redirect('posts');
            }

            // ログインに失敗したらエラーカウントを1増やす
            $user->error_count = $this->user->addErrorCount($user->error_count);

            // エラーの回数が６回を超えたらロックをかける
            // エラー回数の仕様が変更されることを考慮して定数にしてもいいな

            if ($this->user->lockAccount($user))
            {
                $user->locked_flg = 1;
                $user->save();
                return back()->withErrors([
                    'login_error' => 'account is being locked. if you unlock, please contact administrator.'
                ]);
            }
            $user->save();
        }

        // if username or password are wrong, redirect to back page.
        return back()->withErrors([
            'login_error' => 'mail address or password is incorrect'
        ]);

    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        // これの意味を理解したい。

        $request->session()->regenerateToken();

        return redirect()->route('showLogin')->with('logout', 'logout is done.');
    }
}
