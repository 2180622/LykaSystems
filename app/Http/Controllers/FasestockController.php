<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\FaseStock;
use App\Http\Requests\StoreFasestockRequest;

class FasestockController extends Controller
{
    public function create(){
        $fasestock = new FaseStock();

        return view('fasestock.add', compact('fasestock'));
    }

    public function store(StoreFasestockRequest $requestFase){
        $faseFields = $requestFase->validated();

        $faseStock = new FaseStock();
        $faseStock->fill($faseFields);

        $faseStock->save();

        return redirect()->route('fasestock.index')->with('success', 'Fase stock adicionada com sucesso');
    }
}
