<?php

namespace App\Http\Controllers;

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
}
