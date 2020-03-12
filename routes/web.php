<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Contracts\Console\Kernel;
use App\Mail\SendEmailConfirmation;
use Illuminate\Support\Facades\Mail;

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

Route::post('/users/storeAdmin', 'UserController@storeAdmin')->name('users.storeAdmin');
Route::post('/users/storeAgente', 'UserController@storeAgente')->name('users.storeAgente');
Route::post('/users/storeCliente', 'UserController@storeCliente')->name('users.storeCliente');

/* Email Confirmation */
Route::get('/confirmation/{user}', 'AccountConfirmationController@index')->name('confirmation.index');
Route::post('/confirmation/{user}', 'AccountConfirmationController@update')->name('confirmation.update');
/* Universidades */
Route::resource('/universities', 'UniversityController');

Route::group(['middleware' => ['auth']], function () {
    /* Dashboard */
    Route::get('/', 'DashboardController@index')->name('dashboard');

    /* Phonebook */
    Route::resource('/phonebook', 'PhonebookController');
});
    /* Estudantes */
    Route::resource('/clients', 'ClientController');

/* Estudantes */
Route::resource('/clients', 'ClientController');

/* Edgar Teste */ /* eliminar no futuro */
Route::get('/edgarteste', 'EdgarTesteController@index');
