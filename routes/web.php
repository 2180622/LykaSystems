<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Contracts\Console\Kernel;



/* Dashboard */
Route::get('/', 'DashboardController@index')->name('dashboard');



/* Utilizadores */
Route::resource('/users', 'UserController');







