<?php

namespace App\Http\Controllers;

use App\Cliente;
use App\Agente;
use App\User;
use App\Universidade;
use App\DocPessoal;
use App\DocAcademico;
use App\DocNecessario;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

use Illuminate\Http\Request;
use App\Http\Requests\UpdateClienteRequest;
use App\Http\Requests\StoreClientRequest;

use App\Jobs\SendWelcomeEmail;

class ClientController extends Controller
{


    public function sendActivationEmail(Cliente $client){


        $user = User::where('idCliente', '=', $client->idCliente)->first();

        /* Cria o UTILIZADOR se ainda não existir */

        if ( !$user ){
            /* obtem os dados para criar o utilizador */
            $user = new User;
            $user->idCliente = $client->idCliente;
            $user->email = $client->email;
            $user->tipo = "cliente";
            $password = random_str(64);
            $user->password = Hash::make($password);
            $user->auth_key = strtoupper(random_str(5));
            $user->estado = true;
            $user->slug = post_slug($client->nome.' '.$client->apelido);
            $user->idAdmin = null;
            $user->idAgente = null;
            $user->save();

            /* Envia o e-mail para ativação */
            $name = $client->nome .' '. $client->apelido;
            $email = $client->email;
            $auth_key = $user->auth_key;
            dispatch(new SendWelcomeEmail($email, $name, $auth_key));

            return back()->with('success', 'E-mail de ativação enviado com sucesso');

        }else{

            return back()->with('error', 'O utilizador já existe');

        }

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

            /* Lista para Agentes */
            if (Auth::user()->agente->tipo== "Agente"){
                $clients_associados = Cliente::
                where('idAgente', '=', Auth::user()->agente->idAgente)
                ->get();

                /* Lista todos os produtos registados em nome do agente que está logado */
                $clients_produto = Cliente::
                selectRaw("Cliente.*")
                ->join('Produto', 'Cliente.idCliente', '=', 'Produto.idCliente')
                ->where('Produto.idAgente', '=', Auth::user()->agente->idAgente)
                ->groupBy('Cliente.idCliente')
                ->orderBy('Cliente.idCliente','asc')
                ->get();

                /* Junta as duas listas */
                $clients = $clients_associados->merge($clients_produto);
                /* $clients = $clients->unique(); */
            }

            /* Lista para SubAgentes */
            if (Auth::user()->agente->tipo== "Subagente"){
            $clients_associados = Cliente::
            where('idAgente', '=', Auth::user()->agente->idAgente)
            ->get();

            /* Lista todos os produtos registados em nome do agente que está logado */
            $clients_produto = Cliente::
            selectRaw("Cliente.*")
            ->join('Produto', 'Cliente.idCliente', '=', 'Produto.idCliente')
            ->where('Produto.idSubAgente', '=', Auth::user()->agente->idAgente)
            ->groupBy('Cliente.idCliente')
            ->orderBy('Cliente.idCliente','asc')
            ->get();

            /* Junta as duas listas */
            $clients = $clients_associados->merge($clients_produto);
            /* $clients = $clients->unique(); */
            }

        }

