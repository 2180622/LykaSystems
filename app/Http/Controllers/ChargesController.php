<?php

namespace App\Http\Controllers;

use App\Fase;
use App\Conta;
use App\Produto;
use App\DocTransacao;
use App\Responsabilidade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreChargeRequest;
use App\Http\Requests\UpdateChargeRequest;

class ChargesController extends Controller
{
    public function index()
    {
      $products = Produto::all();
      $numberProducts = Produto::where('valorTotal', '!=', '0')->get();
      return view('charges.list', compact('products', 'numberProducts'));
    }

    public function show(DocTransacao $docTrasancao, Fase $fase, Produto $product)
    {
      $docTrasancao = DocTransacao::all();
      $fases = Fase::where('idProduto', '=', $product->idProduto)
      ->orderBy('verificacaoPago', 'ASC')
      ->orderBy('dataVencimento', 'ASC')
      ->get();
      return view('charges.show', compact('product', 'fases', 'docTrasancao'));
    }

    public function showcharge(Produto $product, Fase $fase, Conta $contas)
    {
      $contas = Conta::all();
      $docTrasancao = DocTransacao::where('idFase', '=', $fase->idFase)->get();
      return view('charges.showcharge', compact('product', 'fase', 'docTrasancao', 'contas'));
    }

    public function store(Request $request, StoreChargeRequest $requestCharge, Produto $product, Fase $fase)
    {
      $docTrasancao = new DocTransacao;
      $fields = $requestCharge->validated();
      $docTrasancao->fill($fields);

      $value = number_format((float) $docTrasancao->valorRecebido,2 ,'.' ,'');
      $docTrasancao->valorRecebido = $value;

      $idConta = $request->input('conta');
      $docTrasancao->idConta = $idConta;

      $docTrasancao->descricao = 'Cobrança da '.$fase->descricao;
      $docTrasancao->idFase = $fase->idFase;

      $docTrasancao->save();

      if ($requestCharge->hasFile('comprovativoPagamento')) {
          $fileproof = $requestCharge->file('comprovativoPagamento');
          $imgproof = strtolower($docTrasancao->descricao).'_comprovativo_'.$docTrasancao->idDocTransacao.'.' . $fileproof->getClientOriginalExtension();
          Storage::disk('public')->putFileAs('payment-proof/', $fileproof, $imgproof);
          $docTrasancao->comprovativoPagamento = $imgproof;
          $docTrasancao->save();
      }

      if ($docTrasancao->valorRecebido >= $fase->valorFase) {
        Fase::where('descricao', '=', $fase->descricao)->update(['verificacaoPago' => '1']);
      }

      return redirect()->route('charges.show', $product)->with('success', 'Estado da cobrança alterado com sucesso!');
    }

    public function edit(Produto $product, Fase $fase, DocTransacao $paymentProof, Conta $contas)
    {
      $contas = Conta::all();
      return view('charges.edit', compact('product', 'fase', 'paymentProof', 'contas'));
    }

    public function update(UpdateChargeRequest $requestCharge, Produto $product, DocTransacao $paymentProof)
    {
      $fields = $requestCharge->validated();
      $paymentProof->fill($fields);

      $value = number_format((float) $paymentProof->valorRecebido,2 ,'.' ,'');
      $paymentProof->valorRecebido = $value;

      if ($requestCharge->hasFile('comprovativoPagamento')) {
          $fileproof = $requestCharge->file('comprovativoPagamento');
          $imgproof = strtolower($paymentProof->descricao) . '_comprovativo_'. $paymentProof->idDocTransacao .'.' . $fileproof->getClientOriginalExtension();
          if (!empty($paymentProof->comprovativoPagamento)) {
              Storage::disk('public')->delete('payment-proof/' . $paymentProof->comprovativoPagamento);
          }
          Storage::disk('public')->putFileAs('payment-proof/', $fileproof, $imgproof);
          $paymentProof->comprovativoPagamento = $imgproof;
      }

      $paymentProof->save();

      if ($paymentProof->valorRecebido >= $paymentProof->fase->valorFase) {
        Fase::where('descricao', '=', $paymentProof->fase->descricao)->update(['verificacaoPago' => '1']);
      }else {
        Fase::where('descricao', '=', $paymentProof->fase->descricao)->update(['verificacaoPago' => '0']);
      }

      return redirect()->route('charges.show', $product)->with('success', 'Estado da cobrança editado com sucesso!');
    }

    public function test(DocTransacao $paymentProof)
    {
      dd($paymentProof);
    }
}
