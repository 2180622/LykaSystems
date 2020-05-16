<?php

namespace App\Http\Controllers;

use App\Cliente;
use App\Agente;
use App\User;

use App\DocPessoal;
use App\DocAcademico;
use App\DocNecessario;

use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;


use App\Http\Requests\UpdateClienteRequest;
use App\Http\Requests\StoreClientRequest;
use App\Http\Requests\StoreUserRequest;

use App\Jobs\SendWelcomeEmail;

class ClientController extends Controller
{


    public function sendActivationEmail(Cliente $client){

        $user = User::where('idCliente', '=', $client->idCliente)->first();

        /* Envia o e-mail para ativação */
        $name = $client->nome .' '. $client->apelido;
        $email = $client->email;
        $auth_key = $user->auth_key;
        dispatch(new SendWelcomeEmail($email, $name, $auth_key));

        return back()->with('success', 'E-mail de ativação enviado com sucesso');

    }


    public function index(){

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
        return view('clients.list', compact('clients'));

    }




    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create(){

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

        $t=time(); /*  data atual */

        /* obtem os dados para criar o cliente */
        $client = new Cliente;
        $fields = $requestClient->validated();
        $client->fill($fields);
        $client->save();

        /* obtem os dados para criar o utilizador */
        $user = new User;
        $fieldsUser = $requestUser->validated();
        $user->fill($fieldsUser);



        /* Criação de cliente */
        if ($requestClient->hasFile('fotografia')) {
            $photo = $requestClient->file('fotografia');
            $profileImg = $client->idCliente .'.'. $photo->getClientOriginalExtension();
            Storage::disk('public')->putFileAs('client-documents/'.$client->idCliente.'/', $photo, $profileImg);
            $client->fotografia = $profileImg;
            $client->save();
        }
        $client->slug = post_slug($client->nome.' '.$client->apelido); /*slugs */
        $client->create_at == date("Y-m-d",$t);
        $client->save();





    /* Criação de documentos Pessoais */


        /* Cria Documento de identificação pessoal se Existir ficheiro para Upload*/
        if ($requestClient->hasFile('img_docOficial')) {

            $doc_id = new DocPessoal;
            $doc_id->idCliente = $client->idCliente;
            $doc_id->tipo = "Doc. Oficial";
            $doc_id->idFase = 1;
            $doc_id->dataValidade = $requestClient->validade_docOficial;

            /* Constroi a informação adicional para documento de ID */
            $infoDocId = null;
            $infoDocId['numDoc'] = $requestClient->num_docOficial;
            $doc_id->info = json_encode($infoDocId);

            /* Imagem do documento de identificação Pessoal*/
            $img_doc = $requestClient->file('img_docOficial');
            $nome_imgDocOff = 'cliente_'.$client->idCliente. '_fase_2'. '_documento_pessoal_Doc_Oficial'.'.'.$img_doc->getClientOriginalExtension();
            Storage::disk('public')->putFileAs('client-documents/'.$client->idCliente.'/', $img_doc, $nome_imgDocOff);
            $doc_id->imagem = $nome_imgDocOff;

            /* Guarda documento de identificação Pessoal */
            $doc_id->create_at == date("Y-m-d",$t);
            $doc_id->save();
        }



        /* Cria Passaporte se Existir ficheiro para Upload*/
        if ($requestClient->hasFile('img_Passaporte')) {
            $passaporte = new DocPessoal;
            $passaporte->idCliente = $client->idCliente;
            $passaporte->tipo = "Passaporte";
            $passaporte->idFase = 2;
            $passaporte->dataValidade = $requestClient->dataValidPP;

            /* Constroi a informação adicional para o passaporte */
            $infoPassaporte = null;
            $infoPassaporte['numPassaporte'] = $requestClient->numPassaporte;
            $infoPassaporte['dataValidPP'] = $requestClient->dataValidPP;
            $infoPassaporte['passaportPaisEmi'] =$requestClient->passaportPaisEmi;
            $infoPassaporte['localEmissaoPP'] = $requestClient->localEmissaoPP;

            $passaporte->info = json_encode($infoPassaporte);


            /* Imagem do passaporte*/

            $img_doc = $requestClient->file('img_Passaporte');
            $nome_imgPassaporte = 'cliente_'.$client->idCliente. '_fase_2'. '_documento_pessoal_Passaporte'.'.'.$img_doc->getClientOriginalExtension();
            Storage::disk('public')->putFileAs('client-documents/'.$client->idCliente.'/', $img_doc, $nome_imgPassaporte);
            $passaporte->imagem = $nome_imgPassaporte;

            /* Guarda passaporte */
            $passaporte->create_at == date("Y-m-d",$t);
            $passaporte->save();
        }


        /* Criação de utilizador */

        $user->tipo = "cliente";
        $user->idCliente = $client->idCliente;
        $user->slug = post_slug($client->nome.' '.$client->apelido);
        $user->auth_key = strtoupper(random_str(5));
        $password = random_str(64);
        $user->password = Hash::make($password);
        $user->save();

        return redirect()->route('clients.show',$client)->with('success', 'Ficha de estudante criada com sucesso');
    }




