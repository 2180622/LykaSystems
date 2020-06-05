<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateDocumentoRequest;
use App\Http\Requests\StoreDocumentoRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class ListagemController extends Controller
{

    public function index()
    {
        if(Auth()->user()->tipo == 'admin' && Auth()->user()->idAdmin != null && Auth()->user()->admin->superAdmin){

            return view('listagem.list');
        }else{
            abort(401);
        }
    }
}
