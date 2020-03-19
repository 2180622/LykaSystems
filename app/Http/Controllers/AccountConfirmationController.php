<?php
namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\UserController;
use App\Http\Requests\UpdateUserRequest;

class AccountConfirmationController extends Controller
{
    public function index($user){
      $user = User::findOrFail($user);
      return view('auth.confirmation-mail', compact('user'));
    }

    public function mailconfirmation(Request $request, User $user){
      $mailinsert = $request->input('email');
      if ($mailinsert == null) {
        return view('auth.confirmation-mail', compact('user'));
      }else {
        if ($user->email == $mailinsert) {
          return view('auth.confirmation-password', compact('user'));
        }else {
          abort(403);
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
        $user->save();
        return view('auth.accountactive', compact('user'));
      }else {
        return redirect()->route('confirmation.update', $user)->with('error', 'As passwords não coincidem. Verique a sua inserção.');
      }
    }
}
