<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

use App\Models\AuthHistory;

class LoginToLog
{
    /**
     * Create the event listener.
     *
     * @return void
     */

    // public $guard;

    // public $user;

    public function __construct()
    {
        // $this->user = $user;
        // $this->guard = $guard;
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\Login  $event
     * @return void
     */
    public function handle(Login $event)
    {
        // ログインをリッスンしたらlogin history を作成
        AuthHistory::create(
            [
                'user_id' => $event->user->id,
                'ip_address' => request()->ip(),
                'user_agent' => request()->userAgent(),
                'login_time' => \Carbon\Carbon::now()
            ]
        );
    }
}
