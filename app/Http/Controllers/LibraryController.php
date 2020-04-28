<?php

namespace App\Http\Controllers;

use App\Biblioteca;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Biblioteca  $biblioteca
     * @return \Illuminate\Http\Response
     */
    public function show(Biblioteca $biblioteca)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Biblioteca  $biblioteca
     * @return \Illuminate\Http\Response
     */
    public function edit(Biblioteca $biblioteca)
    {
        /* Permissões */
        if (Auth::user()->tipo != "admin" ){
            abort (401);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Biblioteca  $biblioteca
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Biblioteca $biblioteca)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Biblioteca  $biblioteca
     * @return \Illuminate\Http\Response
     */
    public function destroy(Biblioteca $biblioteca)
    {
        /* Permissões */
        if (Auth::user()->tipo != "admin" ){
            abort (401);
        }
    }
}
