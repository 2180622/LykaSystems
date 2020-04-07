<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Contracts\Console\Kernel;

Auth::routes();

/* Route group protected with authentication */
Route::group(['middleware' => ['auth', 'PreventBackHistory']], function () {

    /* Logout */
    Route::get('/logout', 'Auth\LoginController@logout');

    /* Dashboard */
    Route::get('/', 'DashboardController@index')->name('dashboard');

    /* Report Problem */
    Route::get('/reportproblem', 'DashboardController@report')->name('report');

    /* Contacts */
    Route::resource('/contacts', 'ContactoController');

    /* Universidades */
    Route::resource('/universities', 'UniversityController');

    /* Estudantes */
    Route::get('/clients/print/{client}', 'ClientController@print')->name('clients.print');
    Route::resource('/clients', 'ClientController');

    /* Agentes */
    Route::get('/agents/print/{agent}', 'AgenteController@print')->name('agents.print');
    Route::resource('/agents', 'AgenteController');

    /* Biblioteca */
    Route::resource('/libraries', 'LibraryController');

    /* Agenda */
    Route::resource('/agends', 'AgendController');
    Route::get('/EventAgend', 'EventAgendController@EventoAgenda')->name('routeEventAgend');


    /* Pagamentos */
    Route::get('/payments', 'PaymentController@index')->name('payments.index');
    Route::get('/payments/{product}', 'PaymentController@show')->name('payments.show');
    Route::get('/payments/{product}/{fase}', 'PaymentController@showfase')->name('payments.showfase');
    Route::put('/payments/{responsabilidade}', 'PaymentController@update')->name('payments.update');

    /* Cobranças */
    Route::get('/charges', 'ChargesController@index')->name('charges.index');


    /* Utilizadores */
    Route::resource('/users', 'UserController');
    Route::post('/users/storeAdmin', 'UserController@storeAdmin')->name('users.storeAdmin');

    /* ProdutosStock*/
    Route::resource('/produtostock', 'ProdutosstockController');

    /* Produtos */
    Route::get('/produtos/create/{client}', 'ProdutoController@create')->name('produtos.create');
    Route::get('/produtos/print/{produto}', 'ProdutoController@print')->name('produtos.print');
    Route::resource('/produtos', 'ProdutoController')->only(['print', 'destroy', 'update','show','edit','store']);
});

/* Email Confirmation */
Route::get('/confirmation/{user}', 'AccountConfirmationController@mailconfirmation')->name('confirmation.mail');
Route::post('/confirmation/{user}', 'AccountConfirmationController@update')->name('confirmation.update');

/* Edgar Teste -> Eliminar no futuro */
Route::get('/edgarteste', 'EdgarTesteController@index');
