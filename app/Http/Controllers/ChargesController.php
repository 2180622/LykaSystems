<?php

namespace App\Http\Controllers;

use App\Fase;
use App\Produto;
use App\DocTransacao;
use App\Responsabilidade;
use Illuminate\Http\Request;
use App\Http\Requests\StoreChargeRequest;

class ChargesController extends Controller
{
    public function index()
    {
      $products = Produto::all();
      $numberProducts = Produto::where('valorTotal', '!=', '0')->get();
      return view('charges.list', compact('products', 'numberProducts'));
    }

    public function show(Fase $fase, Produto $product)
    {
      $fases = Fase::where('idProduto', '=', $product->idProduto)->get();
      return view('charges.show', compact('product', 'fases'));
    }

    public function showcharge(Produto $product, Fase $fase)
    {
      $docTrasancao = new DocTransacao;
      return view('charges.showcharge', compact('product', 'fase', 'docTrasancao'));
    }

    public function store(StoreChargeRequest $requestCharge, Produto $product, Fase $fase)
    {
      $docTrasancao = new DocTransacao;
      $fields = $requestCharge->validated();
      $docTrasancao->fill($fields);
      $docTrasancao->descricao = 'Cobrança da '.$fase->descricao;
      $docTrasancao->imagem = 'imagem';
      $docTrasancao->idConta = '1';
      $docTrasancao->idFase = $fase->idFase;
      $docTrasancao->save();

      if ($docTrasancao->valorRecebido == $fase->valorFase) {
        Fase::where('descricao', '=', $fase->descricao)->update(['verificacaoPago' => '1']);
      }

      return redirect()->route('charges.show', $product)->with('success', 'Estado da cobrança alterado com sucesso!');
    }
}
