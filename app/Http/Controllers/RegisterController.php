<?php

// namespace App\Http\Controllers\User;
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;

use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;



class RegisterController extends Controller
{
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     *
     */
    public function showRegistrationForm()
    {
        // パスワードリセットを行うための認証コード入力画面にてリロードを行うとユーザ作成ページへ飛ばされる。
        // その際にPasswordResetControllerで設定していたフラグを削除する。
        Session::forget('password_reset_flg');

        return view('auth.registration_form');
    }

    /**
     * @param
     * @return void
     */
    public function register(RegisterRequest $request)
    {

        // check password and password_cnf is match
        if ($request->password != $request->password_conf)
        {
            return back()->withErrors([
                'match_error' => 'password is not matched.',
            ]);
        }

        // ユーザ作成と同時にログインを行う
        //
        Auth::login($user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]));

        $credentials = $request->only('username', 'password');

        return redirect()->route('user.home');
    }


}
