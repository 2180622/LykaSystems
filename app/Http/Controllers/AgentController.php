<?php

namespace App\Http\Controllers;

use App\Agente;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests\StoreAgenteRequest;
use App\Http\Requests\StoreUserRequest;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use App\Mail\SendEmailConfirmation;
use Mail;

class AgentController extends Controller
{

    public function index(){
        $agents = Agente::all();
        $Notificacoes = Auth()->user()->getNotifications();
        return view('agents.list', compact('agents','Notificacoes'));
    }


    public function create(){
        return view('agents.add');
    }


    public function store(StoreUserRequest $requestUser, StoreAgenteRequest $requestAgente){
      $curTime = Carbon::now();

      $fieldsUser = $requestUser->validated();
      $fieldsAgente = $requestAgente->validated();

      $user = new User;
      $user->tipo = "agente";
      $user->auth_key = rand(655541,getrandmax());
      $user->status = 10;
      $user->fill($fieldsUser);
      //gerar hash a partir da pass inserida
      $password = $requestUser->get('password');
      $hashed = Hash::make($password);
      $user->password = $hashed;

      $agente = new Agente;
      $agente->dataRegis = $curTime;
      $agente->fill($fieldsAgente);
      $name = $agente->nome;
      $agente->save();
      $user->idAgente = $agente->idAgente;
      $user->email = $agente->email;
      $user->save();

      $email = $user->email;
      $id = $user->idUser;
      Mail::to($email)->send(new SendEmailConfirmation($id, $name));

      return redirect()->route('users.index')->with('success', 'Agent successfully created');
    }


    public function show(Agent $agent)
    {
        //
    }


    public function edit(Agent $agent)
    {
        //
    }


    public function update(Request $request, Agent $agent)
    {
        //
    }


    public function destroy(Agent $agent)
    {
        //
    }
}
