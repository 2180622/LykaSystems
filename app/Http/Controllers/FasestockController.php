<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\FaseStock;
use App\ProdutoStock;
use App\DocStock;
use App\Http\Requests\StoreFasestockRequest;

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

    public function show(DocStock $documentoStocks, FaseStock $fasestock){
        $nrDocs = 1;
        $docStocks = DocStock::where('idFaseStock', '=', $fasestock->idFaseStock)->get();
        return view('fasestock.show', compact('fasestock', 'docStocks', 'nrDocs'));
    }
}
