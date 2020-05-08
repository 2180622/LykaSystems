<?php
namespace App\Listeners;
use Mail;
use App\User;
use App\Events\LoginVerification;
use App\Mail\LoginEmailConfirmation;

class UserEventListener
{
    public function handle(LoginVerification $event)
    {
        $user = $event->user;
        $user->loginCount++;

        if($user->loginCount == 3){
            Mail::to($user->email)->send(new LoginEmailConfirmation($user->slug));
            $user->loginCount = 0;
        }

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
