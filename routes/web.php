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

/* Email Confirmation */
Route::get('/confirmation/{user}', 'AccountConfirmationController@index')->name('confirmation.index');
Route::post('/confirmation/{user}', 'AccountConfirmationController@update')->name('confirmation.update');

/* Universidades */
Route::resource('/universities', 'UniversityController');

/* Estudantes */
Route::resource('/clients', 'ClientController');

/* Edgar Teste */ /* eliminar no futuro */
Route::get('/edgarteste', 'EdgarTesteController@index');
