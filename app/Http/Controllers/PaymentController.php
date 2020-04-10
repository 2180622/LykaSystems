<?php

namespace App\Http\Controllers;

use App\Fase;
use App\Conta;
use App\Produto;
use App\DocTransacao;
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

    public function showpayment(Produto $product, Fase $fase)
    {
      return view('payments.showpayment', compact('product', 'fase'));
    }
}
