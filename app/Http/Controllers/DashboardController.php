<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Agente;
use App\Cliente;
use App\Universidade;


class DashboardController extends Controller{

    public function index(){
        $agente = Agente::all();
        $cliente = Cliente::all();
        $universidade = Universidade::all();

        $agenteCount = count($agente);
        $clienteCount = count($cliente);
        $universidadeCount = count($universidade);

        return view('index', compact('agenteCount', 'clienteCount', 'universidadeCount'));
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
