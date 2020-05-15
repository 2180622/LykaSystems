<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Contracts\Console\Kernel;
use Illuminate\Support\Facades\Auth;

Auth::routes();

/* Route group protected with authentication and prevent back in history after logout */
Route::group(['middleware' => ['auth', 'PreventBackHistory']], function () {
    /* Logout */
    Route::get('/logout', 'Auth\LoginController@logout');

    /* Dashboard */
    Route::get('/', 'DashboardController@index')->name('dashboard');

    /* Reportar Problema */
    Route::get('/reportar-problema', 'ExtraFunctionsController@report')->name('report');
    Route::post('/reportar-problema/email', 'ExtraFunctionsController@reportmail')->name('report.send');

    /* Procura de contactos */
    Route::post('/procurar-contacto', 'ExtraFunctionsController@searchcontact')->name('search.contact');

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
    Route::resource('/universidades', 'UniversityController')->parameters([
        'universidades' => 'university'
    ])->names([
        'index' => 'universities.index',
        'store' => 'universities.store',
        'create' => 'universities.create',
        'show' => 'universities.show',
        'update' => 'universities.update',
        'destroy' => 'universities.destroy',
        'edit' => 'universities.edit',
    ]);

    /* Estudantes */
    Route::get('/clientes/print/{client}', 'ClientController@print')->name('clients.print');
    Route::resource('/clientes', 'ClientController')->parameters([
        'clientes' => 'client'
    ])->names([
        'index' => 'clients.index',
        'store' => 'clients.store',
        'create' => 'clients.create',
        'show' => 'clients.show',
        'update' => 'clients.update',
        'destroy' => 'clients.destroy',
        'edit' => 'clients.edit',
    ]);

    /* Agentes */
    Route::get('/agents/print/{agent}', 'AgenteController@print')->name('agents.print');
    Route::resource('/agentes', 'AgenteController')->parameters([
        'agentes' => 'agent'
    ])->names([
        'index' => 'agents.index',
        'store' => 'agents.store',
        'create' => 'agents.create',
        'show' => 'agents.show',
        'update' => 'agents.update',
        'destroy' => 'agents.destroy',
        'edit' => 'agents.edit',
    ]);

    /* Biblioteca */
    Route::resource('/biblioteca', 'LibraryController')->parameters([
        'biblioteca' => 'library'
    ])->names([
        'index' => 'libraries.index',
        'store' => 'libraries.store',
        'create' => 'libraries.create',
        'show' => 'libraries.show',
        'update' => 'libraries.update',
        'destroy' => 'libraries.destroy',
        'edit' => 'libraries.edit',
    ]);

    /* Agenda */
    Route::resource('/agenda', 'AgendController');
    Route::post('/agenda', 'AgendController@store')->name('agend.store');

    /* Pagamentos */
    Route::get('/pagamentos', 'PaymentController@index')->name('payments.index');
    Route::post('/pagamentos/pesquisa', 'PaymentController@search')->name('payments.search');
        // Registar pagamento CLIENTE
        Route::get('/pagamentos/cliente/{cliente}/fase/{fase}/{responsabilidade}', 'PaymentController@createcliente')->name('payments.cliente');
        // Registar pagamento AGENTE
        Route::get('/pagamentos/agente/{agente}/fase/{fase}/{responsabilidade}', 'PaymentController@createagente')->name('payments.agente');
        // Registar pagamento SUBAGENTE
        Route::get('/pagamentos/subagente/{subagente}/fase/{fase}/{responsabilidade}', 'PaymentController@createsubagente')->name('payments.subagente');
        // Registar pagamento UNIVERSIDADE PRINCIPAL
        Route::get('/pagamentos/universidade-principal/{universidade1}/fase/{fase}/{responsabilidade}', 'PaymentController@createuni1')->name('payments.uni1');
        // Registar pagamento UNIVERSIDADE SECUNDÁRIA
        Route::get('/pagamentos/universidade-secundaria/{universidade2}/fase/{fase}/{responsabilidade}', 'PaymentController@createuni2')->name('payments.uni2');
        // Registar pagamento FORNECEDOR
        Route::get('/pagamentos/fornecedor/{fornecedor}/fase/{fase}/{relacao}', 'PaymentController@createfornecedor')->name('payments.fornecedor');
    Route::post('/pagamentos/{responsabilidade}/registar', 'PaymentController@store')->name('payments.store');

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
    Route::resource('/administradores', 'UserController')->parameters([
      'administradores' => 'user'
    ])->names([
      'index' => 'users.index',
      'store' => 'users.store',
      'create' => 'users.create',
      'show' => 'users.show',
      'update' => 'users.update',
      'destroy' => 'users.destroy',
      'edit' => 'users.edit',
    ]);


    /* Produto Stock*/
    Route::resource('/produtostock', 'ProdutosstockController');
    Route::get('/produtostock/{fasestock}', 'ProdutosstockController@show')->name('produtostock.show');

    /* Fase Stock */
    Route::resource('/fasestock', 'FasestockController');
    Route::post('/produtostock/{produtostock}', 'FasestockController@store')->name('fasestock.store');
    Route::get('/fasestock/{fasestock}', 'FasestockController@show')->name('fasestock.show');

    /* Documentos Stock*/
    Route::resource('/documentostock', 'DocumentostockController');
    Route::post('/fasestock/{fasestock}', 'DocumentostockController@store')->name('documentostock.store');
    Route::get('/documentostock/{docstock}', 'DocumentostockController@show')->name('documentostock.show');

    /* Produtos */
    Route::get('/produtos/create/{client}', 'ProdutoController@create')->name('produtos.create');
    Route::post('/produtos/store/{produtoStock}', 'ProdutoController@store')->name('produtos.store');
    Route::get('/produtos/print/{produto}', 'ProdutoController@print')->name('produtos.print');
    Route::resource('/produtos', 'ProdutoController')->only(['destroy', 'update','show','edit']);

    /* Documentos Pessoais */
    Route::get('/documento-pessoal/create/{fase}/{docnecessario}', 'DocPessoalController@create')->name('documento-pessoal.create');
    Route::post('/documento-pessoal/store/{fase}/{docnecessario}', 'DocPessoalController@store')->name('documento-pessoal.store');
    Route::get('/documento-pessoal/{documento}/editar', 'DocPessoalController@edit')->name('documento-pessoal.edit');
    Route::put('/documento-pessoal/{documento}/update', 'DocPessoalController@update')->name('documento-pessoal.update');
    Route::get('/documento-pessoal/{documento}/verifica', 'DocPessoalController@verify')->name('documento-pessoal.verify');
    Route::put('/documento-pessoal/{documento}/verify', 'DocPessoalController@verifica')->name('documento-pessoal.verifica');
    Route::resource('/documento-pessoal', 'DocPessoalController')->only(['destroy','show']);

    /* Documentos Academicos */
    Route::get('/documento-academico/create/{fase}/{docnecessario}', 'DocAcademicoController@create')->name('documento-academico.create');
    Route::post('/documento-academico/store/{fase}/{docnecessario}', 'DocAcademicoController@store')->name('documento-academico.store');
    Route::get('/documento-academico/{documento}/editar', 'DocAcademicoController@edit')->name('documento-academico.edit');
    Route::put('/documento-academico/{documento}/update', 'DocAcademicoController@update')->name('documento-academico.update');
    Route::get('/documento-academico/{documento}/verifica', 'DocAcademicoController@verify')->name('documento-academico.verify');
    Route::put('/documento-academico/{documento}/verify', 'DocAcademicoController@verifica')->name('documento-academico.verifica');
    Route::resource('/documento-academico', 'DocAcademicoController')->only(['destroy','show']);

    /* Documentos Transações */
    Route::get('/documento-transacao/create/{fase}', 'DocTransacaoController@create')->name('documento-transacao.create');
    Route::post('/documento-transacao/store/{fase}', 'DocTransacaoController@store')->name('documento-transacao.store');
    Route::get('/documento-transacao/{documento}/editar', 'DocTransacaoController@edit')->name('documento-transacao.edit');
    Route::put('/documento-transacao/{documento}/update', 'DocTransacaoController@update')->name('documento-transacao.update');
    Route::resource('/documento-transacao', 'DocTransacaoController')->only(['destroy','show']);

    /* Conta */
    Route::resource('/conta-bancaria', 'ContaController')->parameters([
      'conta-bancaria' => 'conta'
    ])->names([
      'index' => 'conta.index',
      'store' => 'conta.store',
      'create' => 'conta.create',
      'show' => 'conta.show',
      'update' => 'conta.update',
      'destroy' => 'conta.destroy',
      'edit' => 'conta.edit',
    ]);

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

    /* Ajuda */
    Route::get('/ajuda', 'HelpController@show')->name('ajuda');
    Route::get('/ajuda/lista', 'HelpController@index')->name('ajudaLista');
});

