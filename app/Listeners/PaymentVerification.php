<?php

namespace App\Listeners;

use App\Events\StorePayment;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class PaymentVerification
{
    public function handle(StorePayment $event)
    {
        dd($event->responsabilidade);
    }
}
