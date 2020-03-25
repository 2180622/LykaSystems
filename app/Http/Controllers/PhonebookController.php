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
    public function index()
    {

        $contactos = Contacto::all();


        // Contactos Favoritos
        $favoritos = DB::table("Contacto")
        ->select('*')
        ->where('favorito', '=', true)
        ->get();

        if ($favoritos->isEmpty()) {
            $favoritos=null;
        }



        $Notificacoes = Auth()->user()->getNotifications(); // PORQUE É QUE ESTÁ AQUI(EM TODAS AS PAGINAS), E NÃO ESTÁ SÓ NO MASTER?



        return view('phonebook.list',compact('contactos','favoritos','Notificacoes'));
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
