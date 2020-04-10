<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\ProdutoStock;
use App\FaseStock;
use App\DocStock;
use App\Http\Requests\StoreProdutosstockRequest;
use App\Http\Requests\StoreFasestockRequest;
use App\Http\Requests\StoreDocstockRequest;

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

    public function store(StoreProdutosstockRequest $requestProduto){
        $produtoFields = $requestProduto->validated();
        // $faseFields = $requestFase->validated();
        // $docFields = $requestDoc->validated();

        $produtoStock = new ProdutoStock();

        $produtoStock->fill($produtoFields);
        //
        // $faseStock = new FaseStock();
        // $faseStock->fill($faseFields);

        $produtoStock->save();
        // $faseStock->idProdutoStock = $produtoStock->idProdutoStock;
        //
        // $docStock = new DocStock();
        // $docStock->fill($docFields);
        //
        // $faseStock->save();
        // $docStock->idFaseStock = $faseStock->idFaseStock;
        //
        // $docStock->save();

        return redirect()->route('produtostock.index')->with('success', 'Adicionado com sucesso');
    }

    public function edit(ProdutoStock $produtoStock)
    {
        if (Auth::user()->tipo == "admin"){
            return view('produtostock.edit', compact('produtoStock'));
        }else{
            /* não tem permissões */
            abort (401);
      }
    }

    public function show(FaseStock $faseStocks,ProdutoStock $produtoStock)
    {
        $faseStocks = FaseStock::where('idProdutoStock', '=', $produtoStock->idProdutoStock)->get();
        return view('produtostock.show', compact('produtoStock', 'faseStocks'));
    }
}
