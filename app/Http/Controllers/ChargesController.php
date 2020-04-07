<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ChargesController extends Controller
{
    public function index()
    {
      return view('charges.list');
    }
}
