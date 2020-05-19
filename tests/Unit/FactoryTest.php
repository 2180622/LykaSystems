<?php

namespace Tests\Unit;


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

class FactoryTest extends TestCase
{
    use DatabaseMigrations;
    use RefreshDatabase;


    /** @test */
    public function Factory_Administrador_Test()
    {
        $administrador = factory(Administrador::class)->make();

        $this->assertNotEmpty($administrador);
    }


    /** @test */
    public function Factory_Agente_Test()
    {
        $agente = factory(Agente::class)->make();

        $this->assertNotEmpty($agente);
    }


    /** @test */
    public function Factory_Biblioteca_Test()
    {
        $biblioteca = factory(Biblioteca::class)->make();

        $this->assertNotEmpty($biblioteca);
    }


    /** @test */
    public function Factory_Cliente_Test()
    {
        $cliente = factory(Cliente::class)->make();

        $this->assertNotEmpty($cliente);
    }


    /** @test */
    public function Factory_Conta_Test()
    {
        $conta = factory(Conta::class)->make();

        $this->assertNotEmpty($conta);
    }


    /** @test */
    public function Factory_Fornecedor_Test()
    {
        $fornecedor = factory(Fornecedor::class)->make();

        $this->assertNotEmpty($fornecedor);
    }


    /** @test */
    public function Factory_Produto_Stock_Test()
    {
        $produtoStock = factory(ProdutoStock::class)->make();

        $this->assertNotEmpty($produtoStock);
    }


    /** @test */
    public function Factory_Fase_Stock_Test()
    {
        $produtoStock = factory(ProdutoStock::class)->make();

        $faseStock = factory(FaseStock::class)->make([
            'idProdutoStock' => $produtoStock->idProdutoStock,
        ]);

        $this->assertNotEmpty($faseStock);
    }


    /** @test */
    public function Factory_Doc_Stock_Test()
    {
        $produtoStock = factory(ProdutoStock::class)->make();
        $faseStock = factory(FaseStock::class)->make([
            'idProdutoStock' => $produtoStock->idProdutoStock,
        ]);

        $docStock = factory(DocStock::class)->make([
            'idFaseStock' => $faseStock->idFaseStock,
        ]);

        $this->assertNotEmpty($docStock);
    }


    /** @test */
    public function Factory_Universidade_Test()
    {
        $universidade = factory(Universidade::class)->make();

        $this->assertNotEmpty($universidade);
    }


    /** @test */
    public function Factory_User_Test()
    {
        $administrador = factory(Administrador::class)->make();

        $user = factory(User::class)->make([
            'email' => $administrador->email,
            'tipo' => 'admin',
            'idAdmin' => $administrador->idAdmin,
        ]);

        $this->assertNotEmpty($user);
    }


    /** @test */
    public function Factory_Contacto_Test()
    {
        $contacto = factory(Contacto::class)->make();

        $this->assertNotEmpty($contacto);
    }


    /** @test */
    public function Factory_Agenda_Test()
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

        $this->assertNotEmpty($agenda);
    }


    /** @test *//*
    public function Factory_Notificacao_Test()
    {
        $notificacao = factory(Notificacao::class)->make();

        $this->assertNotEmpty($notificacao);
    }/**/


    /** @test */
    public function Factory_Produto_Test()
    {
        $cliente = factory(Cliente::class)->make();
        $agente = factory(Agente::class)->make();
        $universidade = factory(Universidade::class)->make();

        $produto = factory(Produto::class)->make([
            'idAgente' => $agente->idAgente,
            'idCliente' => $cliente->idCliente,
            'idUniversidade1' => $universidade->idUniversidade1,
        ]);

        $this->assertNotEmpty($produto);
    }


    /** @test */
    public function Factory_Responsabilidade_Test()
    {
        $cliente = factory(Cliente::class)->make();
        $agente = factory(Agente::class)->make();
        $universidade = factory(Universidade::class)->make();
        
        $responsabilidade = factory(Responsabilidade::class)->make([
            'idAgente' => $agente->idAgente,
            'idCliente' => $cliente->idCliente,
            'idUniversidade1' => $universidade->idUniversidade1,
        ]);

        $this->assertNotEmpty($responsabilidade);
    }


    /** @test */
    public function Factory_Fase_Test()
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

        $this->assertNotEmpty($fase);
    }


    /** @test */
    public function Factory_Doc_Necessario_Test()
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

        $docNecessario = factory(DocNecessario::class)->make([
            'idFase' => $fase->idFase,
        ]);

        $this->assertNotEmpty($docNecessario);
    }


    /** @test */
    public function Factory_Doc_Academico_Test()
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

        $this->assertNotEmpty($docAcademico);
    }


    /** @test */
    public function Factory_Doc_Pessoal_Test()
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

        $this->assertNotEmpty($docPessoal);
    }


    /** @test */
    public function Factory_Doc_Transacao_Test()
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

        $this->assertNotEmpty($docTransacao);
    }


    /** @test */
    public function Factory_Pago_Responsabilidade_Test()
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

        $this->assertNotEmpty($pagoResponsabilidade);
    }


    /** @test */
    public function Factory_Relacao_Fornecedor_Responsabilidade_Test()
    {
        $cliente = factory(Cliente::class)->make();
        $agente = factory(Agente::class)->make();
        $universidade = factory(Universidade::class)->make();
        $responsabilidade = factory(Responsabilidade::class)->make([
            'idAgente' => $agente->idAgente,
            'idCliente' => $cliente->idCliente,
            'idUniversidade1' => $universidade->idUniversidade1,
        ]);
        $fornecedor = factory(Fornecedor::class)->make();

        $relFornResp = factory(RelFornResp::class)->make([
            'idResponsabilidade' => $responsabilidade->idResponsabilidade,
            'idFornecedor' => $fornecedor->idFornecedor,
        ]);

        $this->assertNotEmpty($relFornResp);
    }


    /** @test */
    public function Factory_Relatorio_Problema_Test()
    {
        $relatorioProblema = factory(RelatorioProblema::class)->make();

        $this->assertNotEmpty($relatorioProblema);
    }


    /** @test *//*
    public function Factory_Create_Jobs_Test()
    {
        $createJobs = factory(CreateJobs::class)->make();

        $this->assertNotEmpty($createJobs);
    }/**/
}
