<?php

namespace App\Http\Controllers;

use App\Conta;
use Illuminate\Http\Request;
use App\Http\Requests\StoreContaRequest;
use App\Http\Requests\UpdateContaRequest;

class ContaController extends Controller
{
    public function index()
    {
      $contums = Conta::all();
      return view('conta.list', compact('contums'));
    }

    public function create()
    {
      $contum = new Conta;
      return view('conta.add', compact('contum'));
    }

    public function store(StoreContaRequest $contaRequest)
    {
      $fields = $contaRequest->validated();
      $contum = new Conta;
      $contum->fill($fields);
      $contum->save();
      return redirect()->route('conta.index')->with('success', 'Nova conta bancária criada com sucesso.');
    }

    public function show(Conta $contum)
    {
      return view('conta.show', compact('contum'));
    }

    public function edit(Conta $contum)
    {
      return view('conta.edit', compact('contum'));
    }

    public function update(UpdateContaRequest $contaRequest, Conta $contum)
    {
      $fields = $contaRequest->validated();
      $contum->fill($fields);
      $contum->save();
      return redirect()->route('conta.index')->with('success', 'Conta bancária editada com sucesso.');
    }

    public function destroy(Conta $contum)
    {
      $contum->delete();
      return redirect()->route('conta.index')->with('success', 'Conta bancária eliminada com sucesso');
    }
}
