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
use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\UpdateAdministradorRequest;

class UserController extends Controller
{
    public function index()
    {
        $users = User::where('tipo', '=', 'admin')->with('admin')->get();
        return view('users.list', compact('users'));
    }

    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    public function create()
    {
      $user = new User;
      return view('users.add', compact('user'));
    }

    public function store(StoreUserRequest $requestUser, StoreAdministradorRequest $requestAdmin){
      $fieldsUser = $requestUser->validated();
      $fieldsAdmin = $requestAdmin->validated();

      $user = new User;
      $user->tipo = "admin";
      $user->fill($fieldsUser);

      $admin = new Administrador;
      $admin->fill($fieldsAdmin);

      $name = $admin->nome .' '. $admin->apelido;
      $admin->save();

      $user->idAdmin = $admin->idAdmin;
      $user->email = $admin->email;
      $user->slug = post_slug($name);
      $user->save();

      $email = $user->email;
      Mail::to($email)->send(new SendEmailConfirmation($name));

      return redirect()->route('users.index')->with('success', 'Utilizador criado com sucesso.');
    }

    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    public function update(UpdateUserRequest $requestUser, UpdateAdministradorRequest $requestAdmin, User $user, Administrador $admin)
    {
        $fieldsUser = $requestUser->validated();
        $fieldsAdmin = $requestAdmin->validated();
        $user->fill($fieldsUser);
        $admin->fill($fieldsAdmin);

        $update = time();
        $user->updated_at == date("Y-m-d", $update);
        $admin->updated_at == date("Y-m-d", $update);

        DB::table('User')
        ->where('idAdmin', $admin->idAdmin)
        ->update(['email' => $admin->email]);

        $admin->save();
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
