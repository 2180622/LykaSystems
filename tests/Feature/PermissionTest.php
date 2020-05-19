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
        $response = $this->get('/administradores')->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_show_administrador_para_login()
    {
        $administrador = factory(Administrador::class)->make();

        $response = $this->get('/administradores'.'/'.$administrador->slug)->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_create_administrador_para_login()
    {

        $response = $this->get('/administradores/criar')->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_edit_administrador_para_login()
    {
        $administrador = factory(Administrador::class)->make();

        $response = $this->get('/administradores'.'/'.$administrador->slug.'/editar')->assertRedirect('/login');
    }

    /********************************************************************************************************** */

    /** @test */
    public function redirecionar_de_lista_agente_para_login()
    {
        $response = $this->get('/agentes')->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_show_agentes_para_login()
    {
        $agente = factory(Agente::class)->make();

        $response = $this->get('/agentes'.'/'.$agente->slug)->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_create_agentes_para_login()
    {

        $response = $this->get('/agentes/criar')->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_edit_agentes_para_login()
    {
        $agente = factory(Agente::class)->make();

        $response = $this->get('/agentes'.'/'.$agente->slug.'/editar')->assertRedirect('/login');
    }

    /********************************************************************************************************** */

    /** @test */
    public function redirecionar_de_lista_biblioteca_para_login()
    {
        $response = $this->get('/biblioteca')->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_create_biblioteca_para_login()
    {

        $response = $this->get('/biblioteca/criar')->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_edit_biblioteca_para_login()
    {
        $biblioteca = factory(Biblioteca::class)->make();

        $response = $this->get('/biblioteca'.'/'.$biblioteca->slug.'/editar')->assertRedirect('/login');
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
        $cliente = factory(Cliente::class)->make();

        $response = $this->get('/clientes'.'/'.$cliente->slug)->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_create_cliente_para_login()
    {

        $response = $this->get('/clientes/criar')->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_edit_cliente_para_login()
    {
        $cliente = factory(Cliente::class)->make();

        $response = $this->get('/clientes'.'/'.$cliente->slug.'/editar')->assertRedirect('/login');
    }

    /********************************************************************************************************** */

    /** @test */
    public function redirecionar_de_lista_conta_para_login()
    {
        $response = $this->get('/conta-bancaria')->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_show_conta_para_login()
    {
        $conta = factory(Conta::class)->make();

        $response = $this->get('/conta-bancaria'.'/'.$conta->slug)->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_create_conta_para_login()
    {
        $response = $this->get('/conta-bancaria/criar')->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_edit_conta_para_login()
    {
        $conta = factory(Conta::class)->make();

        $response = $this->get('/conta-bancaria'.'/'.$conta->slug.'/editar')->assertRedirect('/login');
    }

    /********************************************************************************************************** */

    /** @test */
    public function redirecionar_de_lista_fornecedor_para_login()
    {
        $response = $this->get('/fornecedores')->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_show_fornecedor_para_login()
    {
        $fornecedor = factory(Fornecedor::class)->make();

        $response = $this->get('/fornecedores'.'/'.$fornecedor->slug)->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_create_fornecedor_para_login()
    {

        $response = $this->get('/fornecedores/criar')->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_edit_fornecedor_para_login()
    {
        $fornecedor = factory(Fornecedor::class)->make();

        $response = $this->get('/fornecedores'.'/'.$fornecedor->slug.'/editar')->assertRedirect('/login');
    }

    /********************************************************************************************************** */

    /** @test */
    public function redirecionar_de_lista_produto_stock_para_login()
    {
        $response = $this->get('/produtostock')->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_show_produto_stock_para_login()
    {
        $produtoStock = factory(ProdutoStock::class)->make();

        $response = $this->get('/produtostock'.'/'.$produtoStock->slug)->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_create_produto_stock_para_login()
    {

        $response = $this->get('/produtostock/criar')->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_edit_produto_stock_para_login()
    {
        $produtoStock = factory(ProdutoStock::class)->make();

        $response = $this->get('/produtostock'.'/'.$produtoStock->slug.'/editar')->assertRedirect('/login');
    }

    /********************************************************************************************************** */

    /** @test */
    public function redirecionar_de_lista_fase_stock_para_login()
    {
        $response = $this->get('/fasestock')->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_show_fase_stock_para_login()
    {
        $produtoStock = factory(ProdutoStock::class)->make();

        $faseStock = factory(FaseStock::class)->make([
            'idProdutoStock' => $produtoStock->idProdutoStock,
        ]);

        $response = $this->get('/fasestock'.'/'.$faseStock->slug)->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_create_fase_stock_para_login()
    {

        $response = $this->get('/fasestock/criar')->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_edit_fase_stock_para_login()
    {
        $produtoStock = factory(ProdutoStock::class)->make();

        $faseStock = factory(FaseStock::class)->make([
            'idProdutoStock' => $produtoStock->idProdutoStock,
        ]);

        $response = $this->get('/fasestock'.'/'.$faseStock->slug.'/editar')->assertRedirect('/login');
    }

    /********************************************************************************************************** */

    /** @test */
    public function redirecionar_de_lista_doc_stock_para_login()
    {
        $response = $this->get('/documentostock')->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_show_doc_stock_para_login()
    {
        $produtoStock = factory(ProdutoStock::class)->make();
        $faseStock = factory(FaseStock::class)->make([
            'idProdutoStock' => $produtoStock->idProdutoStock,
        ]);

        $docStock = factory(DocStock::class)->make([
            'idFaseStock' => $faseStock->idFaseStock,
        ]);

        $response = $this->get('/documentostock'.'/'.$docStock->slug)->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_create_doc_stock_para_login()
    {

        $response = $this->get('/documentostock/criar')->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_edit_doc_stock_para_login()
    {
        $produtoStock = factory(ProdutoStock::class)->make();
        $faseStock = factory(FaseStock::class)->make([
            'idProdutoStock' => $produtoStock->idProdutoStock,
        ]);

        $docStock = factory(DocStock::class)->make([
            'idFaseStock' => $faseStock->idFaseStock,
        ]);

        $response = $this->get('/documentostock'.'/'.$docStock->slug.'/editar')->assertRedirect('/login');
    }

    /********************************************************************************************************** */

    /** @test */
    public function redirecionar_de_lista_universidade_para_login()
    {
        $response = $this->get('/universidades')->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_show_universidade_para_login()
    {
        $universidade = factory(Universidade::class)->make();

        $response = $this->get('/universidades'.'/'.$universidade->slug)->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_create_universidade_para_login()
    {

        $response = $this->get('/universidades/criar')->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_edit_universidade_para_login()
    {
        $universidade = factory(Universidade::class)->make();

        $response = $this->get('/universidades'.'/'.$universidade->slug.'/editar')->assertRedirect('/login');
    }

    /********************************************************************************************************** */

    /** @test */
    public function redirecionar_de_lista_contacto_para_login()
    {
        $response = $this->get('/contacts')->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_show_contacto_para_login()
    {
        $contacto = factory(Contacto::class)->make();

        $response = $this->get('/contacts'.'/'.$contacto->slug)->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_create_contacto_para_login()
    {

        $response = $this->get('/contacts/criar')->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_edit_contacto_para_login()
    {
        $contacto = factory(Contacto::class)->make();

        $response = $this->get('/contacts'.'/'.$contacto->slug.'/editar')->assertRedirect('/login');
    }

    /********************************************************************************************************** */

    /** @test */
    public function redirecionar_de_lista_agenda_para_login()
    {
        $response = $this->get('/agenda')->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_show_agenda_para_login()
    {
        $administrador = factory(Administrador::class)->make();
        $user = factory(User::class)->make([
            'email' => $administrador->email,
            'tipo' => 'admin',
            'idAdmin' => $administrador->idAdmin,
        ]);

        $agenda = factory(Agenda::class)->make([
            'idUser' => $user->idUser,
        ]);

        $response = $this->get('/agenda'.'/'.$agenda->slug)->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_create_agenda_para_login()
    {

        $response = $this->get('/agenda/criar')->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_edit_agenda_para_login()
    {
        $administrador = factory(Administrador::class)->make();
        $user = factory(User::class)->make([
            'email' => $administrador->email,
            'tipo' => 'admin',
            'idAdmin' => $administrador->idAdmin,
        ]);

        $agenda = factory(Agenda::class)->make([
            'idUser' => $user->idUser,
        ]);

        $response = $this->get('/agenda'.'/'.$agenda->slug.'/editar')->assertRedirect('/login');
    }

    /********************************************************************************************************** */

    /** @test */
    public function redirecionar_de_lista_produto_para_login()
    {
        $response = $this->get('/produtos')->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_show_produto_para_login()
    {
        $cliente = factory(Cliente::class)->make();
        $agente = factory(Agente::class)->make();
        $universidade = factory(Universidade::class)->make();

        $produto = factory(Produto::class)->make([
            'idAgente' => $agente->idAgente,
            'idCliente' => $cliente->idCliente,
            'idUniversidade1' => $universidade->idUniversidade1,
        ]);

        $response = $this->get('/produtos'.'/'.$produto->slug)->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_create_produto_para_login()
    {
        $cliente = factory(Cliente::class)->make();
        $agente = factory(Agente::class)->make();
        $universidade = factory(Universidade::class)->make();

        $produto = factory(Produto::class)->make([
            'idAgente' => $agente->idAgente,
            'idCliente' => $cliente->idCliente,
            'idUniversidade1' => $universidade->idUniversidade1,
        ]);

        $response = $this->get('/produtos/criar/'.$cliente->slug)->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_edit_produto_para_login()
    {
        $cliente = factory(Cliente::class)->make();
        $agente = factory(Agente::class)->make();
        $universidade = factory(Universidade::class)->make();

        $produto = factory(Produto::class)->make([
            'idAgente' => $agente->idAgente,
            'idCliente' => $cliente->idCliente,
            'idUniversidade1' => $universidade->idUniversidade1,
        ]);

        $response = $this->get('/produtos'.'/'.$produto->slug.'/editar')->assertRedirect('/login');
    }

    /********************************************************************************************************** */

    /** @test */
    public function redirecionar_de_lista_doc_academico_para_login()
    {
        $response = $this->get('/documento-academico')->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_show_doc_academico_para_login()
    {
        $cliente = factory(Cliente::class)->make();
        $agente = factory(Agente::class)->make();
        $universidade = factory(Universidade::class)->make();
        $produto = factory(Produto::class)->make([
            'idAgente' => $agente->idAgente,
            'idCliente' => $cliente->idCliente,
            'idUniversidade1' => $universidade->idUniversidade1,
        ]);
        $responsabilidade = factory(Responsabilidade::class)->make([
            'idAgente' => $agente->idAgente,
            'idCliente' => $cliente->idCliente,
            'idUniversidade1' => $universidade->idUniversidade1,
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

        $response = $this->get('/documento-academico/criar')->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_edit_doc_academico_para_login()
    {
        $cliente = factory(Cliente::class)->make();
        $agente = factory(Agente::class)->make();
        $universidade = factory(Universidade::class)->make();
        $produto = factory(Produto::class)->make([
            'idAgente' => $agente->idAgente,
            'idCliente' => $cliente->idCliente,
            'idUniversidade1' => $universidade->idUniversidade1,
        ]);
        $responsabilidade = factory(Responsabilidade::class)->make([
            'idAgente' => $agente->idAgente,
            'idCliente' => $cliente->idCliente,
            'idUniversidade1' => $universidade->idUniversidade1,
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

    /********************************************************************************************************** */

    /** @test */
    public function redirecionar_de_lista_doc_pessoal_para_login()
    {
        $response = $this->get('/documento-pessoal')->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_show_doc_pessoal_para_login()
    {
        $cliente = factory(Cliente::class)->make();
        $agente = factory(Agente::class)->make();
        $universidade = factory(Universidade::class)->make();
        $produto = factory(Produto::class)->make([
            'idAgente' => $agente->idAgente,
            'idCliente' => $cliente->idCliente,
            'idUniversidade1' => $universidade->idUniversidade1,
        ]);
        $responsabilidade = factory(Responsabilidade::class)->make([
            'idAgente' => $agente->idAgente,
            'idCliente' => $cliente->idCliente,
            'idUniversidade1' => $universidade->idUniversidade1,
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

        $response = $this->get('/documento-pessoal/criar')->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_edit_doc_pessoal_para_login()
    {
        $cliente = factory(Cliente::class)->make();
        $agente = factory(Agente::class)->make();
        $universidade = factory(Universidade::class)->make();
        $produto = factory(Produto::class)->make([
            'idAgente' => $agente->idAgente,
            'idCliente' => $cliente->idCliente,
            'idUniversidade1' => $universidade->idUniversidade1,
        ]);
        $responsabilidade = factory(Responsabilidade::class)->make([
            'idAgente' => $agente->idAgente,
            'idCliente' => $cliente->idCliente,
            'idUniversidade1' => $universidade->idUniversidade1,
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

    /********************************************************************************************************** */

    /** @test */
    public function redirecionar_de_lista_doc_transacao_para_login()
    {
        $response = $this->get('/documento-transacao')->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_show_doc_transacao_para_login()
    {
        $cliente = factory(Cliente::class)->make();
        $agente = factory(Agente::class)->make();
        $universidade = factory(Universidade::class)->make();
        $produto = factory(Produto::class)->make([
            'idAgente' => $agente->idAgente,
            'idCliente' => $cliente->idCliente,
            'idUniversidade1' => $universidade->idUniversidade1,
        ]);
        $responsabilidade = factory(Responsabilidade::class)->make([
            'idAgente' => $agente->idAgente,
            'idCliente' => $cliente->idCliente,
            'idUniversidade1' => $universidade->idUniversidade1,
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

        $response = $this->get('/documento-transacao/criar')->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_edit_doc_transacao_para_login()
    {
        $cliente = factory(Cliente::class)->make();
        $agente = factory(Agente::class)->make();
        $universidade = factory(Universidade::class)->make();
        $produto = factory(Produto::class)->make([
            'idAgente' => $agente->idAgente,
            'idCliente' => $cliente->idCliente,
            'idUniversidade1' => $universidade->idUniversidade1,
        ]);
        $responsabilidade = factory(Responsabilidade::class)->make([
            'idAgente' => $agente->idAgente,
            'idCliente' => $cliente->idCliente,
            'idUniversidade1' => $universidade->idUniversidade1,
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
        $response = $this->get('/pagamentos')->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_show_pago_responsabilidade_para_login()
    {
        $cliente = factory(Cliente::class)->make();
        $agente = factory(Agente::class)->make();
        $universidade = factory(Universidade::class)->make();
        $produto = factory(Produto::class)->make([
            'idAgente' => $agente->idAgente,
            'idCliente' => $cliente->idCliente,
            'idUniversidade1' => $universidade->idUniversidade1,
        ]);
        $responsabilidade = factory(Responsabilidade::class)->make([
            'idAgente' => $agente->idAgente,
            'idCliente' => $cliente->idCliente,
            'idUniversidade1' => $universidade->idUniversidade1,
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
    
    /** @test */
    public function redirecionar_de_create_pago_responsabilidade_para_login()
    {

        $response = $this->get('/pagamentos/criar')->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_edit_pago_responsabilidade_para_login()
    {
        $cliente = factory(Cliente::class)->make();
        $agente = factory(Agente::class)->make();
        $universidade = factory(Universidade::class)->make();
        $produto = factory(Produto::class)->make([
            'idAgente' => $agente->idAgente,
            'idCliente' => $cliente->idCliente,
            'idUniversidade1' => $universidade->idUniversidade1,
        ]);
        $responsabilidade = factory(Responsabilidade::class)->make([
            'idAgente' => $agente->idAgente,
            'idCliente' => $cliente->idCliente,
            'idUniversidade1' => $universidade->idUniversidade1,
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

        $response = $this->get('/pagamentos'.'/'.$pagoResponsabilidade->slug.'/editar')->assertRedirect('/login');
    }

    /********************************************************************************************************** */

    /** @test */
    public function redirecionar_de_lista_relatorio_problema_para_login()
    {
        $response = $this->get('/reportar-problema')->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_show_relatorio_problema_para_login()
    {
        $relatorioProblema = factory(RelatorioProblema::class)->make();

        $response = $this->get('/reportar-problema'.'/'.$relatorioProblema->slug)->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_create_relatorio_problema_para_login()
    {

        $response = $this->get('/reportar-problema/criar')->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_edit_relatorio_problema_para_login()
    {
        $relatorioProblema = factory(RelatorioProblema::class)->make();

        $response = $this->get('/reportar-problema'.'/'.$relatorioProblema->slug.'/editar')->assertRedirect('/login');
    }
}
