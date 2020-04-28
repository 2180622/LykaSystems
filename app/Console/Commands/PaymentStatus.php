<?php

namespace App\Console\Commands;

use App\Responsabilidade;
use Illuminate\Console\Command;

class PaymentStatus extends Command
{
    protected $signature = 'payment:update';

    protected $description = 'Update the payment status on DB';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
      // Para cada responsabilidade verificar a sua data de vencimento
    }
}
