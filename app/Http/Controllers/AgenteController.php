<?php

namespace App\Http\Controllers;

use App\Agente;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Mail;
use App\Mail\SendEmailConfirmation;
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
        $agent = new Agente;
        return view('agents.add',compact('agent'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAgenteRequest $requestAgente, StoreUserRequest $requestUser)
    {

        /* obtem os dados para criar o agente */
        $agente = new Agente;
        $fields = $requestAgente->validated();
        $agente->fill($fields);

        /* obtem os dados para criar o utilizador */
        $user = new User;
        $fieldsUser = $requestUser->validated();
        $user->fill($fieldsUser);



        /* Criação de Agente */

        if ($requestAgente->hasFile('fotografia')) {
            $photo = $requestAgente->file('fotografia');
            $profileImg = $agente->nome . '_' . time() . '.' . $photo->getClientOriginalExtension();
            Storage::disk('public')->putFileAs('agent-photos/', $photo, $profileImg);
            $agente->fotografia = $profileImg;
            $agente->save();
        }

        if ($requestAgente->fotografia==null){
            $agente->fotografia = null;
        }

        // data em que foi criado
        $t=time();
        $agente->create_at == date("Y-m-d",$t);

        $agente->save();



        /* Criação de utilizador */

        $user->tipo = "agente";
        $user->status = 10;
        $user->idAgente = $agente->idAgente;
        $user->save();


        /* Envia o e-mail para ativação */
        $email = $user->email;
        $id = $user->idUser;
        $name = $agente->nome;
        Mail::to($email)->send(new SendEmailConfirmation($id, $name));

        return redirect()->route('agents.index')->with('success', 'Agente criado com sucesso. Aguarda Ativação');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Agente  $agente
     * @return \Illuminate\Http\Response
     */
    public function show(Agente $agente)
    {
        return view('agents.show',compact("agente"));
    }


   /**
    * Prepares document for printing the specified agent.
    *
    * @param  \App\Agente  $agente
    * @return \Illuminate\Http\Response
    */
    public function print(Agente $agente)
    {
        return view('agents.print',compact("agente"));
    }




    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Agente  $agente
     * @return \Illuminate\Http\Response
     */
    public function edit(Agente $agente)
    {
        return view('agents.edit', compact('agente'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Agente  $agente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Agente $agente)
    {
        $fields = $request->validated();
        $agente->fill($fields);


        if ($request->hasFile('fotografia')) {
            $photo = $request->file('fotografia');
            $profileImg = $agente->nome . '_' . time() . '.' . $photo->getClientOriginalExtension();
            if (!empty($agente->fotografia)) {
                Storage::disk('public')->delete('agennt-photos/' . $agente->fotografia);
            }
            Storage::disk('public')->putFileAs('agent-photos/', $photo, $profileImg);
            $agente->fotografia = $profileImg;
        }

        // data em que foi modificado
        $t=time();
        $agente->updated_at == date("Y-m-d",$t);

        $agente->save();

         return redirect()->route('agents.index')->with('success', 'Dados do agente modificados com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Agente  $agente
     * @return \Illuminate\Http\Response
     */
    public function destroy(Agente $agente)
    {
        $agente->delete();
        return redirect()->route('agents.index')->with('success', 'Agente eliminado com sucesso');
    }
}
