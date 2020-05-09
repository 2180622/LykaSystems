<?php

namespace App\Http\Controllers;

use App\Cliente;
use App\Agente;

use App\DocPessoal;
use App\DocAcademico;
use App\DocNecessario;
use App\Fase;

use App\Produto;
use App\User;
use Illuminate\Support\Arr;


use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
/* use Illuminate\Http\Request; */

use App\Http\Requests\UpdateClienteRequest;
use App\Http\Requests\StoreClientRequest;
use App\Http\Requests\StoreUserRequest;

use App\Jobs\SendWelcomeEmail;

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


        }else{

            /* Lista de clientes caso seja agente
            /* Lista todos os produtos registados em nome do agente que está logado */
/*          $clients = Cliente::
            selectRaw("Cliente.*")
            ->join('Produto', 'Cliente.idCliente', '=', 'Produto.idCliente')
            ->where('Produto.idAgente', '=', Auth::user()->agente->idAgente)
            ->groupBy('Cliente.idCliente')
            ->orderBy('Cliente.idCliente','asc')
            ->get(); */

            $clients = Cliente::
            where('idAgente', '=', Auth::user()->agente->idAgente)
            ->get();

            if ($clients->isEmpty()) {
                $clients=null;
            }


        }


        /* mostra a lista */
        $totalestudantes = $clients->count();
        return view('clients.list', compact('clients'));

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
            $agents = Agente::all();

            return view('clients.add',compact('client','agents'));
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

        $t=time(); /* obtem data atual */

        /* obtem os dados para criar o cliente */
        $client = new Cliente;
        $fields = $requestClient->validated();
        $client->fill($fields);

        /* obtem os dados para criar o utilizador */
        $user = new User;
        $fieldsUser = $requestUser->validated();
        $user->fill($fieldsUser);

        /* Dados do passaporte JSON: numPassaporte dataValidPP passaportePaisEmi localEmissaoPP */
        $passaporteInfo =[];
        Arr::set($passaporteInfo, 'numPassaporte', $requestClient->numPassaporte);
        Arr::set($passaporteInfo, 'dataValidPP', $requestClient->dataValidPP);
        Arr::set($passaporteInfo, 'passaportePaisEmi', $requestClient->passaportePaisEmi);
        Arr::set($passaporteInfo, 'localEmissaoPP', $requestClient->localEmissaoPP);
        $passaporteInfoJSON = json_encode($passaporteInfo);
        $client->info_Passaporte = $passaporteInfoJSON;



    /* Criação de documentos Pessoais */

        /* Documento de identificação */
        $doc_id= new DocPessoal;
        $doc_id->idCliente = $client->idCliente;
        $doc_id->tipo="Cartão Cidadão";

        $doc_id->info= $requestClient->num_docOficial;
        $doc_id->dataValidade= $requestClient->dataValidade_docOficial;



        if ($requestClient->hasFile('img_docOficial')) {

            $img_doc = $requestClient->file('img_docOficial');
            $nome_imgDocOff = $client->idCliente . '_CC.' . $img_doc->getClientOriginalExtension();
            Storage::disk('public')->putFileAs('client-documents/'.$client->idCliente.'/', $img_doc, $nome_imgDocOff);
            $doc_id->imagem = $nome_imgDocOff;

            /* salva o documento na tabela dos clientes */
            $client->img_docOficial=$nome_imgDocOff;
            $client->save();

        }

        /* Passaporte */
        $passaporte= new DocPessoal;

        $passaporte->idCliente = $client->idCliente;
        $passaporte->tipo="Passaporte";
        $passaporte->info= $passaporteInfoJSON;
        $passaporte->dataValidade= $requestClient->dataValidPP;



        if ($requestClient->hasFile('img_Passaporte')) {
            $img_doc = $requestClient->file('img_Passaporte');
            $nome_imgPassaporte = $client->idCliente . '_PP.' . $img_doc->getClientOriginalExtension();
            Storage::disk('public')->putFileAs('client-documents/'.$client->idCliente.'/', $img_doc, $nome_imgPassaporte);
            $passaporte->imagem = $nome_imgPassaporte;

            /* salva o documento na tabela dos clientes */
            $client->img_Passaporte=$nome_imgPassaporte;
            $client->save();

        }



        /* Criação de cliente */
        $client->info_docOficial = $requestClient->dataValidade_docOficial;


        if ($requestClient->hasFile('fotografia')) {
            $photo = $requestClient->file('fotografia');
            $profileImg = $client->idCliente .'.'. $photo->getClientOriginalExtension();
            Storage::disk('public')->putFileAs('client-documents/'.$client->idCliente.'/', $photo, $profileImg);
            $client->fotografia = $profileImg;
            $doc_id->imagem = $profileImg;
            $client->save();
        }



        /* Guarda Documento oficial */
        $doc_id->create_at == date("Y-m-d",$t);
        $doc_id->save();

        /* Guarda Passaporte */
        $passaporte->create_at == date("Y-m-d",$t);
        $passaporte->save();


        /* Guarda Cliente */
        $client->create_at == date("Y-m-d",$t);

        /* Slugs */
        $client->slug = post_slug($client->nome.' '.$client->apelido);

        $client->save();



        /* Criação de utilizador */

        $user->tipo = "cliente";
        $user->idCliente = $client->idCliente;
        $user->slug = post_slug($client->nome.' '.$client->apelido);
        $user->auth_key = strtoupper(random_str(5));
        $password = random_str(64);
        $user->password = Hash::make($password);
        $user->save();

        /* Envia o e-mail para ativação */
        $name = $client->nome .' '. $client->apelido;
        $email = $client->email;
        $auth_key = $user->auth_key;
        dispatch(new SendWelcomeEmail($email, $name, $auth_key));

        return redirect()->route('clients.show',$client)->with('success', 'Ficha de estudante criada com sucesso');
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
        $produtos = $client->produtoSaved;

        if ($produtos->isEmpty()) {
            $produtos=null;
        }else{

            /* Soma do valor total dos produtos */
            $totalprodutos=0;
            foreach ($produtos as $produto) {
                $totalprodutos=$totalprodutos+$produto->valorTotal;
            }

        }

        /* Agentes associados */
        $agents = Agente::
        whereIn('idAgente', function ($query) use ($client) {
            $query->select('idAgente')
            ->from('Produto')
            ->where('idCliente', $client->idCliente)
            ->distinct('idAgente');
        })->get();

        if ($agents->isEmpty()) {
            $agents=null;
        }

        /* Subagentes associados */
        $subagents = Agente::
        whereIn('idAgente', function ($query) use ($client) {
            $query->select('idSubAgente')
            ->from('Produto')
            ->where('idCliente', $client->idCliente)
            ->distinct('idSubAgente');
        })->get();

        if ($subagents->isEmpty()) {
            $subagents=null;
        }


        /* Lê os dados do passaporte JSON: numPassaporte dataValidPP passaportePaisEmi localEmissaoPP */
