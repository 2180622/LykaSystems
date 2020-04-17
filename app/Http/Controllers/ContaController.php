<?php

namespace App\Http\Controllers;

use App\Conta;
use Illuminate\Http\Request;

class ContaController extends Controller
{
    public function index()
    {
      $contums = Conta::all();
      return view('conta.list', compact('contums'));
    }
}
