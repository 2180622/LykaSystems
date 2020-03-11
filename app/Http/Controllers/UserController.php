<?php

namespace App\Http\Controllers;

use App\User;
use App\Administrador;
use App\Cliente;
use App\Agente;
use Illuminate\Http\Request;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\StoreAdministradorRequest;
use App\Http\Requests\StoreAgenteRequest;
use App\Http\Requests\StoreClienteRequest;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        return view('users.list');
    }


    public function create()
    {
      $user = new User;
      return view('users.add', compact('user'));
    }


    public function storeAdmin(StoreUserRequest $requestUser, StoreAdministradorRequest $requestAdmin){
      $curTime = Carbon::now();

      $fieldsUser = $requestUser->validated();
      $fieldsAdmin = $requestAdmin->validated();

      $user = new User;
      $user->tipo = "admin";
      $user->auth_key = rand(655541,getrandmax());
      $user->status = 10;
      $user->fill($fieldsUser);
      //gerar hash a partir da pass inserida
      $password = $requestUser->get('password_hash');
      $hashed = Hash::make($password);
      $user->password_hash = $hashed;

      $admin = new Administrador;
      $admin->dataRegis = $curTime;
      $admin->fill($fieldsAdmin);

      $user->save();
      $admin->save();

      return redirect()->route('users.index')->with('success', 'Admin successfully created');
    }

    public function storeAgente(StoreUserRequest $requestUser, StoreAgenteRequest $requestAgente){
      $curTime = Carbon::now();

      $fieldsUser = $requestUser->validated();
      $fieldsAgente = $requestAgente->validated();

      $user = new User;
      $user->tipo = "agente";
      $user->auth_key = rand(655541,getrandmax());
      $user->status = 10;
      $user->fill($fieldsUser);
      //gerar hash a partir da pass inserida
      $password = $requestUser->get('password_hash');
      $hashed = Hash::make($password);
      $user->password_hash = $hashed;

      $agente = new Agente;
      $agente->dataRegis = $curTime;
      $agente->fill($fieldsAgente);

      $user->save();
      $agente->save();

      return redirect()->route('users.index')->with('success', 'Admin successfully created');
    }

    public function storeCliente(StoreUserRequest $requestUser, StoreClienteRequest $requestCliente){
      $curTime = Carbon::now();

      $fieldsUser = $requestUser->validated();
      $fieldsCliente = $requestCliente->validated();

      $user = new User;
      $user->tipo = "cliente";
      $user->auth_key = rand(655541,getrandmax());
      $user->status = 10;
      $user->fill($fieldsUser);//gerar hash a partir da pass inserida
      $password = $requestUser->get('password_hash');
      $hashed = Hash::make($password);
      $user->password_hash = $hashed;

      $cliente= new Cliente;
      $cliente->dataRegis = $curTime;
      $cliente->fill($fieldsCliente);

      $user->save();
      $cliente->save();

      return redirect()->route('users.index')->with('success', 'Admin successfully created');
    }


    public function show(User $user)
    {
        //
    }


    public function edit(User $user)
    {
        //
    }


    public function update(Request $request, User $user)
    {
        //
    }


    public function destroy(User $user)
    {
        //
    }
}
