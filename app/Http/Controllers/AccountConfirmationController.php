<?php
namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Jobs\RestoreAccount;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AccountConfirmationController extends Controller
{
    public function index(Request $request, User $user)
    {
      if ($user->estado == true) {
          abort(403);
      }elseif($user->auth_key == null) {
          return view('auth.account-inactive', compact('user'));
      }else {
          return view('auth.confirmation-key', compact('user'));
      }
    }

    public function keyconfirmation(Request $request, User $user)
    {
      $auth_key = $request->only('key');

      if ($user->auth_key == $auth_key['key']) {
          return view('auth.confirmation-password', compact('user'));
      }else {
          $error = "O código de autenticação que introduziu é inválido.";
          return view('auth.confirmation-key', compact('user', 'error'));
      }
    }

    public function password(Request $request, User $user)
    {
      $password = $request->input('password');
      $passwordConf = $request->input('password-confirmation');

      if ($password == $passwordConf) {
          $hashed = Hash::make($password);
          $user->password = $hashed;
          $user->estado = true;
          $user->save();
          if (Auth::check()) {
              Auth::logout();
          }
          return view('auth.accountactive', compact('user'));
      }else {
          $error = "As palavras-chaves não coincidem. Verifique a sua inserção.";
          return view('auth.confirmation-password', compact('user', 'error'));
      }
    }

    public function restore(Request $request, User $user)
    {
        $email = $request->only('email');

        if ($email['email'] == $user->email) {
            $auth_key = strtoupper(random_str(5));
            User::where('idUser', $user->idUser)->update(['auth_key' => $auth_key]);
            $email = $user->email;
            if ($user->tipo == 'admin') {
                $name = $user->admin->nome.' '.$user->admin->apelido;
            }elseif ($user->tipo == 'agente') {
                $name = $user->agente->nome.' '.$user->agente->apelido;
            }else {
                $name = $user->cliente->nome.' '.$user->cliente->apelido;
            }
            dispatch(new RestoreAccount($email, $name, $auth_key));
            return redirect()->route('confirmation.index', $user);
        }else {
            $error = "O e-mail que inseriu não correspodem ao registado no sistema.";
            return view('auth.account-inactive', compact('user', 'error'));
        }
    }

    public function mailrestorepassword()
    {
        return view('auth.mail-password');
    }

    public function sendmailpassword(Request $request)
    {
        $email = $request->input('email');
        return $email->toJson();
    }
}
