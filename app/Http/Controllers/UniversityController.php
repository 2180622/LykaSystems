<?php

namespace App\Http\Controllers;

use App\User;
use App\Agenda;
use App\Cliente;
use App\Contacto;
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
        return view('universities.list', compact('universities'));


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
        ->orderBy('dataInicio')
        ->get();

        if ($eventos->isEmpty()) {
            $eventos=null;
        }


        /* Obtem os clientes da que estão na universidade */
/*      SELECT DISTINCT cliente.idCliente FROM cliente JOIN produto ON
        cliente.idCliente=produto.idCliente WHERE produto.idUniversidade1 LIKE 1 OR produto.idUniversidade2 =1; */

        $clients = Cliente::distinct('Cliente.idCliente')
        ->join('Produto', 'Produto.idCliente', '=', 'Cliente.idCliente')
        ->where('Produto.idUniversidade1', '=',$university->idUniversidade )
        ->orWhere('Produto.idUniversidade2', '=',$university->idUniversidade)
        ->select('Cliente.idCliente','Cliente.fotografia','Cliente.nome','Cliente.apelido','Cliente.paisNaturalidade','Cliente.slug')
        ->get();

       /*  dd($clients); */

        if ($clients->isEmpty()) {
            $clients=null;
        }



        /* Contactos da universidade */
        $contacts = Contacto::
        where('idUniversidade', '=', $university->idUniversidade)
        ->get();
        if ($contacts->isEmpty()) {
            $contacts=null;
        }



        return view('universities.show', compact('university','eventos','clients','contacts'));
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
