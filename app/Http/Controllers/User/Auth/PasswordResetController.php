<?php

namespace App\Http\Controllers\User\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendEmail;
use App\Http\Requests\PasswordResetRequest;



class PasswordResetController extends Controller
{
    public function index()
    {
        return view('reset.password_reset');
    }

    public function sendEmail(PasswordResetRequest $request)
    // public function sendEmail(Request $request)
    {
        $to_mail_address = $request->input('email');

        $email = User::where('email', '=', $request->email)->exists();

        $request->session()->put('update_password_for_email', $request->email);

        if (empty($email))
        {
            $request->session()->put('send_email', $request->email);
            return redirect()->back()->withErrors(['err_msg' => '入力されたメールアドレスは存在しません']);
        }

        $code = random_int(10000,99999);

        Mail::to($to_mail_address)
            ->send(new SendEmail($code));

        return redirect()->route('auth-code.entry_form');
    }

}
