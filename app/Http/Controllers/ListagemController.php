<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ListagemController extends Controller
{
    public function index()
    {
      return view('listagens.list');
    }
}
