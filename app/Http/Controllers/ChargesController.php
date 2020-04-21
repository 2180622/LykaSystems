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
      $fasesPendentes = Fase::where('estado', '=', 'Pendente')->get();
      $fasesPagas = Fase::where('estado', '=', 'Pago')->get();
      $fasesDivida = Fase::where('estado', '=', 'Dívida')->get();
      $numberProducts = Produto::where('valorTotal', '!=', '0')->get();
      return view('charges.list', compact('products', 'numberProducts', 'fasesPendentes', 'fasesPagas', 'fasesDivida'));
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

      switch ($docTrasancao->valorRecebido) {
        case $docTrasancao->valorRecebido == $fase->valorFase:
          Fase::where('idFase', '=', $fase->idFase)
          ->update([
            'verificacaoPago' => '1',
            'estado' => 'Pago'
          ]);
          break;

        case $docTrasancao->valorRecebido > $fase->valorFase:
          Fase::where('idFase', '=', $fase->idFase)
          ->update([
            'verificacaoPago' => '1',
            'estado' => 'Crédito'
          ]);
          break;

        case $docTrasancao->valorRecebido < $fase->valorFase:
          Fase::where('idFase', '=', $fase->idFase)
          ->update(['estado' => 'Dívida']);
          break;
      }

      return redirect()->route('charges.show', $product)->with('success', 'Estado da cobrança alterado com sucesso!');
    }

    public function edit(Produto $product, Fase $fase, DocTransacao $document, Conta $contas)
    {
      $contas = Conta::all();
      return view('charges.edit', compact('product', 'fase', 'document', 'contas'));
    }

    public function update(UpdateChargeRequest $requestCharge, Produto $product, DocTransacao $document)
    {
      $fields = $requestCharge->validated();
      $document->fill($fields);

      $value = number_format((float) $document->valorRecebido,2 ,'.' ,'');
      $document->valorRecebido = $value;

      if ($requestCharge->hasFile('comprovativoPagamento')) {
          $fileproof = $requestCharge->file('comprovativoPagamento');
          $imgproof = strtolower(preg_replace('/\s+/', '_', $document->descricao)) . '_comprovativo_'. $document->idDocTransacao .'.' . $fileproof->getClientOriginalExtension();
          if (!empty($document->comprovativoPagamento)) {
              Storage::disk('public')->delete('payment-proof/'.$document->comprovativoPagamento);
          }
          Storage::disk('public')->putFileAs('payment-proof/', $fileproof, $imgproof);
          $document->comprovativoPagamento = $imgproof;
      }

      $document->save();

      if ($document->valorRecebido >= $document->fase->valorFase) {
        Fase::where('descricao', '=', $document->fase->descricao)->update(['verificacaoPago' => '1']);
      }else {
        Fase::where('descricao', '=', $document->fase->descricao)->update(['verificacaoPago' => '0']);
      }

      return redirect()->route('charges.show', $product)->with('success', 'Estado da cobrança editado com sucesso!');
    }

    public function download(DocTransacao $document)
    {
      return Storage::disk('public')->download('payment-proof/'.$document->comprovativoPagamento);
    }
}