/* Account Confirmation */
Route::get('/ativacao-conta/{user}', 'AccountConfirmationController@index')->name('confirmation.index');
Route::get('/ativacao-conta/{user}/confirmar-chave', 'AccountConfirmationController@keyconfirmation')->name('confirmation.key');
Route::put('/ativacao-conta/{user}/confirmar-password', 'AccountConfirmationController@password')->name('confirmation.password');
Route::get('/ativacao-conta/{user}/restaurar-conta', 'AccountConfirmationController@restore')->name('confirmation.restore');
Route::get('/login-verification/{user}', 'AccountConfirmationController@loginVerificationView')->name('confirmation.loginVerificationView');
Route::get('/verify/{user}', 'AccountConfirmationController@loginVerification')->name('confirmation.loginVerification');

/* Restore password */
Route::get('/restaurar-password', 'AccountConfirmationController@mailrestorepassword')->name('mailrestore.password');
Route::post('/restaurar-passwords/confirmacao-email', 'AccountConfirmationController@checkemail')->name('check.email');
Route::post('/restaurar-passwords/confirmacao-telemovel', 'AccountConfirmationController@checkphone')->name('check.phone');
Route::get('/restaurar-password/{user}', 'AccountConfirmationController@restorepassword');
Route::post('/restaurar-password/confirmacao-utilizador', 'AccountConfirmationController@checkuser')->name('check.user');
Route::post('/restaurar-password/confirmacao-password', 'AccountConfirmationController@checkpassword')->name('check.password');

/* Ajuda */
Route::get('/ajuda', 'HelpController@show')->name('ajuda');

/* Edgar Teste -> Eliminar no futuro */
Route::get('/data', 'EdgarTesteController@index');
