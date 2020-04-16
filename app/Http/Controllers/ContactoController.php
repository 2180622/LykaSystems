<?php

namespace App\Http\Controllers;

use App\Contacto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
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


        $contacts = Contacto::
        where('Contacto.idUser', '=', Auth::user()->idUser)
        ->get();

        $totalcontacts = $contacts->count();

        return view('contacts.list', compact('contacts', 'totalcontacts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $contact = new Contacto;
        return view('contacts.add',compact('contact'));
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
        $contact = new Contacto;
        $contact->fill($fields);

        if ($request->hasFile('fotografia')) {
            $photo = $request->file('fotografia');
            $profileImg = $contact->nome . '_' . time() . '.' . $photo->getClientOriginalExtension();
            Storage::disk('public')->putFileAs('contact-photos/', $photo, $profileImg);
            $contact->fotografia = $profileImg;
        }

        $contact->idUser = Auth::user()->idUser;

        // data em que foi criado
        $t=time();
        $contact->create_at == date("Y-m-d",$t);

        $contact->save();
        return redirect()->route('contacts.index')->with('success', 'Novo contacto criado com sucesso');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\contacto  $contacto
     * @return \Illuminate\Http\Response
     */
    public function show(contacto $contact)
    {



        return view('contacts.show',compact("contact"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\contacto  $contacto
     * @return \Illuminate\Http\Response
     */
    public function edit(contacto $contact)
    {
        return view('contacts.edit', compact('contact'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\contacto  $contacto
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateContactoRequest $request, contacto $contact)
    {
        $fields = $request->validated();
        $contact->fill($fields);


        if ($request->hasFile('fotografia')) {
            $photo = $request->file('fotografia');
            $profileImg = $contact->nome . '_' . time() . '.' . $photo->getClientOriginalExtension();
            if (!empty($contact->fotografia)) {
                Storage::disk('public')->delete('contact-photos/' . $contact->fotografia);
            }
            Storage::disk('public')->putFileAs('contact-photos/', $photo, $profileImg);
            $contact->fotografia = $profileImg;
        }

        // data em que foi modificado
        $t=time();
        $contact->updated_at == date("Y-m-d",$t);

        $contact->save();


         return redirect()->route('contacts.index')->with('success', 'Dados do contcto modificados com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\contacto  $contacto
     * @return \Illuminate\Http\Response
     */
    public function destroy(contacto $contact)
    {
        $contact->delete();
        return redirect()->route('contacts.index')->with('success', 'Contacto eliminado com sucesso');
    }
}
