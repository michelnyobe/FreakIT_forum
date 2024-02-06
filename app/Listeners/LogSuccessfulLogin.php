<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use App\Events\UserLoggedIn;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Login;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Queue\InteractsWithQueue;

class LogSuccessfulLogin
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(Login $event): void
    {
        //
        $user = $event->user;
        DB::table('users')->where('id', $user->id)->update(['actived' => '1']);
        
    }
}
