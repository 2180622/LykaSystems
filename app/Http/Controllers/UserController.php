<?php

namespace App\Http\Controllers;

use App\User;
use App\Administrador;
use App\Cliente;
use App\Agente;
use Illuminate\Http\Request;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\StoreAdministradorRequest;
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

      $admin = new Administrador;
      $admin->dataRegis = $curTime;
      $admin->fill($fieldsAdmin);

      $user->save();
      $admin->save();

      return redirect()->route('users.index')->with('success', 'Admin successfully created');
    }

    // public function storeAgente(Request $request)
    // {
    //   $fields = $request->validate();
    //   $user = new User;
    //   $agente = new Agente;
    //   $agente->fill($fields);
    //   $user->fill($fields);
    //   $user->password = Hash::make('username');
    //
    //   dd($user);
    //   $user->save();
    //   $agente->save();
    //
    //   return redirect()->route('users.index')->with('success', 'Agent successfully created');
    // }
    //
    // public function storeCliente(StoreUserRequest $request)
    // {
    //   $fields = $request->validate();
    //   $user = new User;
    //   $cliente = new Cliente;
    //   $cliente->fill($fields);
    //   $user->fill($fields);
    //   $user->password = Hash::make('username');
    //   $user->save();
    //   $cliente->save();
    //
    //   return redirect()->route('users.index')->with('success', 'Client successfully created');
    // }


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
