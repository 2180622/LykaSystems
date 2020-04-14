<?php

namespace App\Http\Controllers;

use App\Cliente;
use App\User;
use App\Produto;
use App\DocPessoal;
use App\DocAcademico;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
/* use Illuminate\Http\Request; */

use App\Http\Requests\UpdateClienteRequest;
use App\Http\Requests\StoreClientRequest;
use App\Http\Requests\StoreUserRequest;

use Mail;
use App\Mail\SendEmailConfirmation;


class ClientController extends Controller
{
    public function index()
    {

        /* Permissões */
        if (Auth::user()->tipo == "cliente" ){
            abort (401);
        }


        /* Lista de clientes caso seja admin */
        if (Auth::user()->tipo == "admin"){
            $clients = Cliente::all();

        /* Lista de clientes caso seja agente /  ++++++++FALTA: subagente */
        }else{

            /* Lista todos os produtos registados em nome do agente que está logado */
            /* SELECT Cliente.idCliente,nome,apelido,genero,email,telefone1,telefone2,dataNasc,numCCid,numPassaport,dataValidPP,localEmissaoPP,paisNaturalidade,morada,cidade,moradaResidencia,passaportPaisEmi,nomePai,telefonePai,emailPai,nomeMae,telefoneMae,emailMae,fotografia,NIF,IBAN,nivEstudoAtual,nomeInstituicaoOrigem,cidadeInstituicaoOrigem,obsPessoais,obsFinanceiras,obsAcademicas
            FROM cliente JOIN produto ON Produto.idCliente=Cliente.idCliente where Produto.idAgente="7" GROUP BY cliente.idCliente ORDER BY cliente.idCliente asc */

            $clients = Cliente::
            selectRaw("Cliente.idCliente,nome,apelido,genero,email,telefone1,telefone2,dataNasc,numCCid,numPassaport,dataValidPP,localEmissaoPP,paisNaturalidade,morada,cidade,moradaResidencia,passaportPaisEmi,nomePai,telefonePai,emailPai,nomeMae,telefoneMae,emailMae,fotografia,NIF,IBAN,nivEstudoAtual,nomeInstituicaoOrigem,cidadeInstituicaoOrigem,obsPessoais,obsFinanceiras,obsAcademicas")
            ->join('Produto', 'Cliente.idCliente', '=', 'Produto.idCliente')
            ->where('Produto.idAgente', '=', Auth::user()->agente->idAgente)
            ->groupBy('cliente.idCliente')
            ->orderBy('cliente.idCliente','asc')
            ->get();

        }

        /* mostra a lista */
        $totalestudantes = $clients->count();
        return view('clients.list', compact('clients','totalestudantes'));

    }




    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create()
    {

        if (Auth::user()->tipo == "admin"){
            $client = new Cliente;
            return view('clients.add',compact('client'));
        }else{
            /* não tem permissões */
            abort (401);
        }


    }




    /***********************************************************************//*
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    * @param  \App\User  $user
    */
    public function store(StoreClientRequest $requestClient, StoreUserRequest $requestUser){

        /* obtem os dados para criar o cliente */
        $client = new Cliente;
        $fields = $requestClient->validated();
        $client->fill($fields);

        /* obtem os dados para criar o utilizador */
        $user = new User;
        $fieldsUser = $requestUser->validated();
        $user->fill($fieldsUser);



        /* Criação de cliente */

        if ($requestClient->hasFile('fotografia')) {
            $photo = $requestClient->file('fotografia');
            $profileImg = $client->nome . '_' . time() . '.' . $photo->getClientOriginalExtension();
            Storage::disk('public')->putFileAs('client-photos/', $photo, $profileImg);
            $client->fotografia = $profileImg;
            $client->save();
        }

        if ($requestClient->fotografia==null){
            $client->fotografia = null;
        }

        // data em que foi criado
        $t=time();
        $client->create_at == date("Y-m-d",$t);

        $client->save();




        /* Criação de documentos Pessoais */

        /* Documento de identificação */
        $doc_id= new DocPessoal;
        $doc_id->tipo="Cartão Cidadão";
        $doc_id->dataValidade= $requestClient->dataValidade_docOficial;

        if ($requestClient->hasFile('img_docOficial')) {
            $img_doc = $requestClient->file('img_docOficial');
            $nome_img = $client->idCliente . '_CC.' . $img_doc->getClientOriginalExtension();
            Storage::disk('public')->putFileAs('client-documents/', $img_doc, $nome_img);
            $doc_id->imagem = $nome_img;
            $doc_id->save();
        }
        if ($requestClient->img_docOficial==null){
            $doc_id->imagem->img_docOficial = null;
        }



        /* Passaporte */
        $passaporte= new DocPessoal;
        $passaporte->tipo="Passaporte";
        $passaporte->dataValidade= $requestClient->dataValidPP;

        if ($requestClient->hasFile('img_Passaport')) {
            $img_doc = $requestClient->file('img_Passaport');
            $nome_img = $client->idCliente . '_CC.' . $img_doc->getClientOriginalExtension();
            Storage::disk('public')->putFileAs('client-documents/', $img_doc, $nome_img);
            $passaporte->imagem = $nome_img;
            $passaporte->save();
        }
        if ($requestClient->img_Passaport==null){
            $doc_id->imagem->img_Passaport = null;
        }

        $passaporte->create_at == date("Y-m-d",$t);




        /* Criação de documentos ACADÉMICOS */
        /* use App\DocAcademico; */





        /* Criação de utilizador */

        $user->tipo = "cliente";
        $user->status = 10;
        $user->idCliente = $client->idCliente;
        $user->save();


        /* Envia o e-mail para ativação */
        $email = $user->email;
        $id = $user->idUser;
        $name = $client->nome;
        Mail::to($email)->send(new SendEmailConfirmation($id, $name));

        return redirect()->route('clients.index')->with('success', 'Ficha de estudante criada com sucesso');
    }




