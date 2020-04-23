<?php
namespace App\Http\Controllers;

use Mail;
use App\User;
use App\Agente;
use App\Cliente;
use App\Administrador;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Mail\SendEmailConfirmation;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\StoreAdministradorRequest;

class UserController extends Controller
{
    public function index()
    {
        $users = User::where('tipo', '=', 'admin')->get();
        return view('users.list', compact('users'));
    }

    public function create()
    {
      $user = new User;
      return view('users.add', compact('user'));
    }

    public function storeAdmin(StoreUserRequest $requestUser, StoreAdministradorRequest $requestAdmin){
      $fieldsUser = $requestUser->validated();
      $fieldsAdmin = $requestAdmin->validated();

      $user = new User;
      $user->tipo = "admin";
      $user->status = 10;
      $user->fill($fieldsUser);

      $admin = new Administrador;
      $admin->fill($fieldsAdmin);

      $name = $admin->nome .' '. $admin->apelido;

      $admin->save();
      $user->idAdmin = $admin->idAdmin;
      $user->email = $admin->email;
      $user->save();

      $email = $user->email;
      $id = $user->idUser;
      Mail::to($email)->send(new SendEmailConfirmation($id, $name));

      return redirect()->route('users.index')->with('success', 'Utilizador criado com sucesso.');
    }


    public function show(User $user, Administrador $admin)
    {
        return view('users.show', compact('user', 'admin'));
    }


    public function edit(User $user)
    {
      return view('users.edit', compact('user'));
    }


    public function update(StoreUserRequest $request, StoreAdministradorRequest $requestAdmin, User $user)
    {
        $fields = $request->validated();
        $user->fill($fields);

        $update = time();
        $user->updated_at == date("Y-m-d",$update);
        //
        // DB::table('User')
        // ->where('idAdmin', $admin->idAdmin)
        // ->update(['email' => $admin->email]);
        $user->save();

        return redirect()->route('users.index')->with('success', 'Dados do user modificados com sucesso');
    }


    public function destroy(User $user)
    {
        //
    }

    public function print(User $user)
    {
        return view('user.print',compact("user"));
    }
}
