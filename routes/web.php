<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Contracts\Console\Kernel;


/* Dashboard */
Route::get('/', 'DashboardController@index')->name('dashboard');

/* Utilizadores */
Route::resource('/users', 'UserController');

/* Estudantes */
Route::resource('/students', 'StudentController');




/* Phonebook */
Route::resource('/phonebook', 'PhonebookController');



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
