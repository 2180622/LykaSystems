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
use App\Http\Requests\UpdateFaseRequest;
use App\Http\Requests\StoreFaseRequest;

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
        $Fases=null;
        $Responsabilidades = null;

        for($i=0;$i<20;$i++){
            $Fases[] = new Fase;
            $Responsabilidades[] = new Responsabilidade;
        }

        return view('produtos.add',compact('produto','produtoStock','cliente','Agentes','SubAgentes','Universidades','Fases','Responsabilidades'));
    }




    /***********************************************************************//*
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    * @param  \App\User  $user
    */
    public function store(StoreProdutoRequest $request, Cliente $cliente){

        $fields = $request->all();
        $produto = new Produto;
        $produto->tipo = $fields['tipo'];
        $produto->descricao = $fields['descricao'];
        $produto->anoAcademico = $fields['anoAcademico'];
        $produto->idCliente = $cliente->idCliente;
        $produto->idAgente = $fields['agente'];
        $produto->idSubAgente = $fields['subagente'];
        $produto->idUniversidade1 = $fields['uni1'];
        $produto->idUniversidade2 = $fields['uni2'];
        $produto->valorTotal = 0;
        $produto->valorTotalAgente = 0;
        $produto->valorTotalSubAgente = 0;
        //dd($fields);

        $t=time();
        $produto->create_at == date("Y-m-d",$t);
        
        $produto->save();
        for($i=1;$i<=20;$i++){
            if($fields['resp-cliente-fase'.$i]!=null&&$fields['resp-agente-fase'.$i]!=null&&$fields['resp-uni1-fase'.$i]!=null){
                $fase = new Fase;
                $responsabilidade = new Responsabilidade;
                $responsabilidade->valorCliente = $fields['resp-cliente-fase'.$i];
                $responsabilidade->valorAgente = $fields['resp-agente-fase'.$i];
                $responsabilidade->valorSubAgente = $fields['resp-subagente-fase'.$i];
                $responsabilidade->valorUniversidade1 = $fields['resp-uni1-fase'.$i];
                $responsabilidade->valorUniversidade2 = $fields['resp-uni2-fase'.$i];
                $responsabilidade->verificacaoPagoCliente = false;
                $responsabilidade->verificacaoPagoAgente = false;
                $responsabilidade->verificacaoPagoSubAgente = false;
                $responsabilidade->verificacaoPagoUni1 = false;
                $responsabilidade->verificacaoPagoUni2 = false;
                $responsabilidade->save();
                
                $fase->descricao = $fields['des-fase'.$i];
                $fase->dataVencimento = date("Y-m-d",$fields['data-fase'.$i]);
                $fase->valorFase = $fields['resp-agente-fase'.$i];
                $fase->create_at == date("Y-m-d",$t);
                $fase->idResponsabilidade = $responsabilidade->idResponsabilidade;
                $fase->idProduto = $produto->idProduto;
                $fase->save();
            }
        }

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
        $Fornecedores = Fornecedor::all();
        $Agentes = Agente::where('tipo','=','Agente')->orderBy('nome')->get();
        $SubAgentes = Agente::where('tipo','=','Subagente')->orderBy('nome')->get();
        $Universidades = Universidade::all();
        $fases = $produto->fase;
        $responsabilidades = null;
        $relacoes = null;
        $i=0;
        foreach($fases as $fase){
            $resp = $fase->responsabilidade;
            $responsabilidades[$i]['idFase'] = $fase->idFase;
            $responsabilidades[$i]['idResponsabilidade'] = $resp->idResponsabilidade;
            $responsabilidades[$i]['descricao'] = $fase->idFase;
            $responsabilidades[$i]['valorCliente'] = $fase->idFase;
            $responsabilidades[$i]['valorAgente'] = $fase->idFase;
            $responsabilidades[$i]['valorSubAgente'] = $fase->idFase;
            $responsabilidades[$i]['valorUniversidade1'] = $fase->idFase;
            $responsabilidades[$i]['valorUniversidade2'] = $fase->idFase;
            $rels = $resp->relacao;
            $i2 = 0;
            foreach($rels as $relacao){
                $relacoes[$i][$i2]['idFase'] = $fase->idFase;
                $relacoes[$i][$i2]['idResponsabilidade'] = $relacao->idResponsabilidade;
                $relacoes[$i][$i2]['idFornecedor'] = $relacao->idFornecedor;
                $relacoes[$i][$i2]['valor'] = $relacao->valor;
                $i2++;
            }
            $i++;
        }

        return view('produtos.edit', compact('produto','Agentes','SubAgentes','Universidades','fases','responsabilidades','Fornecedor'));
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
