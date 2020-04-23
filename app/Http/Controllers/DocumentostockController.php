<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\DocStock;
use App\FaseStock;
use App\Http\Requests\StoreDocstockRequest;
use Illuminate\Support\Facades\Auth;

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
        if($docStock->tipo == "Pessoal"){
            $docStock->tipoAcademico = null;
        }else {
            $docStock->tipoPessoal = null;
        }

        $docStock->save();

        return redirect()->route('produtostock.index')->with('success', 'Documento stock adicionado com sucesso');
    }

    public function show(DocStock $documentostock){
        // $documentostock = DocStock::where('idFaseStock', '=', $fasestock->idFaseStock)->get();

        return view('documentostock.show', compact('documentostock'));
    }

    public function edit(DocStock $documentostock)
    {
        if (Auth::user()->tipo == "admin"){

            return view('documentostock.edit', compact('documentostock'));
        }else{
            /* não tem permissões */
            abort (401);
      }
    }

    public function update(StoreDocstockRequest $request, DocStock $documentostock)
    {
        $fields = $request->validated();
        $documentostock->fill($fields);

        // data em que foi modificado
        $t=time();
        $documentostock->updated_at == date("Y-m-d",$t);
        $documentostock->save();

        return redirect()->route('produtostock.index')->with('success', 'Dados do documento de stock modificados com sucesso');
    }

    public function destroy(DocStock $documentostock){
        $documentostock->delete();

        return redirect()->route('produtostock.index')->with('success', 'Documento stock eliminado com sucesso');
    }
}
