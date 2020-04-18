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
    Route::get('/reportproblem', 'ExtraFunctionsController@report')->name('report');
    Route::post('/reportproblem/sendmail', 'ExtraFunctionsController@reportmail')->name('report.send');

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
    Route::post('/agends/create', 'AgendController@store')->name('agend.store');


    /* Pagamentos */
    Route::get('/payments', 'PaymentController@index')->name('payments.index');
    Route::get('/payments/{product}', 'PaymentController@show')->name('payments.show');
    Route::get('/payments/{product}/{fase}', 'PaymentController@showpayment');

    /* Cobranças */
    Route::get('/charges', 'ChargesController@index')->name('charges.index');
    Route::get('/charges/{product}', 'ChargesController@show')->name('charges.show');
    Route::get('/charges/{product}/{fase}', 'ChargesController@showcharge')->name('charges.showcharge');
    Route::post('/charges/{product}/{fase}', 'ChargesController@store')->name('charges.store');
    Route::get('/charges/{product}/{fase}/{paymentProof}/edit', 'ChargesController@edit')->name('charges.edit');
    Route::put('/charges/{product}/{paymentProof}', 'ChargesController@update')->name('charges.update');
    Route::get('/charges/{paymentProof}/download', 'ChargesController@download')->name('charges.download');

    /* Utilizadores */
    Route::resource('/users', 'UserController');
    Route::post('/users/storeAdmin', 'UserController@storeAdmin')->name('users.storeAdmin');

    /* Produto Stock*/
    Route::resource('/produtostock', 'ProdutosstockController');
    Route::get('/produtostock/{fasestock}', 'ProdutosstockController@show')->name('produtostock.show');

    /* Fase Stock */
    Route::resource('/fasestock', 'FasestockController');
    Route::post('/produtostock/{produtostock}', 'FasestockController@store')->name('fasestock.store');
    Route::get('/fasestock/{docstock}', 'FasestockController@show')->name('fasestock.show');

    /* Documentos Stock*/
    Route::resource('/documentostock', 'DocumentostockController');
    Route::post('/fasestock/{fasestock}', 'DocumentostockController@store')->name('documentostock.store');

    /* Produtos */
    Route::get('/produtos/create/{client}', 'ProdutoController@create')->name('produtos.create');
    Route::get('/produtos/print/{produto}', 'ProdutoController@print')->name('produtos.print');
    Route::resource('/produtos', 'ProdutoController')->only(['destroy', 'update','show','edit','store']);

    /* Conta */
    Route::resource('/conta', 'ContaController');
});

/* Email Confirmation */
Route::get('/confirmation/{user}', 'AccountConfirmationController@mailconfirmation')->name('confirmation.mail');
Route::post('/confirmation/{user}', 'AccountConfirmationController@update')->name('confirmation.update');

/* Edgar Teste -> Eliminar no futuro */
Route::get('/data', 'EdgarTesteController@index');
