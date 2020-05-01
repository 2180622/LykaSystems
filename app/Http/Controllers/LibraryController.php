<?php

namespace App\Http\Controllers;

use App\Biblioteca;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreLibraryRequest;
use App\Http\Requests\UpdateLibraryRequest;
use Illuminate\Support\Facades\Storage;


class LibraryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        /* Ficheiros para os agentes */
        if (Auth::user()->tipo != "admin" ){
            $files = Biblioteca::
            where('acesso', '=', "Público")
            ->get();
        }else{
            /* Ficheiros para os admins */
            $files = Biblioteca::all();
        }

        return view('libraries.list', compact('files'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        /* Permissões */
        if (Auth::user()->tipo != "admin" ){
            abort (401);
        }
        $library = new Biblioteca;
        return view('libraries.add' , compact('library'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreLibraryRequest $request)
    {
        $file = new Biblioteca;
        $fields = $request->validated();
        $file->fill($fields);

        $file->save();

        if ($request->hasFile('ficheiro')) {
            $uploadfile = $request->file('ficheiro');

            $file_name = $request->file_name . $file->idBiblioteca.'.'.$uploadfile->getClientOriginalExtension();
            $file->ficheiro = $file_name;
            Storage::disk('public')->putFileAs('library/', $uploadfile, $file_name);

            $file->save();
        }

        return redirect()->route('libraries.index')->with('success', 'Ficheiro carregado com sucesso!');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Biblioteca  $file
     * @return \Illuminate\Http\Response
     */
    public function show(Biblioteca $library)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Biblioteca  $file
     * @return \Illuminate\Http\Response
     */
    public function edit(Biblioteca $library)
    {
        /* Permissões */
        if (Auth::user()->tipo != "admin" ){
            abort (401);
        }

        return view('libraries.edit', compact('library'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Biblioteca  $library
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateLibraryRequest $request, Biblioteca $library)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Biblioteca  $library
     * @return \Illuminate\Http\Response
     */
    public function destroy(Biblioteca $library)
    {
        /* Permissões */
        if (Auth::user()->tipo != "admin" ){
            abort (401);
        }
    }
}