    /**
    * Display the specified resource.
    *
    * @param  \App\Cliente  $client
    * @return \Illuminate\Http\Response
    */
    public function show(Cliente $client){

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


        /* AGENTE RESPONSAVEL   ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ */
        $agente = Agente::
        where("idAgente","=",$client->idAgente)
        ->first();



        /* Agentes associados */
        $agents = Agente::
        whereIn('idAgente', function ($query) use ($client) {
            $query->select('idAgente')
            ->from('Produto')
            ->where('idAgente','<>',$client->idAgente)
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
            ->where('idAgente','<>',$client->idAgente)
            ->where('idCliente', $client->idCliente)
            ->distinct('idSubAgente');
        })->get();


        if ($subagents->isEmpty()) {
            $subagents=null;
        }


        /* Lê os dados do passaporte JSON: numPassaporte dataValidPP passaportPaisEmi localEmissaoPP */

            $passaporte = DocPessoal::
            where ("idCliente","=",$client->idCliente)
            ->where("tipo","=","Passaporte")
            ->first();

            if($passaporte!=null){
                $passaporteData = json_decode($passaporte->info);
            }




        /* Documentos pessoais */
        $documentosPessoais = DocPessoal::where("idCliente","=",$client->idCliente)->get();
        if ($documentosPessoais->isEmpty()) {
            $documentosPessoais=null;
        }


        /* Documentos académicos */
        $documentosAcademicos = DocAcademico::where("idCliente","=",$client->idCliente)->get();
        if ($documentosAcademicos->isEmpty()) {
            $documentosAcademicos=null;
        }

        /* Lista de Documentos Necessários */
        $novosDocumentos = DocNecessario::all();



        return view('clients.show',compact("client","agente","agents","subagents","produtos","totalprodutos","passaporteData",'documentosPessoais','documentosAcademicos','novosDocumentos'));
    }




    /**
    * Prepares document for printing the specified client.
    *
    * @param  \App\Cliente  $client
    * @return \Illuminate\Http\Response
    */
    public function print(Cliente $client){
       /* Permissões */
       if (Auth::user()->tipo == "cliente" ){
        abort (401);
      }

        // Produtos adquiridos pelo cliente
        $produtos = $client->produto;

        if ($produtos->isEmpty()) {
            $produtos=null;
        }


        /* Lê os dados do passaporte JSON: numPassaporte dataValidPP passaportPaisEmi localEmissaoPP */

        $passaporte = DocPessoal::
        where ("idCliente","=",$client->idCliente)
        ->where("tipo","=","Passaporte")
        ->first();

        if($passaporte!=null){
            $infosPassaporte = json_decode($passaporte->info);
        }


        return view('clients.print',compact("client","produtos","infosPassaporte"));
    }




