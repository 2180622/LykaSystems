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
use App\RelFornResp;
use App\DocNecessario;
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
        if(Auth()->user()->tipo == 'admin' && Auth()->user()->idAdmin != null){
            $cliente = $client;
            $produto = new Produto;
            $produto->idCLiente = $cliente->idCliente;
            $produtoStock = ProdutoStock::all();
            $Agentes = Agente::where('tipo','=','Agente')->orderBy('nome')->get();
            $SubAgentes = Agente::where('tipo','=','Subagente')->orderBy('nome')->get();
            $Universidades = Universidade::all();
            $Fornecedores = Fornecedor::all();
            $Fases=null;
            $Responsabilidades = null;
            $relacao = new RelFornResp;
            //$relacao->valor=0;

            for($i=0;$i<20;$i++){
                $fase = new Fase;
                //$fase->valorFase = 0;
                $Fases[] = $fase;
                $responsabilidade = new Responsabilidade;
                /*$responsabilidade->valorCliente = 0;
                $responsabilidade->valorAgente = 0;
                $responsabilidade->valorSubAgente = 0;
                $responsabilidade->valorUniversidade1 = 0;
                $responsabilidade->valorUniversidade2 = 0;*/
                $Responsabilidades[] = $responsabilidade;
            }

            return view('produtos.add',compact('produto','produtoStock','cliente','Agentes','SubAgentes','Universidades','Fases','Responsabilidades','Fornecedores','relacao'));
        }else{
            return redirect()->route('clients.show',$cliente);
        }
    }




    /***********************************************************************//*
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    * @param  \App\User  $user
    */
    public function store(StoreProdutoRequest $request, ProdutoStock $produtoStock){

        if(Auth()->user()->tipo == 'admin' && Auth()->user()->idAdmin != null){
            $fields = $request->all();

            $produto = new Produto;
            $produto->tipo = $fields['tipo'];
            $produto->descricao = $fields['descricao'];
            $produto->anoAcademico = $fields['anoAcademico'];
            $produto->idCliente = $fields['idCliente'];
            $produto->idAgente = $fields['agente'];
            $produto->idSubAgente = null;
            $produto->idUniversidade1 = $fields['uni1'];
            $produto->idUniversidade2 = $fields['uni2'];
            $produto->valorTotal = 0;
            $produto->valorTotalAgente = 0;

            $t=time();
            $produto->create_at == date("Y-m-d",$t);
            
            $produto->save();
            $valorProduto = 0;
            $valorTAgente = 0;
            $valorTSubAgente = 0;

            $fasesStock = $produtoStock->faseStock;

            for($i=1;$i<=20;$i++){
                if($fields['descricao-fase'.$i]!=null){
                    $fase = new Fase;
                    $responsabilidade = new Responsabilidade;
                    $valorRelacoes = 0;
                    $responsabilidade->valorCliente = $fields['resp-cliente-fase'.$i];
                    $responsabilidade->dataVencimentoPagamentoCliente = $fields['resp-data-cliente-fase'.$i];
                    $responsabilidade->valorAgente = $fields['resp-agente-fase'.$i];
                    $responsabilidade->dataVencimentoPagamentoAgente = $fields['resp-data-agente-fase'.$i];
                    $responsabilidade->valorSubAgente = null;
                    $responsabilidade->dataVencimentoPagamentoSubAgente = null;
                    $responsabilidade->valorUniversidade1 = $fields['resp-uni1-fase'.$i];
                    $responsabilidade->dataVencimentoPagamentoUni1 = $fields['resp-data-uni1-fase'.$i];
                    if($produto->idUniversidade2){
                        $responsabilidade->valorUniversidade2 = $fields['resp-uni2-fase'.$i];
                        $responsabilidade->dataVencimentoPagamentoUni2 = $fields['resp-data-uni2-fase'.$i];
                    }else{
                        $responsabilidade->valorUniversidade2 = null;
                        $responsabilidade->dataVencimentoPagamentoUni2 = null;
                    }
                    $responsabilidade->verificacaoPagoCliente = false;
                    $responsabilidade->verificacaoPagoAgente = false;
                    $responsabilidade->verificacaoPagoSubAgente = false;
                    $responsabilidade->verificacaoPagoUni1 = false;
                    $responsabilidade->verificacaoPagoUni2 = false;
                    $responsabilidade->save();
                    
                    for($numF=1;$numF<=500;$numF++){
                        if(array_key_exists("fornecedor".$numF."-fase".$i, $fields)){
                            if($fields["fornecedor".$numF."-fase".$i]){
                                $relacao = new RelFornResp;
                                $relacao->idFornecedor = $fields["fornecedor".$numF."-fase".$i];
                                $relacao->idResponsabilidade = $responsabilidade->idResponsabilidade;
                                $relacao->valor = $fields["valor-fornecedor".$numF."-fase".$i];
                                $relacao->create_at == date("Y-m-d",$t);
                                $relacao->save();

                                $valorRelacoes = $valorRelacoes + $relacao->valor;
                            }
                        }else{
                            break;
                        }
                    }

                    $fase->descricao = $fields['descricao-fase'.$i];
                    $fase->dataVencimento = date("Y-m-d",strtotime($fields['data-fase'.$i]));
                    $fase->valorFase = $fields['valor-fase'.$i];
                    $fase->create_at == date("Y-m-d",$t);
                    $fase->idResponsabilidade = $responsabilidade->idResponsabilidade;
                    $fase->idProduto = $produto->idProduto;
                    $fase->save();

                    $docsStock = $fasesStock[$i-1]->docStock;
                    foreach($docsStock as $doc){
                        $documento = new DocNecessario;
                        $documento->tipo = $doc->tipo;
                        $documento->tipoPessoal = $doc->tipoPessoal;
                        $documento->tipoAcademico = $doc->tipoAcademico;
                        $documento->idFase = $fase->idFase;
                        $documento->save();
                    }

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
        }else{
            return redirect()->route('clients.show',$cliente);
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
        if((Auth()->user()->tipo == 'admin' && Auth()->user()->idAdmin != null)||
        (Auth()->user()->tipo == 'agente' && Auth()->user()->idAgente != null && Auth()->user()->agente->tipo == "Agente")){
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
        if((Auth()->user()->tipo == 'admin' && Auth()->user()->idAdmin != null)||
        (Auth()->user()->tipo == 'agente' && Auth()->user()->idAgente != null && Auth()->user()->agente->tipo == "Agente")){
            $fases = $produto->fase;
            $fields = $request->all();
            //dd($fields);
            $produto->tipo = $fields['tipo'];
            $produto->descricao = $fields['descricao'];
            $produto->anoAcademico = $fields['anoAcademico'];
            $produto->idAgente = $fields['agente'];
            if(array_key_exists('subagente', $fields)){
                $produto->idSubAgente = $fields['subagente'];
            }
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
                $relacoes = $responsabilidade->relacao;
                $valorRelacoes = 0;
                $responsabilidade->valorCliente = $fields['resp-cliente-fase'.$fase->idFase];
                $responsabilidade->dataVencimentoPagamentoCliente = $fields['resp-data-cliente-fase'.$fase->idFase];
                $responsabilidade->verificacaoPagoCliente = false;

                $valorTotalAgeSubAge = $responsabilidade->valorAgente + $responsabilidade->valorSubAgente;
                $novoValorAgente = null;

                $responsabilidade->valorAgente = $fields['resp-agente-fase'.$fase->idFase];
                $responsabilidade->dataVencimentoPagamentoAgente = $fields['resp-data-agente-fase'.$fase->idFase];
                $responsabilidade->verificacaoPagoAgente = false;

                if(array_key_exists('resp-subagente-fase'.$fase->idFase, $fields)){
                    if($produto->idSubAgente && $responsabilidade->valorSubAgente != $fields['resp-subagente-fase'.$fase->idFase]){
                        $novoValorAgente = $valorTotalAgeSubAge-$fields['resp-subagente-fase'.$fase->idFase];
                        if($novoValorAgente == 0){
                            $responsabilidade->valorAgente = 0;
                        }elseif($novoValorAgente<0){
                            $responsabilidade->valorAgente = 0;
                            $responsabilidade->valorSubAgente = $valorTotalAgeSubAge;
                        }else{
                            $responsabilidade->valorAgente = $novoValorAgente;
                            $responsabilidade->valorSubAgente = $fields['resp-subagente-fase'.$fase->idFase];
                        }
                        $responsabilidade->verificacaoPagoSubAgente = false;
                    }
                    $responsabilidade->dataVencimentoPagamentoSubAgente = $fields['resp-data-subagente-fase'.$fase->idFase];
                }

                if($responsabilidade->valorUniversidade1 != $fields['resp-uni1-fase'.$fase->idFase]){
                    $responsabilidade->valorUniversidade1 = $fields['resp-uni1-fase'.$fase->idFase];
                    $responsabilidade->dataVencimentoPagamentoUni1 = $fields['resp-data-uni1-fase'.$fase->idFase];
                    $responsabilidade->verificacaoPagoUni1 = false;
                }

                if($produto->idUniversidade2 && $responsabilidade->valorUniversidade2 = $fields['resp-uni2-fase'.$fase->idFase]){
                    $responsabilidade->valorUniversidade2 = $fields['resp-uni2-fase'.$fase->idFase];
                    $responsabilidade->dataVencimentoPagamentoUni2 = $fields['resp-data-uni2-fase'.$fase->idFase];
                    $responsabilidade->verificacaoPagoUni2 = false;
                }
                $responsabilidade->save();

                if($relacoes->toArray()){
                    foreach($relacoes as $relacao){
                        $existe = false;
                        for($i=1;$i<=10000;$i++){
                            if(array_key_exists("fornecedor".$i."-fase".$fase->idFase, $fields)){
                                if($fields["fornecedor".$i."-fase".$fase->idFase]==$relacao->idFornecedor){
                                    $relacao->valor = $fields["valor-fornecedor".$i."-fase".$fase->idFase];
                                    $relacao->save();
                                    $existe = true;
                                }
                            }else{
                                break;
                            }
                        }
                        if(!$existe){
                            $relacao->delete();
                        }
                    }
                }

                for($i=1;$i<=10000;$i++){
                    if(array_key_exists("fornecedor".$i."-fase".$fase->idFase, $fields)){
                        if($fields["fornecedor".$i."-fase".$fase->idFase]){
                            $existe = false;
                            if($relacoes->toArray()){
                                foreach($relacoes as $relacao){
                                    if($fields["fornecedor".$i."-fase".$fase->idFase]==$relacao->idFornecedor){
                                        $existe = true;
                                    }
                                }
                            }
                            if(!$existe){
                                $relacao = new RelFornResp;
                                $relacao->idFornecedor = $fields["fornecedor".$i."-fase".$fase->idFase];
                                $relacao->idResponsabilidade = $responsabilidade->idResponsabilidade;
                                $relacao->valor = $fields["valor-fornecedor".$i."-fase".$fase->idFase];
                                $relacao->create_at == date("Y-m-d",$t);
                                $relacao->save();

                                $valorRelacoes = $valorRelacoes + $relacao->valor;
                            }
                        }
                    }else{
                        break;
                    }
                }
                

                $fase->descricao = $fields['descricao-fase'.$fase->idFase];
                $fase->dataVencimento = date("Y-m-d",strtotime($fields['data-fase'.$fase->idFase]));
                $fase->valorFase = $fields['valor-fase'.$fase->idFase];
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
