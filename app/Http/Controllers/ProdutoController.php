<?php

namespace App\Http\Controllers;

use App\Agente;
use App\Cliente;
use App\Produto;
use App\ProdutoStock;
use App\Universidade;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateClienteRequest;
use App\Http\Requests\StoreClientRequest;

class ProdutoController extends Controller
{
    public function index()
    {
          $produtos = Produto::all();
          $totalprodutos = $produtos->count();

          return view('produtos.list', compact('produtos', 'totalprodutos'));
    }




    /**
    * Display the specified resource.
    *
    * @param  \App\Cliente  $client
    * @return \Illuminate\Http\Response
    */
    public function create(Cliente $client)
    {
        $cliente = $client;
        $produto = new Produto;
        $produtoStock = ProdutoStock::all();
        $Agentes = Agente::where('tipo','=','Agente')->orderBy('nome')->get();
        $SubAgentes = Agente::where('tipo','=','Subagente')->orderBy('nome')->get();
        $Universidades = Universidade::all();
        return view('produtos.add',compact('produto','produtoStock','cliente','Agentes','SubAgentes','Universidades'));
    }




    /***********************************************************************//*
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    * @param  \App\User  $user
    */
    public function store(StoreClientRequest $request){

        $fields = $request->validated();
        $produto = new Produto;
        $produto->fill($fields);

        // data em que foi criado

        $t=time();
        $produto->create_at == date("Y-m-d",$t);

        $produto->save();
        return redirect()->route('produtos.index')->with('success', 'Produto criada com sucesso');
    }




    /**
    * Display the specified resource.
    *
    * @param  \App\Cliente  $client
    * @return \Illuminate\Http\Response
    */
    public function show(Produto $produto)
    {
        $Fases = $produto->fase;

        return view('produtos.show',compact("produto",'Fases'));
    }




    /**
    * Prepares document for printing the specified client.
    *
    * @param  \App\Cliente  $client
    * @return \Illuminate\Http\Response
    */
    public function print(Produto $produto)
    {

        return view('produtos.print',compact("produto"));
    }







    /**
    * Show the form for editing the specified resource.
    *
    * @param  \App\Cliente  $client
    * @return \Illuminate\Http\Response
    */
    public function edit(Produto $produto)
    {
        $Agentes = Agente::where('tipo','=','Agente')->orderBy('nome')->get();
        $SubAgentes = Agente::where('tipo','=','Subagente')->orderBy('nome')->get();
        $Universidades = Universidade::all();
        $fases = $produto->fase;

        return view('produtos.edit', compact('produto','Agentes','SubAgentes','Universidades','fases'));
    }



    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \App\Cliente  $user
    * @return \Illuminate\Http\Response
    */

    public function update(UpdateClienteRequest $request, Produto $produto)
    {
        $fields = $request->validated();
        $produto->fill($fields);

        // data em que foi modificado
        $t=time();
        $produto->updated_at == date("Y-m-d",$t);

        $produto->save();


         return redirect()->route('produtos.index')->with('success', 'Dados do produto modificados com sucesso');

    }






    /**
    * Remove the specified resource from storage.
    *
    * @param  \App\Cliente  $client
    * @return \Illuminate\Http\Response
    */

    public function destroy(Produto $produto)
    {
                //$client = client::findOrFail($request->modalclientid);
                $produto->delete();
                return redirect()->route('produtos.index')->with('success', 'Produto eliminado com sucesso');
    }
}
