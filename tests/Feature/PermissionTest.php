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
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PermissionTest extends TestCase
{
    use DatabaseMigrations;
    use RefreshDatabase;

    /** @test */
    public function redirecionar_de_dashboard_para_login()
    {
        $response = $this->get('/')->assertRedirect('/login');
    }

    /********************************************************************************************************** */

    /** @test */
    public function redirecionar_de_lista_administrador_para_login()
    {
        $administrador = factory(Administrador::class)->make();

        $response = $this->get('/clientes')->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_show_administrador_para_login()
    {
        $administrador = factory(Administrador::class)->make();

        $response = $this->get('/')->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_create_administrador_para_login()
    {
        $administrador = factory(Administrador::class)->make();

        $response = $this->get('/')->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_edit_administrador_para_login()
    {
        $administrador = factory(Administrador::class)->make();

        $response = $this->get('/')->assertRedirect('/login');
    }

    /********************************************************************************************************** */

    /** @test */
    public function redirecionar_de_lista_cliente_para_login()
    {
        $response = $this->get('/clientes')->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_show_cliente_para_login()
    {
        $response = $this->get('/')->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_create_cliente_para_login()
    {
        $response = $this->get('/')->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_edit_cliente_para_login()
    {
        $response = $this->get('/')->assertRedirect('/login');
    }

    /********************************************************************************************************** */

    /** @test */
    public function redirecionar_de_lista_cliente_para_login()
    {
        $response = $this->get('/clientes')->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_show_cliente_para_login()
    {
        $response = $this->get('/')->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_create_cliente_para_login()
    {
        $response = $this->get('/')->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_edit_cliente_para_login()
    {
        $response = $this->get('/')->assertRedirect('/login');
    }

    /********************************************************************************************************** */

    /** @test */
    public function redirecionar_de_lista_cliente_para_login()
    {
        $response = $this->get('/clientes')->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_show_cliente_para_login()
    {
        $response = $this->get('/')->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_create_cliente_para_login()
    {
        $response = $this->get('/')->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_edit_cliente_para_login()
    {
        $response = $this->get('/')->assertRedirect('/login');
    }

    /********************************************************************************************************** */

    /** @test */
    public function redirecionar_de_lista_cliente_para_login()
    {
        $response = $this->get('/clientes')->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_show_cliente_para_login()
    {
        $response = $this->get('/')->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_create_cliente_para_login()
    {
        $response = $this->get('/')->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_edit_cliente_para_login()
    {
        $response = $this->get('/')->assertRedirect('/login');
    }

    /********************************************************************************************************** */

    /** @test */
    public function redirecionar_de_lista_cliente_para_login()
    {
        $response = $this->get('/clientes')->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_show_cliente_para_login()
    {
        $response = $this->get('/')->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_create_cliente_para_login()
    {
        $response = $this->get('/')->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_edit_cliente_para_login()
    {
        $response = $this->get('/')->assertRedirect('/login');
    }

    /********************************************************************************************************** */

    /** @test */
    public function redirecionar_de_lista_cliente_para_login()
    {
        $response = $this->get('/clientes')->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_show_cliente_para_login()
    {
        $response = $this->get('/')->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_create_cliente_para_login()
    {
        $response = $this->get('/')->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_edit_cliente_para_login()
    {
        $response = $this->get('/')->assertRedirect('/login');
    }

    /********************************************************************************************************** */

    /** @test */
    public function redirecionar_de_lista_cliente_para_login()
    {
        $response = $this->get('/clientes')->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_show_cliente_para_login()
    {
        $response = $this->get('/')->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_create_cliente_para_login()
    {
        $response = $this->get('/')->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_edit_cliente_para_login()
    {
        $response = $this->get('/')->assertRedirect('/login');
    }

    /********************************************************************************************************** */

    /** @test */
    public function redirecionar_de_lista_cliente_para_login()
    {
        $response = $this->get('/clientes')->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_show_cliente_para_login()
    {
        $response = $this->get('/')->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_create_cliente_para_login()
    {
        $response = $this->get('/')->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_edit_cliente_para_login()
    {
        $response = $this->get('/')->assertRedirect('/login');
    }

    /********************************************************************************************************** */

    /** @test */
    public function redirecionar_de_lista_cliente_para_login()
    {
        $response = $this->get('/clientes')->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_show_cliente_para_login()
    {
        $response = $this->get('/')->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_create_cliente_para_login()
    {
        $response = $this->get('/')->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_edit_cliente_para_login()
    {
        $response = $this->get('/')->assertRedirect('/login');
    }

    /********************************************************************************************************** */

    /** @test */
    public function redirecionar_de_lista_cliente_para_login()
    {
        $response = $this->get('/clientes')->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_show_cliente_para_login()
    {
        $response = $this->get('/')->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_create_cliente_para_login()
    {
        $response = $this->get('/')->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_edit_cliente_para_login()
    {
        $response = $this->get('/')->assertRedirect('/login');
    }

    /********************************************************************************************************** */

    /** @test */
    public function redirecionar_de_lista_cliente_para_login()
    {
        $response = $this->get('/clientes')->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_show_cliente_para_login()
    {
        $response = $this->get('/')->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_create_cliente_para_login()
    {
        $response = $this->get('/')->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_edit_cliente_para_login()
    {
        $response = $this->get('/')->assertRedirect('/login');
    }

    /********************************************************************************************************** */

    /** @test */
    public function redirecionar_de_lista_cliente_para_login()
    {
        $response = $this->get('/clientes')->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_show_cliente_para_login()
    {
        $response = $this->get('/')->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_create_cliente_para_login()
    {
        $response = $this->get('/')->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_edit_cliente_para_login()
    {
        $response = $this->get('/')->assertRedirect('/login');
    }

    /********************************************************************************************************** */

    /** @test */
    public function redirecionar_de_lista_cliente_para_login()
    {
        $response = $this->get('/clientes')->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_show_cliente_para_login()
    {
        $response = $this->get('/')->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_create_cliente_para_login()
    {
        $response = $this->get('/')->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_edit_cliente_para_login()
    {
        $response = $this->get('/')->assertRedirect('/login');
    }

    /********************************************************************************************************** */

    /** @test */
    public function redirecionar_de_lista_cliente_para_login()
    {
        $response = $this->get('/clientes')->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_show_cliente_para_login()
    {
        $response = $this->get('/')->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_create_cliente_para_login()
    {
        $response = $this->get('/')->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_edit_cliente_para_login()
    {
        $response = $this->get('/')->assertRedirect('/login');
    }

    /********************************************************************************************************** */

    /** @test */
    public function redirecionar_de_lista_cliente_para_login()
    {
        $response = $this->get('/clientes')->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_show_cliente_para_login()
    {
        $response = $this->get('/')->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_create_cliente_para_login()
    {
        $response = $this->get('/')->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_edit_cliente_para_login()
    {
        $response = $this->get('/')->assertRedirect('/login');
    }

    /********************************************************************************************************** */

    /** @test */
    public function redirecionar_de_lista_cliente_para_login()
    {
        $response = $this->get('/clientes')->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_show_cliente_para_login()
    {
        $response = $this->get('/')->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_create_cliente_para_login()
    {
        $response = $this->get('/')->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_edit_cliente_para_login()
    {
        $response = $this->get('/')->assertRedirect('/login');
    }

    /********************************************************************************************************** */

    /** @test */
    public function redirecionar_de_lista_cliente_para_login()
    {
        $response = $this->get('/clientes')->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_show_cliente_para_login()
    {
        $response = $this->get('/')->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_create_cliente_para_login()
    {
        $response = $this->get('/')->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_edit_cliente_para_login()
    {
        $response = $this->get('/')->assertRedirect('/login');
    }

    /********************************************************************************************************** */

    /** @test */
    public function redirecionar_de_lista_cliente_para_login()
    {
        $response = $this->get('/clientes')->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_show_cliente_para_login()
    {
        $response = $this->get('/')->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_create_cliente_para_login()
    {
        $response = $this->get('/')->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_edit_cliente_para_login()
    {
        $response = $this->get('/')->assertRedirect('/login');
    }

    /********************************************************************************************************** */

    /** @test */
    public function redirecionar_de_lista_cliente_para_login()
    {
        $response = $this->get('/clientes')->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_show_cliente_para_login()
    {
        $response = $this->get('/')->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_create_cliente_para_login()
    {
        $response = $this->get('/')->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_edit_cliente_para_login()
    {
        $response = $this->get('/')->assertRedirect('/login');
    }

    /********************************************************************************************************** */

    /** @test */
    public function redirecionar_de_lista_cliente_para_login()
    {
        $response = $this->get('/clientes')->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_show_cliente_para_login()
    {
        $response = $this->get('/')->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_create_cliente_para_login()
    {
        $response = $this->get('/')->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_edit_cliente_para_login()
    {
        $response = $this->get('/')->assertRedirect('/login');
    }

    /********************************************************************************************************** */

    /** @test */
    public function redirecionar_de_lista_cliente_para_login()
    {
        $response = $this->get('/clientes')->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_show_cliente_para_login()
    {
        $response = $this->get('/')->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_create_cliente_para_login()
    {
        $response = $this->get('/')->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_edit_cliente_para_login()
    {
        $response = $this->get('/')->assertRedirect('/login');
    }

    /********************************************************************************************************** */

    /** @test */
    public function redirecionar_de_lista_cliente_para_login()
    {
        $response = $this->get('/clientes')->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_show_cliente_para_login()
    {
        $response = $this->get('/')->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_create_cliente_para_login()
    {
        $response = $this->get('/')->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_edit_cliente_para_login()
    {
        $response = $this->get('/')->assertRedirect('/login');
    }
}
