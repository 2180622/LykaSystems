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
    /* Route::resource('/contacts', 'ContactoController'); */
/*     Route::get('/contacts', 'ContactoController@index')->name('contacts.index'); */
/*
    Route::post('/contacts/{contact}', 'ContactoController@store')->name('contacts.store');
    Route::get('/contacts/{contact}', 'ContactoController@edit')->name('contacts.edit');
    Route::put('/contacts/{contact}', 'ContactoController@update')->name('contacts.update');
    Route::delete('/contacts/{contact}', 'ContactoController@destroy')->name('contacts.destroy'); */

    Route::get('/contacts/new/{university?}', 'ContactoController@create')->name('contacts.create');
    Route::get('/contacts/show/{contact}/{university?}', 'ContactoController@show')->name('contacts.show');
    Route::get('/contacts/edit/{contact}/{university?}', 'ContactoController@edit')->name('contacts.edit');
    Route::resource('/contacts', 'ContactoController')->only(['index','destroy', 'update','store']);



/*     Route::resource('/contacts', 'ContactoController', ['except' => ['create']]); */



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
    Route::get('/test/agends/events', 'AgendController@events');


    /* Pagamentos */
    Route::get('/payments', 'PaymentController@index')->name('payments.index');

    /* Cobranças */
    Route::get('/cobrancas', 'ChargesController@index')->name('charges.index');
      // Transferir comprovativo de pagamento
      Route::get('/cobrancas/{document}/download', 'ChargesController@download')->name('charges.download');
      // Visualizar cobranças
      Route::get('/cobrancas/{product}', 'ChargesController@show')->name('charges.show');
      Route::get('/cobrancas/{product}/{fase}', 'ChargesController@showcharge')->name('charges.showcharge');
      // Adicionar cobrança
      Route::post('/cobrancas/{product}/{fase}', 'ChargesController@store')->name('charges.store');
      // Editar cobrança
      Route::get('/cobrancas/{product}/{fase}/{document}/editar', 'ChargesController@edit')->name('charges.edit');
      Route::put('/cobrancas/{product}/{document}', 'ChargesController@update')->name('charges.update');


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

    /* Fonecedores */
    Route::resource('/fornecedores', 'ProviderController')->parameters([
      'fornecedores' => 'provider'
    ])->names([
      'index' => 'provider.index',
      'store' => 'provider.store',
      'create' => 'provider.create',
      'show' => 'provider.show',
      'update' => 'provider.update',
      'destroy' => 'provider.destroy',
      'edit' => 'provider.edit',
    ]);
});

/* Email Confirmation */
Route::get('/confirmation/{user}', 'AccountConfirmationController@mailconfirmation')->name('confirmation.mail');
Route::post('/confirmation/{user}', 'AccountConfirmationController@update')->name('confirmation.update');

/* Edgar Teste -> Eliminar no futuro */
Route::get('/data', 'EdgarTesteController@index');
