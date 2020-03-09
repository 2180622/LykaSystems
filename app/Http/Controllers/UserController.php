<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Http\Requests\StoreUserRequest;

class UserController extends Controller
{
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
      /*return User::create([
          'username' => $data['username'],
          'name' => $data['name'],
          'apelido' => $data['apelido'],
          'email' => $data['email'],
          'datanasc' => $data['datanasc'],
          'telefone1' => $data['telefone1'],
          'telefone2' => $data['telefone2'],
          'password' => Hash::make($data['password']),
      ]);*/
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
      $fields = $request->validated();
      $user = new User;
      $user->fill($fields);
      $user->password = Hash::make('username');
      $user->save();

      // if ($request->hasFile('photo')) {
      // $photo = $request->file('photo');
      // $profileImg = $user->id . '_' . time() . '.' . $photo->getClientOriginalExtension();
      // Storage::disk('public')->putFileAs('users_photos', $photo, $profileImg);
      // $user->photo = $profileImg;
      //$user->save();
      //}
      //$user->sendEmailVerificationNotification();
      return redirect()->route('users.index')->with('success', 'User successfully created');
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
