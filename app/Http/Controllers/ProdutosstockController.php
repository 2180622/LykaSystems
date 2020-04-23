<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\ProdutoStock;
use App\FaseStock;
use App\DocStock;
use App\Http\Requests\StoreProdutosstockRequest;
use Illuminate\Support\Facades\Auth;

class ProdutosstockController extends Controller
{
    public function index(){
          $produtoStocks = ProdutoStock::all();
          $totalfasestock = FaseStock::all()->count();
          $totaldocstock = DocStock::all()->count();
          $totalprodutostock = $produtoStocks->count();

          return view('produtostock.list', compact('produtoStocks', 'totalprodutostock', 'totalfasestock', 'totaldocstock'));
    }

    public function create(){
        $produtostock = new ProdutoStock();

        return view('produtostock.add', compact('produtostock'));
    }

    public function store(StoreProdutosstockRequest $requestProduto){
        $produtoFields = $requestProduto->validated();

        $produtoStock = new ProdutoStock();
        $produtoStock->fill($produtoFields);

        $produtoStock->save();

        return redirect()->route('produtostock.index')->with('success', 'Produto stock adicionado com sucesso');
    }

    public function edit(ProdutoStock $produtostock)
    {
        if (Auth::user()->tipo == "admin"){
            return view('produtostock.edit', compact('produtostock'));
        }else{
            /* não tem permissões */
            abort (401);
      }
    }

    public function update(StoreProdutosstockRequest $request, ProdutoStock $produtostock)
    {
        $fields = $request->validated();
        $produtostock->fill($fields);

        // data em que foi modificado
        $t=time();
        $produtostock->updated_at == date("Y-m-d",$t);
        $produtostock->save();

        return redirect()->route('produtostock.index')->with('success', 'Dados do produto de stock modificados com sucesso');
    }

    public function show(FaseStock $faseStocks,ProdutoStock $produtostock)
    {
        $nrfases = 1;
        $faseStocks = FaseStock::where('idProdutoStock', '=', $produtostock->idProdutoStock)->get();
        return view('produtostock.show', compact('produtostock', 'faseStocks', 'nrfases'));
    }

    public function destroy(ProdutoStock $produtostock){
        $produtostock->delete();

        return redirect()->route('produtostock.index')->with('success', 'Produto stock eliminado com sucesso');
    }
}
