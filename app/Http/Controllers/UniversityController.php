<?php

namespace App\Http\Controllers;

use App\Universidade;
use Illuminate\Http\Request;
use App\User;
use App\Http\Requests\StoreUniversidadeRequest;
use App\Http\Requests\UpdateUniversidadeRequest;

class UniversityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $universities = Universidade::all();
        $totaluniversidades = $universities->count();
        return view('universities.list', compact('universities', 'totaluniversidades'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $university = new Universidade;
        return view('universities.add', compact('university'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUniversidadeRequest $request)
    {
        $fields = $request->validated();

        $university = new Universidade;
        $university->fill($fields);

        // Data em que o registo é criado
        $t = time();
        $university->create_at == date("Y-m-d", $t);

        $university->save();

        return redirect()->route('universities.index')->with('success', 'Universidade Adicionada com Sucesso!');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\University  $university
     * @return \Illuminate\Http\Response
     */
    public function show(University $university)
    {
        return view('universities.show', compact('university'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\University  $university
     * @return \Illuminate\Http\Response
     */
    public function edit(University $university)
    {
        return view('universities.edit', compact('university'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\University  $university
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUniversidadeRequest $request, University $university)
    {
        $fields = $request->validated();
        $university->fill($fields);

        // Data em que o registo é modificado
        $t = time();
        $university->updated_at == date("Y-m-d", $t);
        $university->save();

        return redirect()->route('universities.index')->with('success', 'Universidade Editada com Sucesso!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\University  $university
     * @return \Illuminate\Http\Response
     */
    public function destroy(University $university)
    {
        $university->delete();

        return redirect()->route('universities.index')->with('success', 'Universidade Eliminada com Sucesso!');

    }
}