/*         $infosPassaporte = new stdClass(); */

        if($client->info_Passaporte){
            $infosPassaporte= json_decode($client->info_Passaporte);
        }else{
            $passaporteInfo =[];
            Arr::set($passaporteInfo, 'numPassaporte',null);
            Arr::set($passaporteInfo, 'dataValidPP', null);
            Arr::set($passaporteInfo, 'passaportePaisEmi', null);
            Arr::set($passaporteInfo, 'localEmissaoPP', null);
        }


        /* Documentos pessoais */
        $documentosPessoais = DocPessoal::where("idCliente","=",$client->idCliente)->get();


        /* Documentos académicos */
        $documentosAcademicos = DocAcademico::where("idCliente","=",$client->idCliente)->get();


        /* Lista de Documentos Necessários */
        $novosDocumentos = DocNecessario::all();



        return view('clients.show',compact("client","agents","subagents","produtos","totalprodutos","infosPassaporte",'documentosPessoais','documentosAcademicos','novosDocumentos'));
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


        /* Dados do passaporte JSON: numPassaporte dataValidPP passaportePaisEmi localEmissaoPP */
/*         $infosPassaporte =new stdClass(); */

        if($client->info_Passaporte){
            $infosPassaporte= json_decode($client->info_Passaporte);
        }else{
            $passaporteInfo =[];
            Arr::set($passaporteInfo, 'numPassaporte',null);
            Arr::set($passaporteInfo, 'dataValidPP', null);
            Arr::set($passaporteInfo, 'passaportePaisEmi', null);
            Arr::set($passaporteInfo, 'localEmissaoPP', null);
        }

        return view('clients.print',compact("client","produtos","infosPassaporte"));
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

            $agents = Agente::all();

        /* Dados do passaporte JSON: numPassaporte dataValidPP passaportePaisEmi localEmissaoPP */
