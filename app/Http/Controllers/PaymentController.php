<?php

namespace App\Http\Controllers;

use App;
use PDF;
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
      $responsabilidades = Responsabilidade::orderByRaw("FIELD(estado, \"Dívida\", \"Pendente\", \"Pago\")")
      ->with(["cliente", "agente", "subAgente", "universidade1", "universidade2", "relacao", "relacao.fornecedor", "fase"])
      ->get();

      $responsabilidadesPendentes = Responsabilidade::where('estado', '=', 'Pendente')->get();
      $responsabilidadesPagas = Responsabilidade::where('estado', '=', 'Pago')->get();
      $responsabilidadesDivida = Responsabilidade::where('estado', '=', 'Dívida')->get();

      $relacoes = RelFornResp::all();
      $estudantes = Cliente::all();
      $universidades = Universidade::all();
      $agentes = Agente::where('tipo', 'Agente')->get();
      $subagentes = Agente::where('tipo', 'Subagente')->get();
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
      }

      if (count($relacoes)) {
        foreach ($relacoes as $relacao) {
          if ($relacao->estado == 'Dívida' && $relacao->verificacaoPago == 0) {
            $valorTotalDivida++;
          }elseif($relacao->verificacaoPago == 1) {
            $valorTotalPago++;
          }else {
            $valorTotalPendente++;
          }
        }
      }
      return view('payments.list', compact('responsabilidades', 'valorTotalPendente', 'valorTotalPago', 'valorTotalDivida', 'estudantes', 'agentes', 'subagentes', 'universidades', 'fornecedores'));
    }

    public function search(Request $request)
    {
      $idEstudante = ($request->input('estudante') != 'default') ? $request->input('estudante') : null;
      $idAgente = ($request->input('agente') != 'default') ? $request->input('agente') : null;
      $idSubagente = ($request->input('subagente') != 'default') ? $request->input('subagente') : null;
      $idUniversidade = ($request->input('universidade') != 'default') ? $request->input('universidade') : null;
      $idUniversidadeSec = ($request->input('universidadesec') != 'default') ? $request->input('universidadesec') : null;
      $idFornecedor = ($request->input('fornecedor') != 'default') ? $request->input('fornecedor') : null;
      $dataInicio = $request->input('datainicio');
      $dataFim = $request->input('datafim');

      // Pesquisa de ESTUDANTES
      if ($idEstudante != null) {
        if ($idEstudante == 'todos') {
          $responsabilidades = Responsabilidade::select()->with(['cliente', 'fase']);
          if ($dataInicio != null) {
            $responsabilidades->where('dataVencimentoCliente', '>=', $dataInicio);
          }
          if ($dataFim != null) {
            $responsabilidades->where('dataVencimentoCliente', '<=', $dataFim);
          }
      }else {
        $responsabilidades = Responsabilidade::where('idCliente', $idEstudante)->select()->with(['cliente', 'cliente.user', 'fase']);
        if ($dataInicio != null) {
          $responsabilidades->where('dataVencimentoCliente', '>=', $dataInicio);
        }
        if ($dataFim != null) {
          $responsabilidades->where('dataVencimentoCliente', '<=', $dataFim);
        }
      }
      }

      // Pesquisa de AGENTES
      if ($idAgente != null) {
        if ($idAgente == 'todos') {
          $responsabilidades = Responsabilidade::select()->with(["agente", "fase"]);
        if ($dataInicio != null) {
          $responsabilidades->where('dataVencimentoAgente', '>=', $dataInicio);
        }
        if ($dataFim != null) {
          $responsabilidades->where('dataVencimentoAgente', '<=', $dataFim);
        }
      }else {
        $responsabilidades = Responsabilidade::where('idAgente', $idAgente)->select()->with(["agente", "fase"]);
        if ($dataInicio != null) {
          $responsabilidades->where('dataVencimentoAgente', '>=', $dataInicio);
        }
        if ($dataFim != null) {
          $responsabilidades->where('dataVencimentoAgente', '<=', $dataFim);
        }
      }
      }

      // Pesquisa de SUBAGENTES
      if ($idSubagente != null) {
        if ($idSubagente == 'todos') {
          $responsabilidades = Responsabilidade::select()->with(["subAgente", "fase"]);
        if ($dataInicio != null) {
          $responsabilidades->where('dataVencimentoSubAgente', '>=', $dataInicio);
        }
        if ($dataFim != null) {
          $responsabilidades->where('dataVencimentoSubAgente', '<=', $dataFim);
        }
      }else {
        $responsabilidades = Responsabilidade::where('idSubAgente', $idSubagente)->select()->with(["subAgente", "fase"]);
        if ($dataInicio != null) {
          $responsabilidades->where('dataVencimentoSubAgente', '>=', $dataInicio);
        }
        if ($dataFim != null) {
          $responsabilidades->where('dataVencimentoSubAgente', '<=', $dataFim);
        }
      }
      }

      // Pesquisa de UNIVERSIDADE PRINCIPAL
      if ($idUniversidade != null) {
        if ($idUniversidade == 'todos') {
          $responsabilidades = Responsabilidade::select()->with(["universidade1", "fase"]);
        if ($dataInicio != null) {
          $responsabilidades->where('dataVencimentoUni1', '>=', $dataInicio);
        }
        if ($dataFim != null) {
          $responsabilidades->where('dataVencimentoUni1', '<=', $dataFim);
        }
      }else {
        $responsabilidades = Responsabilidade::where('idUniversidade1', $idUniversidade)->select()->with(["universidade1", "fase"]);
        if ($dataInicio != null) {
          $responsabilidades->where('dataVencimentoUni1', '>=', $dataInicio);
        }
        if ($dataFim != null) {
          $responsabilidades>where('dataVencimentoUni1', '<=', $dataFim);
        }
      }
      }

      // Pesquisa de UNIVERSIDADE SECUNDÁRIA
      if ($idUniversidadeSec != null) {
        if ($idUniversidadeSec == 'todos') {
          $responsabilidades = Responsabilidade::select()->with(["universidade2", "fase"]);
        if ($dataInicio != null) {
          $responsabilidades->where('dataVencimentoUni2', '>=', $idUniversidadeSec);
        }
        if ($dataFim != null) {
          $responsabilidades->where('dataVencimentoUni2', '<=', $idUniversidadeSec);
        }
      }else {
        $responsabilidades = Responsabilidade::where('idUniversidade2', $idUniversidadeSec)->select()->with(["universidade2", "fase"]);
        if ($dataInicio != null) {
          $responsabilidades->where('dataVencimentoUni2', '>=', $idUniversidadeSec);
        }
        if ($dataFim != null) {
          $responsabilidades>where('dataVencimentoUni2', '<=', $idUniversidadeSec);
        }
      }
      }

      // Pesquisa de FORNECEDORES
      if ($idFornecedor != null) {
        if ($idFornecedor == 'todos') {
          $responsabilidades = RelFornResp::where('idFornecedor', '!=', null)
          ->with(["fornecedor", "responsabilidade", "responsabilidade.fase"]);
          if ($dataInicio != null) {
            $responsabilidades->where('dataVencimento', '>=', $dataInicio);
          }
          if ($dataFim != null) {
            $responsabilidades->where('dataVencimento', '<=', $dataFim);
          }
        }else{
          $responsabilidades = RelFornResp::where('idFornecedor', $idFornecedor)
          ->with(["fornecedor", "responsabilidade", "responsabilidade.fase"]);
          if ($dataInicio != null) {
            $responsabilidades->where('dataVencimento', '>=', $dataInicio);
          }
          if ($dataFim != null) {
            $responsabilidades->where('dataVencimento', '<=', $dataFim);
          }
        }
        }

        $responsabilidades = $responsabilidades->get();

        if (count($responsabilidades)) {
            return response()->json($responsabilidades, 200);
        }else {
            return response()->json('NOK', 404);
        }
    }

    public function createcliente(Cliente $cliente, Fase $fase, Responsabilidade $responsabilidade)
    {
        $contas = Conta::all();
        $fase = Fase::where('idFase', $fase->idFase)->with(["produto", "produto.universidade1", "produto.agente"])->first();
        return view('payments.add', compact('cliente', 'fase', 'responsabilidade', 'contas'));
    }

    public function createagente(Agente $agente, Fase $fase, Responsabilidade $responsabilidade)
    {
        $contas = Conta::all();
        $fase = Fase::where('idFase', $fase->idFase)->with(["produto", "produto.universidade1", "produto.cliente"])->first();
        return view('payments.add', compact('agente', 'fase', 'responsabilidade', 'contas'));
    }

    public function createsubagente(Agente $subagente, Fase $fase, Responsabilidade $responsabilidade)
    {
        $contas = Conta::all();
        $fase = Fase::where('idFase', $fase->idFase)->with(["produto", "produto.universidade1", "produto.cliente"])->first();
        return view('payments.add', compact('subagente', 'fase', 'responsabilidade', 'contas'));
    }

    public function createuni1(Universidade $universidade1, Fase $fase, Responsabilidade $responsabilidade)
    {
        $contas = Conta::all();
        $fase = Fase::where('idFase', $fase->idFase)->with(["produto", "produto.agente", "produto.cliente"])->first();
        return view('payments.add', compact('universidade1', 'fase', 'responsabilidade', 'contas'));
    }

    public function createuni2(Universidade $universidade2, Fase $fase, Responsabilidade $responsabilidade)
    {
        $contas = Conta::all();
        $fase = Fase::where('idFase', $fase->idFase)->with(["produto", "produto.agente", "produto.cliente"])->first();
        return view('payments.add', compact('universidade2', 'fase', 'responsabilidade', 'contas'));
    }

    public function createfornecedor(Fornecedor $fornecedor, Fase $fase, RelFornResp $relacao)
    {
        $contas = Conta::all();
        $fase = Fase::where('idFase', $fase->idFase)->with(["produto", "produto.agente", "produto.cliente", "produto.universidade1", "responsabilidade"])->first();
        return view('payments.add', compact('fornecedor', 'fase', 'contas', 'relacao'));
    }

    public function store(Request $request, Responsabilidade $responsabilidade)
    {
        $responsabilidade = Responsabilidade::where('idResponsabilidade', $responsabilidade->idResponsabilidade)->with(["cliente", "fase"])->first();
        // Campos de CLIENTE
        $valorCliente = ($request->input('valorPagoCliente') != null ? $request->input('valorPagoCliente') : null);
        $comprovativoCliente = ($request->file('comprovativoPagamentoCliente') != null ? $request->file('comprovativoPagamentoCliente') : null);
        $dataCliente = ($request->input('dataCliente') != null ? $request->input('dataCliente') : null);
        $contaCliente = ($request->input('contaCliente') != null ? $request->input('contaCliente') : null);
        $descricaoCliente = ($request->input('descricaoCliente') != null ? $request->input('descricaoCliente') : null);
        $observacoesCliente = ($request->input('observacoes') != null ? $request->input('observacoes') : null);
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
        // Campos de FORNECEDOR
        $idRelacao = (isset($fields['relacaoFornecedor']) ? $fields['relacaoFornecedor'] : null);
        $nomeFornecedor = (isset($fields['nomeFornecedor']) ? $fields['nomeFornecedor'] : null);
        $valorFornecedor = (isset($fields['valorPagoFornecedor']) ? $fields['valorPagoFornecedor'] : null);
        $comprovativoFornecedor = (isset($fields['comprovativoPagamentoForn']) ? $fields['comprovativoPagamentoForn'] : null);
        $dataFornecedor = (isset($fields['dataFornecedor']) ? $fields['dataFornecedor'] : null);
        $contaFornecedor = (isset($fields['contaFornecedor']) ? $fields['contaFornecedor'] : null);

        if ($valorCliente != null) {
            $pagoResponsabilidade = new PagoResponsabilidade;
            $valorCliente = str_replace('€', '', $valorCliente);
            $valorCliente = number_format((float) $valorCliente,2 ,'.' ,'');
            $pagoResponsabilidade->valorPago = $valorCliente;
            $pagoResponsabilidade->beneficiario = $responsabilidade->fase->produto->cliente->nome.' '.$responsabilidade->fase->produto->cliente->apelido;
            $pagoResponsabilidade->descricao = $descricaoCliente;
            $pagoResponsabilidade->observacoes = $observacoesCliente;
            $pagoResponsabilidade->dataPagamento = $dataCliente;
                // Comprovativo de pagamento
                $ficheiroPagamento = $comprovativoCliente;
                $nomeFicheiro = post_slug($responsabilidade->fase->produto->cliente->nome.' '.$responsabilidade->fase->descricao).'-comprovativo-'.post_slug($responsabilidade->fase->idFase).'.'.$ficheiroPagamento->getClientOriginalExtension();
                Storage::disk('public')->putFileAs('payment-proof/', $ficheiroPagamento, $nomeFicheiro);
                $pagoResponsabilidade->comprovativoPagamento = $nomeFicheiro;
                // Nota de pagamento
                $pdf = PDF::loadView('payments.pdf.nota-pagamento')->setPaper('a4', 'portrait');
                $content = $pdf->download()->getOriginalContent();
                $nomeNotaPagamento = "nota-pagamento-".post_slug($responsabilidade->cliente->nome.' '.$responsabilidade->fase->descricao).".pdf";
                Storage::put("public/nota-pagamento/".$nomeNotaPagamento, $content);
            $pagoResponsabilidade->notaPagamento = $nomeNotaPagamento;
            $pagoResponsabilidade->idResponsabilidade = $responsabilidade->idResponsabilidade;
            $pagoResponsabilidade->idConta = $contaCliente;
            // $pagoResponsabilidade->save();

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
                // Comprovativo de pagamento
                $ficheiroPagamento = $comprovativoAgente;
                $nomeFicheiro = post_slug($responsabilidade->fase->produto->agente->nome.' '.$responsabilidade->fase->descricao).'-comprovativo-'.post_slug($responsabilidade->fase->idFase).'.'.$ficheiroPagamento->getClientOriginalExtension();
                Storage::disk('public')->putFileAs('payment-proof/', $ficheiroPagamento, $nomeFicheiro);
                $pagoResponsabilidade->comprovativoPagamento = $nomeFicheiro;
            $pagoResponsabilidade->dataPagamento = $dataAgente;
            $pagoResponsabilidade->idResponsabilidade = $responsabilidade->idResponsabilidade;
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
                // Comprovativo de pagamento
                $ficheiroPagamento = $comprovativoSubAgente;
                $nomeFicheiro = post_slug($responsabilidade->fase->produto->subAgente->nome.' '.$responsabilidade->fase->descricao).'-comprovativo-'.post_slug($responsabilidade->fase->idFase).'.'.$ficheiroPagamento->getClientOriginalExtension();
                Storage::disk('public')->putFileAs('payment-proof/', $ficheiroPagamento, $nomeFicheiro);
                $pagoResponsabilidade->comprovativoPagamento = $nomeFicheiro;
            $pagoResponsabilidade->dataPagamento = $dataSubAgente;
            $pagoResponsabilidade->idResponsabilidade = $responsabilidade->idResponsabilidade;
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
                // Comprovativo de pagamento
                $ficheiroPagamento = $comprovativoUni1;
                $nomeFicheiro = post_slug($responsabilidade->fase->produto->universidade1->nome.' '.$responsabilidade->fase->descricao).'-comprovativo-'.post_slug($responsabilidade->fase->idFase).'.'.$ficheiroPagamento->getClientOriginalExtension();
                Storage::disk('public')->putFileAs('payment-proof/', $ficheiroPagamento, $nomeFicheiro);
                $pagoResponsabilidade->comprovativoPagamento = $nomeFicheiro;
            $pagoResponsabilidade->dataPagamento = $dataUni1;
            $pagoResponsabilidade->idResponsabilidade = $responsabilidade->idResponsabilidade;
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
                // Comprovativo de pagamento
                $ficheiroPagamento = $comprovativoUni2;
                $nomeFicheiro = post_slug($responsabilidade->fase->produto->universidade2->nome.' '.$responsabilidade->fase->descricao).'-comprovativo-'.post_slug($responsabilidade->fase->idFase).'.'.$ficheiroPagamento->getClientOriginalExtension();
                Storage::disk('public')->putFileAs('payment-proof/', $ficheiroPagamento, $nomeFicheiro);
                $pagoResponsabilidade->comprovativoPagamento = $nomeFicheiro;
            $pagoResponsabilidade->dataPagamento = $dataUni2;
            $pagoResponsabilidade->idResponsabilidade = $responsabilidade->idResponsabilidade;
            $pagoResponsabilidade->idConta = $contaUni2;
            $pagoResponsabilidade->save();

        if ($valorUni2 >= $responsabilidade->valorUniversidade2) {
            Responsabilidade::where('idResponsabilidade', $responsabilidade->idResponsabilidade)
            ->update(['verificacaoPagoUni2' => '1']);
        }
        }

        if ($valorFornecedor != null) {
            $relacao = RelFornResp::where('idRelacao', $idRelacao)->first();
            $pagoResponsabilidade = new PagoResponsabilidade;
            $valorFornecedor = str_replace('€', '', $valorFornecedor);
            $valorFornecedor = number_format((float) $valorFornecedor,2 ,'.' ,'');
            $pagoResponsabilidade->valorPago = $valorFornecedor;
            $pagoResponsabilidade->beneficiario = $nomeFornecedor;
                // Comprovativo de pagamento
                $ficheiroPagamento = $comprovativoFornecedor;
                $nomeFicheiro = post_slug($nomeFornecedor.' '.$responsabilidade->fase->descricao).'-comprovativo-'.post_slug($responsabilidade->fase->idFase).'.'.$ficheiroPagamento->getClientOriginalExtension();
                Storage::disk('public')->putFileAs('payment-proof/', $ficheiroPagamento, $nomeFicheiro);
                $pagoResponsabilidade->comprovativoPagamento = $nomeFicheiro;
            $pagoResponsabilidade->dataPagamento = $dataFornecedor;
            $pagoResponsabilidade->idResponsabilidade = $responsabilidade->idResponsabilidade;
            $pagoResponsabilidade->idConta = $contaFornecedor;
            $pagoResponsabilidade->save();

        if ($valorFornecedor >= $relacao->valor) {
            $relacao->update([
                'verificacaoPago' => '1',
                'estado' => 'Pago'
            ]);
        }
        }

        $responsabilidade = Responsabilidade::where('idResponsabilidade', $responsabilidade->idResponsabilidade)->first();
        event(new StorePayment($responsabilidade));
        return response()->json($pagoResponsabilidade, 200);
    }

    public function download(PagoResponsabilidade $pagoresponsabilidade)
    {
        $file = Storage::disk('public')->path('nota-pagamento/'.$pagoresponsabilidade->notaPagamento);
        return response()->file($file, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="'.$pagoresponsabilidade->notaPagamento.'"'
        ]);
    }

    public function clientepdf(Cliente $cliente, Responsabilidade $responsabilidade)
    {
        $responsabilidade = Responsabilidade::where('idResponsabilidade', $responsabilidade->idResponsabilidade)->with(["cliente", "fase"])->first();
        $pdf = PDF::loadView('payments.pdf.nota-pagamento', ['responsabilidade' => $responsabilidade])->setPaper('a4', 'portrait');
        $file = post_slug($responsabilidade->cliente->nome.' '.$responsabilidade->fase->descricao);
        return $pdf->stream('nota-pagamento-'.$file.'.pdf');
    }
}
