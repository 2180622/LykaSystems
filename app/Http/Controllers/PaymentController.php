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
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
      $responsabilidades = Responsabilidade::all();
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
          $queryResp = Responsabilidade::select();
        if ($dataInicio != null) {
          $queryResp->where('created_at', '>=', $dataInicio);
        }
        if ($dataFim != null) {
          $queryResp->where('created_at', '<=', $dataFim);
        }
      }else {
        $produtos = Produto::where('idCliente', $idEstudante)->get();
        foreach ($produtos as $produto) {
          $fases = Fase::where('idProduto', $produto->idProduto)->get();
        }
      }
      return view('payments.list', compact('queryResp'));
      }

      // Pesquisa de agentes
      if ($idAgente != null) {
        if ($idAgente == 'todos') {
          // Responsabilidades associadas a todos os agentes
        }else{
          // Responsabilidades associadas ao agente escolhido
        }
      }

      // Pesquisa de universidades
      if ($idUniversidade != null) {
        if ($idUniversidade == 'todos') {
          // Responsabilidades associadas a todas as universidades
        }else{
          // Responsabilidades associadas a uni escolhida
        }
      }

      // Pesquisa de fornecedores
      if ($idFornecedor != null) {
        if ($idFornecedor == 'todos') {
          // Responsabilidades associadas a todos os fornecedores
        }else{
          // Responsabilidades associadas ao fornecedor escolhido
        }
      }

    }

    public function create(Responsabilidade $responsabilidade)
    {
      return view('payments.add', compact('responsabilidade'));
    }

    public function store(Responsabilidade $responsabilidade)
    {
      return view('payments.add', compact('responsabilidade'));
    }
}
