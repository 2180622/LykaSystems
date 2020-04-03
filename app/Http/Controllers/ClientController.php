<?php

namespace App\Http\Controllers;

use App\Cliente;
use App\User;
use App\Produto;
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

        /* Lista de clientes caso seja admin */
        if (Auth::user()->tipo == "admin"){
            $clients = Cliente::all();
            $totalestudantes = $clients->count();



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

            $totalestudantes = $clients->count();


        }

        /* mostra a lista */
        return view('clients.list', compact('clients','totalestudantes'));

    }




    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create()
    {
        $client = new Cliente;
        return view('clients.add',compact('client'));
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
        return view('clients.edit', compact('client'));
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
        DB::table('user')
        ->where('idCliente', $client->idCliente)
        ->update(['deleted_at' => $client->deleted_at]);


        return redirect()->route('clients.index')->with('success', 'Estudante eliminado com sucesso');
    }
}