    /**
    * Show the form for editing the specified resource.
    *
    * @param  \App\Cliente  $client
    * @return \Illuminate\Http\Response
    */
    public function edit(Cliente $client){

        /* Obtem as informações sobre os documentos */

        $docOfficial = DocPessoal::
        where("idCliente","=",$client->idCliente)
        ->where("tipo","=","Doc. Oficial")
        ->first();

        // Dados do passaporte
        $passaporte = DocPessoal::
        where ("idCliente","=",$client->idCliente)
        ->where("tipo","=","Passaporte")
        ->first();

        if($passaporte!=null){
            $passaporteData = json_decode($passaporte->info);
        }

        /* Se for o administrador a editar */
        if (Auth::user()->tipo == "admin"){
            $agents = Agente::all();

            return view('clients.edit', compact('client','agents','docOfficial','passaporte','passaporteData'));

        }


        /* Se for o agente a editar */
        if (Auth::user()->tipo == "agente"){

            if ($client->editavel == 1){
                /* SE TIVER PERMISSÔES para alterar informação */
                return view('clients.edit', compact('client','docOfficial','passaporte','passaporteData'));
            }else{
                /* SE NÃO TIVER PERMISSÕES para alterar informação */
                return Redirect::route('clients.show',$client);
            }

        }



        if (Auth::user()->tipo == "admin" || Auth::user()->tipo == "agente"){


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

    public function update(UpdateClienteRequest $request, Cliente $client){

        $t=time(); /*  data atual */

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

        // data em que foi modificado
        $client->updated_at == date("Y-m-d",$t);

        /* Slugs */
        $client->slug = post_slug($client->nome.' '.$client->apelido);

        $client->save();




        /* Documento de identificação pessoal*/

        /* Obtem o DOCpessoal do tipo "Doc. Oficial"  */
        $doc_id = DocPessoal::
        where("idCliente","=",$client->idCliente)
        ->where("tipo","=","Doc. Oficial")
        ->first();


        /* Constroi a informação adicional para documento de ID */
        $infoDocId = null;
        $infoDocId['numDoc'] = $request->num_docOficial;

        /* Se o Documento de identificação pessoal ainda nao foi criado, cria um novo */
        if ($doc_id==null){
            $doc_id = new DocPessoal;
            $doc_id->idCliente = $client->idCliente;
            $doc_id->tipo = "Doc. Oficial";
/*             $doc_id->idFase = 2; */
            $doc_id->info = json_encode($infoDocId);
            $doc_id->dataValidade = $request->validade_docOficial;
            $doc_id->create_at == date("Y-m-d",$t);
            $doc_id->save();
        }else{
            $doc_id->idCliente = $client->idCliente;
            $doc_id->tipo = "Doc. Oficial";
/*             $doc_id->idFase = 1; */
            $doc_id->info = json_encode($infoDocId);
            $doc_id->dataValidade = $request->validade_docOficial;
            $doc_id->updated_at == date("Y-m-d",$t);
            $doc_id->save();
        }

        /* Documento de identificação pessoal: Tem imagem?? */
        if ($request->hasFile('img_docOficial')) {

            /* Verifica se já existe DocPessoal e respectiva imagem. Se existir ficheiro novo, apaga o antigo*/
            if ($doc_id){
                if(Storage::disk('public')->exists('client-documents/'.$client->idCliente.'/'. $doc_id->imagem)){
                    Storage::disk('public')->delete('client-documents/'.$client->idCliente.'/'. $doc_id->imagem);
                }
            }

            /* Imagem do documento de identificação Pessoal*/
            $img_doc = $request->file('img_docOficial');

            $nome_imgDocOff = 'cliente_'.$client->idCliente. '_fase_2'. '_documento_pessoal_Doc_Oficial'.'.'.$img_doc->getClientOriginalExtension();
            Storage::disk('public')->putFileAs('client-documents/'.$client->idCliente.'/', $img_doc, $nome_imgDocOff);
            $doc_id->imagem = $nome_imgDocOff;
            /* Guarda documento de identificação Pessoal */
            $doc_id->imagem = $nome_imgDocOff;
            $doc_id->create_at == date("Y-m-d",$t);
            $doc_id->save();

        }



        /* Passaporte */

        /* Imagem do passaporte */
        $passaporte = DocPessoal::
        where("idCliente","=",$client->idCliente)
        ->where("tipo","=","Passaporte")
        ->first();


        /* Constroi a informação adicional para o passaporte */
        $infoPassaporte = null;
        $infoPassaporte['numPassaporte'] = $request->numPassaporte;
        $infoPassaporte['dataValidPP'] = $request->dataValidPP;
        $infoPassaporte['passaportPaisEmi'] =$request->passaportPaisEmi;
        $infoPassaporte['localEmissaoPP'] = $request->localEmissaoPP;

        if ($passaporte==null){
            $passaporte = new DocPessoal;
            $passaporte->idCliente = $client->idCliente;
            $passaporte->tipo = "Passaporte";
            $passaporte->idFase = 2;
            $passaporte->info = json_encode($infoPassaporte);
            $passaporte->dataValidade = $request->validade_docOficial;
            $passaporte->create_at == date("Y-m-d",$t);
            $passaporte->save();
        }else{
            $passaporte->idCliente = $client->idCliente;
            $passaporte->tipo = "Passaporte";
            $passaporte->idFase = 2;
            $passaporte->info = json_encode($infoPassaporte);
            $passaporte->dataValidade = $request->dataValidPP;
            $passaporte->updated_at == date("Y-m-d",$t);
            $passaporte->save();
        }


            /* Tem imagem do passaporte ?? */
            if ($request->hasFile('img_Passaporte')) {

                /* Verifica se já existe DocPessoal:passaporte e respectiva imagem. Se existir ficheiro novo, apaga o antigo*/
                if ($passaporte){
                    if(Storage::disk('public')->exists('client-documents/'.$client->idCliente.'/'. $passaporte->imagem)){
                        Storage::disk('public')->delete('client-documents/'.$client->idCliente.'/'. $passaporte->imagem);
                    }
                }
                /* Imagem do documento de identificação Pessoal*/
                $img_passaport = $request->file('img_Passaporte');


                $nome_imgPassaporte = 'cliente_'.$client->idCliente. '_fase_2'.'_documento_pessoal_Passaporte'.'.'.$img_passaport->getClientOriginalExtension();
                Storage::disk('public')->putFileAs('client-documents/'.$client->idCliente.'/', $img_passaport, $nome_imgPassaporte);
                $passaporte->imagem = $nome_imgPassaporte;

                /* Guarda o passaporte */
                $passaporte->imagem = $nome_imgPassaporte;
                $passaporte->create_at == date("Y-m-d",$t);
                $passaporte->save();

            }


        return redirect()->route('clients.show',$client)->with('success', 'Dados do estudante modificados com sucesso');

    }






    /**
    * Remove the specified resource from storage.
    *
    * @param  \App\Cliente  $client
    * @return \Illuminate\Http\Response
    */

    public function destroy(Cliente $client){

        if (Auth::user()->tipo == "admin" ){

            /* "Apaga" dos clientes */
            $client->delete();

            /* "Apaga" dos utilizadores */
            DB::table('User')
            ->where('idCliente', $client->idCliente)
            ->update(['deleted_at' => $client->deleted_at]);

            return redirect()->route('clients.index')->with('success', 'Estudante eliminado com sucesso');
        }

    }
}
