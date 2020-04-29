<?php

namespace App\Http\Controllers;

use App\Fase;
use App\Conta;
use App\Agente;
use App\Produto;
use App\Cliente;
use App\Fornecedor;
use App\RelFornResp;
use App\Universidade;
use App\DocTransacao;
use App\Responsabilidade;
use App\Events\StorePayment;
use Illuminate\Http\Request;
use App\PagoResponsabilidade;
use Illuminate\Support\Facades\Storage;

class PaymentController extends Controller
{
    public function index()
    {
      $responsabilidades = Responsabilidade::orderByRaw("FIELD(estado, \"Dívida\", \"Pendente\", \"Pago\")")->get();
      $responsabilidadesPendentes = Responsabilidade::where('estado', '=', 'Pendente')->get();
      $responsabilidadesPagas = Responsabilidade::where('estado', '=', 'Pago')->get();
      $responsabilidadesDivida = Responsabilidade::where('estado', '=', 'Dívida')->get();

      $estudantes = Cliente::all();
      $universidades = Universidade::all();
      $agentes = Agente::where('tipo', '=', 'Agente')->get();
      $fornecedores = Fornecedor::all();

      $valorTotalPendente = 0;
      $valorTotalPago = 0;
      $valorTotalDivida = 0;

      // Responsabilidades com estado = PENDENTE
      foreach ($responsabilidadesPendentes as $responsabilidadePendente) {
        if ($responsabilidadePendente->verificacaoPagoCliente == 0 && $responsabilidadePendente->valorCliente != null) {
          $valorTotalPendente++;
        }elseif ($responsabilidadePendente->verificacaoPagoCliente == 1 && $responsabilidadePendente->valorCliente != null){
          $valorTotalPago++;
        }

        if ($responsabilidadePendente->verificacaoPagoAgente == 0 && $responsabilidadePendente->valorAgente != null) {
          $valorTotalPendente++;
        }elseif ($responsabilidadePendente->verificacaoPagoAgente == 1 && $responsabilidadePendente->valorAgente != null) {
          $valorTotalPago++;
        }

        if ($responsabilidadePendente->verificacaoPagoSubAgente == 0 && $responsabilidadePendente->valorSubAgente != null) {
          $valorTotalPendente++;
        }elseif ($responsabilidadePendente->verificacaoPagoSubAgente == 1 && $responsabilidadePendente->valorSubAgente != null) {
          $valorTotalPago++;
        }

        if ($responsabilidadePendente->verificacaoPagoUni1 == 0 && $responsabilidadePendente->valorUniversidade1 != null) {
          $valorTotalPendente++;
        }elseif ($responsabilidadePendente->verificacaoPagoUni1 == 1 && $responsabilidadePendente->valorUniversidade1 != null) {
          $valorTotalPago++;
        }

        if ($responsabilidadePendente->verificacaoPagoUni2 == 0 && $responsabilidadePendente->valorUniversidade2 != null) {
          $valorTotalPendente++;
        }elseif ($responsabilidadePendente->verificacaoPagoUni2 == 1 && $responsabilidadePendente->valorUniversidade2 != null) {
          $valorTotalPago++;
        }

        if (count($responsabilidadePendente->relacao)) {
          foreach ($responsabilidadePendente->relacao as $relacao) {
            if ($relacao->verificacaoPago == 0) {
              $valorTotalPendente++;
            }else {
              $valorTotalPago++;
            }
          }
        }
      }

      // Responsabilidades com estado = PAGO
      foreach ($responsabilidadesPagas as $responsabilidadePaga) {
        if ($responsabilidadePaga->verificacaoPagoCliente == 0 && $responsabilidadePaga->valorCliente != null) {
          $valorTotalPendente++;
        }elseif ($responsabilidadePaga->verificacaoPagoCliente == 1 && $responsabilidadePaga->valorCliente != null){
          $valorTotalPago++;
        }

        if ($responsabilidadePaga->verificacaoPagoAgente == 0 && $responsabilidadePaga->valorAgente != null) {
          $valorTotalPendente++;
        }elseif ($responsabilidadePaga->verificacaoPagoAgente == 1 && $responsabilidadePaga->valorAgente != null) {
          $valorTotalPago++;
        }

        if ($responsabilidadePaga->verificacaoPagoSubAgente == 0 && $responsabilidadePaga->valorSubAgente != null) {
          $valorTotalPendente++;
        }elseif ($responsabilidadePaga->verificacaoPagoSubAgente == 1 && $responsabilidadePaga->valorSubAgente != null) {
          $valorTotalPago++;
        }

        if ($responsabilidadePaga->verificacaoPagoUni1 == 0 && $responsabilidadePaga->valorUniversidade1 != null) {
          $valorTotalPendente++;
        }elseif ($responsabilidadePaga->verificacaoPagoUni1 == 1 && $responsabilidadePaga->valorUniversidade1 != null) {
          $valorTotalPago++;
        }

        if ($responsabilidadePaga->verificacaoPagoUni2 == 0 && $responsabilidadePaga->valorUniversidade2 != null) {
          $valorTotalPendente++;
        }elseif ($responsabilidadePaga->verificacaoPagoUni2 == 1 && $responsabilidadePaga->valorUniversidade2 != null) {
          $valorTotalPago++;
        }

        if (count($responsabilidadePaga->relacao)) {
          foreach ($responsabilidadePaga->relacao as $relacao) {
            if ($relacao->verificacaoPago == 0) {
              $valorTotalPendente++;
            }else {
              $valorTotalPago++;
            }
          }
        }
      }

      // Responsabilidades com estado = DÍVIDA
      foreach ($responsabilidadesDivida as $responsabilidadeDivida) {
        if ($responsabilidadeDivida->verificacaoPagoCliente == 0 && $responsabilidadeDivida->valorCliente != null) {
          $valorTotalDivida++;
        }elseif ($responsabilidadeDivida->verificacaoPagoCliente == 1 && $responsabilidadeDivida->valorCliente != null){
          $valorTotalPago++;
        }

        if ($responsabilidadeDivida->verificacaoPagoAgente == 0 && $responsabilidadeDivida->valorAgente != null) {
          $valorTotalDivida++;
        }elseif ($responsabilidadeDivida->verificacaoPagoAgente == 1 && $responsabilidadeDivida->valorAgente != null) {
          $valorTotalPago++;
        }

        if ($responsabilidadeDivida->verificacaoPagoSubAgente == 0 && $responsabilidadeDivida->valorSubAgente != null) {
          $valorTotalDivida++;
        }elseif ($responsabilidadeDivida->verificacaoPagoSubAgente == 1 && $responsabilidadeDivida->valorSubAgente != null) {
          $valorTotalPago++;
        }

        if ($responsabilidadeDivida->verificacaoPagoUni1 == 0 && $responsabilidadeDivida->valorUniversidade1 != null) {
          $valorTotalDivida++;
        }elseif ($responsabilidadeDivida->verificacaoPagoUni1 == 1 && $responsabilidadeDivida->valorUniversidade1 != null) {
          $valorTotalPago++;
        }

        if ($responsabilidadeDivida->verificacaoPagoUni2 == 0 && $responsabilidadeDivida->valorUniversidade2 != null) {
          $valorTotalDivida++;
        }elseif ($responsabilidadeDivida->verificacaoPagoUni2 == 1 && $responsabilidadeDivida->valorUniversidade2 != null) {
          $valorTotalPago++;
        }

        if (count($responsabilidadeDivida->relacao)) {
          foreach ($responsabilidadeDivida->relacao as $relacao) {
            if ($relacao->verificacaoPago == 0) {
              $valorTotalDivida++;
            }else {
              $valorTotalPago++;
            }
          }
        }
      }
      return view('payments.list', compact('responsabilidades', 'valorTotalPendente', 'valorTotalPago', 'valorTotalDivida', 'estudantes', 'agentes', 'universidades', 'fornecedores'));
    }

