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





class AgenteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


/*         dd(Auth::user()->tipo); */

        /* Se for um agente: mostra os sub agentes */
        if(Auth::user()->tipo == "agente"){

            $agents = Agente::
            where('subagent_agentid', '=', Auth::user()->agente->idAgente)
            ->get();
            $totalagents = $agents->count();

            return view('agents.list', compact('agents', 'totalagents'));


       /* Se for um Admin: mostra só os agentes */
        }else{
            $agents = Agente::all();
            $totalagents = $agents->count();

            return view('agents.list', compact('agents', 'totalagents'));

        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $agent = new Agente;
        return view('agents.add',compact('agent'));
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

        // data em que foi criado
        $t=time();
        $agent->create_at == date("Y-m-d",$t);



        /* Verifica se é agente ou admin a criar novo registo */
        if(Auth::user()->tipo == "agente"){
            /* se for agente */
            $agent->tipo="Subagente";
            $agent->subagent_agentid = Auth::user()->agente->idAgente;
        }else{
            /* se for admin */
            $agent->tipo="Agente";
        }

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

        /* Lista de sub agentes do $agente */
        $listagents = Agente::
        where('subagent_agentid', '=',$agent->idAgente)
        ->get();

        return view('agents.show',compact("agent",'listagents'));

    }


   /**
    * Prepares document for printing the specified agent.
    *
    * @param  \App\Agente  $agent
    * @return \Illuminate\Http\Response
    */
    public function print(Agente $agent)
    {
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
        return view('agents.edit', compact('agent'));
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
                Storage::disk('public')->delete('agennt-photos/' . $agent->fotografia);
            }
            Storage::disk('public')->putFileAs('agent-photos/', $photo, $profileImg);
            $agent->fotografia = $profileImg;
        }

        // data em que foi modificado
        $t=time();
        $agent->updated_at == date("Y-m-d",$t);

        $agent->save();

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



        /* "Apaga" dos utilizadores */
        DB::table('user')
        ->where('idAgente', $agent->idAgente)
        ->update(['deleted_at' => $agent->deleted_at]);


        return redirect()->route('agents.index')->with('success', 'Agente eliminado com sucesso');
    }
}
