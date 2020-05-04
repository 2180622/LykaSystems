<?php
namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\UserController;
use App\Http\Requests\UpdateUserRequest;

class AccountConfirmationController extends Controller
{
    public function index(Request $request, User $user)
    {
      return view('auth.confirmation-key', compact('user'));
    }

    public function keyconfirmation(Request $request, User $user)
    {
      $auth_key = $request->input('key');

      if ($user->auth_key == $auth_key) {
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
        $user->save();
        return view('auth.accountactive', compact('user'));
      }else {
        $error = "As palavras-chaves não coincidem. Verifique a sua inserção.";
        return view('auth.confirmation-password', compact('user', 'error'));
      }
    }

    public function setpassword(Request $request, User $user)
    {

    }
}
