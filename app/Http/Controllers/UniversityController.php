<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUniversidadeRequest;
use App\Http\Requests\UpdateUniversidadeRequest;
use App\Universidade;
use App\User;
use Illuminate\Http\Request;

class UniversityController extends Controller
{
    public function index()
    {
        $username = Auth()->user();
        $universidades = Universidade::all();
        return view('universities.list', compact('universidades', 'username'));
    }

    public function create()
    {
        $universidade = new Universidade;
        return view('universities.add', compact('universidade'));
    }

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

    public function show(Universidade $universidade)
    {
        return view('universities.show', compact('universidade'));
    }

    public function edit(Universidade $universidade)
    {

        return view('universities.edit', compact('universidade'));
    }

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

    public function destroy(Universidade $universidade)
    {
        $universidade->delete();

        return redirect()->route('universities.index')->with('success', 'Universidade Eliminada com Sucesso!');
    }
}
