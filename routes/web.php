<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Contracts\Console\Kernel;

/* Dashboard */


Route::get('/dashboard', 'DashboardController@index')->name('dashboard');



/* Utilizadores */
Route::resource('/users', 'UserController');






Route::get('/', function () {
    return view('PAGINA_EXEMPLO');
});
