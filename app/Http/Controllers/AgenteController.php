<?php

namespace App\Http\Controllers;

use App\Agente;
use App\User;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Mail;
use App\Mail\SendEmailConfirmation;

use Illuminate\Http\Request;
use App\Http\Requests\UpdateAgenteRequest;
use App\Http\Requests\StoreAgenteRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;




class AgenteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    /* Permissões */
    if (Auth::user()->tipo != "admin" ){
        abort (401);
    }

        $agents = Agente::all();
        $totalagents = $agents->count();

    return view('agents.list', compact('agents', 'totalagents'));

    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        if (Auth::user()->tipo == "admin"){
            $agent = new Agente;

            /* lista dos agentes principais */
            $listagents = Agente::
            whereNull('idAgenteAssociado')
            ->get();

            return view('agents.add',compact('agent','listagents'));

        }else{
            /* não tem permissões */
            abort (401);
        }


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAgenteRequest $requestAgent, StoreUserRequest $requestUser)
    {

        /* obtem os dados para criar o agente */
        $agent = new Agente;
        $fields = $requestAgent->validated();
        $agent->fill($fields);



        /* obtem os dados para criar o utilizador */
        $user = new User;
        $fieldsUser = $requestUser->validated();
        $user->fill($fieldsUser);


        /* Criação de Agente */
        /* $agent->idAgenteAssociado= $requestAgent->idAgenteAssociado; */

        /* Fotografia do agente */
        if ($requestAgent->hasFile('fotografia')) {
            $photo = $requestAgent->file('fotografia');
            $profileImg = $agent->nome . '_' . time() . '.' . $photo->getClientOriginalExtension();
            Storage::disk('public')->putFileAs('agent-photos/', $photo, $profileImg);
            $agent->fotografia = $profileImg;
            $agent->save();
        }
        if ($requestAgent->fotografia==null){
            $agent->fotografia = null;
        }


        /* Documento de identificação */
        if ($requestAgent->hasFile('img_doc')) {
            $docfile = $requestAgent->file('img_doc');
            $docImg = $agent->nome . $agent->idAgente. '_DocID'.  '.' . $docfile->getClientOriginalExtension();
            Storage::disk('public')->putFileAs('agent-docs/', $docfile, $docImg);
            $agent->img_doc = $docImg;
            $agent->save();
        }
        if ($requestAgent->img_doc==null){
            $agent->img_doc = null;
        }



        // data em que foi criado
        $t=time();
        $agent->create_at == date("Y-m-d",$t);

        $agent->save();




        /* Criação de utilizador */

        $user->tipo = "agente";
        $user->status = 10;
        $user->idAgente = $agent->idAgente;
        $user->save();


        /* Envia o e-mail para ativação */
        $email = $user->email;
        $id = $user->idUser;
        $name = $agent->nome;
        Mail::to($email)->send(new SendEmailConfirmation($id, $name));

        return redirect()->route('agents.index')->with('success', 'Registo criado com sucesso. Aguarda Ativação');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Agente  $agent
     * @return \Illuminate\Http\Response
     */
    public function show(Agente $agent)
    {

        /* Lista de sub-agentes do $agente */
        $listagents = Agente::
        where('idAgenteAssociado', '=',$agent->idAgente)
        ->get();


        if ($listagents->isEmpty()) {
            $listagents=null;
        }

/*       caso seja um sub-agente, obtem o agente que o adicionou */
         if($agent->tipo=="Subagente"){
            $mainAgent=Agente::
            where('idAgente', '=',$agent->idAgenteAssociado)
            ->first();
        }else{
            $mainAgent=null;
        }

        return view('agents.show',compact("agent" ,'listagents','mainAgent'));

    }


   /**
    * Prepares document for printing the specified agent.
    *
    * @param  \App\Agente  $agent
    * @return \Illuminate\Http\Response
    */
    public function print(Agente $agent)
    {
       /* Permissões */
       if (Auth::user()->tipo != "admin" ){
        abort (401);
      }
        return view('agents.print',compact("agent"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Agente  $agent
     * @return \Illuminate\Http\Response
     */
    public function edit(Agente $agent)
    {
        if (Auth::user()->tipo == "admin"){
            /* lista dos agentes principais */
            $listagents = Agente::
            whereNull('idAgenteAssociado')
            ->get();

            return view('agents.edit', compact('agent','listagents'));
        }else{
            /* não tem permissões */
            abort (401);
        }
    }





    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Agente  $agent
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAgenteRequest $request, Agente $agent)
    {
        $fields = $request->validated();
        $agent->fill($fields);

        if ($request->hasFile('fotografia')) {
            $photo = $request->file('fotografia');
            $profileImg = $agent->nome . '_' . time() . '.' . $photo->getClientOriginalExtension();
            if (!empty($agent->fotografia)) {
                Storage::disk('public')->delete('agent-photos/' . $agent->fotografia);
            }
            Storage::disk('public')->putFileAs('agent-photos/', $photo, $profileImg);
            $agent->fotografia = $profileImg;
        }



        /* Documento de identificação */
        if ($request->hasFile('img_doc')) {
            $docfile = $request->file('img_doc');
            $docImg = $agent->nome . $agent->idAgente. '_DocID'.  '.' . $docfile->getClientOriginalExtension();
            if (!empty($agent->img_doc)) {
                Storage::disk('public')->delete('agent-docs/' . $agent->img_doc);
            }
            Storage::disk('public')->putFileAs('agent-docs/', $docfile, $docImg);
            $agent->img_doc = $docImg;
        }



        // Caso se mude o de agente para subagente, garante que nenhum o agente não tem id de subagente
        DB::table('Agente')
        ->where('idAgente', $agent->idAgente)
        ->update(['idAgenteAssociado' => null]);


        // data em que foi modificado
        $t=time();
        $agent->updated_at == date("Y-m-d",$t);

        $agent->save();


        /* update do user->email */
        DB::table('User')
        ->where('idAgente', $agent->idAgente)
        ->update(['email' => $agent->email]);


         return redirect()->route('agents.index')->with('success', 'Dados do agente modificados com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Agente  $agent
     * @return \Illuminate\Http\Response
     */
    public function destroy(Agente $agent)
    {
        /* "Apaga" dos agentes */
        $agent->delete();


        /* Apaga subagentes se o seu agente for apagado */
        $subagents =DB::table('Agente')
        ->where('idAgenteAssociado', $agent->idAgente)
        ->get();

        /* apaga a lista de subagentes do agente que esta a ser apagado */
        if (!$subagents->isEmpty()) {
            foreach ($subagents as $subagent) {
                DB::table('Agente')
                ->where('idAgenteAssociado', $agent->idAgente)
                ->update(['deleted_at' => $agent->deleted_at]);
            }
        }



        /* "Apaga" dos utilizadores */
        DB::table('User')
        ->where('idAgente', $agent->idAgente)
        ->update(['deleted_at' => $agent->deleted_at]);


        /* "Apaga" dos utilizadores os subagentes que tiveram o seu agente apagado */

        /* apaga a lista de subagentes do agente que esta a ser apagado */
        if (!$subagents->isEmpty()) {
            foreach ($subagents as $subagent) {
                DB::table('User')
                ->where('idAgente', '=', $subagent->idAgente)
                ->update(['deleted_at' => $agent->deleted_at]);
            }
        }


        return redirect()->route('agents.index')->with('success', 'Agente eliminado com sucesso');
    }
}
