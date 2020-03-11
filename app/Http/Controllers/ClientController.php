<?php

namespace App\Http\Controllers;

use App\Cliente;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index()
    {
        $clientes = Cliente::all();

        return view('clients.list', compact('clientes'));
    }


    public function create()
    {
        return view('clients.add');
    }


    public function store(Request $request)
    {
        //
    }


    public function show(Client $client)
    {
        return view('clients.show');
    }


    public function edit(Client $client)
    {
        return view('clients.edit');
    }


    public function update(Request $request, Client $client)
    {
        //
    }


    public function destroy(Client $client)
    {
        //
    }
}
