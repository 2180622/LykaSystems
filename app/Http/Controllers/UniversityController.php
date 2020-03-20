<?php

namespace App\Http\Controllers;

use App\User;
use App\Universidade;
use Illuminate\Http\Request;
use App\Http\Requests\StoreUniversidadeRequest;
use App\Http\Requests\UpdateUniversidadeRequest;

class UniversityController extends Controller
{
    public function index()
    {
        $universities = Universidade::all();
        $totaluniversidades = $universities->count();
        return view('universities.list', compact('universities', 'totaluniversidades'));
    }

    public function create()
    {
        $university = new Universidade;
        return view('universities.add', compact('university'));
    }

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

    public function show(Universidade $university)
    {
        return view('universities.show', compact('university'));
    }

    public function edit(Universidade $university)
    {
        return view('universities.edit', compact('university'));
    }

    public function update(UpdateUniversidadeRequest $request, Universidade $university)
    {
        $fields = $request->validated();
        $university->fill($fields);

        // Data em que o registo é modificado
        $t = time();
        $university->updated_at == date("Y-m-d", $t);
        $university->save();

        return redirect()->route('universities.index')->with('success', 'Universidade Editada com Sucesso!');

    }

    public function destroy(Universidade $university)
    {
        $university->delete();
        return redirect()->route('universities.index')->with('success', 'Universidade Eliminada com Sucesso!');
    }
}
