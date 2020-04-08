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

    public function showfase(Produto $product, Fase $fase, Responsabilidade $responsabilidades)
    {
      $responsabilidades = Responsabilidade::where('idResponsabilidade', '=', $fase->idResponsabilidade)->get();
      return view('charges.showfase', compact('product', 'fase', 'responsabilidades'));
    }
}
