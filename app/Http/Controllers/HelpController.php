<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HelpController extends Controller
{
    public function index()
    {
        return view('helpList');
    }

    public function show()
    {
        return view('help');
    }

    public function search(Request $request)
    {
        $search =  $request->get('search');

    }
}
