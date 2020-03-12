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
use App\Mail\SendEmailConfirmation;
use Mail;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('users.list', compact('users'));
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
      $password = $requestUser->get('password');
      $hashed = Hash::make($password);
      $user->password = $hashed;

      $admin = new Administrador;
      $admin->dataRegis = $curTime;
      $admin->fill($fieldsAdmin);

      $admin->save();
      $user->idAdmin = $admin->idAdmin;
      $user->email = $admin->email;
      $user->save();

      $email = $user->email;
      $id = $user->idUser;
      Mail::to($email)->send(new SendEmailConfirmation($id));

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
      $password = $requestUser->get('password');
      $hashed = Hash::make($password);
      $user->password = $hashed;

      $agente = new Agente;
      $agente->dataRegis = $curTime;
      $agente->fill($fieldsAgente);

      $agente->save();
      $user->idAgente = $agente->idAgente;

      $user->save();

      return redirect()->route('users.index')->with('success', 'Agent successfully created');
    }

    public function storeCliente(StoreUserRequest $requestUser, StoreClienteRequest $requestCliente){
      $curTime = Carbon::now();

      $fieldsUser = $requestUser->validated();
      $fieldsCliente = $requestCliente->validated();

      $user = new User;
      $user->tipo = "cliente";
      $user->auth_key = rand(655541,getrandmax());
      $user->status = 10;
      $user->fill($fieldsUser);
      //gerar hash a partir da pass inserida
      $password = $requestUser->get('password');
      $hashed = Hash::make($password);
      $user->password = $hashed;

      $cliente= new Cliente;
      $cliente->dataRegis = $curTime;
      $cliente->fill($fieldsCliente);

      $cliente->save();
      $user->idCliente = $cliente->idCliente;

      $user->save();

      return redirect()->route('users.index')->with('success', 'Client successfully created');
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