/*         $infosPassaporte =new stdClass(); */



        if($client->info_Passaporte){
            $infosPassaporte= json_decode($client->info_Passaporte);
        }else{
            $passaporteInfo =[];
            Arr::set($passaporteInfo, 'numPassaporte',null);
            Arr::set($passaporteInfo, 'dataValidPP', null);
            Arr::set($passaporteInfo, 'passaportePaisEmi', null);
            Arr::set($passaporteInfo, 'localEmissaoPP', null);
        }

            return view('clients.edit', compact('client','agents','infosPassaporte'));
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

        /* Verifica se existem ficheiros antigos e apaga do storage*/
        $oldfile=Cliente::where('idCliente', '=',$client->idCliente)->first();



        /* Fotografia do cliente */
        if ($request->hasFile('fotografia')) {

        /* Verifica se o ficheiro antigo existe e apaga do storage*/
        if(Storage::disk('public')->exists('client-documents/'.$client->idCliente.'/'. $oldfile->fotografia)){
            Storage::disk('public')->delete('client-documents/'.$client->idCliente.'/'. $oldfile->fotografia);
        }

            $photo = $request->file('fotografia');
            $profileImg = $client->idCliente .'.'. $photo->getClientOriginalExtension();
            Storage::disk('public')->putFileAs('client-documents/'.$client->idCliente.'/', $photo, $profileImg);
            $client->fotografia = $profileImg;

        }


        /* Documento de identificação */

        if ($request->hasFile('img_docOficial')) {
            if(Storage::disk('public')->exists('client-documents/'.$client->idCliente.'/'. $oldfile->img_docOficial)){
                Storage::disk('public')->delete('client-documents/'.$client->idCliente.'/'. $oldfile->img_docOficial);
            }
            $img_doc = $request->file('img_docOficial');
            $nome_img = $client->idCliente . '_CC.' . $img_doc->getClientOriginalExtension();
            Storage::disk('public')->putFileAs('client-documents/'.$client->idCliente.'/', $img_doc, $nome_img);
            $client->img_docOficial=$nome_img;
            $client->save();
        }


        /* Passaporte */
        /* Dados do passaporte JSON: numPassaporte dataValidPP passaportePaisEmi localEmissaoPP */
        $passaporteInfo =[];
        Arr::set($passaporteInfo, 'numPassaporte', $request->numPassaporte);
        Arr::set($passaporteInfo, 'dataValidPP', $request->dataValidPP);
        Arr::set($passaporteInfo, 'passaportePaisEmi', $request->passaportePaisEmi);
        Arr::set($passaporteInfo, 'localEmissaoPP', $request->localEmissaoPP);
        $passaporteInfoJSON = json_encode($passaporteInfo);
        $client->info_Passaporte = $passaporteInfoJSON;

        /* ATUALIZA Passaporte NA TABELA DE DOCS PESSOAIS */
        DB::table('DocPessoal')
        ->where('idCliente', $client->idCliente)
        ->where('tipo', "Passaporte")
        ->update(['info' => $passaporteInfoJSON ]);



        /* Imagem do passaporte */
        if ($request->hasFile('img_Passaporte')) {
            if(Storage::disk('public')->exists('client-documents/'.$client->idCliente.'/'. $oldfile->img_Passaporte)){
                Storage::disk('public')->delete('client-documents/'.$client->idCliente.'/'. $oldfile->img_Passaporte);
            }
            $img_doc = $request->file('img_Passaporte');
            $nome_imgPassaporte = $client->idCliente . '_PP.' . $img_doc->getClientOriginalExtension();
            Storage::disk('public')->putFileAs('client-documents/'.$client->idCliente.'/', $img_doc, $nome_imgPassaporte);
            $client->img_Passaporte=$nome_imgPassaporte;
            $client->save();
        }

        $client->info_docOficial = $request->dataValidade_docOficial;

        // data em que foi modificado
        $t=time();
        $client->updated_at == date("Y-m-d",$t);

        /* Slugs */
        $client->slug = post_slug($client->nome.' '.$client->apelido);

        $client->save();

        return redirect()->route('clients.show',$client)->with('success', 'Dados do estudante modificados com sucesso');

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
