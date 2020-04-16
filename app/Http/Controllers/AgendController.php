<?php

namespace App\Http\Controllers;

use App\Agenda;
use Illuminate\Http\Request;

class AgendController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $agends = Agenda::all();
        /*$agend = [];

        foreach ($agends as $agendEvent) {
            $agend[] = \Calendar::agend(
                $agendEvent->titulo,
                false,
                new \DateTime($agendEvent->dataInicio),
                new \DateTime($agendEvent->dataFim),
                $agendEvent->id,
                [
                    'cor' => $agendEvent->color,
                ]
            );
        }*/

        return view('agends.list', compact('agends'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'titulo' => 'required',
            'descricao' => 'required',
            'dataInicio' => 'required',
            'dataFim' => 'required',
            'cor' => 'required',
        ]);

        $agenda = new Agenda;

        $agenda->idUser = auth()->user()->idUser;

        $agenda->titulo = $request->input('titulo');
        $agenda->descricao = $request->input('descricao');
        $agenda->dataInicio = $request->input('dataInicio');
        $agenda->dataFim = $request->input('dataFim');
        $agenda->cor = $request->input('cor');

        $agenda->save();

        return redirect()->route('agends.index')->with('success', 'Evento Adicionado com Sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Agenda  $agenda
     * @return \Illuminate\Http\Response
     */
    public function show(Agenda $agenda)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Agenda  $agenda
     * @return \Illuminate\Http\Response
     */
    public function edit(Agenda $agenda)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Agenda  $agenda
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Agenda $agenda)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Agenda  $agenda
     * @return \Illuminate\Http\Response
     */
    public function destroy(Agenda $agenda)
    {
        //
    }
}
