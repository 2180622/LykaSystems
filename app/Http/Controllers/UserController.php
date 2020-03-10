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
  public $storeAdmin;
  public $storeAgente;
  public $storeCliente;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('users.list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $user = new User;

      return view('users.add', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeAdmin(Request $request)
    {
      $curTime = Carbon::now();
      $user = new User;

      $user->username = "username";
      $user->tipo = "admin";
      $user->password_hash = Hash::make('username');
      $user->password_reset_token = "sd65fg4s65d4g65sd4gf6";
      $user->verification_token = "65sd41g65sd14fg654sdfg";
      $user->auth_key = "65sdf4g65sdf41gh654s1g";
      $user->status = 10;
      $user->created_at = $curTime;
      $user->updated_at = $curTime;

      $admin = new Administrador;
      $admin->nome = "username";
      $admin->apelido = "emanresu";
      $admin->email = "username@gmail.com";
      $admin->dataNasc = "2000-10-10";
      $admin->telefone1 = "915632269";
      $admin->dataRegis = $curTime;
      // $admin->created_at = $curTime;
      // $admin->updated_at = $curTime;

      $user->save();
      $admin->save();

      // if ($request->hasFile('photo')) {
      // $photo = $request->file('photo');
      // $profileImg = $user->id . '_' . time() . '.' . $photo->getClientOriginalExtension();
      // Storage::disk('public')->putFileAs('users_photos', $photo, $profileImg);
      // $user->photo = $profileImg;
      //$user->save();
      //}
      //$user->sendEmailVerificationNotification();
      return redirect()->route('users.index', compact('user', 'admin'))->with('success', 'Admin successfully created');
    }

    public function storeAgente(StoreUserRequest $request)
    {
      $fields = $request->validated();
      $user = new User;
      $agente = new Agente;
      $agente->fill($fields);
      $user->fill($fields);
      $user->password = Hash::make('username');

      dd($user);
      $user->save();
      $agente->save();

      return redirect()->route('users.index')->with('success', 'Agent successfully created');
    }

    public function storeCliente(Request $request)
    {
      $fields = $request->validated();
      $user = new User;
      $cliente = new Cliente;
      $cliente->fill($fields);
      $user->fill($fields);
      $user->password = Hash::make('username');
      $user->save();
      $cliente->save();

      return redirect()->route('users.index')->with('success', 'Client successfully created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from s.addstorage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
