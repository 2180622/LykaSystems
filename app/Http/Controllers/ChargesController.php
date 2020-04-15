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
      ->orderBy('dataVencimento', 'ASC')
      ->orderBy('verificacaoPago', 'ASC')
      ->get();
      return view('charges.show', compact('product', 'fases', 'docTrasancao'));
    }

    public function showcharge(Conta $contas, Produto $product, Fase $fase)
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

      $idConta = $request->input('conta');
      $docTrasancao->idConta = $idConta;

      $docTrasancao->descricao = 'Cobrança da '.$fase->descricao;
      $docTrasancao->idFase = $fase->idFase;

      if ($requestCharge->hasFile('comprovativoPagamento')) {
          $fileproof = $requestCharge->file('comprovativoPagamento');
          $imgproof = $docTrasancao->descricao . '_comprovativo'. '.' . $fileproof->getClientOriginalExtension();
          Storage::disk('public')->putFileAs('payment-proof/', $fileproof, $imgproof);
          $docTrasancao->comprovativoPagamento = $imgproof;
          $docTrasancao->save();
      }

      $docTrasancao->save();

      if ($docTrasancao->valorRecebido == $fase->valorFase) {
        Fase::where('descricao', '=', $fase->descricao)->update(['verificacaoPago' => '1']);
      }

      return redirect()->route('charges.show', $product)->with('success', 'Estado da cobrança alterado com sucesso!');
    }
}