        if ($clients->isEmpty()) {
            $clients=null;
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


            $instituicoes = array_unique(Cliente::pluck('nomeInstituicaoOrigem')->toArray());
            $cidadesInstituicoes = array_unique(Cliente::pluck('cidadeInstituicaoOrigem')->toArray());


            return view('clients.add',compact('client','agents','instituicoes','cidadesInstituicoes'));
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
    public function store(StoreClientRequest $requestClient){

        $t=time(); /*  data atual */

        /* obtem os dados para criar o cliente */
        $client = new Cliente;
        $fields = $requestClient->validated();
        $client->fill($fields);

        /* (Tratamento de strings, casos especificos) */
        $client->nomeInstituicaoOrigem = ucwords(strtolower($requestClient->nomeInstituicaoOrigem));
        $client->cidadeInstituicaoOrigem = ucwords(strtolower($requestClient->cidadeInstituicaoOrigem));


        $client->save();



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
            $doc_id->idFase = null;
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
            $passaporte->idFase = null;
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
       $totalprodutos=null;

        // Produtos adquiridos pelo cliente
        $produtos = $client->produtoSaved;


        if ($produtos->isEmpty()) {
            $produtos=null;
            $totalprodutos=null;
        }else{

            /* Soma do valor total dos produtos */
            $totalprodutos=0;
            foreach ($produtos as $produto) {
                $totalprodutos=$totalprodutos+$produto->valorTotal;
            }

        }


        /* AGENTE RESPONSAVEL   +++++++++++++++++++++++++ */
        $agente = Agente::
        where("idAgente","=",$client->idAgente)
        ->first();


        /* Agentes associados: apartir da tabela dos produtos */
        $agents = Agente::
        whereIn('idAgente', function ($query) use ($client) {
            $query->select('idAgente')
            ->from('Produto')
            ->where('idCliente', $client->idCliente);
/*             ->where('idAgente','!=',$client->idAgente) */
/*             ->distinct('idAgente'); */
        })->get();
/*         if ($agents->isEmpty()) {
            $agents=null;
        } */


        /* Subagentes associados: : apartir da tabela dos produtos */
        $subagents = Agente::
        whereIn('idAgente', function ($query) use ($client) {
            $query->select('idSubAgente')
            ->from('Produto')
            ->where('idCliente', $client->idCliente);
/*             ->where('idSubAgente','!=',$client->idAgente)
            ->distinct('idSubAgente'); */
        })->get();
/*         if ($subagents->isEmpty()) {
            $subagents=null;
        } */


        /* Junta as duas listas */
/*         dd($agents,$subagents); */

        $associados = $agents->merge($subagents);
/*      $associados = $associados->unique(); */



        /* Lê os dados do passaporte JSON: numPassaporte dataValidPP passaportPaisEmi localEmissaoPP */

            $passaporte = DocPessoal::
            where ("idCliente","=",$client->idCliente)
            ->where("tipo","=","Passaporte")
            ->first();

            if($passaporte!=null){
                $passaporteData = json_decode($passaporte->info);
            }else{
                $passaporteData=null;
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



        return view('clients.show',compact("client","agente","associados",/* "agents","subagents", */"produtos","totalprodutos","passaporteData",'documentosPessoais','documentosAcademicos','novosDocumentos'));
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

        $infosPassaporte=null;

        $passaporte = DocPessoal::
        where ("idCliente","=",$client->idCliente)
        ->where("tipo","=","Passaporte")
        ->first();

        if($passaporte!=null || !isEmpty($passaporte)){
            $infosPassaporte = json_decode($passaporte->info);
        }else{
            $infosPassaporte=null;
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
        }else{
            $passaporteData=null;
        }


        /* listas de campos especificos disponiveis */
        $instituicoes = array_unique(Cliente::pluck('nomeInstituicaoOrigem')->toArray());
        $cidadesInstituicoes = array_unique(Cliente::pluck('cidadeInstituicaoOrigem')->toArray());


        /* Se for o administrador a editar */
        if (Auth::user()->tipo == "admin"){
            $agents = Agente::all();

            return view('clients.edit', compact('client','agents','docOfficial','passaporte','passaporteData','instituicoes','cidadesInstituicoes'));

        }


        /* Se for o agente a editar */
        if (Auth::user()->tipo == "agente"){

            if ($client->editavel == 1){
                /* SE TIVER PERMISSÔES para alterar informação */
                return view('clients.edit', compact('client','docOfficial','passaporte','passaporteData','instituicoes','cidadesInstituicoes'));
            }else{
                /* SE NÃO TIVER PERMISSÕES para alterar informação */
                return Redirect::route('clients.show',$client);
            }

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

        /* (Tratamento de strings, casos especificos) */
        $client->nomeInstituicaoOrigem = ucwords(strtolower($request->nomeInstituicaoOrigem));
        $client->cidadeInstituicaoOrigem = ucwords(strtolower($request->cidadeInstituicaoOrigem));


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
            $doc_id->idFase = null;
            $doc_id->info = json_encode($infoDocId);
            $doc_id->dataValidade = $request->validade_docOficial;
            $doc_id->create_at == date("Y-m-d",$t);
            $doc_id->save();
        }else{
            $doc_id->idCliente = $client->idCliente;
            $doc_id->tipo = "Doc. Oficial";
            $doc_id->idFase = null;
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




    /* Search Form */

    public function searchIndex(){

        /* Coloca os dados dos campos num array e elimina os duplicados */

        $paises = array_unique(Cliente::pluck('paisNaturalidade')->toArray());
        $cidadesOrigem = array_unique(Cliente::pluck('cidade')->toArray());
        $instituicoesOrigem = array_unique(Cliente::pluck('nomeInstituicaoOrigem')->toArray());

        $agents= Agente::all();
        $universidades = Universidade::all();

        return view('clients.search',compact('paises','cidadesOrigem','instituicoesOrigem','agents','universidades'));

    }



    /* Search Form */

    public function searchResults(Request $request){

        request()->all();

        $nomeCampo= $request->search_options;

        /* dd( $request); */
        /* dd($nomeCampo, $valor); */

        switch ($nomeCampo) {
            case "País de origem":
                $clients= Cliente::where("paisNaturalidade","=",$request->paisNaturalidade)->get();
                $valor=$request->paisNaturalidade;
            break;


            case "Cidade de origem":
                $clients= Cliente::where("cidade","=",$request->cidade)->get();
                $valor=$request->cidade;
            break;


            case "Instituição de origem":
                $clients= Cliente::where("nomeInstituicaoOrigem","=",$request->nomeInstituicaoOrigem)->get();
                $valor=$request->nomeInstituicaoOrigem;
            break;


            case "Agente":
                $clients= Cliente::where("idAgente","=",$request->agente)->get();
                $valor = Agente:: where("idAgente","=",$request->agente)->first();
                $valor = $valor->nome.' '.$valor->apelido;
            break;


            case "Universidade":
                $clients = Cliente::distinct('Cliente.idCliente')
                ->join('Produto', 'Produto.idCliente', '=', 'Cliente.idCliente')
                ->where('Produto.idUniversidade1', '=',$request->universidade )
                ->orWhere('Produto.idUniversidade2', '=',$request->universidade)
                ->select('Cliente.*')
                ->get();
                $valor=$request->universidade;
            break;


            case "Nível de estudos":
                $clients= Cliente::where("nivEstudoAtual","=",$request->nivelEstudos)->get();
                $valor=$request->nivelEstudos;
            break;


            case "Estado de cliente":
                $clients= Cliente::where("estado","=",$request->estado)->get();
                $valor=$request->estado;
            break;
        }




        /* Se não encontrar resultados */
        if ( !isset($clients) || $clients->isEmpty() ) {
            $clients=0;
        }

        /* dd($clients); */

        $paises = array_unique(Cliente::pluck('paisNaturalidade')->toArray());
        $cidadesOrigem = array_unique(Cliente::pluck('cidade')->toArray());
        $instituicoesOrigem = array_unique(Cliente::pluck('nomeInstituicaoOrigem')->toArray());
        $agents= Agente::all();
        $universidades = Universidade::all();



        return view('clients.search',compact('clients','nomeCampo','valor','paises','cidadesOrigem','instituicoesOrigem','agents','universidades'));

    }













}
