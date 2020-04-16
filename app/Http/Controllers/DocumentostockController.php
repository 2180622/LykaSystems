<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\DocStock;
use App\FaseStock;
use App\Http\Requests\StoreDocstockRequest;

class DocumentostockController extends Controller
{
    public function create(){
        $docStock = new DocStock();

        return view('documentostock.add', compact('docStock'));
    }

    public function store(StoreDocstockRequest $requestDoc, FaseStock $fasestock){
        $docFields = $requestDoc->validated();

        $docStock = new DocStock();
        $docStock->fill($docFields);
        $idFaseStock = $fasestock->idFaseStock;
        $docStock->idFaseStock = $idFaseStock;

        $docStock->save();

        return redirect()->route('produtostock.index')->with('success', 'Documento stock adicionado com sucesso');
    }
}
