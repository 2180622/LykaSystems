<?php
namespace App\Http\Controllers;

use App\Agente;
use App\Cliente;
use App\Universidade;
use Illuminate\Http\Request;

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

    public function report(){
        return view('report');
    }
}
