<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Mail;
use App\Mail\AuthCode;

class PasswordResetController extends Controller
{
    public function index()
    {
        return view('reset.password_reset');
    }

    public function emailSend(Request $request)
    {

        $token = rand(1111, 9999);

        

    }
}
