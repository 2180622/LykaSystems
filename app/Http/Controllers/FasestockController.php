<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\FaseStock;
use App\ProdutoStock;
use App\DocStock;
use App\Http\Requests\StoreFasestockRequest;
use Illuminate\Support\Facades\Auth;

class FasestockController extends Controller
{
    public function create(){
        $fasestock = new FaseStock();

        return view('fasestock.add', compact('fasestock'));
    }

    public function store(StoreFasestockRequest $requestFase, ProdutoStock $produtostock){
        $faseFields = $requestFase->validated();

        $faseStock = new FaseStock();
        $faseStock->fill($faseFields);
        $idProdutoStock = $produtostock->idProdutoStock;

        $faseStock->idProdutoStock = $idProdutoStock;

        $faseStock->save();

        return redirect()->route('produtostock.index')->with('success', 'Fase stock adicionada com sucesso');
    }

    public function show(DocStock $docstocks, FaseStock $fasestock){
        $nrDocs = 1;
        $docstocks = DocStock::where('idFaseStock', '=', $fasestock->idFaseStock)->get();
        return view('fasestock.show', compact('fasestock', 'docstocks', 'nrDocs'));
    }

    public function edit(FaseStock $fasestock)
    {
        if (Auth::user()->tipo == "admin"){
            return view('fasestock.edit', compact('fasestock'));
        }else{
            /* não tem permissões */
            abort (401);
      }
    }

    public function update(StoreFasestockRequest $request, FaseStock $fasestock)
    {
        $fields = $request->validated();
        $fasestock->fill($fields);

        // data em que foi modificado
        $t=time();
        $fasestock->updated_at == date("Y-m-d",$t);
        $fasestock->save();

        return redirect()->route('produtostock.index')->with('success', 'Dados da fase de stock modificados com sucesso');
    }

    public function destroy(FaseStock $fasestock){
        $fasestock->delete();

        return redirect()->route('produtostock.index')->with('success', 'Fase stock eliminada com sucesso');
    }
}
