<?php

namespace App\Http\Controllers\User\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendEmail;
use App\Http\Requests\PasswordResetRequest;
use App\Http\Requests\EmailSendRequest;



class PasswordResetController extends Controller
{
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

        return redirect()->route('auth-code.entry_form');
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'auth_code' => 'required|integer',
            'password' => 'required|between:8,20|regex:/\A(?=.*?[a-z])(?=.*?\d)(?=.*?[!-\/:-@[-`{-~])[!-~]+\z/i',
            'password_conf' => 'same:password'
        ], [
            'password.regex' => '半角英数字のみです。'
        ]);
        $request->auth_code;
    }

}
