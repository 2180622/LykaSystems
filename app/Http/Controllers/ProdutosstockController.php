<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\ProdutoStock;

class ProdutosstockController extends Controller
{
    public function index()
    {
          $produtoStocks = ProdutoStock::all();
          $totalprodutostock = $produtoStocks->count();

          return view('produtostock.list', compact('produtoStocks', 'totalprodutostock'));
    }
}