    public function search(Request $request)
    {
      $fields = $request->all();
      // Escolha de estudantes, agentes, etc...
      $idEstudante = (isset($fields['estudante']) ? $fields['estudante'] : null);
      $idAgente = (isset($fields['agente']) ? $fields['agente'] : null);
      $idUniversidade = (isset($fields['universidade']) ? $fields['universidade'] : null);
      $idFornecedor = (isset($fields['fornecedor']) ? $fields['fornecedor'] : null);
      // Intervalo de datas escolhidas
      $dataInicio = (isset($fields['dataInicio']) ? $fields['dataInicio'] : null);
      $dataFim = (isset($fields['dataFim']) ? $fields['dataFim'] : null);

      // Pesquisa de estudantes
      if ($idEstudante != null) {
        if ($idEstudante == 'todos') {
          $responsabilidades = Responsabilidade::select();
        if ($dataInicio != null) {
          $responsabilidades->where('created_at', '>=', $dataInicio);
        }
        if ($dataFim != null) {
          $responsabilidades->where('created_at', '<=', $dataFim);
        }
      }else {
        $responsabilidades = Responsabilidade::where('idCliente', $idEstudante)->get();
        if ($dataInicio != null) {
          $responsabilidades->where('created_at', '>=', $dataInicio)->dd();
        }
        if ($dataFim != null) {
          $responsabilidades->where('created_at', '<=', $dataFim);
        }
      }
      dd($responsabilidades);
      return view('payments.list', compact('responsabilidades'));
      }

      // Pesquisa de agentes
      if ($idAgente != null) {
        if ($idAgente == 'todos') {
          $responsabilidades = Responsabilidade::select();
        if ($dataInicio != null) {
          $responsabilidades->where('created_at', '>=', $dataInicio);
        }
        if ($dataFim != null) {
          $responsabilidades->where('created_at', '<=', $dataFim);
        }
      }else {
        $responsabilidades = Responsabilidade::where('idAgente', $idAgente)->get();
        if ($dataInicio != null) {
          $responsabilidades->where('created_at', '>=', $dataInicio)->dd();
        }
        if ($dataFim != null) {
          $responsabilidades->where('created_at', '<=', $dataFim);
        }
      }
      dd($responsabilidades);
      return view('payments.list', compact('responsabilidades'));
      }

      // Pesquisa de universidades
      if ($idUniversidade != null) {
        if ($idUniversidade == 'todos') {
          $responsabilidades = Responsabilidade::select();
        if ($dataInicio != null) {
          $responsabilidades->where('created_at', '>=', $dataInicio);
        }
        if ($dataFim != null) {
          $responsabilidades->where('created_at', '<=', $dataFim);
        }
      }else {
        $responsabilidades = Responsabilidade::where('idUniversidade1', $idUniversidade)->orWhere('idUniversidade2', $idUniversidade)->get();
        if ($dataInicio != null) {
          $responsabilidades->where('created_at', '>=', $dataInicio)->dd();
        }
        if ($dataFim != null) {
          $responsabilidades->where('created_at', '<=', $dataFim);
        }
      }
      dd($responsabilidades);
      return view('payments.list', compact('responsabilidades'));
      }

      // Pesquisa de fornecedores
      if ($idFornecedor != null) {
        if ($idFornecedor == 'todos') {
          $responsabilidades = Responsabilidade::select();
        if ($dataInicio != null) {
          $responsabilidades->where('created_at', '>=', $dataInicio);
        }
        if ($dataFim != null) {
          $responsabilidades->where('created_at', '<=', $dataFim);
        }
      }else {
        // Filtrar por fornecedor específico
      }
      dd($responsabilidades);
      return view('payments.list', compact('responsabilidades'));
      }

    }

