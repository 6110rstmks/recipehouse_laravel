<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\AuthHistory;

class UserController extends Controller
{
    public function list()
    {
        $users = User::all();

        return view('admin.users.list')
            ->with([
                'users' => $users,
            ]);
    }

    public function historyList()
    {
        $histories = AuthHistory::all();

        return view('admin.history_list')
            ->with([
                'histories' => $histories,
            ]);
    }
}
