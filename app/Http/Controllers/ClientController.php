<?php

namespace App\Http\Controllers;

use App\Cliente;
use Hash;
use Illuminate\Http\Request;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\StoreClienteRequest;
use App\User;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ClientController extends Controller
{
    public function index()
    {

        $clients = Cliente::all();
        $totalestudantes = DB::table('cliente')->count();
        return view('clients.list', compact('clients', 'totalestudantes'));
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
      // $password = $requestUser->get('password');
      $hashed = Hash::make('password');
      $user->password = $hashed;

      $cliente= new Cliente;
      $cliente->dataRegis = $curTime;
      $cliente->fill($fieldsCliente);

      $cliente->save();
      $user->idCliente = $cliente->idCliente;
      $user->email = $cliente->email;
      $user->save();

      return redirect()->route('users.index')->with('success', 'Client successfully created');
    }


    public function show(Cliente $client)
    {

        return view('clients.show',compact("client"));
    }


    public function edit(Cliente $client)
    {
        return view('clients.edit',$client);
    }


    public function update(Request $request, Cliente $client)
    {
        //
    }


    public function destroy(Cliente $client)
    {
        //
    }
}
