<?php

namespace App\Http\Controllers;

use App\DocTransacao;
use App\Fase;
use App\Conta;
use App\Http\Requests\UpdateDocumentoRequest;
use App\Http\Requests\StoreDocumentoRequest;
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
        if((Auth()->user()->tipo == 'admin' && Auth()->user()->idAdmin != null)/* || (Auth()->user()->tipo == 'agente' && Auth()->user()->idAgente != null)*/){
            
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
    public function store(StoreDocumentoRequest $request,Fase $fase){

        if(Auth()->user()->tipo == 'admin' && Auth()->user()->idAdmin != null){

            $documento = new DocTransacao;
            
            $fields = $request->all();
            $documento->descricao=$fields['descricao'];
            if($fields['valorRecebido'] && $fields['valorRecebido']!=0){
                $documento->valorRecebido=$fields['valorRecebido'];
                $documento->verificacao = true;
            }else{
                $documento->verificacao = false;
            }
            $documento->tipoPagamento=$fields['tipoPagamento'];
            $documento->dataOperacao=$fields['dataOperacao'];
            $documento->dataRecebido=$fields['dataRecebido'];
            $documento->observacoes=$fields['observacoes'];
            $documento->idConta=$fields['idConta'];
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

            return redirect()->route('produtos.show',$fase->produto)->with('success', 'Transação adicionado com sucesso');
        }else{
            return redirect()->route('produtos.show',$fase->produto);
        }
    }




    /**
    * Show the form for editing the specified resource.
    *
    * @param  \App\Cliente  $client
    * @return \Illuminate\Http\Response
    */
    public function edit(DocTransacao $documento)
    {
        if((Auth()->user()->tipo == 'admin' && Auth()->user()->idAdmin != null)/* || (Auth()->user()->tipo == 'agente' && Auth()->user()->idAgente != null)*/){

            $tipoPAT = 'Transacao';
            $tipo = 'Transacao';
            $Contas = Conta::all();

            return view('documentos.edit', compact('documento','tipo','tipoPAT','Contas'));
        }else{
            return redirect()->route('produtos.show',$documento->fase->produto);
        }
    }



    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \App\Cliente  $user
    * @return \Illuminate\Http\Response
    */

    public function update(UpdateDocumentoRequest $request, DocTransacao $documento)
    {
        if((Auth()->user()->tipo == 'admin' && Auth()->user()->idAdmin != null)/* || (Auth()->user()->tipo == 'agente' && Auth()->user()->idAgente != null)*/){
            
            $fields = $request->all();
            $documento->descricao=$fields['descricao'];
            if($fields['valorRecebido'] && $fields['valorRecebido']!=0){
                $documento->valorRecebido=$fields['valorRecebido'];
                $documento->verificacao = true;
            }else{
                $documento->verificacao = false;
            }
            $documento->tipoPagamento=$fields['tipoPagamento'];
            $documento->dataOperacao=$fields['dataOperacao'];
            $documento->dataRecebido=$fields['dataRecebido'];
            $documento->observacoes=$fields['observacoes'];
            $documento->idConta=$fields['idConta'];

            if(Auth()->user()->tipo == 'admin' && Auth()->user()->idAdmin != null){
                $documento->verificacao = true;
            }else{
                $documento->verificacao = false;
            }
            $source = null;

            if(array_key_exists('img_doc',$fields)){
                if($fields['img_doc']) {
                    $ficheiro = $fields['img_doc'];
                    $nomeficheiro = 'cliente_'.$fase->produto->cliente->idCliente.'_fase_'.$fase->idFase.'_documento_transacao_'.$documento->idDocTransacao.'.'.$ficheiro->getClientOriginalExtension();
                    Storage::disk('public')->putFileAs('client-documents/'.$fase->produto->cliente->idCliente.'/', $ficheiro, $nomeficheiro);
                    $source = 'client-documents/'.$fase->produto->cliente->idCliente.'/'.$nomeficheiro;
                    $documento->comprovativoPagamento = $source;
                }
            }
            $documento->save();

            return redirect()->route('produtos.show',$documento->fase->produto)->with('success', 'Dados da Transação editados com sucesso');
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
            return redirect()->route('produtos.show',$documento->fase->produto)->with('success', 'Transação eliminada com sucesso');
        }else{
            return redirect()->route('produtos.show',$documento->fase->produto);
        }
    }
}
