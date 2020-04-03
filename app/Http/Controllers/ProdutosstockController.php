<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\ProdutoStock;
use App\Http\Requests\StoreProdutosstockRequest;

class ProdutosstockController extends Controller
{
    public function index(){
          $produtoStocks = ProdutoStock::all();
          $totalprodutostock = $produtoStocks->count();

          return view('produtostock.list', compact('produtoStocks', 'totalprodutostock'));
    }

    public function create(){
        $produtoStock = new ProdutoStock();

        return view('produtostock.add', compact('ProdutoStock'));
    }

    public function store(storeProdutosstockRequest $request){
        $fields = $request->validated();

        $produtoStock = new ProdutoStock();
        $produtoStock->fill($fields);

        $produtoStock->save();
        return redirect()->route('produtostock.index')->with('success', 'Produto Stock adicionado com sucesso');
    }

    public function edit(ProdutoStock $produtoStock)
    {
        return view('produtostock.edit', compact('produtoStock'));
    }
}
