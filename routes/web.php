<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Contracts\Console\Kernel;

Auth::routes();

/* Route group protected with authentication */
Route::group(['middleware' => ['auth']], function () {
  /* Dashboard */
  Route::get('/', 'DashboardController@index')->name('dashboard');

  /* Phonebook */
  Route::resource('/phonebook', 'PhonebookController');
});

/* Utilizadores */
Route::resource('/users', 'UserController');

/* Universidades */
Route::resource('/universities', 'UniversityController');

/* Estudantes */
Route::resource('/clients', 'ClientController');

/* Edgar Teste */ /* eliminar no futuro */
Route::get('/edgarteste', 'EdgarTesteController@index')->name('teste');
