<?php

namespace App\Listeners;

use App\Events\StorePayment;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class PaymentVerification
{

    public function __construct()
    {
        //
    }

    public function handle(StorePayment $event)
    {
        dump('Hello World');
    }
}
