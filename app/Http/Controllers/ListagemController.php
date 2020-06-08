<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cliente;
use App\Produto;

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

}
