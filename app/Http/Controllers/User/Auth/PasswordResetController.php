<?php

namespace App\Http\Controllers\User\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use App\Mail\SendEmail;
use App\Http\Requests\PasswordResetRequest;
use App\Http\Requests\EmailSendRequest;
use Log;

class PasswordResetController extends Controller
{
    public $user;

    public function index()
    {
        return view('reset.password_reset');
    }

    public function sendEmail(EmailSendRequest $request)
    {
        $to_mail_address = $request->input('email');

        $user = User::where("email", $to_mail_address)->first();

        $code = random_int(100,999);

        // save auth_code in DB.
        $user->auth_code = $code;

        $user->save();


        Mail::to($to_mail_address)
            ->send(new SendEmail($code));

        $request->session()->put('password_reset_flg', 1);
        Log::info($user->id);
        $request->session()->put('user_id', $user->id);

        return redirect()->route('auth-code.entry_form');
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'auth_code' => 'required|integer',
            'password' => 'required|between:8,20|regex:/^[a-zA-Z0-9]+$/',
            'password_conf' => 'same:password'
        ], [
            'password.regex' => '半角英数字のみです。'
        ]);

        $user_id = $request->session()->get('user_id', 'default');

        Log::info($user_id);

        // ユーザidが正しく取得できなかった場合の例外処理
        if ($user_id == 'default')
        {
            return redirect()->route('password-reset-page')
                ->withError([
                    'err' => '問題が発生したためもう一度はじめからやりなおしてください。',
                ]);
        }

        $user = User::find($user_id);

        if($user->auth_code != $request->auth_code)
        {
            return back()->withError([
                'err_msg' => 'auth_code is incorrect',
            ]);


        };

        $user->auth_code = null;

        $user->password = Hash::make($request->password);
        $user->save();

        // パスワードの更新が完了した時点でパスワードリセット用のセッションを削除
        $request->session()->forget('password_reset_flg');
        $request->session()->forget('user_id');

        $request->session()->flash('message', 'Resetting the password is done.');
        return redirect()->route('login_form');
    }

}
