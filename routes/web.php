<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Contracts\Console\Kernel;

Auth::routes();

/* Utilizadores */
Route::resource('/users', 'UserController');
Route::post('/users/storeAdmin', 'UserController@storeAdmin')->name('users.storeAdmin');
Route::post('/users/storeAgente', 'UserController@storeAgente')->name('users.storeAgente');
Route::post('/users/storeCliente', 'UserController@storeCliente')->name('users.storeCliente');

  /* Estudantes */
  Route::resource('/clients', 'ClientController');

Route::group(['middleware' => ['auth']], function () {
  /* Dashboard */
  Route::get('/', 'DashboardController@index')->name('dashboard');

  /* Universidades */
  Route::resource('/universities', 'UniversityController');

  /* Phonebook */
  Route::resource('/phonebook', 'PhonebookController');
});


/* Edgar Teste */ /* eliminar no futuro */
Route::get('/edgarteste', 'EdgarTesteController@index')->name('teste');
