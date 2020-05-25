<?php

namespace Tests\Feature;

use App\User;
use App\Fase;
use App\Conta;
use App\Agente;
use App\Agenda;
use App\Produto;
use App\Cliente;
use App\Contacto;
use App\DocStock;
use App\FaseStock;
use App\Fornecedor;
use App\Biblioteca;
use App\DocPessoal;
use App\RelFornResp;
use App\DocAcademico;
use App\ProdutoStock;
use App\DocTransacao;
use App\Universidade;
use App\Administrador;
use App\DocNecessario;
use App\Responsabilidade;
use App\RelatorioProblema;
use App\PagoResponsabilidade;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class PermissionUserTest extends TestCase
{
    use RefreshDatabase, WithFaker;
    //use DatabaseMigrations;


    /***************************************         Administrador         ***************************************/
    /*******************************************         Agente         ******************************************/
    /******************************************         Cliente         ******************************************/
    

    /** @test */
    public function admin_ir_para_dashboard()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->make([
            'tipo' => 'admin',
            'idAdmin' => factory(Administrador::class),
        ]);
        $user->email = $user->admin->email;
        
        $response = $this->actingAs($user)->withSession(['foo' => 'bar'])->get('/');
        $response->assertSuccessful();
        $response->assertViewIs('dashboard.index');
    }

    /********************************************************************************************************** */

    /** @test */
    public function redirecionar_de_lista_administrador_para_login()
    {
        $this->withoutExceptionHandling();
        
        $response = $this->get('/administradores')->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_show_administrador_para_login()
    {
        $this->withoutExceptionHandling();
        
        $administrador = factory(Administrador::class)->make();

        $user = factory(User::class)->make([
            'email' => $administrador->email,
            'tipo' => 'admin',
            'idAdmin' => $administrador->idAdmin,
        ]);

        $response = $this->get('/administradores'.'/'.$user->slug)->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_create_administrador_para_login()
    {
        $this->withoutExceptionHandling();
        

        $response = $this->get('/administradores/criar')->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_edit_administrador_para_login()
    {
        $this->withoutExceptionHandling();
        
        $administrador = factory(Administrador::class)->make();

        $user = factory(User::class)->make([
            'email' => $administrador->email,
            'tipo' => 'admin',
            'idAdmin' => $administrador->idAdmin,
        ]);
        
        $response = $this->get('/administradores'.'/'.$user->slug.'/editar')->assertRedirect('/login');
    }

    /********************************************************************************************************** */

    /** @test */
    public function redirecionar_de_lista_agente_para_login()
    {
        $this->withoutExceptionHandling();
        
        $response = $this->get('/agentes')->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_show_agentes_para_login()
    {
        $this->withoutExceptionHandling();
        
        $agente = factory(Agente::class)->make();

        $response = $this->get('/agentes'.'/'.$agente->slug)->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_create_agentes_para_login()
    {
        $this->withoutExceptionHandling();
        
        $response = $this->get('/agentes/criar')->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_edit_agentes_para_login()
    {
        $this->withoutExceptionHandling();
        
        $agente = factory(Agente::class)->make();

        $response = $this->get('/agentes'.'/'.$agente->slug.'/editar')->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_print_agentes_para_login()
    {
        $this->withoutExceptionHandling();
        
        $agente = factory(Agente::class)->make();

        $response = $this->get('/agentes/print'.'/'.$agente->slug)->assertRedirect('/login');
    }

    /********************************************************************************************************** */

    /** @test */
    public function redirecionar_de_lista_biblioteca_para_login()
    {
        $this->withoutExceptionHandling();
        
        $response = $this->get('/biblioteca')->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_create_biblioteca_para_login()
    {
        $this->withoutExceptionHandling();
        
        $response = $this->get('/biblioteca/criar')->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_edit_biblioteca_para_login()
    {
        $this->withoutExceptionHandling();
        
        $biblioteca = factory(Biblioteca::class)->make();

        $response = $this->get('/biblioteca'.'/'.$biblioteca->slug.'/editar')->assertRedirect('/login');
    }

    /********************************************************************************************************** */

    /** @test */
    public function redirecionar_de_lista_cliente_para_login()
    {
        $this->withoutExceptionHandling();
        
        $response = $this->get('/clientes')->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_show_cliente_para_login()
    {
        $this->withoutExceptionHandling();
        
        $cliente = factory(Cliente::class)->make();

        $response = $this->get('/clientes'.'/'.$cliente->slug)->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_create_cliente_para_login()
    {
        $this->withoutExceptionHandling();
        
        $response = $this->get('/clientes/criar')->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_edit_cliente_para_login()
    {
        $this->withoutExceptionHandling();
        
        $cliente = factory(Cliente::class)->make();

        $response = $this->get('/clientes'.'/'.$cliente->slug.'/editar')->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_pesquisa_cliente_para_login()
    {
        $this->withoutExceptionHandling();
        
        $response = $this->get('/clientes/pesquisa')->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_print_cliente_para_login()
    {
        $this->withoutExceptionHandling();
        
        $cliente = factory(Cliente::class)->make();

        $response = $this->get('/clientes/print'.'/'.$cliente->slug)->assertRedirect('/login');
    }

    /********************************************************************************************************** */

    /** @test */
    public function redirecionar_de_lista_conta_para_login()
    {
        $this->withoutExceptionHandling();
        
        $response = $this->get('/conta-bancaria')->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_show_conta_para_login()
    {
        $this->withoutExceptionHandling();
        
        $conta = factory(Conta::class)->make();

        $response = $this->get('/conta-bancaria'.'/'.$conta->slug)->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_create_conta_para_login()
    {
        $this->withoutExceptionHandling();
        
        $response = $this->get('/conta-bancaria/criar')->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_edit_conta_para_login()
    {
        $this->withoutExceptionHandling();
        
        $conta = factory(Conta::class)->make();

        $response = $this->get('/conta-bancaria'.'/'.$conta->slug.'/editar')->assertRedirect('/login');
    }

    /********************************************************************************************************** */

    /** @test */
    public function redirecionar_de_lista_fornecedor_para_login()
    {
        $this->withoutExceptionHandling();
        
        $response = $this->get('/fornecedores')->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_show_fornecedor_para_login()
    {
        $this->withoutExceptionHandling();
        
        $fornecedor = factory(Fornecedor::class)->make();

        $response = $this->get('/fornecedores'.'/'.$fornecedor->slug)->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_create_fornecedor_para_login()
    {
        $this->withoutExceptionHandling();
        
        $response = $this->get('/fornecedores/criar')->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_edit_fornecedor_para_login()
    {
        $this->withoutExceptionHandling();
        
        $fornecedor = factory(Fornecedor::class)->make();

        $response = $this->get('/fornecedores'.'/'.$fornecedor->slug.'/editar')->assertRedirect('/login');
    }

    /********************************************************************************************************** */

    /** @test */
    public function redirecionar_de_lista_produto_stock_para_login()
    {
        $this->withoutExceptionHandling();
        
        $response = $this->get('/produtostock')->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_show_produto_stock_para_login()
    {
        $this->withoutExceptionHandling();
        
        $produtoStock = factory(ProdutoStock::class)->make();

        $response = $this->get('/produtostock'.'/'.$produtoStock->idProdutoStock)->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_create_produto_stock_para_login()
    {
        $this->withoutExceptionHandling();
        
        $response = $this->get('/produtostock/criar')->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_edit_produto_stock_para_login()
    {
        $this->withoutExceptionHandling();
        
        $produtoStock = factory(ProdutoStock::class)->make();

        $response = $this->get('/produtostock'.'/'.$produtoStock->idProdutoStock.'/editar')->assertRedirect('/login');
    }

    /********************************************************************************************************** */

    /** @test */
    public function redirecionar_de_lista_fase_stock_para_login()
    {
        $this->withoutExceptionHandling();
        
        $response = $this->get('/fasestock')->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_show_fase_stock_para_login()
    {
        $this->withoutExceptionHandling();
        
        $produtoStock = factory(ProdutoStock::class)->make();

        $faseStock = factory(FaseStock::class)->make([
            'idProdutoStock' => $produtoStock->idProdutoStock,
        ]);

        $response = $this->get('/fasestock'.'/'.$faseStock->idFaseStock)->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_create_fase_stock_para_login()
    {
        $this->withoutExceptionHandling();
        
        $response = $this->get('/fasestock/criar')->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_edit_fase_stock_para_login()
    {
        $this->withoutExceptionHandling();
        
        $produtoStock = factory(ProdutoStock::class)->make();

        $faseStock = factory(FaseStock::class)->make([
            'idProdutoStock' => $produtoStock->idProdutoStock,
        ]);

        $response = $this->get('/fasestock'.'/'.$faseStock->idFaseStock.'/editar')->assertRedirect('/login');
    }

    /********************************************************************************************************** */

    /** @test */
    public function redirecionar_de_lista_doc_stock_para_login()
    {
        $this->withoutExceptionHandling();
        
        $response = $this->get('/documentostock')->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_show_doc_stock_para_login()
    {
        $this->withoutExceptionHandling();
        
        $produtoStock = factory(ProdutoStock::class)->make();
        $faseStock = factory(FaseStock::class)->make([
            'idProdutoStock' => $produtoStock->idProdutoStock,
        ]);

        $docStock = factory(DocStock::class)->make([
            'idFaseStock' => $faseStock->idFaseStock,
        ]);

        $response = $this->get('/documentostock'.'/'.$docStock->idDocStock)->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_create_doc_stock_para_login()
    {
        $this->withoutExceptionHandling();
        
        $response = $this->get('/documentostock/criar')->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_edit_doc_stock_para_login()
    {
        $this->withoutExceptionHandling();
        
        $produtoStock = factory(ProdutoStock::class)->make();
        $faseStock = factory(FaseStock::class)->make([
            'idProdutoStock' => $produtoStock->idProdutoStock,
        ]);

        $docStock = factory(DocStock::class)->make([
            'idFaseStock' => $faseStock->idFaseStock,
        ]);

        $response = $this->get('/documentostock'.'/'.$docStock->idDocStock.'/editar')->assertRedirect('/login');
    }

    /********************************************************************************************************** */

    /** @test */
    public function redirecionar_de_lista_universidade_para_login()
    {
        $this->withoutExceptionHandling();
        
        $response = $this->get('/universidades')->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_show_universidade_para_login()
    {
        $this->withoutExceptionHandling();
        
        $universidade = factory(Universidade::class)->make();

        $response = $this->get('/universidades'.'/'.$universidade->slug)->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_create_universidade_para_login()
    {
        $this->withoutExceptionHandling();
        
        $response = $this->get('/universidades/criar')->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_edit_universidade_para_login()
    {
        $this->withoutExceptionHandling();
        
        $universidade = factory(Universidade::class)->make();

        $response = $this->get('/universidades'.'/'.$universidade->slug.'/editar')->assertRedirect('/login');
    }

    /********************************************************************************************************** */

    /** @test */
    public function redirecionar_de_lista_contacto_para_login()
    {
        $this->withoutExceptionHandling();
        
        $response = $this->get('/contactos')->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_show_contacto_para_login()
    {
        $this->withoutExceptionHandling();
        
        $contacto = factory(Contacto::class)->make();

        $response = $this->get('/contactos/show/'.$contacto->slug)->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_create_contacto_para_login()
    {
        $this->withoutExceptionHandling();
        
        $response = $this->get('/contactos/criar')->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_edit_contacto_para_login()
    {
        $this->withoutExceptionHandling();
        
        $contacto = factory(Contacto::class)->make();

        $response = $this->get('/contactos/editar/'.$contacto->slug)->assertRedirect('/login');
    }

    /********************************************************************************************************** */

    /** @test */
    public function redirecionar_de_lista_agenda_para_login()
    {
        $this->withoutExceptionHandling();
        
        $response = $this->get('/agenda')->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_show_agenda_para_login()
    {
        $this->withoutExceptionHandling();
        
        $administrador = factory(Administrador::class)->make();
        $user = factory(User::class)->make([
            'email' => $administrador->email,
            'tipo' => 'admin',
            'idAdmin' => $administrador->idAdmin,
        ]);

        $agenda = factory(Agenda::class)->make([
            'idUser' => $user->idUser,
        ]);

        $response = $this->get('/agenda'.'/'.$agenda->idAgenda)->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_create_agenda_para_login()
    {
        $this->withoutExceptionHandling();
        
        $response = $this->get('/agenda/criar')->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_edit_agenda_para_login()
    {
        $this->withoutExceptionHandling();
        
        $administrador = factory(Administrador::class)->make();
        $user = factory(User::class)->make([
            'email' => $administrador->email,
            'tipo' => 'admin',
            'idAdmin' => $administrador->idAdmin,
        ]);

        $agenda = factory(Agenda::class)->make([
            'idUser' => $user->idUser,
        ]);

        $response = $this->get('/agenda'.'/'.$agenda->idAgenda.'/editar')->assertRedirect('/login');
    }

    /********************************************************************************************************** */
    
    /** @test */
    public function redirecionar_de_show_produto_para_login()
    {
        $this->withoutExceptionHandling();
        
        $cliente = factory(Cliente::class)->make();
        $agente = factory(Agente::class)->make();
        $universidade = factory(Universidade::class)->make();

        $produto = factory(Produto::class)->make([
            'idAgente' => $agente->idAgente,
            'idCliente' => $cliente->idCliente,
            'idUniversidade1' => $universidade->idUniversidade,
        ]);

        $response = $this->get('/produtos'.'/'.$produto->slug)->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_create_produto_para_login()
    {
        $this->withoutExceptionHandling();
        
        $cliente = factory(Cliente::class)->make();
        $agente = factory(Agente::class)->make();
        $universidade = factory(Universidade::class)->make();

        $produto = factory(Produto::class)->make([
            'idAgente' => $agente->idAgente,
            'idCliente' => $cliente->idCliente,
            'idUniversidade1' => $universidade->idUniversidade,
        ]);

        $response = $this->get('/produtos/criar/'.$cliente->slug)->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_edit_produto_para_login()
    {
        $this->withoutExceptionHandling();
        
        $cliente = factory(Cliente::class)->make();
        $agente = factory(Agente::class)->make();
        $universidade = factory(Universidade::class)->make();

        $produto = factory(Produto::class)->make([
            'idAgente' => $agente->idAgente,
            'idCliente' => $cliente->idCliente,
            'idUniversidade1' => $universidade->idUniversidade,
        ]);

        $response = $this->get('/produtos'.'/'.$produto->slug.'/editar')->assertRedirect('/login');
    }

    /********************************************************************************************************** */
    
    /** @test */
    public function redirecionar_de_show_doc_academico_para_login()
    {
        $this->withoutExceptionHandling();
        
        $cliente = factory(Cliente::class)->make();
        $agente = factory(Agente::class)->make();
        $universidade = factory(Universidade::class)->make();
        $produto = factory(Produto::class)->make([
            'idAgente' => $agente->idAgente,
            'idCliente' => $cliente->idCliente,
            'idUniversidade1' => $universidade->idUniversidade,
        ]);
        $responsabilidade = factory(Responsabilidade::class)->make([
            'idAgente' => $agente->idAgente,
            'idCliente' => $cliente->idCliente,
            'idUniversidade1' => $universidade->idUniversidade,
        ]);
        $fase = factory(Fase::class)->make([
            'idProduto' => $produto->idProduto,
            'idResponsabilidade' => $responsabilidade->idResponsabilidade,
        ]);

        $docAcademico = factory(DocAcademico::class)->make([
            'idFase' => $fase->idFase,
            'idCliente' => $cliente->idCliente,
        ]);

        $response = $this->get('/documento-academico'.'/'.$docAcademico->slug)->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_create_doc_academico_para_login()
    {
        $this->withoutExceptionHandling();
        
        $cliente = factory(Cliente::class)->make();
        $agente = factory(Agente::class)->make();
        $universidade = factory(Universidade::class)->make();
        $produto = factory(Produto::class)->make([
            'idAgente' => $agente->idAgente,
            'idCliente' => $cliente->idCliente,
            'idUniversidade1' => $universidade->idUniversidade,
        ]);
        $responsabilidade = factory(Responsabilidade::class)->make([
            'idAgente' => $agente->idAgente,
            'idCliente' => $cliente->idCliente,
            'idUniversidade1' => $universidade->idUniversidade,
        ]);
        $fase = factory(Fase::class)->make([
            'idProduto' => $produto->idProduto,
            'idResponsabilidade' => $responsabilidade->idResponsabilidade,
        ]);

        $docNecessario = factory(DocNecessario::class)->make([
            'idFase' => $fase->idFase,
        ]);

        $response = $this->get('/documento-academico/criar/'.$fase->slug.'/'.$docNecessario->idDocNecessario)->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_edit_doc_academico_para_login()
    {
        $this->withoutExceptionHandling();
        
        $cliente = factory(Cliente::class)->make();
        $agente = factory(Agente::class)->make();
        $universidade = factory(Universidade::class)->make();
        $produto = factory(Produto::class)->make([
            'idAgente' => $agente->idAgente,
            'idCliente' => $cliente->idCliente,
            'idUniversidade1' => $universidade->idUniversidade,
        ]);
        $responsabilidade = factory(Responsabilidade::class)->make([
            'idAgente' => $agente->idAgente,
            'idCliente' => $cliente->idCliente,
            'idUniversidade1' => $universidade->idUniversidade,
        ]);
        $fase = factory(Fase::class)->make([
            'idProduto' => $produto->idProduto,
            'idResponsabilidade' => $responsabilidade->idResponsabilidade,
        ]);

        $docAcademico = factory(DocAcademico::class)->make([
            'idFase' => $fase->idFase,
            'idCliente' => $cliente->idCliente,
        ]);

        $response = $this->get('/documento-academico'.'/'.$docAcademico->slug.'/editar')->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_verifica_doc_academico_para_login()
    {
        $this->withoutExceptionHandling();
        
        $cliente = factory(Cliente::class)->make();
        $agente = factory(Agente::class)->make();
        $universidade = factory(Universidade::class)->make();
        $produto = factory(Produto::class)->make([
            'idAgente' => $agente->idAgente,
            'idCliente' => $cliente->idCliente,
            'idUniversidade1' => $universidade->idUniversidade,
        ]);
        $responsabilidade = factory(Responsabilidade::class)->make([
            'idAgente' => $agente->idAgente,
            'idCliente' => $cliente->idCliente,
            'idUniversidade1' => $universidade->idUniversidade,
        ]);
        $fase = factory(Fase::class)->make([
            'idProduto' => $produto->idProduto,
            'idResponsabilidade' => $responsabilidade->idResponsabilidade,
        ]);

        $docAcademico = factory(DocAcademico::class)->make([
            'idFase' => $fase->idFase,
            'idCliente' => $cliente->idCliente,
        ]);

        $response = $this->get('/documento-academico'.'/'.$docAcademico->slug.'/verifica')->assertRedirect('/login');
    }

    /********************************************************************************************************** */
    
    /** @test */
    public function redirecionar_de_show_doc_pessoal_para_login()
    {
        $this->withoutExceptionHandling();
        
        $cliente = factory(Cliente::class)->make();
        $agente = factory(Agente::class)->make();
        $universidade = factory(Universidade::class)->make();
        $produto = factory(Produto::class)->make([
            'idAgente' => $agente->idAgente,
            'idCliente' => $cliente->idCliente,
            'idUniversidade1' => $universidade->idUniversidade,
        ]);
        $responsabilidade = factory(Responsabilidade::class)->make([
            'idAgente' => $agente->idAgente,
            'idCliente' => $cliente->idCliente,
            'idUniversidade1' => $universidade->idUniversidade,
        ]);
        $fase = factory(Fase::class)->make([
            'idProduto' => $produto->idProduto,
            'idResponsabilidade' => $responsabilidade->idResponsabilidade,
        ]);

        $docPessoal = factory(DocPessoal::class)->make([
            'idFase' => $fase->idFase,
            'idCliente' => $cliente->idCliente,
        ]);

        $response = $this->get('/documento-pessoal'.'/'.$docPessoal->slug)->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_create_doc_pessoal_para_login()
    {
        $this->withoutExceptionHandling();
        
        $cliente = factory(Cliente::class)->make();
        $agente = factory(Agente::class)->make();
        $universidade = factory(Universidade::class)->make();
        $produto = factory(Produto::class)->make([
            'idAgente' => $agente->idAgente,
            'idCliente' => $cliente->idCliente,
            'idUniversidade1' => $universidade->idUniversidade,
        ]);
        $responsabilidade = factory(Responsabilidade::class)->make([
            'idAgente' => $agente->idAgente,
            'idCliente' => $cliente->idCliente,
            'idUniversidade1' => $universidade->idUniversidade,
        ]);
        $fase = factory(Fase::class)->make([
            'idProduto' => $produto->idProduto,
            'idResponsabilidade' => $responsabilidade->idResponsabilidade,
        ]);

        $docNecessario = factory(DocNecessario::class)->make([
            'idFase' => $fase->idFase,
        ]);

        $response = $this->get('/documento-pessoal/criar/'.$fase->slug.'/'.$docNecessario->idDocNecessario)->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_edit_doc_pessoal_para_login()
    {
        $this->withoutExceptionHandling();
        
        $cliente = factory(Cliente::class)->make();
        $agente = factory(Agente::class)->make();
        $universidade = factory(Universidade::class)->make();
        $produto = factory(Produto::class)->make([
            'idAgente' => $agente->idAgente,
            'idCliente' => $cliente->idCliente,
            'idUniversidade1' => $universidade->idUniversidade,
        ]);
        $responsabilidade = factory(Responsabilidade::class)->make([
            'idAgente' => $agente->idAgente,
            'idCliente' => $cliente->idCliente,
            'idUniversidade1' => $universidade->idUniversidade,
        ]);
        $fase = factory(Fase::class)->make([
            'idProduto' => $produto->idProduto,
            'idResponsabilidade' => $responsabilidade->idResponsabilidade,
        ]);

        $docPessoal = factory(DocPessoal::class)->make([
            'idFase' => $fase->idFase,
            'idCliente' => $cliente->idCliente,
        ]);

        $response = $this->get('/documento-pessoal'.'/'.$docPessoal->slug.'/editar')->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_verifica_doc_pessoal_para_login()
    {
        $this->withoutExceptionHandling();
        
        $cliente = factory(Cliente::class)->make();
        $agente = factory(Agente::class)->make();
        $universidade = factory(Universidade::class)->make();
        $produto = factory(Produto::class)->make([
            'idAgente' => $agente->idAgente,
            'idCliente' => $cliente->idCliente,
            'idUniversidade1' => $universidade->idUniversidade,
        ]);
        $responsabilidade = factory(Responsabilidade::class)->make([
            'idAgente' => $agente->idAgente,
            'idCliente' => $cliente->idCliente,
            'idUniversidade1' => $universidade->idUniversidade,
        ]);
        $fase = factory(Fase::class)->make([
            'idProduto' => $produto->idProduto,
            'idResponsabilidade' => $responsabilidade->idResponsabilidade,
        ]);

        $docPessoal = factory(DocPessoal::class)->make([
            'idFase' => $fase->idFase,
            'idCliente' => $cliente->idCliente,
        ]);

        $response = $this->get('/documento-pessoal'.'/'.$docPessoal->slug.'/verifica')->assertRedirect('/login');
    }

    /********************************************************************************************************** */

    /** @test */
    public function redirecionar_de_show_doc_transacao_para_login()
    {
        $this->withoutExceptionHandling();
        
        $cliente = factory(Cliente::class)->make();
        $agente = factory(Agente::class)->make();
        $universidade = factory(Universidade::class)->make();
        $produto = factory(Produto::class)->make([
            'idAgente' => $agente->idAgente,
            'idCliente' => $cliente->idCliente,
            'idUniversidade1' => $universidade->idUniversidade,
        ]);
        $responsabilidade = factory(Responsabilidade::class)->make([
            'idAgente' => $agente->idAgente,
            'idCliente' => $cliente->idCliente,
            'idUniversidade1' => $universidade->idUniversidade,
        ]);
        $fase = factory(Fase::class)->make([
            'idProduto' => $produto->idProduto,
            'idResponsabilidade' => $responsabilidade->idResponsabilidade,
        ]);
        $conta = factory(Conta::class)->make();

        $docTransacao = factory(DocTransacao::class)->make([
            'idFase' => $fase->idFase,
            'idConta' => $conta->idConta,
        ]);

        $response = $this->get('/documento-transacao'.'/'.$docTransacao->slug)->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_create_doc_transacao_para_login()
    {
        $this->withoutExceptionHandling();
        
        $response = $this->get('/documento-transacao/criar')->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_edit_doc_transacao_para_login()
    {
        $this->withoutExceptionHandling();
        
        $cliente = factory(Cliente::class)->make();
        $agente = factory(Agente::class)->make();
        $universidade = factory(Universidade::class)->make();
        $produto = factory(Produto::class)->make([
            'idAgente' => $agente->idAgente,
            'idCliente' => $cliente->idCliente,
            'idUniversidade1' => $universidade->idUniversidade,
        ]);
        $responsabilidade = factory(Responsabilidade::class)->make([
            'idAgente' => $agente->idAgente,
            'idCliente' => $cliente->idCliente,
            'idUniversidade1' => $universidade->idUniversidade,
        ]);
        $fase = factory(Fase::class)->make([
            'idProduto' => $produto->idProduto,
            'idResponsabilidade' => $responsabilidade->idResponsabilidade,
        ]);
        $conta = factory(Conta::class)->make();

        $docTransacao = factory(DocTransacao::class)->make([
            'idFase' => $fase->idFase,
            'idConta' => $conta->idConta,
        ]);

        $response = $this->get('/documento-transacao'.'/'.$docTransacao->slug.'/editar')->assertRedirect('/login');
    }

    /********************************************************************************************************** */

    /** @test */
    public function redirecionar_de_lista_pago_responsabilidade_para_login()
    {
        $this->withoutExceptionHandling();
        
        $response = $this->get('/pagamentos')->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_show_pago_responsabilidade_para_login()
    {
        $this->withoutExceptionHandling();
        
        $cliente = factory(Cliente::class)->make();
        $agente = factory(Agente::class)->make();
        $universidade = factory(Universidade::class)->make();
        $produto = factory(Produto::class)->make([
            'idAgente' => $agente->idAgente,
            'idCliente' => $cliente->idCliente,
            'idUniversidade1' => $universidade->idUniversidade,
        ]);
        $responsabilidade = factory(Responsabilidade::class)->make([
            'idAgente' => $agente->idAgente,
            'idCliente' => $cliente->idCliente,
            'idUniversidade1' => $universidade->idUniversidade,
        ]);
        $fase = factory(Fase::class)->make([
            'idProduto' => $produto->idProduto,
            'idResponsabilidade' => $responsabilidade->idResponsabilidade,
        ]);
        $conta = factory(Conta::class)->make();

        $pagoResponsabilidade = factory(PagoResponsabilidade::class)->make([
            'idFase' => $fase->idFase,
            'idConta' => $conta->idConta,
        ]);

        $response = $this->get('/pagamentos'.'/'.$pagoResponsabilidade->slug)->assertRedirect('/login');
    }
    
    /** @teste */
    public function redirecionar_de_edit_pago_responsabilidade_para_login()
    {
        $this->withoutExceptionHandling();
        
        $cliente = factory(Cliente::class)->make();
        $agente = factory(Agente::class)->make();
        $universidade = factory(Universidade::class)->make();
        $produto = factory(Produto::class)->make([
            'idAgente' => $agente->idAgente,
            'idCliente' => $cliente->idCliente,
            'idUniversidade1' => $universidade->idUniversidade,
        ]);
        $responsabilidade = factory(Responsabilidade::class)->make([
            'idAgente' => $agente->idAgente,
            'idCliente' => $cliente->idCliente,
            'idUniversidade1' => $universidade->idUniversidade,
        ]);
        $fase = factory(Fase::class)->make([
            'idProduto' => $produto->idProduto,
            'idResponsabilidade' => $responsabilidade->idResponsabilidade,
        ]);
        $conta = factory(Conta::class)->make();

        $pagoResponsabilidade = factory(PagoResponsabilidade::class)->make([
            'idFase' => $fase->idFase,
            'idConta' => $conta->idConta,
        ]);

        $response = $this->get('/pagamentos'.'/'.$pagoResponsabilidade->idPagoResp.'/editar')->assertRedirect('/login');
    }
    
    /** @teste */
    public function redirecionar_de_agente_pago_responsabilidade_para_login()
    {
        $this->withoutExceptionHandling();
        
        $cliente = factory(Cliente::class)->make();
        $agente = factory(Agente::class)->make();
        $universidade = factory(Universidade::class)->make();
        $produto = factory(Produto::class)->make([
            'idAgente' => $agente->idAgente,
            'idCliente' => $cliente->idCliente,
            'idUniversidade1' => $universidade->idUniversidade,
        ]);
        $responsabilidade = factory(Responsabilidade::class)->make([
            'idAgente' => $agente->idAgente,
            'idCliente' => $cliente->idCliente,
            'idUniversidade1' => $universidade->idUniversidade,
        ]);
        $fase = factory(Fase::class)->make([
            'idProduto' => $produto->idProduto,
            'idResponsabilidade' => $responsabilidade->idResponsabilidade,
        ]);

        $response = $this->get('/pagamentos/agente/'.$agente->slug.'/fase'.'/'.$fase->slug.'/'.$responsabilidade->idResponsabilidade)->assertRedirect('/login');
    }
    
    /** @teste */
    public function redirecionar_de_cliente_pago_responsabilidade_para_login()
    {
        $this->withoutExceptionHandling();
        
        $cliente = factory(Cliente::class)->make();
        $agente = factory(Agente::class)->make();
        $universidade = factory(Universidade::class)->make();
        $produto = factory(Produto::class)->make([
            'idAgente' => $agente->idAgente,
            'idCliente' => $cliente->idCliente,
            'idUniversidade1' => $universidade->idUniversidade,
        ]);
        $responsabilidade = factory(Responsabilidade::class)->make([
            'idAgente' => $agente->idAgente,
            'idCliente' => $cliente->idCliente,
            'idUniversidade1' => $universidade->idUniversidade,
        ]);
        $fase = factory(Fase::class)->make([
            'idProduto' => $produto->idProduto,
            'idResponsabilidade' => $responsabilidade->idResponsabilidade,
        ]);

        $response = $this->get('/pagamentos/cliente/'.$cliente->slug.'/fase'.'/'.$fase->slug.'/'.$responsabilidade->idResponsabilidade)->assertRedirect('/login');
    }
    
    /** @teste */
    public function redirecionar_de_fornecedor_pago_responsabilidade_para_login()
    {
        $this->withoutExceptionHandling();
        
        $cliente = factory(Cliente::class)->make();
        $agente = factory(Agente::class)->make();
        $universidade = factory(Universidade::class)->make();
        $produto = factory(Produto::class)->make([
            'idAgente' => $agente->idAgente,
            'idCliente' => $cliente->idCliente,
            'idUniversidade1' => $universidade->idUniversidade,
        ]);
        $responsabilidade = factory(Responsabilidade::class)->make([
            'idAgente' => $agente->idAgente,
            'idCliente' => $cliente->idCliente,
            'idUniversidade1' => $universidade->idUniversidade,
        ]);
        $fase = factory(Fase::class)->make([
            'idProduto' => $produto->idProduto,
            'idResponsabilidade' => $responsabilidade->idResponsabilidade,
        ]);
        $fornecedor = factory(Fornecedor::class)->make();

        $relFornResp = factory(RelFornResp::class)->make([
            'idResponsabilidade' => $responsabilidade->idResponsabilidade,
            'idFornecedor' => $fornecedor->idFornecedor,
        ]);

        $response = $this->get('/pagamentos/fornecedor/'.$fornecedor->slug.'/fase'.'/'.$fase->slug.'/'.$relFornResp->idRelacao)->assertRedirect('/login');
    }
    
    /** @teste */
    public function redirecionar_de_cliente_pdf_pago_responsabilidade_para_login()
    {
        $this->withoutExceptionHandling();
        
        $cliente = factory(Cliente::class)->make();
        $agente = factory(Agente::class)->make();
        $universidade = factory(Universidade::class)->make();
        $produto = factory(Produto::class)->make([
            'idAgente' => $agente->idAgente,
            'idCliente' => $cliente->idCliente,
            'idUniversidade1' => $universidade->idUniversidade,
        ]);
        $responsabilidade = factory(Responsabilidade::class)->make([
            'idAgente' => $agente->idAgente,
            'idCliente' => $cliente->idCliente,
            'idUniversidade1' => $universidade->idUniversidade,
        ]);
        $fase = factory(Fase::class)->make([
            'idProduto' => $produto->idProduto,
            'idResponsabilidade' => $responsabilidade->idResponsabilidade,
        ]);

        $response = $this->get('/pagamentos/nota-pagamento/cliente/'.$cliente->slug.'/'.$responsabilidade->idResponsabilidade)->assertRedirect('/login');
    }
    
    /** @teste */
    public function redirecionar_de_download_pago_responsabilidade_para_login()
    {
        $this->withoutExceptionHandling();
        
        $cliente = factory(Cliente::class)->make();
        $agente = factory(Agente::class)->make();
        $universidade = factory(Universidade::class)->make();
        $produto = factory(Produto::class)->make([
            'idAgente' => $agente->idAgente,
            'idCliente' => $cliente->idCliente,
            'idUniversidade1' => $universidade->idUniversidade,
        ]);
        $responsabilidade = factory(Responsabilidade::class)->make([
            'idAgente' => $agente->idAgente,
            'idCliente' => $cliente->idCliente,
            'idUniversidade1' => $universidade->idUniversidade,
        ]);
        $fase = factory(Fase::class)->make([
            'idProduto' => $produto->idProduto,
            'idResponsabilidade' => $responsabilidade->idResponsabilidade,
        ]);
        $conta = factory(Conta::class)->make();

        $pagoResponsabilidade = factory(PagoResponsabilidade::class)->make([
            'idFase' => $fase->idFase,
            'idConta' => $conta->idConta,
        ]);

        $response = $this->get('/pagamentos/nota-pagamento/'.$pagoResponsabilidade->idPagoResp.'/transferir')->assertRedirect('/login');
    }
    
    /** @teste */
    public function redirecionar_de_pesquisa_pago_responsabilidade_para_login()
    {
        $this->withoutExceptionHandling();
        
        $response = $this->get('/pagamentos/pesquisa')->assertRedirect('/login');
    }
    
    /** @teste */
    public function redirecionar_de_subagente_pago_responsabilidade_para_login()
    {
        $this->withoutExceptionHandling();
        
        $cliente = factory(Cliente::class)->make();
        $agente = factory(Agente::class)->make();
        $subagente = factory(Agente::class)->make(['tipo'=>'Subagente','idAgenteAssociado'=>$agente->idAgente]);
        $universidade = factory(Universidade::class)->make();
        $produto = factory(Produto::class)->make([
            'idAgente' => $agente->idAgente,
            'idCliente' => $cliente->idCliente,
            'idUniversidade1' => $universidade->idUniversidade,
        ]);
        $responsabilidade = factory(Responsabilidade::class)->make([
            'idAgente' => $agente->idAgente,
            'idCliente' => $cliente->idCliente,
            'idUniversidade1' => $universidade->idUniversidade,
        ]);
        $fase = factory(Fase::class)->make([
            'idProduto' => $produto->idProduto,
            'idResponsabilidade' => $responsabilidade->idResponsabilidade,
        ]);

        $response = $this->get('/pagamentos/subagente/'.$subagente->slug.'/fase'.'/'.$fase->slug.'/'.$responsabilidade->idResponsabilidade)->assertRedirect('/login');
    }
    
    /** @teste */
    public function redirecionar_de_universidade_principal_pago_responsabilidade_para_login()
    {
        $this->withoutExceptionHandling();
        
        $cliente = factory(Cliente::class)->make();
        $agente = factory(Agente::class)->make();
        $universidade = factory(Universidade::class)->make();
        $produto = factory(Produto::class)->make([
            'idAgente' => $agente->idAgente,
            'idCliente' => $cliente->idCliente,
            'idUniversidade1' => $universidade->idUniversidade,
        ]);
        $responsabilidade = factory(Responsabilidade::class)->make([
            'idAgente' => $agente->idAgente,
            'idCliente' => $cliente->idCliente,
            'idUniversidade1' => $universidade->idUniversidade,
        ]);
        $fase = factory(Fase::class)->make([
            'idProduto' => $produto->idProduto,
            'idResponsabilidade' => $responsabilidade->idResponsabilidade,
        ]);

        $response = $this->get('/pagamentos/universidade-principal/'.$universidade->slug.'/fase'.'/'.$fase->slug.'/'.$responsabilidade->idResponsabilidade)->assertRedirect('/login');
    }
    
    /** @teste */
    public function redirecionar_de_universidade_secundaria_pago_responsabilidade_para_login()
    {
        $this->withoutExceptionHandling();
        
        $cliente = factory(Cliente::class)->make();
        $agente = factory(Agente::class)->make();
        $universidade1 = factory(Universidade::class)->make();
        $universidade2 = factory(Universidade::class)->make();
        $produto = factory(Produto::class)->make([
            'idAgente' => $agente->idAgente,
            'idCliente' => $cliente->idCliente,
            'idUniversidade1' => $universidade->idUniversidade1,
        ]);
        $responsabilidade = factory(Responsabilidade::class)->make([
            'idAgente' => $agente->idAgente,
            'idCliente' => $cliente->idCliente,
            'idUniversidade1' => $universidade1->idUniversidade,
            'idUniversidade2' => $universidade2->idUniversidade,
        ]);
        $fase = factory(Fase::class)->make([
            'idProduto' => $produto->idProduto,
            'idResponsabilidade' => $responsabilidade->idResponsabilidade,
        ]);

        $response = $this->get('/pagamentos/universidade-secundaria/'.$universidade2->slug.'/fase'.'/'.$fase->slug.'/'.$responsabilidade->idResponsabilidade)->assertRedirect('/login');
    }

    /********************************************************************************************************** */

    /** @teste */
    public function redirecionar_de_lista_relatorio_problema_para_login()
    {
        $this->withoutExceptionHandling();
        
        $response = $this->get('/reportar-problema')->assertRedirect('/login');
    }
    
    /** @teste */
    public function redirecionar_de_show_relatorio_problema_para_login()
    {
        $this->withoutExceptionHandling();
        
        $relatorioProblema = factory(RelatorioProblema::class)->make();

        $response = $this->get('/reportar-problema'.'/'.$relatorioProblema->idRelatorioProblema)->assertRedirect('/login');
    }
    
    /** @teste */
    public function redirecionar_de_create_relatorio_problema_para_login()
    {
        $this->withoutExceptionHandling();
        
        $response = $this->get('/reportar-problema/criar')->assertRedirect('/login');
    }
    
    /** @teste */
    public function redirecionar_de_edit_relatorio_problema_para_login()
    {
        $this->withoutExceptionHandling();
        
        $relatorioProblema = factory(RelatorioProblema::class)->make();

        $response = $this->get('/reportar-problema'.'/'.$relatorioProblema->idRelatorioProblema.'/editar')->assertRedirect('/login');
    }

    /********************************************************************************************************** */

    /** @teste */
    public function redirecionar_de_lista_cobrancas_para_login()
    {
        $this->withoutExceptionHandling();
        
        $response = $this->get('/cobrancas')->assertRedirect('/login');
    }
    
    /** @teste */
    public function redirecionar_de_show_cobrancas_para_login()
    {
        $this->withoutExceptionHandling();
        
        $cliente = factory(Cliente::class)->make();
        $agente = factory(Agente::class)->make();
        $universidade = factory(Universidade::class)->make();
        $produto = factory(Produto::class)->make([
            'idAgente' => $agente->idAgente,
            'idCliente' => $cliente->idCliente,
            'idUniversidade1' => $universidade->idUniversidade,
        ]);

        $response = $this->get('/cobrancas'.'/'.$produto->slug)->assertRedirect('/login');
    }
    
    /** @teste */
    public function redirecionar_de_create_cobrancas_para_login()
    {
        $this->withoutExceptionHandling();
        
        $response = $this->get('/cobrancas/criar')->assertRedirect('/login');
    }
    
    /** @teste */
    public function redirecionar_de_edit_cobrancas_para_login()
    {
        $this->withoutExceptionHandling();
        
        $cliente = factory(Cliente::class)->make();
        $agente = factory(Agente::class)->make();
        $universidade = factory(Universidade::class)->make();
        $produto = factory(Produto::class)->make([
            'idAgente' => $agente->idAgente,
            'idCliente' => $cliente->idCliente,
            'idUniversidade1' => $universidade->idUniversidade,
        ]);
        $responsabilidade = factory(Responsabilidade::class)->make([
            'idAgente' => $agente->idAgente,
            'idCliente' => $cliente->idCliente,
            'idUniversidade1' => $universidade->idUniversidade,
        ]);
        $fase = factory(Fase::class)->make([
            'idProduto' => $produto->idProduto,
            'idResponsabilidade' => $responsabilidade->idResponsabilidade,
        ]);
        $conta = factory(Conta::class)->make();

        $docTransacao = factory(DocTransacao::class)->make([
            'idFase' => $fase->idFase,
            'idConta' => $conta->idConta,
        ]);

        $response = $this->get('/cobrancas'.'/'.$produto->slug.'/'.$fase->slug.'/'.$docTransacao->slug.'/editar')->assertRedirect('/login');
    }
    
    /** @teste */
    public function redirecionar_de_download_cobrancas_para_login()
    {
        $this->withoutExceptionHandling();
        
        $cliente = factory(Cliente::class)->make();
        $agente = factory(Agente::class)->make();
        $universidade = factory(Universidade::class)->make();
        $produto = factory(Produto::class)->make([
            'idAgente' => $agente->idAgente,
            'idCliente' => $cliente->idCliente,
            'idUniversidade1' => $universidade->idUniversidade,
        ]);
        $responsabilidade = factory(Responsabilidade::class)->make([
            'idAgente' => $agente->idAgente,
            'idCliente' => $cliente->idCliente,
            'idUniversidade1' => $universidade->idUniversidade,
        ]);
        $fase = factory(Fase::class)->make([
            'idProduto' => $produto->idProduto,
            'idResponsabilidade' => $responsabilidade->idResponsabilidade,
        ]);
        $conta = factory(Conta::class)->make();

        $docTransacao = factory(DocTransacao::class)->make([
            'idFase' => $fase->idFase,
            'idConta' => $conta->idConta,
        ]);

        $response = $this->get('/cobrancas'.'/'.$docTransacao->slug.'/download')->assertRedirect('/login');
    }
    
    /** @teste */
    public function redirecionar_de_showcharge_cobrancas_para_login()
    {
        $this->withoutExceptionHandling();
        
        $cliente = factory(Cliente::class)->make();
        $agente = factory(Agente::class)->make();
        $universidade = factory(Universidade::class)->make();
        $produto = factory(Produto::class)->make([
            'idAgente' => $agente->idAgente,
            'idCliente' => $cliente->idCliente,
            'idUniversidade1' => $universidade->idUniversidade,
        ]);
        $responsabilidade = factory(Responsabilidade::class)->make([
            'idAgente' => $agente->idAgente,
            'idCliente' => $cliente->idCliente,
            'idUniversidade1' => $universidade->idUniversidade,
        ]);
        $fase = factory(Fase::class)->make([
            'idProduto' => $produto->idProduto,
            'idResponsabilidade' => $responsabilidade->idResponsabilidade,
        ]);

        $response = $this->get('/cobrancas'.'/'.$produto->slug.'/'.$fase->slug)->assertRedirect('/login');
    }
}
