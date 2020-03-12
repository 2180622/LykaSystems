<?php

namespace App\Http\Controllers;

use App\Cliente;
use Hash;
use Illuminate\Http\Request;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\StoreClienteRequest;
use App\User;
use Carbon\Carbon;

class ClientController extends Controller
{
    public function index(){
        $username = Auth()->user();
        $clients = Cliente::all();
        return view('clients.list', compact('clients', 'username'));
    }


    public function create()
    {
        return view('clients.add');
    }


    public function store(StoreUserRequest $requestUser, StoreClienteRequest $requestCliente){
      $curTime = Carbon::now();

      $fieldsUser = $requestUser->validated();
      $fieldsCliente = $requestCliente->validated();

      $user = new User;
      $user->tipo = "cliente";
      $user->auth_key = rand(655541,getrandmax());
      $user->status = 10;
      $user->fill($fieldsUser);
      //gerar hash a partir da pass inserida
      $hashed = Hash::make('password');
      $user->password = $hashed;

      $cliente= new Cliente;
      $cliente->dataRegis = $curTime;
      $cliente->fill($fieldsCliente);

      $cliente->save();
      $user->idCliente = $cliente->idCliente;
      $user->email = $cliente->email;
      $user->save();

      $email = $user->email;
      $id = $user->idUser;
      Mail::to($email)->send(new SendEmailConfirmation($id));

      return redirect()->route('users.index')->with('success', 'Client successfully created');
    }


    public function show(Client $client)
    {
        return view('clients.show');
    }


    public function edit(Client $client)
    {
        return view('clients.edit');
    }


    public function update(Request $request, Client $client)
    {
        //
    }


    public function destroy(Client $client)
    {
        //
    }
}
