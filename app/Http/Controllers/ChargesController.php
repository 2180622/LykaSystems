<?php

namespace App\Http\Controllers;

use App\Fase;
use App\Produto;
use App\Responsabilidade;
use Illuminate\Http\Request;

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
      return view('charges.showcharge', compact('product', 'fase'));
    }

    public function update(Produto $product, Fase $fase, DocTransacao $docTrasancao)
    {
      // Relacionar o DocTransacao com a conta e a fase em questão
    }
}
