<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use illuminate\Support\Facades\Auth;


class RegisterController extends Controller
{
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function showRegistrationForm()
    {
        return view('auth.registration_form');
    }

    public function register(Request $request)
    {
        User::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
        ]);

        $credentials = $request->only('username', 'password');

        Log::debug($credentials);

        if (Auth::attempt($credentials))
        {

            return redirect('posts');
        }


    }


}
