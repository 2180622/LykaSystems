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
}
