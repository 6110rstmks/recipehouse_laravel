<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Log;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;



class RegisterController extends Controller
{
    public function register(Request $request)
    {
        Log::info('lij');
        Admin::create([
            'name' => $request->name,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('admin.login_page');
    }
}
