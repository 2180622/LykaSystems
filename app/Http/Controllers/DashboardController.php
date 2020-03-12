<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Administrador;
use App\Agente;
use App\Cliente;


class DashboardController extends Controller{

    public function index(){
        $agente = Agente::all();
        $cliente = Cliente::all();

        $agenteCount = count($agente);
        $clienteCount = count($cliente);

        return view('index', compact('agenteCount', 'clienteCount'));
    }

    public function create(){
        //
    }

    public function store(Request $request){
        //
    }

    public function show($id){
        //
    }

    public function edit($id){
        //
    }

    public function update(Request $request, $id){
        //
    }

    public function destroy($id){
        //
    }
}
