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
      return view('auth.confirmation', compact('user'));
    }

    public function edit(User $user){
      return view('auth.confirmation', compact('user'));
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
        return redirect()->route('confirmation.index', $user)->with('success', 'Password successfully updated');
      }else {
        $error = "lorem ipsum";
        return redirect()->route('confirmation.update', $user)->with('error');
      }
    }
}
