<?php
namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{

    protected $listen = [
        'App\Events\StorePayment' => [
          'App\Listeners\PaymentVerification',
        ],
        'App\Events\LoginVerification' => [
          'App\Listeners\UserEventListener',
        ]
    ];

    protected $subscribe = [
        'App\Listeners\UserEventListener',
    ];

    public function boot()
    {
        parent::boot();
    }
}
