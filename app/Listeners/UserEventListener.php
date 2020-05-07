<?php
namespace App\Listeners;
use App\User;

class UserEventListener
{
    public function onUserLogin(User $user, $remember)
    {
        $user->loginCount++;
        $user->save();
    }

    public function subscribe($events)
    {
        $events->listen(
            'auth.login',
            'App\Listeners\UserEventListener@onUserLogin'
        );
    }
}
