<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ListagemController extends Controller
{
    public function index()
    {
        if(Auth()->user()->tipo == 'admin' && Auth()->user()->idAdmin != null && Auth()->user()->admin->superAdmin){
            return view('listagens.list');
        }else{
            abort(401);
        }
    }

    public function getList($tipo, $pais, $cidade, $agente, $subagente, $universidade, $curso, $intitutoOrigem, $atividade)
    {
        if(Auth()->user()->tipo == 'admin' && Auth()->user()->idAdmin != null && Auth()->user()->admin->superAdmin){
            return view('listagens.list');
        }else{
            abort(401);
        }
    }
}
