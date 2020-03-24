<?php
namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\UserController;
use App\Http\Requests\UpdateUserRequest;

class AccountConfirmationController extends Controller
{
    public function mailconfirmation(Request $request, User $user){
      if ($user->password != null) {
        abort(404);
      }else {
        $mailinsert = $request->input('email');
        if ($mailinsert == null) {
          $error = null;
          return view('auth.confirmation-mail', compact('user', 'error'));
        }else {
          if ($user->email == $mailinsert) {
            $error = null;
            return view('auth.confirmation-password', compact('user', 'error'));
          }else {
            $error = "O endereço eletrónico que introduziu é inválido.";
            return view('auth.confirmation-mail', compact('user', 'error'));
          }
        }
      }
    }

    public function edit(User $user){
      return view('auth.confirmation-password', compact('user'));
    }

    public function update(UpdateUserRequest $request, User $user){
      $fields = $request->validated();
      $user->fill($fields);
      $password = $request->input('password');
      $passwordConf = $request->input('password-confirmation');

      if ($password == $passwordConf) {
        $hashed = Hash::make($password);
        $user->password = $hashed;
        $user->auth_key = rand(655541,getrandmax());
        $user->save();
        return view('auth.accountactive', compact('user'));
      }else {
        $error = "As palavras-chaves não coincidem. Verifique a sua inserção.";
        return view('auth.confirmation-password', compact('user', 'error'));
      }
    }
}
