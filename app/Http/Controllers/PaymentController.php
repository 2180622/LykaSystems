<?php

namespace App\Http\Controllers;

use App\Fase;
use App\Produto;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
      $products = Produto::all();
      $numberProducts = Produto::where('valorTotal', '!=', '0')->get();
      return view('payments.list', compact('products', 'numberProducts'));
    }

    public function show(Fase $fase, Produto $product)
    {
      $fases = Fase::where('idProduto', '=', $product->idProduto)->get();
      return view('payments.show', compact('product', 'fases'));
    }

    public function showfase()
    {
      //Mostrar o pagamento da fase em pormenor com a relação as responsabilidades
    }
}
