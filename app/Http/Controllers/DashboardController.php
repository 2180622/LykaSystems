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

    public function report(){
        return view('report');
    }
}
