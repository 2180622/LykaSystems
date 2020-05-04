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
                $infoDoc['dataValidPP'] = date("Y-m-d",strtotime($fields['dataValidPP']));
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
            $documento->dataValidade = date("Y-m-d",strtotime($fields['dataValidade'].'-1'));
            if(Auth()->user()->tipo == 'admin' && Auth()->user()->idAdmin != null){
                $documento->verificacao = true;
            }else{
                $documento->verificacao = false;
            }
            $documento->idCliente = $fase->produto->cliente->idCliente;
            $documento->idFase = $fase->idFase;
            $imagem = $fields['img_doc'];
            $documento->imagem = 'source';//$imagem->originalName;
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
        if((Auth()->user()->tipo == 'admin' && Auth()->user()->idAdmin != null) || (Auth()->user()->tipo == 'agente' && Auth()->user()->idAgente != null)){
            $Fornecedores = Fornecedor::all();
            $Agentes = Agente::where('tipo','=','Agente')->orderBy('nome')->get();
            $SubAgentes = Agente::where('tipo','=','Subagente')->orderBy('nome')->get();
            $Universidades = Universidade::all();
            $relacao = new RelFornResp;
            $relacao->valor=0;
            $fases = $produto->fase;

            return view('produtos.edit', compact('produto','Agentes','SubAgentes','Universidades','fases','Fornecedores','relacao'));
        }else{
            return redirect()->route('clients.show',$cliente);
        }
    }



    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \App\Cliente  $user
    * @return \Illuminate\Http\Response
    */

    public function update(UpdateProdutoRequest $request, Produto $produto)
    {
        if((Auth()->user()->tipo == 'admin' && Auth()->user()->idAdmin != null) || (Auth()->user()->tipo == 'agente' && Auth()->user()->idAgente != null)){

            return redirect()->route('clients.show',$produto->cliente)->with('success', 'Dados do produto modificados com sucesso');
        }else{
            return redirect()->route('clients.show',$cliente);
        }

    }






    /**
    * Remove the specified resource from storage.
    *
    * @param  \App\Cliente  $client
    * @return \Illuminate\Http\Response
    */

    public function destroy(Produto $produto)
    {
        if(Auth()->user()->tipo == 'admin' && Auth()->user()->idAdmin != null){
            $produto->delete();
            $fases = $produto->fase;
            foreach($fases as $fase){
                $responsabilidade = $fase->responsabilidade;
                $responsabilidade->delete();
                $fase->delete();
            }
            return redirect()->route('clients.show',$produto->cliente)->with('success', 'Produto eliminado com sucesso');
        }else{
            return redirect()->route('clients.show',$cliente);
        }
    }
}
