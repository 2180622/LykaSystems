<?php

namespace App\Http\Controllers;

use App\DocPessoal;
use App\DocNecessario;
use App\Fase;
use App\Http\Requests\UpdateDocumentoRequest;
use App\Http\Requests\StoreDocumentoRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class DocPessoalController extends Controller
{

    /**
    * Display the specified resource.
    *
    * @param  \App\Cliente  $client
    * @return \Illuminate\Http\Response
    */
    public function create(Fase $fase, DocNecessario $docnecessario)
    {
        if((Auth()->user()->tipo == 'admin' && Auth()->user()->idAdmin != null) || (Auth()->user()->tipo == 'agente' && Auth()->user()->idAgente != null)){

            $documento = new DocPessoal;
            $tipoPAT = $docnecessario->tipo;
            $tipo = $docnecessario->tipoDocumento;

            return view('documentos.add',compact('fase','tipoPAT','tipo','documento', 'docnecessario'));
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
    public function store(StoreDocumentoRequest $request,Fase $fase, DocNecessario $docnecessario){

        if((Auth()->user()->tipo == 'admin' && Auth()->user()->idAdmin != null) || (Auth()->user()->tipo == 'agente' && Auth()->user()->idAgente != null)){

            $fields = $request->all();
            //dd($fields);
            $infoDoc = null;
            if(strtolower($docnecessario->tipoDocumento) == "passaport"){
                $infoDoc['numPassaport'] = $fields['numPassaport'];
                $infoDoc['dataValidPP'] = date("Y-m-d",strtotime($fields['dataValidPP']).'-1');
                $infoDoc['passaportPaisEmi'] = $fields['passaportPaisEmi'];
                $infoDoc['localEmissaoPP'] = $fields['localEmissaoPP'];
            }
            for($i=1;$i<=500;$i++){
                if(array_key_exists('nome-campo'.$i, $fields)){
                    if($fields['nome-campo'.$i]){
                        $infoDoc[$fields['nome-campo'.$i]] = $fields['valor-campo'.$i];
                    }
                }else{
                    break;
                }
            }

            $documento = new DocPessoal;
            $documento->tipo=$docnecessario->tipoDocumento;
            if(array_key_exists('dataValidade', $fields)){
                $documento->dataValidade = date("Y-m-d",strtotime($fields['dataValidade'].'-1'));
            }
            if(Auth()->user()->tipo == 'admin' && Auth()->user()->idAdmin != null){
                $documento->verificacao = true;
            }else{
                $documento->verificacao = false;
            }
            $documento->idCliente = $fase->produto->cliente->idCliente;
            $documento->idFase = $fase->idFase;



            $source = null;

            if($fields['img_doc']) {
                $ficheiro = $fields['img_doc'];
                $tipoDoc = str_replace(".","_",str_replace(" ","",$documento->tipo));
                $nomeficheiro = 'cliente_'.$fase->produto->cliente->idCliente.'_fase_'.$fase->idFase.'_documento_pessoal_'.$tipoDoc.'.'.$ficheiro->getClientOriginalExtension();
                Storage::disk('public')->putFileAs('client-documents/'.$fase->produto->cliente->idCliente.'/', $ficheiro, $nomeficheiro);
                $source = 'client-documents/'.$fase->produto->cliente->idCliente.'/'.$nomeficheiro;
            }
            $documento->imagem = $source;
            if($infoDoc){
                $documento->info = json_encode($infoDoc);
            }
            $documento->save();

            return redirect()->route('produtos.show',$fase->produto)->with('success', $docnecessario->tipoDocumento.' adicionado com sucesso');
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
    public function show(DocPessoal $documento)
    {
        return view('documentos.show',compact('documento'));
    }




    /**
    * Show the form for editing the specified resource.
    *
    * @param  \App\Cliente  $client
    * @return \Illuminate\Http\Response
    */
    public function edit(DocPessoal $documento)
    {
        if((Auth()->user()->tipo == 'admin' && Auth()->user()->idAdmin != null) || (Auth()->user()->tipo == 'agente' && Auth()->user()->idAgente != null)){

            $infoDoc = (array)json_decode($documento->info);
            $infoKeys = array_keys($infoDoc);
            $tipoPAT = 'Pessoal';
            $tipo = $documento->tipo;

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

    public function update(UpdateDocumentoRequest $request, DocPessoal $documento)
    {
        if((Auth()->user()->tipo == 'admin' && Auth()->user()->idAdmin != null) || (Auth()->user()->tipo == 'agente' && Auth()->user()->idAgente != null)){

            $fields = $request->all();
            //dd($fields);

            $infoDoc = null;
            if(strtolower($documento->tipo) == "passaport"){
                $infoDoc['numPassaport'] = $fields['numPassaport'];
                $infoDoc['dataValidPP'] = date("Y-m-d",strtotime($fields['dataValidPP']).'-1');
                $infoDoc['passaportPaisEmi'] = $fields['passaportPaisEmi'];
                $infoDoc['localEmissaoPP'] = $fields['localEmissaoPP'];
            }
            for($i=1;$i<=500;$i++){
                if(array_key_exists('nome-campo'.$i, $fields)){
                    if($fields['nome-campo'.$i]){
                        $infoDoc[$fields['nome-campo'.$i]] = $fields['valor-campo'.$i];
                    }
                }else{
                    break;
                }
            }
            
            if(array_key_exists('dataValidade', $fields)){
                $documento->dataValidade = date("Y-m-d",strtotime($fields['dataValidade'].'-1'));
            }
            if(Auth()->user()->tipo == 'admin' && Auth()->user()->idAdmin != null){
                $documento->verificacao = true;
            }else{
                $documento->verificacao = false;
            }
            if($fields['img_doc']){
                $source = null;

                if($fields['img_doc']) {
                    $ficheiro = $fields['img_doc'];
                    $tipoDoc = str_replace(".","_",str_replace(" ","",$documento->tipo));
                    $nomeficheiro = 'cliente_'.$fase->produto->cliente->idCliente.'_fase_'.$fase->idFase.'_documento_pessoal_'.$tipoDoc.'.'.$ficheiro->getClientOriginalExtension();
                    Storage::disk('public')->putFileAs('client-documents/'.$fase->produto->cliente->idCliente.'/', $ficheiro, $nomeficheiro);
                    $source = 'client-documents/'.$fase->produto->cliente->idCliente.'/'.$nomeficheiro;
                }
                $documento->imagem = $source;
            }
            if($infoDoc){
                $documento->info = json_encode($infoDoc);
            }
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

    public function destroy(DocPessoal $documento)
    {
        if(Auth()->user()->tipo == 'admin' && Auth()->user()->idAdmin != null){

            $documento->delete();
            
            return redirect()->route('produtos.show',$documento->fase->produto)->with('success', 'Produto eliminado com sucesso');
        }else{
            return redirect()->route('produtos.show',$documento->fase->produto);
        }
    }
}
