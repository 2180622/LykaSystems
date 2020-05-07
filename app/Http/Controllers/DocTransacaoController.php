<?php

namespace App\Http\Controllers;

use App\DocTransacao;
use App\Fase;
use App\Conta;
use App\Http\Requests\UpdateDocTransacaoRequest;
use App\Http\Requests\StoreDocTransacaoRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class DocTransacaoController extends Controller
{

    /**
    * Display the specified resource.
    *
    * @param  \App\Cliente  $client
    * @return \Illuminate\Http\Response
    */
    public function create(Fase $fase)
    {
        if((Auth()->user()->tipo == 'admin' && Auth()->user()->idAdmin != null) || (Auth()->user()->tipo == 'agente' && Auth()->user()->idAgente != null)){
            
            $documento = new DocTransacao;
            $tipoPAT = 'Transacao';
            $tipo = 'Transacao';
            $Contas = Conta::all();
            
            return view('documentos.add',compact('fase','tipoPAT','tipo','documento','Contas'));
        }else{
            return redirect()->route('produtos.show',$fase->produto);
        }
    }




    /***********************************************************************//*
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    * @param  \App\User  $user
    */
    public function store(StoreDocTransacaoRequest $request,Fase $fase){

        if(Auth()->user()->tipo == 'admin' && Auth()->user()->idAdmin != null){

            $documento = new DocTransacao;
            
            $fields = $request->validated();
            $documento->fill($fields);

            $source = null;

            $documento->comprovativoPagamento = $source;
            
            $documento->idFase = $fase->idFase;
            $documento->save();


            if($fields['img_doc']) {
                $ficheiro = $fields['img_doc'];
                $nomeficheiro = 'cliente_'.$fase->produto->cliente->idCliente.'_fase_'.$fase->idFase.'_documento_transacao_'.$documento->idDocTransacao.'.'.$ficheiro->getClientOriginalExtension();
                Storage::disk('public')->putFileAs('client-documents/'.$fase->produto->cliente->idCliente.'/', $ficheiro, $nomeficheiro);
                $source = 'client-documents/'.$fase->produto->cliente->idCliente.'/'.$nomeficheiro;
            }

            $documento->comprovativoPagamento = $source;
            $documento->save();

            return redirect()->route('produtos.show',$fase->produto)->with('success', 'Documento adicionado com sucesso');
        }else{
            return redirect()->route('produtos.show',$fase->produto);
        }
    }




    /**
    * Display the specified resource.
    *
    * @param  \App\Cliente  $client
    * @return \Illuminate\Http\Response
    */
    public function show(DocTransacao $documento)
    {

        return view('documentos.show',compact('documento'));
    }









    /**
    * Show the form for editing the specified resource.
    *
    * @param  \App\Cliente  $client
    * @return \Illuminate\Http\Response
    */
    public function edit(DocTransacao $documento, Fase $fase)
    {
        if((Auth()->user()->tipo == 'admin' && Auth()->user()->idAdmin != null) || (Auth()->user()->tipo == 'agente' && Auth()->user()->idAgente != null)){

            $infoDoc = json_decode($documento->info);
            $infoKeys = array_keys($infoDoc);
            $tipoPAT = 'Transacao';
            $tipo = 'Transacao';

            return view('documentos.edit', compact('documento','infoDoc','infoKeys','tipo','tipoPAT'));
        }else{
            return redirect()->route('produtos.show',$fase->produto);
        }
    }



    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \App\Cliente  $user
    * @return \Illuminate\Http\Response
    */

    public function update(UpdateDocTransacaoRequest $request, DocTransacao $documento)
    {
        if((Auth()->user()->tipo == 'admin' && Auth()->user()->idAdmin != null) || (Auth()->user()->tipo == 'agente' && Auth()->user()->idAgente != null)){

            
            $fields = $request->validated();
            $documento->fill($fields);
            $source = null;

            if($fields['img_doc']) {
                $ficheiro = $fields['img_doc'];
                $nomeficheiro = 'cliente_'.$fase->produto->cliente->idCliente.'_fase_'.$fase->idFase.'_documento_transacao_'.$documento->idDocTransacao.'.'.$ficheiro->getClientOriginalExtension();
                Storage::disk('public')->putFileAs('client-documents/'.$fase->produto->cliente->idCliente.'/', $ficheiro, $nomeficheiro);
                $source = 'client-documents/'.$fase->produto->cliente->idCliente.'/'.$nomeficheiro;
            }

            $documento->comprovativoPagamento = $source;
            $documento->idFase = $fase->idFase;
            $documento->save();

            return redirect()->route('produtos.show',$documento->fase->produto)->with('success', 'Dados do produto modificados com sucesso');
        }else{
            return redirect()->route('produtos.show',$documento->fase->produto);
        }

    }






    /**
    * Remove the specified resource from storage.
    *
    * @param  \App\Cliente  $client
    * @return \Illuminate\Http\Response
    */

    public function destroy(DocTransacao $documento)
    {
        if(Auth()->user()->tipo == 'admin' && Auth()->user()->idAdmin != null){
            $documento->delete();
            return redirect()->route('produtos.show',$documento->fase->produto)->with('success', 'Produto eliminado com sucesso');
        }else{
            return redirect()->route('produtos.show',$documento->fase->produto);
        }
    }
}
