<?php

namespace App\Http\Controllers;

use App\Cliente;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateClienteRequest;
use App\Http\Requests\StoreClientRequest;

class ClientController extends Controller
{
    public function index()
    {

        $clients = Cliente::all();
        $totalestudantes = $clients->count();
        return view('clients.list', compact('clients', 'totalestudantes'));
    }




    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create()
    {
        $client = new Cliente;
        return view('clients.add',compact('client'));
    }




    /***********************************************************************//*
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    * @param  \App\User  $user
    */
    public function store(StoreClientRequest $request){

        $fields = $request->validated();
        $client = new Cliente;
        $client->fill($fields);


        if ($request->hasFile('fotografia')) {
            $photo = $request->file('fotografia');
            $profileImg = $client->nome . '_' . time() . '.' . $photo->getClientOriginalExtension();
            Storage::disk('public')->putFileAs('users_photos/', $photo, $profileImg);
            $client->fotografia = $profileImg;
            $client->save();
        }

        // data em que foi criado
        $t=time();
        $client->create_at == date("Y-m-d",$t);

        $client->save();
        return redirect()->route('clients.index')->with('success', 'Ficha de estudante criada com sucesso');
    }




    /**
    * Display the specified resource.
    *
    * @param  \App\Cliente  $client
    * @return \Illuminate\Http\Response
    */
    public function show(Cliente $client)
    {

        return view('clients.show',compact("client"));
    }





    /**
    * Show the form for editing the specified resource.
    *
    * @param  \App\Cliente  $client
    * @return \Illuminate\Http\Response
    */
    public function edit(Cliente $client)
    {

        return view('clients.edit', compact('client'));
    }



    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \App\User  $user
    * @return \Illuminate\Http\Response
    */
    public function update(UpdateClienteRequest $request, Cliente $client)
    {
        $fields = $request->validated();
        $client->fill($fields);


        if ($request->fotografia==null){
            $client->fotografia = "default_client.png";
        }

        if ($request->hasFile('fotografia')) {
            $photo = $request->file('fotografia');
            $profileImg = $client->nome . '_' . time() . '.' . $photo->getClientOriginalExtension();
            if (!empty($client->fotografia)) {
                Storage::disk('public')->delete('client-photos/' . $client->fotografia);
            }
            Storage::disk('public')->putFileAs('client-photos/', $photo, $profileImg);
            $client->fotografia = $profileImg;
        }

        // data em que foi modificado
        $t=time();
        $client->updated_at == date("Y-m-d",$t);

        $client->save();



         return redirect()->route('clients.index')->with('success', 'Dados do estudante modificados com sucesso');

    }






    /**
    * Remove the specified resource from storage.
    *
    * @param  \App\Cliente  $client
    * @return \Illuminate\Http\Response
    */

    public function destroy(Cliente $client)
    {
                //$client = client::findOrFail($request->modalclientid);
                $client->delete();
                return redirect()->route('clients.index')->with('success', 'Estudante eliminado com sucesso');
    }
}
