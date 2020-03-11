<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUniversidadeRequest;
use App\Http\Requests\UpdateUniversidadeRequest;
use App\Universidade;
use Illuminate\Http\Request;

class UniversityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $universidades = Universidade::all();
        return view('universities.list', compact('universidades'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $universidade = new Universidade;
        return view('universities.add', compact('universidade'));
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

        $universidade = new Universidade;
        $universidade->fill($fields);

        // Data em que o registo é criado
        $t = time();
        $universidade->create_at == date("Y-m-d", $t);

        $universidade->save();

        return redirect()->route('universities.index')->with('success', 'Universidade Adicionada com Sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Universidade  $universidade
     * @return \Illuminate\Http\Response
     */
    public function show(Universidade $universidade)
    {
        return view('universities.show', compact('universidade'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Universidade  $Universidade
     * @return \Illuminate\Http\Response
     */
    public function edit(Universidade $universidade)
    {

        return view('universities.edit', compact('universidade'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Universidade  $universidade
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUniversidadeRequest $request, Universidade $universidade)
    {
        $fields = $request->validated();
        $universidade->fill($fields);

        // Data em que o registo é modificado
        $t = time();
        $universidade->updated_at == date("Y-m-d", $t);
        $universidade->save();

        return redirect()->route('universities.index')->with('success', 'Universidade Editada com Sucesso!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Universidade  $universidade
     * @return \Illuminate\Http\Response
     */
    public function destroy(Universidade $universidade)
    {
        $universidade->delete();

        return redirect()->route('universities.index')->with('success', 'Universidade Eliminada com Sucesso!');
    }
}
