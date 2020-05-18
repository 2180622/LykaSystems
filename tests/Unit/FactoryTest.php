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
    private $user = null;
    private $fase = null;
    private $conta = null;
    private $agente = null;
    private $agenda = null;
    private $produto = null;
    private $cliente = null;
    private $contacto = null;
    private $docStock = null;
    private $faseStock = null;
    private $fornecedor = null;
    private $biblioteca = null;
    private $docPessoal = null;
    private $relFornResp = null;
    private $docAcademico = null;
    private $produtoStock = null;
    private $docTransacao = null;
    private $universidade = null;
    private $administrador = null;
    private $docNecessario = null;
    private $responsabilidade = null;
    private $relatorioProblema = null;
    private $pagoResponsabilidade = null;


    /** @test */
    public function Factory_Administrador_Test()
    {
        $this->administrador = factory(Administrador::class)->make();

        $this->assertNotEmpty($this->administrador);
    }


    /** @test */
    public function Factory_Agente_Test()
    {
        $this->agente = factory(Agente::class)->make();

        $this->assertNotEmpty($this->agente);
    }


    /** @test */
    public function Factory_Biblioteca_Test()
    {
        $this->biblioteca = factory(Biblioteca::class)->make();

        $this->assertNotEmpty($this->biblioteca);
    }


    /** @test */
    public function Factory_Cliente_Test()
    {
        $this->cliente = factory(Cliente::class)->make();

        $this->assertNotEmpty($this->cliente);
    }


    /** @test */
    public function Factory_Conta_Test()
    {
        $this->Conta = factory(Conta::class)->make();

        $this->assertNotEmpty($this->Conta);
    }


    /** @test */
    public function Factory_Fornecedor_Test()
    {
        $this->fornecedor = factory(Fornecedor::class)->make();

        $this->assertNotEmpty($this->fornecedor);
    }


    /** @test */
    public function Factory_Produto_Stock_Test()
    {
        $this->produtoStock = factory(ProdutoStock::class)->make();

        $this->assertNotEmpty($this->produtoStock);
    }


    /** @test */
    public function Factory_Fase_Stock_Test()
    {
        $this->faseStock = factory(FaseStock::class)->make([
            'idProdutoStock' => $this->produtoStock->idProdutoStock,
        ]);

        $this->assertNotEmpty($this->faseStock);
    }


    /** @test */
    public function Factory_Doc_Stock_Test()
    {
        $this->docStock = factory(DocStock::class)->make([
            'idFaseStock' => $this->faseStock->idFaseStock,
        ]);

        $this->assertNotEmpty($this->docStock);
    }


    /** @test */
    public function Factory_Universidade_Test()
    {
        $this->universidade = factory(Universidade::class)->make();

        $this->assertNotEmpty($this->universidade);
    }


    /** @test */
    public function Factory_User_Test()
    {
        $this->user = factory(User::class)->make([
            'email' => $this->administrador->email,
            'tipo' => 'admin',
            'idAdmin' => $this->administrador->idAdmin,
        ]);

        $this->assertNotEmpty($this->user);
    }


    /** @test */
    public function Factory_Contacto_Test()
    {
        $this->contacto = factory(Contacto::class)->make();

        $this->assertNotEmpty($this->contacto);
    }


    /** @test */
    public function Factory_Agenda_Test()
    {
        $this->agenda = factory(Agenda::class)->make([
            'idUser' => $this->user->idUser,
        ]);

        $this->assertNotEmpty($this->agenda);
    }


    /** @test *//*
    public function Factory_Notificacao_Test()
    {
        $this->notificacao = factory(Notificacao::class)->make();

        $this->assertNotEmpty($this->notificacao);
    }/**/


    /** @test */
    public function Factory_Produto_Test()
    {
        $this->produto = factory(Produto::class)->make([
            'idAgente' => $this->Agente->idAgente,
            'idCliente' => $this->Cliente->idCliente,
            'idUniversidade1' => $this->Universidade->idUniversidade1,
        ]);

        $this->assertNotEmpty($this->produto);
    }


    /** @test */
    public function Factory_Responsabilidade_Test()
    {
        $this->responsabilidade = factory(Responsabilidade::class)->make([
            'idAgente' => $this->Agente->idAgente,
            'idCliente' => $this->Cliente->idCliente,
            'idUniversidade1' => $this->Universidade->idUniversidade1,
        ]);

        $this->assertNotEmpty($this->responsabilidade);
    }


    /** @test */
    public function Factory_Fase_Test()
    {
        $this->fase = factory(Fase::class)->make([
            'idProduto' => $this->Produto->idProduto,
            'idResponsabilidade' => $this->Responsabilidade->idResponsabilidade,
        ]);

        $this->assertNotEmpty($this->fase);
    }


    /** @test */
    public function Factory_Doc_Necessario_Test()
    {
        $this->docNecessario = factory(DocNecessario::class)->make([
            'idFase' => $this->Fase->idFase,
        ]);

        $this->assertNotEmpty($this->docNecessario);
    }


    /** @test */
    public function Factory_Doc_Academico_Test()
    {
        $this->docNecessario = factory(DocAcademico::class)->make([
            'idFase' => $this->Fase->idFase,
            'idCliente' => $this->Cliente->idCliente,
        ]);

        $this->assertNotEmpty($this->docAcademico);
    }


    /** @test */
    public function Factory_Doc_Pessoal_Test()
    {
        $this->docPessoal = factory(DocPessoal::class)->make([
            'idFase' => $this->Fase->idFase,
            'idCliente' => $this->Cliente->idCliente,
        ]);

        $this->assertNotEmpty($this->docPessoal);
    }


    /** @test */
    public function Factory_Doc_Transacao_Test()
    {
        $this->docTransacao = factory(DocTransacao::class)->make([
            'idFase' => $this->Fase->idFase,
            'idConta' => $this->Conta->idConta,
        ]);

        $this->assertNotEmpty($this->docTransacao);
    }


    /** @test */
    public function Factory_Pago_Responsabilidade_Test()
    {
        $this->pagoResponsabilidade = factory(PagoResponsabilidade::class)->make([
            'idFase' => $this->Fase->idFase,
            'idConta' => $this->Conta->idConta,
        ]);

        $this->assertNotEmpty($this->pagoResponsabilidade);
    }


    /** @test */
    public function Factory_Relacao_Fornecedor_Responsabilidade_Test()
    {
        $this->relFornResp = factory(RelFornResp::class)->make([
            'idResponsabilidade' => $this->Responsabilidade->idResponsabilidade,
            'idFornecedor' => $this->Fornecedor->idFornecedor,
        ]);

        $this->assertNotEmpty($this->relFornResp);
    }


    /** @test */
    public function Factory_Relatorio_Problema_Test()
    {
        $this->relatorioProblema = factory(RelatorioProblema::class)->make();

        $this->assertNotEmpty($this->relatorioProblema);
    }


    /** @test *//*
    public function Factory_Create_Jobs_Test()
    {
        $createJobs = factory(CreateJobs::class)->make();

        $this->assertNotEmpty($createJobs);
    }/**/
}