    /**
    * Display the specified resource.
    *
    * @param  \App\Cliente  $client
    * @return \Illuminate\Http\Response
    */
    public function show(Cliente $client)
    {

       /* Permissões */
        if (Auth::user()->tipo == "cliente" ){
         abort (401);
       }

        // Produtos adquiridos pelo cliente
        $produtos = $client->produto;

        if ($produtos->isEmpty()) {
            $produtos=null;
        }else{

            $totalprodutos=0;
            foreach ($produtos as $produto) {
                $totalprodutos=$totalprodutos+$produto->valorTotal;
            }
        }

        return view('clients.show',compact("client","produtos","totalprodutos"));
    }




    /**
    * Prepares document for printing the specified client.
    *
    * @param  \App\Cliente  $client
    * @return \Illuminate\Http\Response
    */
    public function print(Cliente $client)
    {
       /* Permissões */
       if (Auth::user()->tipo == "cliente" ){
        abort (401);
      }

        // Produtos adquiridos pelo cliente
        $produtos = $client->produto;

        if ($produtos->isEmpty()) {
            $produtos=null;
        }

        return view('clients.print',compact("client","produtos"));
    }







    /**
    * Show the form for editing the specified resource.
    *
    * @param  \App\Cliente  $client
    * @return \Illuminate\Http\Response
    */
    public function edit(Cliente $client)
    {
        if (Auth::user()->tipo == "admin"){
            return view('clients.edit', compact('client'));
        }else{
            /* não tem permissões */
            abort (401);
        }

    }



    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \App\Cliente  $user
    * @return \Illuminate\Http\Response
    */

    public function update(UpdateClienteRequest $request, Cliente $client)
    {
        $fields = $request->validated();
        $client->fill($fields);


        if ($request->hasFile('fotografia')) {
            $photo = $request->file('fotografia');
            $profileImg = $client->nome . '_' . time() . '.' . $photo->getClientOriginalExtension();
            if (!empty($client->fotografia)) {
                Storage::disk('public')->delete('client-photos/' . $client->fotografia);
            }
            Storage::disk('public')->putFileAs('client-photos/', $photo, $profileImg);
            $client->fotografia = $profileImg;
        }

        // data em que foi modificado
        $t=time();
        $client->updated_at == date("Y-m-d",$t);

        $client->save();

         return redirect()->route('clients.index')->with('success', 'Dados do estudante modificados com sucesso');

    }






    /**
    * Remove the specified resource from storage.
    *
    * @param  \App\Cliente  $client
    * @return \Illuminate\Http\Response
    */

    public function destroy(Cliente $client)
    {
        /* "Apaga" dos clientes */
        $client->delete();


        /* "Apaga" dos utilizadores */
        DB::table('User')
        ->where('idCliente', $client->idCliente)
        ->update(['deleted_at' => $client->deleted_at]);


        return redirect()->route('clients.index')->with('success', 'Estudante eliminado com sucesso');
    }
}
