<?php

namespace App\Http\Controllers;

use App\User;
use App\Agenda;
use App\Cliente;
use App\Produto;
use App\Universidade;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests\StoreUniversidadeRequest;
use App\Http\Requests\UpdateUniversidadeRequest;

class UniversityController extends Controller
{
    public function index()
    {
       /* Permissões */
       if (Auth::user()->tipo != "admin" ){
        abort (401);
      }

        $universities = Universidade::all();
        $totaluniversidades = $universities->count();

        return view('universities.list', compact('universities', 'totaluniversidades'));


    }

    public function create()
    {
       /* Permissões */
       if (Auth::user()->tipo != "admin" ){
        abort (401);
      }

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
        return redirect()->route('universities.show',$university)->with('success', 'Universidade Adicionada com Sucesso!');

    }

    public function show(Universidade $university)
    {
       /* Permissões */
       if (Auth::user()->tipo != "admin" ){
        abort (401);
      }

        /* Obtem os eventos da universidade */
        $eventos = Agenda::
        where('idUniversidade', $university->idUniversidade)
        ->get();

        if ($eventos->isEmpty()) {
            $eventos=null;
        }


        /* Obtem os clientes da que estão na universidade */
        $clients = Cliente::where('idCliente', function ($query) use ($university){
            $query->select('idCliente')
            ->from(with(new Produto)->getTable())
            ->where('idUniversidade1', $university->idUniversidade)
            ->orwhere('idUniversidade2', $university->idUniversidade)
            ->distinct('idCliente');
        })->get();

        if ($clients->isEmpty()) {
            $clients=null;
        }



        return view('universities.show', compact('university','eventos','clients'));
    }




    public function edit(Universidade $university)
    {
       /* Permissões */
       if (Auth::user()->tipo != "admin" ){
        abort (401);
      }

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
