<?php

namespace App\Http\Controllers;

use App\Agente;
use App\Cliente;
use App\Fase;
use App\Fornecedor;
use App\Produto;
use App\ProdutoStock;
use App\Responsabilidade;
use App\Universidade;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateProdutoRequest;
use App\Http\Requests\StoreProdutoRequest;

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
        $produto->idCLiente = $cliente->idCliente;
        $produtoStock = ProdutoStock::all();
        $Agentes = Agente::where('tipo','=','Agente')->orderBy('nome')->get();
        $SubAgentes = Agente::where('tipo','=','Subagente')->orderBy('nome')->get();
        $Universidades = Universidade::all();
        $Fases=null;
        $Responsabilidades = null;

        for($i=0;$i<20;$i++){
            $Fases[] = new Fase;
            $responsabilidade = new Responsabilidade;
            $responsabilidade->valorCliente = 0;
            $responsabilidade->valorAgente = 0;
            $responsabilidade->valorSubAgente = 0;
            $responsabilidade->valorUniversidade1 = 0;
            $responsabilidade->valorUniversidade2 = 0;
            $Responsabilidades[] = $responsabilidade;
        }

        return view('produtos.add',compact('produto','produtoStock','cliente','Agentes','SubAgentes','Universidades','Fases','Responsabilidades'));
    }




    /***********************************************************************//*
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    * @param  \App\User  $user
    */
    public function store(StoreProdutoRequest $request){

        $fields = $request->all();

        $produto = new Produto;
        $produto->tipo = $fields['tipo'];
        $produto->descricao = $fields['descricao'];
        $produto->anoAcademico = $fields['anoAcademico'];
        $produto->idCliente = $fields['idCliente'];
        $produto->idAgente = $fields['agente'];
        $produto->idSubAgente = $fields['subagente'];
        $produto->idUniversidade1 = $fields['uni1'];
        $produto->idUniversidade2 = $fields['uni2'];

        $t=time();
        $produto->create_at == date("Y-m-d",$t);
        
        $produto->save();
        $valorProduto = 0;
        $valorTAgente = 0;
        $valorTSubAgente = 0;

        for($i=1;$i<=20;$i++){
            if($fields['descricao-fase'.$i]!=null){
                $fase = new Fase;
                $responsabilidade = new Responsabilidade;
                $responsabilidade->valorCliente = $fields['resp-cliente-fase'.$i];
                $responsabilidade->valorAgente = $fields['resp-agente-fase'.$i];
                if($produto->idSubAgente){
                    $responsabilidade->valorSubAgente = $fields['resp-subagente-fase'.$i];
                }else{
                    $responsabilidade->valorSubAgente = null;
                }
                $responsabilidade->valorUniversidade1 = $fields['resp-uni1-fase'.$i];
                if($produto->idUniversidade2){
                    $responsabilidade->valorUniversidade2 = $fields['resp-uni2-fase'.$i];
                }else{
                    $responsabilidade->valorUniversidade2 = null;
                }
                $responsabilidade->verificacaoPagoCliente = false;
                $responsabilidade->verificacaoPagoAgente = false;
                $responsabilidade->verificacaoPagoSubAgente = false;
                $responsabilidade->verificacaoPagoUni1 = false;
                $responsabilidade->verificacaoPagoUni2 = false;
                $responsabilidade->save();
                

                $fase->descricao = $fields['descricao-fase'.$i];
                $fase->dataVencimento = date("Y-m-d",strtotime($fields['data-fase'.$i]));
                $fase->idFaseStock = $fields['fase-idStock'.$i];
                $fase->valorFase = $responsabilidade->valorCliente + $responsabilidade->valorAgente + 
                    $responsabilidade->valorSubAgente + $responsabilidade->valorUniversidade1 +$responsabilidade->valorUniversidade2;
                $fase->create_at == date("Y-m-d",$t);
                $fase->idResponsabilidade = $responsabilidade->idResponsabilidade;
                $fase->idProduto = $produto->idProduto;
                $fase->save();


                $valorProduto = $valorProduto + $fase->valorFase;
                $valorTAgente = $valorTAgente + $responsabilidade->valorAgente;
                $valorTSubAgente = $valorTSubAgente + $responsabilidade->valorSubAgente;
            }
        }

        $produto->valorTotal = $valorProduto;
        $produto->valorTotalAgente = $valorTAgente;
        if($produto->idSubAgente){
            $produto->valorTotalSubAgente = $valorTSubAgente;
        }
        $produto->save();

        return redirect()->route('clients.show',$produto->cliente)->with('success', 'Produto criada com sucesso');
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
        $Fornecedores = Fornecedor::all();
        $Agentes = Agente::where('tipo','=','Agente')->orderBy('nome')->get();
        $SubAgentes = Agente::where('tipo','=','Subagente')->orderBy('nome')->get();
        $Universidades = Universidade::all();
        $fases = $produto->fase;

        return view('produtos.edit', compact('produto','Agentes','SubAgentes','Universidades','fases','Fornecedores'));
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
        $fases = $produto->fase;
        $fields = $request->all();
        //dd($fields);
        $produto->tipo = $fields['tipo'];
        $produto->descricao = $fields['descricao'];
        $produto->anoAcademico = $fields['anoAcademico'];
        $produto->idAgente = $fields['agente'];
        $produto->idSubAgente = $fields['subagente'];
        $produto->idUniversidade1 = $fields['uni1'];
        $produto->idUniversidade2 = $fields['uni2'];

        // data em que foi modificado
        $t=time();
        $produto->updated_at == date("Y-m-d",$t);
        
        $produto->save();
        $valorProduto = 0;
        $valorTAgente = 0;
        $valorTSubAgente = 0;

        foreach($fases as $fase){
            $responsabilidade = $fase->responsabilidade;
            if($responsabilidade->valorCliente != $fields['resp-cliente-fase'.$fase->idFase]){
                $responsabilidade->valorCliente = $fields['resp-cliente-fase'.$fase->idFase];
                $responsabilidade->verificacaoPagoCliente = false;
            }

            if($responsabilidade->valorAgente != $fields['resp-agente-fase'.$fase->idFase]){
                $responsabilidade->valorAgente = $fields['resp-agente-fase'.$fase->idFase];
                $responsabilidade->verificacaoPagoAgente = false;
            }

            if($produto->idSubAgente && $responsabilidade->valorSubAgente != $fields['resp-subagente-fase'.$fase->idFase]){
                $responsabilidade->valorSubAgente = $fields['resp-subagente-fase'.$fase->idFase];
                $responsabilidade->verificacaoPagoSubAgente = false;
            }

            if($responsabilidade->valorUniversidade1 != $fields['resp-uni1-fase'.$fase->idFase]){
                $responsabilidade->valorUniversidade1 = $fields['resp-uni1-fase'.$fase->idFase];
                $responsabilidade->verificacaoPagoUni1 = false;
            }

            if($produto->idUniversidade2 && $responsabilidade->valorUniversidade2 = $fields['resp-uni2-fase'.$fase->idFase]){
                $responsabilidade->valorUniversidade2 = $fields['resp-uni2-fase'.$fase->idFase];
                $responsabilidade->verificacaoPagoUni2 = false;
            }
            $responsabilidade->save();
            

            $fase->descricao = $fields['descricao-fase'.$fase->idFase];
            $fase->dataVencimento = date("Y-m-d",strtotime($fields['data-fase'.$fase->idFase]));
            $fase->valorFase = $responsabilidade->valorCliente + $responsabilidade->valorAgente + 
                $responsabilidade->valorSubAgente + $responsabilidade->valorUniversidade1 +$responsabilidade->valorUniversidade2;
            $fase->create_at == date("Y-m-d",$t);
            $fase->idResponsabilidade = $responsabilidade->idResponsabilidade;
            $fase->idProduto = $produto->idProduto;
            $fase->save();


            $valorProduto = $valorProduto + $fase->valorFase;
            $valorTAgente = $valorTAgente + $responsabilidade->valorAgente;
            $valorTSubAgente = $valorTSubAgente + $responsabilidade->valorSubAgente;
        }

        $produto->valorTotal = $valorProduto;
        $produto->valorTotalAgente = $valorTAgente;
        if($produto->idSubAgente){
            $produto->valorTotalSubAgente = $valorTSubAgente;
        }
        $produto->save();

         return redirect()->route('clients.show',$produto->cliente)->with('success', 'Dados do produto modificados com sucesso');

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
