<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Contracts\Console\Kernel;

Auth::routes();

/* Dashboard */
Route::get('/', 'DashboardController@index')->name('dashboard');

/* Utilizadores */
Route::resource('/users', 'UserController');
Route::post('/users/storeAdmin', 'UserController@storeAdmin')->name('users.storeAdmin');
Route::post('/users/storeAgente', 'UserController@storeAgente')->name('users.storeAgente');
Route::post('/users/storeCliente', 'UserController@storeCliente')->name('users.storeCliente');

/* Estudantes */
Route::resource('/clients', 'ClientController');

/* Phonebook */
Route::resource('/phonebook', 'PhonebookController');

Route::get('/home', 'HomeController@index')->name('home');


/* Edgar Teste */ /* eliminar no futuro */
Route::get('/edgarteste', 'EdgarTesteController@index')->name('teste');
