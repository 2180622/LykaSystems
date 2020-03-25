<?php

namespace App\Http\Controllers;

use App\Contacto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UpdateContactoRequest;
use App\Http\Requests\StoreContactoRequest;

class ContactoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contactos = Contacto::all();

        return view('contacts.list',compact('contactos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $contacto = new Contacto;
        return view('contacts.add',compact("contacto"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreContactoRequest $request)
    {
        $fields = $request->validated();
        $contacto = new Contacto;
        $contacto->fill($fields);

        if ($request->hasFile('fotografia')) {
            $photo = $request->file('fotografia');
            $profileImg = $contacto->nome . '_' . time() . '.' . $photo->getClientOriginalExtension();
            Storage::disk('public')->putFileAs('contact-photos/', $photo, $profileImg);
            $contacto->fotografia = $profileImg;
            $contacto->save();
        }

        if ($request->fotografia==null){
            $contacto->fotografia = "default.png";
        }

        // data em que foi criado
        $t=time();
        $contacto->create_at == date("Y-m-d",$t);

        $contacto->save();
        return redirect()->route('clients.index')->with('success', 'Novo contacto criado com sucesso');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Contacto  $contacto
     * @return \Illuminate\Http\Response
     */
    public function show(Contacto $contacto)
    {


        return view('contacts.show',compact("contacto"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Contacto  $contacto
     * @return \Illuminate\Http\Response
     */
    public function edit(Contacto $contacto)
    {

        return view('contacts.edit', compact('contacto'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Contacto  $contacto
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateContactoRequest $request, Contacto $contacto)
    {
        $fields = $request->validated();
        $contacto->fill($fields);


        if ($request->hasFile('fotografia')) {
            $photo = $request->file('fotografia');
            $profileImg = $contacto->nome . '_' . time() . '.' . $photo->getClientOriginalExtension();
            if (!empty($contacto->fotografia)) {
                Storage::disk('public')->delete('contact-photos/' . $contacto->fotografia);
            }
            Storage::disk('public')->putFileAs('contact-photos/', $photo, $profileImg);
            $contacto->fotografia = $profileImg;
        }

        // data em que foi modificado
        $t=time();
        $contacto->updated_at == date("Y-m-d",$t);

        $contacto->save();


         return redirect()->route('contacts.index')->with('success', 'Dados do contacto modificados com sucesso');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Contacto  $contacto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contacto $contacto)
    {
        $contacto->delete();
        return redirect()->route('contacts.index')->with('success', 'Contacto eliminado com sucesso');
    }
}
