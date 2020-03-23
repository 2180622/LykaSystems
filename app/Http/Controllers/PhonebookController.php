<?php

namespace App\Http\Controllers;

use App\Contacto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UpdateContactoRequest;
use App\Http\Requests\StoreContactoRequest;

class PhonebookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $contactos = Contacto::all();
        $total = $contactos->count();


        /* Fornecedores */
        $fornecedores = DB::table("contacto")
        ->select('*')
        ->where('contacto.tipo', '=', 'Fornecedor')
        ->get();

        if ($fornecedores->isEmpty()) {
            $fornecedores=null;
        }



        // Contactos Favoritos
        $favoritos = DB::table("contacto")
        ->select('*')
        ->where('contacto.favorito', '=', true)
        ->get();

        if ($favoritos->isEmpty()) {
            $favoritos=null;
        }

        $Notificacoes = Auth()->user()->getNotifications();
        return view('phonebook.list',compact('contactos','total','fornecedores','favoritos','Notificacoes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $contacto = new Contacto;
        return view('phonebook.add',compact("contacto"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Phonebook  $phonebook
     * @return \Illuminate\Http\Response
     */
    public function show(Contacto $contacto)
    {
        return view('phonebook.show',compact("contacto"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Phonebook  $phonebook
     * @return \Illuminate\Http\Response
     */
    public function edit(Contacto $contacto)
    {
        return view('phonebook.edit', compact('contacto'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Phonebook  $phonebook
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contacto $contacto)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Phonebook  $phonebook
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contacto $contacto)
    {
        $contacto->delete();
                return redirect()->route('phonebook.index')->with('success', 'Contacto eliminado com sucesso');
    }
}
