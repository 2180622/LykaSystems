<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\ProdutoStock;
use App\FaseStock;
use App\DocStock;

class StockController extends Controller
{
    public function produtos(){
        $produtos = ProdutoStock::all();
        return $produtos;
    }
    public function fases($id){
        $fases = FaseStock::where('idProdutoStock','=',$id)->get();
        return $fases;
    }
    public function documentos($id){
        $documentos = DocStock::where('idFaseStock','=',$id)->get();
        return $documentos;
    }
}
