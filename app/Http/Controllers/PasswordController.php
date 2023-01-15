<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Repositories\Interfaces\UserTokenRepositoryInterface;
use App\Http\Requests\SendEmailRequest;
use App\Mail\UserResetPasswordMail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Exception;

class PasswordController extends Controller
{

    private $userRepository;

    private const MAIL_SENDED_SESSION_KEY = 'user_reset_password_mail_sended_action';




    public function resetPasswordPage()
    {
        return view('auth.password_reset');
    }

    public function
}
