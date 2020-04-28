<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Responsabilidade;
use Illuminate\Console\Command;

class PaymentStatus extends Command
{
    protected $signature = 'payment:update';

    protected $description = 'Update the payment status on database';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
      $responsabilidades = Responsabilidade::where('estado', '!=', 'Pago')->get();

      foreach ($responsabilidades as $responsabilidade) {
        $dataCliente = $responsabilidade->dataVencimentoPagamentoCliente;
        $dataAgente = $responsabilidade->dataVencimentoPagamentoAgente;
        $dataSubAgente = $responsabilidade->dataVencimentoPagamentoSubAgente;
        $dataUni1 = $responsabilidade->dataVencimentoPagamentoUni1;
        $dataUni2 = $responsabilidade->dataVencimentoPagamentoUni2;

        if ($dataCliente < Carbon::now() || $dataAgente < Carbon::now() || $dataSubAgente < Carbon::now() || $dataUni1 < Carbon::now() || $dataUni2 < Carbon::now()) {
          Responsabilidade::where('idResponsabilidade', $responsabilidade->idResponsabilidade)
          ->update(['estado' => 'Dívida']);
        }
      }
    }
}
