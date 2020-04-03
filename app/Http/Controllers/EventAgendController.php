<?php

namespace App\Http\Controllers;

use App\Agenda;
use Illuminate\Http\Request;

class EventAgendController extends Controller
{
    public function EventoAgenda()
    {
        $events = Agenda::all();

        return response()->json($events);

    }
}
