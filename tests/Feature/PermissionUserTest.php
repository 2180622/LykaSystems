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

        $user = factory(User::class)->make();
        $user->email = $user->admin->email;
        
        $response = $this->actingAs($user)->withSession(['foo' => 'bar'])->get('/');
        $response->assertSuccessful();
        $response->assertViewIs('dashboard.index');
    }

    /********************************************************************************************************** */

    /** @test */
    public function admin_ir_para_lista_administrador()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->make();
        $user->email = $user->admin->email;
        
        $response = $this->actingAs($user)->withSession(['foo' => 'bar'])->get('/administradores');
        $response->assertSuccessful();
        $response->assertViewIs('users.list');
    }
    
    /** @test *//*
    public function admin_ir_para_show_administrador()
    {
        $this->withoutExceptionHandling();

        $administrador = factory(User::class)->make();
        $user = factory(User::class)->make();
        $user->email = $user->admin->email;
        
        $response = $this->actingAs($user)->withSession(['foo' => 'bar'])->get('/administradores'.'/'.$administrador->slug);
        $response->assertSuccessful();
        $response->assertViewIs('users.show');
    }
    
    /** @test */
    public function admin_ir_para_create_administrador()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->make();
        $user->email = $user->admin->email;

        $response = $this->actingAs($user)->withSession(['foo' => 'bar'])->get('/administradores/criar');
        $response->assertSuccessful();
        $response->assertViewIs('users.add');
    }
    
    /** @test *//*
    public function admin_ir_para_edit_administrador()
    {
        $this->withoutExceptionHandling();

        $administrador = factory(User::class)->make();
        $user = factory(User::class)->make();
        $user->email = $user->admin->email;
        
        $response = $this->actingAs($user)->withSession(['foo' => 'bar'])->get('/administradores'.'/'.$administrador->slug.'/editar');
        $response->assertSuccessful();
        $response->assertViewIs('users.add');
    }

    /********************************************************************************************************** */

    /** @test */
    public function admin_ir_para_lista_agente()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->make();
        $user->email = $user->admin->email;

        $response = $this->actingAs($user)->withSession(['foo' => 'bar'])->get('/agentes');
        $response->assertSuccessful();
        $response->assertViewIs('agents.list');
    }
    
    /** @test */
    public function admin_ir_para_show_agentes()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->make();
        $user->email = $user->admin->email;

        $agente = factory(Agente::class)->make();

        $response = $this->actingAs($user)->withSession(['foo' => 'bar'])->get('/agentes'.'/'.$agente->slug);
        $response->assertSuccessful();
        $response->assertViewIs('agents.show');
    }
    
    /** @test */
    public function admin_ir_para_create_agentes()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->make();
        $user->email = $user->admin->email;


        $response = $this->actingAs($user)->withSession(['foo' => 'bar'])->get('/agentes/criar');
        $response->assertSuccessful();
        $response->assertViewIs('agents.add');
    }
    
    /** @test */
    public function admin_ir_para_edit_agentes()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->make();
        $user->email = $user->admin->email;

        $agente = factory(Agente::class)->make();

        $response = $this->actingAs($user)->withSession(['foo' => 'bar'])->get('/agentes'.'/'.$agente->slug.'/editar');
        $response->assertSuccessful();
        $response->assertViewIs('agents.edit');
    }
    
    /** @test */
    public function admin_ir_para_print_agentes()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->make();
        $user->email = $user->admin->email;

        $agente = factory(Agente::class)->make();

        $response = $this->actingAs($user)->withSession(['foo' => 'bar'])->get('/agentes/print'.'/'.$agente->slug);
        $response->assertSuccessful();
        $response->assertViewIs('agents.print');
    }

    /********************************************************************************************************** */

    /** @test */
    public function admin_ir_para_lista_biblioteca()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->make();
        $user->email = $user->admin->email;

        $response = $this->actingAs($user)->withSession(['foo' => 'bar'])->get('/biblioteca');
        $response->assertSuccessful();
        $response->assertViewIs('users.add');
    }
    
    /** @test */
    public function admin_ir_para_create_biblioteca()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->make();
        $user->email = $user->admin->email;


        $response = $this->actingAs($user)->withSession(['foo' => 'bar'])->get('/biblioteca/criar');
        $response->assertSuccessful();
        $response->assertViewIs('users.add');
    }
    
    /** @test */
    public function admin_ir_para_edit_biblioteca()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->make();
        $user->email = $user->admin->email;

        $biblioteca = factory(Biblioteca::class)->make();

        $response = $this->actingAs($user)->withSession(['foo' => 'bar'])->get('/biblioteca'.'/'.$biblioteca->slug.'/editar');
        $response->assertSuccessful();
        $response->assertViewIs('users.add');
    }

    /********************************************************************************************************** */

    /** @test */
    public function admin_ir_para_lista_cliente()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->make();
        $user->email = $user->admin->email;

        $response = $this->actingAs($user)->withSession(['foo' => 'bar'])->get('/clientes');
        $response->assertSuccessful();
        $response->assertViewIs('users.add');
    }
    
    /** @test */
    public function admin_ir_para_show_cliente()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->make();
        $user->email = $user->admin->email;

        $cliente = factory(Cliente::class)->make();

        $response = $this->actingAs($user)->withSession(['foo' => 'bar'])->get('/clientes'.'/'.$cliente->slug);
        $response->assertSuccessful();
        $response->assertViewIs('users.add');
    }
    
    /** @test */
    public function admin_ir_para_create_cliente()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->make();
        $user->email = $user->admin->email;


        $response = $this->actingAs($user)->withSession(['foo' => 'bar'])->get('/clientes/criar');
        $response->assertSuccessful();
        $response->assertViewIs('users.add');
    }
    
    /** @test */
    public function admin_ir_para_edit_cliente()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->make();
        $user->email = $user->admin->email;

        $cliente = factory(Cliente::class)->make();

        $response = $this->actingAs($user)->withSession(['foo' => 'bar'])->get('/clientes'.'/'.$cliente->slug.'/editar');
        $response->assertSuccessful();
        $response->assertViewIs('users.add');
    }
    
    /** @test */
    public function admin_ir_para_pesquisa_cliente()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->make();
        $user->email = $user->admin->email;


        $response = $this->actingAs($user)->withSession(['foo' => 'bar'])->get('/clientes/pesquisa');
        $response->assertSuccessful();
        $response->assertViewIs('users.add');
    }
    
    /** @test */
    public function admin_ir_para_print_cliente()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->make();
        $user->email = $user->admin->email;

        $cliente = factory(Cliente::class)->make();

        $response = $this->actingAs($user)->withSession(['foo' => 'bar'])->get('/clientes/print'.'/'.$cliente->slug);
        $response->assertSuccessful();
        $response->assertViewIs('users.add');
    }

    /********************************************************************************************************** */

    /** @test */
    public function admin_ir_para_lista_conta()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->make();
        $user->email = $user->admin->email;

        $response = $this->actingAs($user)->withSession(['foo' => 'bar'])->get('/conta-bancaria');
        $response->assertSuccessful();
        $response->assertViewIs('users.add');
    }
    
    /** @test */
    public function admin_ir_para_show_conta()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->make();
        $user->email = $user->admin->email;

        $conta = factory(Conta::class)->make();

        $response = $this->actingAs($user)->withSession(['foo' => 'bar'])->get('/conta-bancaria'.'/'.$conta->slug);
        $response->assertSuccessful();
        $response->assertViewIs('users.add');
    }
    
    /** @test */
    public function admin_ir_para_create_conta()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->make();
        $user->email = $user->admin->email;

        $response = $this->actingAs($user)->withSession(['foo' => 'bar'])->get('/conta-bancaria/criar');
        $response->assertSuccessful();
        $response->assertViewIs('users.add');
    }
    
    /** @test */
    public function admin_ir_para_edit_conta()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->make();
        $user->email = $user->admin->email;

        $conta = factory(Conta::class)->make();

        $response = $this->actingAs($user)->withSession(['foo' => 'bar'])->get('/conta-bancaria'.'/'.$conta->slug.'/editar');
        $response->assertSuccessful();
        $response->assertViewIs('users.add');
    }

    /********************************************************************************************************** */

    /** @test */
    public function admin_ir_para_lista_fornecedor()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->make();
        $user->email = $user->admin->email;

        $response = $this->actingAs($user)->withSession(['foo' => 'bar'])->get('/fornecedores');
        $response->assertSuccessful();
        $response->assertViewIs('users.add');
    }
    
    /** @test */
    public function admin_ir_para_show_fornecedor()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->make();
        $user->email = $user->admin->email;

        $fornecedor = factory(Fornecedor::class)->make();

        $response = $this->actingAs($user)->withSession(['foo' => 'bar'])->get('/fornecedores'.'/'.$fornecedor->slug);
        $response->assertSuccessful();
        $response->assertViewIs('users.add');
    }
    
    /** @test */
    public function admin_ir_para_create_fornecedor()
    {

        $this->withoutExceptionHandling();

        $user = factory(User::class)->make();
        $user->email = $user->admin->email;

        $response = $this->actingAs($user)->withSession(['foo' => 'bar'])->get('/fornecedores/criar');
        $response->assertSuccessful();
        $response->assertViewIs('users.add');
    }
    
    /** @test */
    public function admin_ir_para_edit_fornecedor()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->make();
        $user->email = $user->admin->email;

        $fornecedor = factory(Fornecedor::class)->make();

        $response = $this->actingAs($user)->withSession(['foo' => 'bar'])->get('/fornecedores'.'/'.$fornecedor->slug.'/editar');
        $response->assertSuccessful();
        $response->assertViewIs('users.add');
    }

    /********************************************************************************************************** */

    /** @test */
    public function admin_ir_para_lista_produto_stock()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->make();
        $user->email = $user->admin->email;

        $response = $this->actingAs($user)->withSession(['foo' => 'bar'])->get('/produtostock');
        $response->assertSuccessful();
        $response->assertViewIs('users.add');
    }
    
    /** @test */
    public function admin_ir_para_show_produto_stock()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->make();
        $user->email = $user->admin->email;

        $produtoStock = factory(ProdutoStock::class)->make();

        $response = $this->actingAs($user)->withSession(['foo' => 'bar'])->get('/produtostock'.'/'.$produtoStock->idProdutoStock);
        $response->assertSuccessful();
        $response->assertViewIs('users.add');
    }
    
    /** @test */
    public function admin_ir_para_create_produto_stock()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->make();
        $user->email = $user->admin->email;


        $response = $this->actingAs($user)->withSession(['foo' => 'bar'])->get('/produtostock/criar');
        $response->assertSuccessful();
        $response->assertViewIs('users.add');
    }
    
    /** @test */
    public function admin_ir_para_edit_produto_stock()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->make();
        $user->email = $user->admin->email;

        $produtoStock = factory(ProdutoStock::class)->make();

        $response = $this->actingAs($user)->withSession(['foo' => 'bar'])->get('/produtostock'.'/'.$produtoStock->idProdutoStock.'/editar');
        $response->assertSuccessful();
        $response->assertViewIs('users.add');
    }

    /********************************************************************************************************** */

    /** @test */
    public function admin_ir_para_lista_fase_stock()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->make();
        $user->email = $user->admin->email;

        $response = $this->actingAs($user)->withSession(['foo' => 'bar'])->get('/fasestock');
        $response->assertSuccessful();
        $response->assertViewIs('users.add');
    }
    
    /** @test */
    public function admin_ir_para_show_fase_stock()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->make();
        $user->email = $user->admin->email;

        $faseStock = factory(FaseStock::class)->make();

        $response = $this->actingAs($user)->withSession(['foo' => 'bar'])->get('/fasestock'.'/'.$faseStock->idFaseStock);
        $response->assertSuccessful();
        $response->assertViewIs('users.add');
    }
    
    /** @test */
    public function admin_ir_para_create_fase_stock()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->make();
        $user->email = $user->admin->email;

        $response = $this->actingAs($user)->withSession(['foo' => 'bar'])->get('/fasestock/criar');
        $response->assertSuccessful();
        $response->assertViewIs('users.add');
    }
    
    /** @test */
    public function admin_ir_para_edit_fase_stock()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->make();
        $user->email = $user->admin->email;

        $faseStock = factory(FaseStock::class)->make();

        $response = $this->actingAs($user)->withSession(['foo' => 'bar'])->get('/fasestock'.'/'.$faseStock->idFaseStock.'/editar');
        $response->assertSuccessful();
        $response->assertViewIs('users.add');
    }

    /********************************************************************************************************** */

    /** @test */
    public function admin_ir_para_lista_doc_stock()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->make();
        $user->email = $user->admin->email;

        $response = $this->actingAs($user)->withSession(['foo' => 'bar'])->get('/documentostock');
        $response->assertSuccessful();
        $response->assertViewIs('users.add');
    }
    
    /** @test */
    public function admin_ir_para_show_doc_stock()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->make();
        $user->email = $user->admin->email;

        $docStock = factory(DocStock::class)->make();

        $response = $this->actingAs($user)->withSession(['foo' => 'bar'])->get('/documentostock'.'/'.$docStock->idDocStock);
        $response->assertSuccessful();
        $response->assertViewIs('users.add');
    }
    
    /** @test */
    public function admin_ir_para_create_doc_stock()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->make();
        $user->email = $user->admin->email;

        $response = $this->actingAs($user)->withSession(['foo' => 'bar'])->get('/documentostock/criar');
        $response->assertSuccessful();
        $response->assertViewIs('users.add');
    }
    
    /** @test */
    public function admin_ir_para_edit_doc_stock()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->make();
        $user->email = $user->admin->email;

        $docStock = factory(DocStock::class)->make();

        $response = $this->actingAs($user)->withSession(['foo' => 'bar'])->get('/documentostock'.'/'.$docStock->idDocStock.'/editar');
        $response->assertSuccessful();
        $response->assertViewIs('users.add');
    }

    /********************************************************************************************************** */

    /** @test */
    public function admin_ir_para_lista_universidade()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->make();
        $user->email = $user->admin->email;

        $response = $this->actingAs($user)->withSession(['foo' => 'bar'])->get('/universidades');
        $response->assertSuccessful();
        $response->assertViewIs('users.add');
    }
    
    /** @test */
    public function admin_ir_para_show_universidade()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->make();
        $user->email = $user->admin->email;

        $universidade = factory(Universidade::class)->make();

        $response = $this->actingAs($user)->withSession(['foo' => 'bar'])->get('/universidades'.'/'.$universidade->slug);
        $response->assertSuccessful();
        $response->assertViewIs('users.add');
    }
    
    /** @test */
    public function admin_ir_para_create_universidade()
    {

        $this->withoutExceptionHandling();

        $user = factory(User::class)->make();
        $user->email = $user->admin->email;

        $response = $this->actingAs($user)->withSession(['foo' => 'bar'])->get('/universidades/criar');
        $response->assertSuccessful();
        $response->assertViewIs('users.add');
    }
    
    /** @test */
    public function admin_ir_para_edit_universidade()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->make();
        $user->email = $user->admin->email;

        $universidade = factory(Universidade::class)->make();

        $response = $this->actingAs($user)->withSession(['foo' => 'bar'])->get('/universidades'.'/'.$universidade->slug.'/editar');
        $response->assertSuccessful();
        $response->assertViewIs('users.add');
    }

    /********************************************************************************************************** */

    /** @test */
    public function admin_ir_para_lista_contacto()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->make();
        $user->email = $user->admin->email;

        $response = $this->actingAs($user)->withSession(['foo' => 'bar'])->get('/contactos');
        $response->assertSuccessful();
        $response->assertViewIs('users.add');
    }
    
    /** @test */
    public function admin_ir_para_show_contacto()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->make();
        $user->email = $user->admin->email;

        $contacto = factory(Contacto::class)->make();

        $response = $this->actingAs($user)->withSession(['foo' => 'bar'])->get('/contactos/show/'.$contacto->slug);
        $response->assertSuccessful();
        $response->assertViewIs('users.add');
    }
    
    /** @test */
    public function admin_ir_para_create_contacto()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->make();
        $user->email = $user->admin->email;


        $response = $this->actingAs($user)->withSession(['foo' => 'bar'])->get('/contactos/criar');
        $response->assertSuccessful();
        $response->assertViewIs('users.add');
    }
    
    /** @test */
    public function admin_ir_para_edit_contacto()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->make();
        $user->email = $user->admin->email;

        $contacto = factory(Contacto::class)->make();

        $response = $this->actingAs($user)->withSession(['foo' => 'bar'])->get('/contactos/editar/'.$contacto->slug);
        $response->assertSuccessful();
        $response->assertViewIs('users.add');
    }

    /********************************************************************************************************** */

    /** @test */
    public function admin_ir_para_lista_agenda()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->make();
        $user->email = $user->admin->email;

        $response = $this->actingAs($user)->withSession(['foo' => 'bar'])->get('/agenda');
        $response->assertSuccessful();
        $response->assertViewIs('users.add');
    }
    
    /** @test */
    public function admin_ir_para_show_agenda()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->make();
        $user->email = $user->admin->email;

        $agenda = factory(Agenda::class)->make();

        $response = $this->actingAs($user)->withSession(['foo' => 'bar'])->get('/agenda'.'/'.$agenda->idAgenda);
        $response->assertSuccessful();
        $response->assertViewIs('users.add');
    }
    
    /** @test */
    public function admin_ir_para_create_agenda()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->make();
        $user->email = $user->admin->email;

        $response = $this->actingAs($user)->withSession(['foo' => 'bar'])->get('/agenda/criar');
        $response->assertSuccessful();
        $response->assertViewIs('users.add');
    }
    
    /** @test */
    public function admin_ir_para_edit_agenda()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->make();
        $user->email = $user->admin->email;

        $agenda = factory(Agenda::class)->make();

        $response = $this->actingAs($user)->withSession(['foo' => 'bar'])->get('/agenda'.'/'.$agenda->idAgenda.'/editar');
        $response->assertSuccessful();
        $response->assertViewIs('users.add');
    }

    /********************************************************************************************************** */
    
    /** @test */
    public function admin_ir_para_show_produto()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->make();
        $user->email = $user->admin->email;

        $produto = factory(Produto::class)->make();

        $response = $this->actingAs($user)->withSession(['foo' => 'bar'])->get('/produtos'.'/'.$produto->slug);
        $response->assertSuccessful();
        $response->assertViewIs('users.add');
    }
    
    /** @test */
    public function admin_ir_para_create_produto()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->make();
        $user->email = $user->admin->email;

        $produto = factory(Produto::class)->make();

        $response = $this->actingAs($user)->withSession(['foo' => 'bar'])->get('/produtos/criar/'.$produto->cliente->slug);
        $response->assertSuccessful();
        $response->assertViewIs('users.add');
    }
    
    /** @test */
    public function admin_ir_para_edit_produto()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->make();
        $user->email = $user->admin->email;

        $produto = factory(Produto::class)->make();

        $response = $this->actingAs($user)->withSession(['foo' => 'bar'])->get('/produtos'.'/'.$produto->slug.'/editar');
        $response->assertSuccessful();
        $response->assertViewIs('users.add');
    }

    /********************************************************************************************************** */
    
    /** @test */
    public function admin_ir_para_show_doc_academico()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->make();
        $user->email = $user->admin->email;

        $docAcademico = factory(DocAcademico::class)->make();

        $response = $this->actingAs($user)->withSession(['foo' => 'bar'])->get('/documento-academico'.'/'.$docAcademico->slug);
        $response->assertSuccessful();
        $response->assertViewIs('users.add');
    }
    
    /** @test */
    public function admin_ir_para_create_doc_academico()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->make();
        $user->email = $user->admin->email;

        $docNecessario = factory(DocNecessario::class)->make();

        $response = $this->actingAs($user)->withSession(['foo' => 'bar'])->get('/documento-academico/criar/'.$docNecessario->fase->slug.'/'.$docNecessario->idDocNecessario);
        $response->assertSuccessful();
        $response->assertViewIs('users.add');
    }
    
    /** @test */
    public function admin_ir_para_edit_doc_academico()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->make();
        $user->email = $user->admin->email;

        $docAcademico = factory(DocAcademico::class)->make();

        $response = $this->actingAs($user)->withSession(['foo' => 'bar'])->get('/documento-academico'.'/'.$docAcademico->slug.'/editar');
        $response->assertSuccessful();
        $response->assertViewIs('users.add');
    }
    
    /** @test */
    public function admin_ir_para_verifica_doc_academico()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->make();
        $user->email = $user->admin->email;

        $docAcademico = factory(DocAcademico::class)->make();

        $response = $this->actingAs($user)->withSession(['foo' => 'bar'])->get('/documento-academico'.'/'.$docAcademico->slug.'/verifica');
        $response->assertSuccessful();
        $response->assertViewIs('users.add');
    }

    /********************************************************************************************************** */
    
    /** @test */
    public function admin_ir_para_show_doc_pessoal()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->make();
        $user->email = $user->admin->email;

        $docPessoal = factory(DocPessoal::class)->make();

        $response = $this->actingAs($user)->withSession(['foo' => 'bar'])->get('/documento-pessoal'.'/'.$docPessoal->slug);
        $response->assertSuccessful();
        $response->assertViewIs('users.add');
    }
    
    /** @test */
    public function admin_ir_para_create_doc_pessoal()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->make();
        $user->email = $user->admin->email;

        $docNecessario = factory(DocNecessario::class)->make();

        $response = $this->actingAs($user)->withSession(['foo' => 'bar'])->get('/documento-pessoal/criar/'.$docNecessario->fase->slug.'/'.$docNecessario->idDocNecessario);
        $response->assertSuccessful();
        $response->assertViewIs('users.add');
    }
    
    /** @test */
    public function admin_ir_para_edit_doc_pessoal()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->make();
        $user->email = $user->admin->email;

        $docPessoal = factory(DocPessoal::class)->make();

        $response = $this->actingAs($user)->withSession(['foo' => 'bar'])->get('/documento-pessoal'.'/'.$docPessoal->slug.'/editar');
        $response->assertSuccessful();
        $response->assertViewIs('users.add');
    }
    
    /** @test */
    public function admin_ir_para_verifica_doc_pessoal()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->make();
        $user->email = $user->admin->email;

        $docPessoal = factory(DocPessoal::class)->make();

        $response = $this->actingAs($user)->withSession(['foo' => 'bar'])->get('/documento-pessoal'.'/'.$docPessoal->slug.'/verifica');
        $response->assertSuccessful();
        $response->assertViewIs('users.add');
    }

    /********************************************************************************************************** */

    /** @test */
    public function admin_ir_para_show_doc_transacao()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->make();
        $user->email = $user->admin->email;

        $docTransacao = factory(DocTransacao::class)->make();

        $response = $this->actingAs($user)->withSession(['foo' => 'bar'])->get('/documento-transacao'.'/'.$docTransacao->slug);
        $response->assertSuccessful();
        $response->assertViewIs('users.add');
    }
    
    /** @test */
    public function admin_ir_para_create_doc_transacao()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->make();
        $user->email = $user->admin->email;

        $response = $this->actingAs($user)->withSession(['foo' => 'bar'])->get('/documento-transacao/criar');
        $response->assertSuccessful();
        $response->assertViewIs('users.add');
    }
    
    /** @test */
    public function admin_ir_para_edit_doc_transacao()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->make();
        $user->email = $user->admin->email;

        $docTransacao = factory(DocTransacao::class)->make();

        $response = $this->actingAs($user)->withSession(['foo' => 'bar'])->get('/documento-transacao'.'/'.$docTransacao->slug.'/editar');
        $response->assertSuccessful();
        $response->assertViewIs('users.add');
    }

    /********************************************************************************************************** */

    /** @test */
    public function admin_ir_para_lista_pago_responsabilidade()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->make();
        $user->email = $user->admin->email;

        $response = $this->actingAs($user)->withSession(['foo' => 'bar'])->get('/pagamentos');
        $response->assertSuccessful();
        $response->assertViewIs('users.add');
    }
    
    /** @test */
    public function admin_ir_para_show_pago_responsabilidade()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->make();
        $user->email = $user->admin->email;

        $pagoResponsabilidade = factory(PagoResponsabilidade::class)->make();

        $response = $this->actingAs($user)->withSession(['foo' => 'bar'])->get('/pagamentos'.'/'.$pagoResponsabilidade->slug);
        $response->assertSuccessful();
        $response->assertViewIs('users.add');
    }
    
    /** @test */
    public function admin_ir_para_agente_pago_responsabilidade()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->make();
        $user->email = $user->admin->email;

        $responsabilidade = factory(Responsabilidade::class)->make();

        $response = $this->actingAs($user)->withSession(['foo' => 'bar'])->get('/pagamentos/agente/'.$responsabilidade->agente->slug.'/fase'.'/'.$responsabilidade->fase->slug.'/'.$responsabilidade->idResponsabilidade);
        $response->assertSuccessful();
        $response->assertViewIs('users.add');
    }
    
    /** @test */
    public function admin_ir_para_cliente_pago_responsabilidade()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->make();
        $user->email = $user->admin->email;

        $responsabilidade = factory(Responsabilidade::class)->make();

        $response = $this->actingAs($user)->withSession(['foo' => 'bar'])->get('/pagamentos/cliente/'.$responsabilidade->cliente->slug.'/fase'.'/'.$responsabilidade->fase->slug.'/'.$responsabilidade->idResponsabilidade);
        $response->assertSuccessful();
        $response->assertViewIs('users.add');
    }
    
    /** @test */
    public function admin_ir_para_fornecedor_pago_responsabilidade()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->make();
        $user->email = $user->admin->email;

        $relFornResp = factory(RelFornResp::class)->make();

        $response = $this->actingAs($user)->withSession(['foo' => 'bar'])->get('/pagamentos/fornecedor/'.$relFornResp->fornecedor->slug.'/fase'.'/'.$relFornResp->responsabilidade->fase->slug.'/'.$relFornResp->idRelacao);
        $response->assertSuccessful();
        $response->assertViewIs('users.add');
    }
    
    /** @test */
    public function admin_ir_para_download_pago_responsabilidade()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->make();
        $user->email = $user->admin->email;

        $pagoResponsabilidade = factory(PagoResponsabilidade::class)->make();

        $response = $this->actingAs($user)->withSession(['foo' => 'bar'])->get('/pagamentos/nota-pagamento/'.$pagoResponsabilidade->idPagoResp.'/transferir');
        $response->assertSuccessful();
        $response->assertViewIs('users.add');
    }
    
    /** @test */
    public function admin_ir_para_subagente_pago_responsabilidade()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->make();
        $user->email = $user->admin->email;

        $responsabilidade = factory(Responsabilidade::class)->make();
        $responsabilidade->subagente->tipo = 'Subagente';
        $responsabilidade->subagente->idAgenteAssociado = $responsabilidade->agente->idAgente;

        $response = $this->actingAs($user)->withSession(['foo' => 'bar'])->get('/pagamentos/subagente/'.$responsabilidade->subagente->slug.'/fase'.'/'.$responsabilidade->fase->slug.'/'.$responsabilidade->idResponsabilidade);
        $response->assertSuccessful();
        $response->assertViewIs('users.add');
    }
    
    /** @test */
    public function admin_ir_para_universidade_principal_pago_responsabilidade()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->make();
        $user->email = $user->admin->email;

        $responsabilidade = factory(Responsabilidade::class)->make();

        $response = $this->actingAs($user)->withSession(['foo' => 'bar'])->get('/pagamentos/universidade-principal/'.$responsabilidade->universidade1->slug.'/fase'.'/'.$responsabilidade->fase->slug.'/'.$responsabilidade->idResponsabilidade);
        $response->assertSuccessful();
        $response->assertViewIs('users.add');
    }
    
    /** @test */
    public function admin_ir_para_universidade_secundaria_pago_responsabilidade()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->make();
        $user->email = $user->admin->email;

        $responsabilidade = factory(Responsabilidade::class)->make();

        $response = $this->actingAs($user)->withSession(['foo' => 'bar'])->get('/pagamentos/universidade-secundaria/'.$responsabilidade->universidade2->slug.'/fase'.'/'.$responsabilidade->fase->slug.'/'.$responsabilidade->idResponsabilidade);
        $response->assertSuccessful();
        $response->assertViewIs('users.add');
    }

    /********************************************************************************************************** */

    /** @test */
    public function admin_ir_para_lista_relatorio_problema()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->make();
        $user->email = $user->admin->email;

        $response = $this->actingAs($user)->withSession(['foo' => 'bar'])->get('/reportar-problema');
        $response->assertSuccessful();
        $response->assertViewIs('users.add');
    }
    
    /** @test */
    public function admin_ir_para_create_relatorio_problema()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->make();
        $user->email = $user->admin->email;


        $response = $this->actingAs($user)->withSession(['foo' => 'bar'])->get('/reportar-problema/criar');
        $response->assertSuccessful();
        $response->assertViewIs('users.add');
    }

    /********************************************************************************************************** */

    /** @test */
    public function admin_ir_para_lista_cobrancas()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->make();
        $user->email = $user->admin->email;

        $response = $this->actingAs($user)->withSession(['foo' => 'bar'])->get('/cobrancas');
        $response->assertSuccessful();
        $response->assertViewIs('users.add');
    }
    
    /** @test */
    public function admin_ir_para_show_cobrancas()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->make();
        $user->email = $user->admin->email;

        $produto = factory(Produto::class)->make();

        $response = $this->actingAs($user)->withSession(['foo' => 'bar'])->get('/cobrancas'.'/'.$produto->slug);
        $response->assertSuccessful();
        $response->assertViewIs('users.add');
    }
    
    /** @test */
    public function admin_ir_para_create_cobrancas()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->make();
        $user->email = $user->admin->email;


        $response = $this->actingAs($user)->withSession(['foo' => 'bar'])->get('/cobrancas/criar');
        $response->assertSuccessful();
        $response->assertViewIs('users.add');
    }
    
    /** @test */
    public function admin_ir_para_edit_cobrancas()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->make();
        $user->email = $user->admin->email;

        $docTransacao = factory(DocTransacao::class)->make();

        $response = $this->actingAs($user)->withSession(['foo' => 'bar'])->get('/cobrancas'.'/'.$docTransacao->fase->produto->slug.'/'.$docTransacao->fase->slug.'/'.$docTransacao->slug.'/editar');
        $response->assertSuccessful();
        $response->assertViewIs('users.add');
    }
    
    /** @test */
    public function admin_ir_para_download_cobrancas()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->make();
        $user->email = $user->admin->email;

        $docTransacao = factory(DocTransacao::class)->make();

        $response = $this->actingAs($user)->withSession(['foo' => 'bar'])->get('/cobrancas'.'/'.$docTransacao->slug.'/download');
        $response->assertSuccessful();
        $response->assertViewIs('users.add');
    }
    
    /** @test */
    public function admin_ir_para_show_charge_cobrancas()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->make();
        $user->email = $user->admin->email;

        $fase = factory(Fase::class)->make();

        $response = $this->actingAs($user)->withSession(['foo' => 'bar'])->get('/cobrancas'.'/'.$fase->produto->slug.'/'.$fase->slug);
        $response->assertSuccessful();
        $response->assertViewIs('users.add');
    }
}