    public function create(Responsabilidade $responsabilidade)
    {
      $contas = Conta::all();
      return view('payments.add', compact('responsabilidade', 'contas'));
    }

    public function store(Request $request, Responsabilidade $responsabilidade)
    {
      $fields = $request->all();
      // Campos de CLIENTE
      $valorCliente = (isset($fields['valorPagoCliente']) ? $fields['valorPagoCliente'] : null);
      $comprovativoCliente = (isset($fields['comprovativoPagamentoCliente']) ? $fields['comprovativoPagamentoCliente'] : null);
      $dataCliente = (isset($fields['dataCliente']) ? $fields['dataCliente'] : null);
      $contaCliente = (isset($fields['contaCliente']) ? $fields['contaCliente'] : null);
      // Campos de AGENTE
      $valorAgente = (isset($fields['valorPagoAgente']) ? $fields['valorPagoAgente'] : null);
      $comprovativoAgente = (isset($fields['comprovativoPagamentoAgente']) ? $fields['comprovativoPagamentoAgente'] : null);
      $dataAgente = (isset($fields['dataAgente']) ? $fields['dataAgente'] : null);
      $contaAgente = (isset($fields['contaAgente']) ? $fields['contaAgente'] : null);
      // Campos de SUBAGENTE
      $valorSubAgente = (isset($fields['valorPagoSubAgente']) ? $fields['valorPagoSubAgente'] : null);
      $comprovativoSubAgente = (isset($fields['comprovativoPagamentoSubAgente']) ? $fields['comprovativoPagamentoSubAgente'] : null);
      $dataSubAgente = (isset($fields['dataSubAgente']) ? $fields['dataSubAgente'] : null);
      $contaSubAgente = (isset($fields['contaSubAgente']) ? $fields['contaSubAgente'] : null);
      // Campos de UNIVERSIDADE1
      $valorUni1 = (isset($fields['valorPagoUni1']) ? $fields['valorPagoUni1'] : null);
      $comprovativoUni1 = (isset($fields['comprovativoPagamentoUni1']) ? $fields['comprovativoPagamentoUni1'] : null);
      $dataUni1 = (isset($fields['dataUni1']) ? $fields['dataUni1'] : null);
      $contaUni1 = (isset($fields['contaUni1']) ? $fields['contaUni1'] : null);
      // Campos de UNIVERSIDADE2
      $valorUni2 = (isset($fields['valorPagoUni2']) ? $fields['valorPagoUni2'] : null);
      $comprovativoUni2 = (isset($fields['comprovativoPagamentoUni2']) ? $fields['comprovativoPagamentoUni2'] : null);
      $dataUni2 = (isset($fields['dataUni2']) ? $fields['dataUni2'] : null);
      $contaUni2 = (isset($fields['contaUni2']) ? $fields['contaUni2'] : null);

      if ($valorCliente != null) {
        $pagoResponsabilidade = new PagoResponsabilidade;
        $valorCliente = str_replace('€', '', $valorCliente);
        $valorCliente = number_format((float) $valorCliente,2 ,'.' ,'');
        $pagoResponsabilidade->valorPago = $valorCliente;
        $pagoResponsabilidade->beneficiario = $responsabilidade->fase->produto->cliente->nome.' '.$responsabilidade->fase->produto->cliente->apelido;
          $ficheiroPagamento = $comprovativoCliente;
          $nomeFicheiro = strtolower($responsabilidade->fase->produto->cliente->nome.'_'.$responsabilidade->fase->descricao).'_comprovativoPagamento_'.$responsabilidade->fase->idFase.'.' .$ficheiroPagamento->getClientOriginalExtension();
          Storage::disk('public')->putFileAs('payment-proof/', $ficheiroPagamento, $nomeFicheiro);
          $pagoResponsabilidade->comprovativoPagamento = $nomeFicheiro;
        $pagoResponsabilidade->dataPagamento = $dataCliente;
        $pagoResponsabilidade->idFase = $responsabilidade->fase->idFase;
        $pagoResponsabilidade->idConta = $contaCliente;
        $pagoResponsabilidade->save();

        if ($valorCliente >= $responsabilidade->valorCliente) {
          Responsabilidade::where('idResponsabilidade', $responsabilidade->idResponsabilidade)
          ->update(['verificacaoPagoCliente' => '1']);
        }
      }

      if ($valorAgente != null) {
        $pagoResponsabilidade = new PagoResponsabilidade;
        $valorAgente = str_replace('€', '', $valorAgente);
        $valorAgente = number_format((float) $valorAgente,2 ,'.' ,'');
        $pagoResponsabilidade->valorPago = $valorAgente;
        $pagoResponsabilidade->beneficiario = $responsabilidade->fase->produto->agente->nome.' '.$responsabilidade->fase->produto->agente->apelido;
          $ficheiroPagamento = $comprovativoAgente;
          $nomeFicheiro = strtolower($responsabilidade->fase->produto->agente->nome.'_'.$responsabilidade->fase->descricao).'_comprovativoPagamento_'.$responsabilidade->fase->idFase.'.' .$ficheiroPagamento->getClientOriginalExtension();
          Storage::disk('public')->putFileAs('payment-proof/', $ficheiroPagamento, $nomeFicheiro);
          $pagoResponsabilidade->comprovativoPagamento = $nomeFicheiro;
        $pagoResponsabilidade->dataPagamento = $dataAgente;
        $pagoResponsabilidade->idFase = $responsabilidade->fase->idFase;
        $pagoResponsabilidade->idConta = $contaAgente;
        $pagoResponsabilidade->save();

        if ($valorAgente >= $responsabilidade->valorAgente) {
          Responsabilidade::where('idResponsabilidade', $responsabilidade->idResponsabilidade)
          ->update(['verificacaoPagoAgente' => '1']);
        }
      }

      if ($valorSubAgente != null) {
        $pagoResponsabilidade = new PagoResponsabilidade;
        $valorSubAgente = str_replace('€', '', $valorSubAgente);
        $valorSubAgente = number_format((float) $valorSubAgente,2 ,'.' ,'');
        $pagoResponsabilidade->valorPago = $valorSubAgente;
        $pagoResponsabilidade->beneficiario = $responsabilidade->fase->produto->subAgente->nome.' '.$responsabilidade->fase->produto->subAgente->apelido;
          $ficheiroPagamento = $comprovativoSubAgente;
          $nomeFicheiro = strtolower($responsabilidade->fase->produto->subAgente->nome.'_'.$responsabilidade->fase->descricao).'_comprovativoPagamento_'.$responsabilidade->fase->idFase.'.' .$ficheiroPagamento->getClientOriginalExtension();
          Storage::disk('public')->putFileAs('payment-proof/', $ficheiroPagamento, $nomeFicheiro);
          $pagoResponsabilidade->comprovativoPagamento = $nomeFicheiro;
        $pagoResponsabilidade->dataPagamento = $dataSubAgente;
        $pagoResponsabilidade->idFase = $responsabilidade->fase->idFase;
        $pagoResponsabilidade->idConta = $contaSubAgente;
        $pagoResponsabilidade->save();

        if ($valorSubAgente >= $responsabilidade->valorSubAgente) {
          Responsabilidade::where('idResponsabilidade', $responsabilidade->idResponsabilidade)
          ->update(['verificacaoPagoSubAgente' => '1']);
        }
      }

      if ($valorUni1 != null) {
        $pagoResponsabilidade = new PagoResponsabilidade;
        $valorUni1 = str_replace('€', '', $valorUni1);
        $valorUni1 = number_format((float) $valorUni1,2 ,'.' ,'');
        $pagoResponsabilidade->valorPago = $valorUni1;
        $pagoResponsabilidade->beneficiario = $responsabilidade->fase->produto->universidade1->nome;
          $ficheiroPagamento = $comprovativoUni1;
          $nomeFicheiro = strtolower($responsabilidade->fase->produto->universidade1->nome.'_'.$responsabilidade->fase->descricao).'_comprovativoPagamento_'.$responsabilidade->fase->idFase.'.' .$ficheiroPagamento->getClientOriginalExtension();
          Storage::disk('public')->putFileAs('payment-proof/', $ficheiroPagamento, $nomeFicheiro);
          $pagoResponsabilidade->comprovativoPagamento = $nomeFicheiro;
        $pagoResponsabilidade->dataPagamento = $dataUni1;
        $pagoResponsabilidade->idFase = $responsabilidade->fase->idFase;
        $pagoResponsabilidade->idConta = $contaUni1;
        $pagoResponsabilidade->save();

        if ($valorUni1 >= $responsabilidade->valorUniversidade1) {
          Responsabilidade::where('idResponsabilidade', $responsabilidade->idResponsabilidade)
          ->update(['verificacaoPagoUni1' => '1']);
        }
      }

      if ($valorUni2 != null) {
        $pagoResponsabilidade = new PagoResponsabilidade;
        $valorUni2 = str_replace('€', '', $valorUni2);
        $valorUni2 = number_format((float) $valorUni2,2 ,'.' ,'');
        $pagoResponsabilidade->valorPago = $valorUni2;
        $pagoResponsabilidade->beneficiario = $responsabilidade->fase->produto->universidade2->nome;
          $ficheiroPagamento = $comprovativoUni1;
          $nomeFicheiro = strtolower($responsabilidade->fase->produto->universidade2->nome.'_'.$responsabilidade->fase->descricao).'_comprovativoPagamento_'.$responsabilidade->fase->idFase.'.' .$ficheiroPagamento->getClientOriginalExtension();
          Storage::disk('public')->putFileAs('payment-proof/', $ficheiroPagamento, $nomeFicheiro);
          $pagoResponsabilidade->comprovativoPagamento = $nomeFicheiro;
        $pagoResponsabilidade->dataPagamento = $dataUni2;
        $pagoResponsabilidade->idFase = $responsabilidade->fase->idFase;
        $pagoResponsabilidade->idConta = $contaUni2;
        $pagoResponsabilidade->save();

        if ($valorUni2 >= $responsabilidade->valorUniversidade2) {
          Responsabilidade::where('idResponsabilidade', $responsabilidade->idResponsabilidade)
          ->update(['verificacaoPagoUni2' => '1']);
        }
      }
      $responsabilidade = Responsabilidade::where('idResponsabilidade', $responsabilidade->idResponsabilidade)->first();
      event(new StorePayment($responsabilidade));
      return redirect()->route('payments.index')->with('success', 'Pagamento registado com sucesso!');
    }
}
