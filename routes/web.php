<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Contracts\Console\Kernel;

Auth::routes();

/* Dashboard */
Route::get('/', 'DashboardController@index')->name('dashboard');

/* Utilizadores */
Route::resource('/users', 'UserController');

/* Estudantes */
Route::resource('/students', 'StudentController');

/* Phonebook */
Route::resource('/phonebook', 'PhonebookController');

Route::get('/home', 'HomeController@index')->name('home');
