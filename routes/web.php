<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Contracts\Console\Kernel;

Auth::routes();

/* Route group protected with authentication */
Route::group(['middleware' => ['auth', 'PreventBackHistory']], function () {
  /* Dashboard */
  Route::get('/', 'DashboardController@index')->name('dashboard');

  /* Phonebook */
  Route::resource('/phonebook', 'PhonebookController');

  /* Universidades */
  Route::resource('/universities', 'UniversityController');

  /* Estudantes */
  Route::resource('/clients', 'ClientController');

  /* Agentes */
  Route::resource('agents', 'AgentController');

  /* Logout */
  Route::get('logout', 'Auth\LoginController@logout');
});

/* Utilizadores */
Route::resource('/users', 'UserController');

Route::post('/users/storeAdmin', 'UserController@storeAdmin')->name('users.storeAdmin');
Route::post('/users/storeAgente', 'UserController@storeAgente')->name('users.storeAgente');

/* Email Confirmation */
Route::get('/confirmation/{user}', 'AccountConfirmationController@index')->name('confirmation.index');
Route::post('/confirmation/{user}', 'AccountConfirmationController@update')->name('confirmation.update');

/* Edgar Teste */ /* eliminar no futuro */
Route::get('/edgarteste', 'EdgarTesteController@index');
