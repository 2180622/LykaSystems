<?php
namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\UserController;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Support\Facades\Hash;

class AccountConfirmationController extends Controller
{
    public function index($user){
      $user = User::findOrFail($user);
      return view('confirmation', compact('user'));
    }

    public function edit(User $user){
      return view('confirmation', compact('user'));
    }

    public function update(UpdateUserRequest $request, User $user){
      $fields = $request->validated();
      $user->fill($fields);
      $password = $request->input('password');
      $hashed = Hash::make($password);
      $user->password = $hashed;
      $user->save();
      return redirect()->route('confirmation.index', $user)->with('success', 'Password successfully updated');
    }
}
