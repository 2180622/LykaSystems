<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use DateTime;
use DateInterval;

use App\Notificacao;
use App\Administrador;
use App\Agenda;
use App\Agente;
use App\Biblioteca;
use App\Cliente;
use App\Conta;
use App\Contacto;
use App\DocAcademico;
use App\DocPessoal;
use App\DocStock;
use App\DocTransacao;
use App\Fase;
use App\FaseStock;
use App\Fornecedor;
use App\PagoResponsabilidade;
use App\Produto;
use App\ProdutoStock;
use App\RelFornResp;
use App\Responsabilidade;
use App\Universidade;
use App\User;


class DataController extends Controller
{
    public function createData(){

        /****************          Administradores          ****************/

        $admin = new Administrador;
        $admin->nome = 'Edgar';
        $admin->apelido = 'Cordeiro';
        $admin->genero = 'M';
        $admin->email = 'nill546@hotmail.com';
        $admin->dataNasc = date('Y-m-d',strtotime('17-04-1997'));
        $admin->fotografia = null;
        $admin->telefone1 = 919245453;
        $admin->telefone2 = null;
        $admin->save();

        $admin = new Administrador;
        $admin->nome = 'Neuza';
        $admin->apelido = 'Cordeiro';
        $admin->genero = 'F';
        $admin->email = 'nex543@hotmail.com';
        $admin->dataNasc = date('Y-m-d',strtotime('30-10-1999'));
        $admin->fotografia = null;
        $admin->telefone1 = 919200000;
        $admin->telefone2 = null;
        $admin->save();

        /********************          Agentes          ********************/

        $agente = new Agente;
        $agente->nome = 'José';
        $agente->apelido = 'Fernandes';
        $agente->genero = 'M';
        $agente->email = 'jose.fer@gmail.com';
        $agente->dataNasc = date('Y-m-d',strtotime('15-07-1990'));
        $agente->fotografia = null;
        $agente->morada = 'Rua dos Agentes, 1234 Amores';
        $agente->pais = 'Portugal';
        $agente->NIF = 123456789;
        $agente->num_doc = 123456789;
        $agente->info_doc = '{"campo1":"NIF","valor1":123456789,
            "campo2":"Data Validade","valor2":"09/12/2025"}';
        $agente->telefone1 = 932354453;
        $agente->telefone2 = null;
        $agente->tipo = 'Agente';
        $agente->save();

        $agente = new Agente;
        $agente->nome = 'Michaela';
        $agente->apelido = 'Silva';
        $agente->genero = 'F';
        $agente->email = 'michaela@outlook.com';
        $agente->dataNasc = date('Y-m-d',strtotime('16-03-1993'));
        $agente->fotografia = null;
        $agente->morada = 'Bidoeira de Cima';
        $agente->pais = 'Portugal';
        $agente->NIF = '213455767';
        $agente->num_doc = 321654987;
        $agente->info_doc = '{"campo1":"NIF","valor1":321654987,
            "campo2":"Data Validade","valor2":"09/12/2025"}';
        $agente->telefone1 = 932355555;
        $agente->telefone2 = null;
        $agente->tipo = 'Agente';
        $agente->save();

        $agente = new Agente;
        $agente->nome = 'João';
        $agente->apelido = 'Gama';
        $agente->genero = 'M';
        $agente->email = 'gama.jonh@hotmail.com';
        $agente->dataNasc = date('Y-m-d',strtotime('15-07-1995'));
        $agente->fotografia = null;
        $agente->morada = 'Rua dos Agentes, 1274 Amores';
        $agente->pais = 'Portugal';
        $agente->NIF = '987654321';
        $agente->num_doc = 789456123;
        $agente->info_doc = '{"campo1":"NIF","valor1":789456123,
            "campo2":"Data Validade","valor2":"09/12/2025"}';
        $agente->telefone1 = 963423423;
        $agente->telefone2 = null;
        $agente->tipo = 'Subagente';
        $agente->idAgenteAssociado = 1;
        $agente->save();

        /******************          Bibliotecas          ******************/

/*         $biblioteca = new Biblioteca;
        $biblioteca->nome = 'YII2-Intro';
        $biblioteca->imagem = 'docs/Biblioteca-0001_YII2-Intro';
        $biblioteca->save(); */

        /*******************          Clientes          ********************/

        $cliente = new Cliente;
        $cliente->nome = 'Tiago';
        $cliente->apelido = 'Oliveira';
        $cliente->genero = 'M';
        $cliente->email = 'tiaveira@gmail.com';
        $cliente->telefone1 = 913432423;
        $cliente->telefone2 = null;
        $cliente->dataNasc = date('Y-m-d',strtotime('27-01-1995'));
        $cliente->paisNaturalidade = 'França';
        $cliente->morada = 'Rua francesa';
        $cliente->cidade = 'Paris';
        $cliente->moradaResidencia = 'Paris';
        $cliente->nomePai = 'João Oliveira';
        $cliente->telefonePai = 914535342;
        $cliente->emailPai = 'oliveira.joao@gmail.com';
        $cliente->nomeMae = null;
        $cliente->telefoneMae = null;
        $cliente->emailMae = null;
        $cliente->fotografia = null;
        $cliente->NIF = 3490587685;
        $cliente->IBAN = 'FR76 123 4321 1345678901 72';
        $cliente->nivEstudoAtual = 3;
        $cliente->nomeInstituicaoOrigem = 'Instituto Frances';
        $cliente->cidadeInstituicaoOrigem = 'Paris';
        $cliente->num_docOficial = '9845776436ZZ8';
        $cliente->info_docOficial = date('Y-m-d',strtotime('27-01-1995'));
        $cliente->info_Passaport = '{"numPassaport":"9453574976496","dataValidPP":"'.date('Y-m-d',strtotime('27-01-1995')).'",
            "passaportPaisEmi":"França","localEmissaoPP":"Paris"}';
        $cliente->info_docAcademico = '{"campo1":"Tipo","valor1":"Certificado",
            "campo2":"Nota Final","valor2":16}';
        $cliente->obsPessoais = null;
        $cliente->obsFinanceiras = null;
        $cliente->obsAcademicas = null;
        $cliente->save();

        $cliente = new Cliente;
        $cliente->nome = 'Katherine';
        $cliente->apelido = 'Romaria';
        $cliente->genero = 'F';
        $cliente->email = 'kathe@mail.ru';
        $cliente->telefone1 = 945345784;
        $cliente->telefone2 = null;
        $cliente->dataNasc = date('Y-m-d',strtotime('02-05-1998'));
        $cliente->paisNaturalidade = 'Rússia';
        $cliente->morada = 'Rua Russia';
        $cliente->cidade = 'Cidade Russa';
        $cliente->moradaResidencia = 'Russia';
        $cliente->nomePai = 'Arthem Romaria';
        $cliente->telefonePai = 932452343;
        $cliente->emailPai = 'arthem@mail.ru';
        $cliente->nomeMae = 'Vaness Romaria';
        $cliente->telefoneMae = 913343443;
        $cliente->emailMae = 'vaness@mail.ru';
        $cliente->fotografia = null;
        $cliente->NIF = 759456385645;
        $cliente->IBAN = 'RU76 123 4321 1345678901 72';
        $cliente->nivEstudoAtual = 3;
        $cliente->nomeInstituicaoOrigem = 'Instituto Russo';
        $cliente->cidadeInstituicaoOrigem = 'Cidade Russa';
        $cliente->cidadeInstituicaoOrigem = 'Paris';
        $cliente->num_docOficial = '61436534643DS4';
        $cliente->info_docOficial = date('Y-m-d',strtotime('27-01-1993'));
        $cliente->info_Passaport = '{"numPassaport":"9453574976496","dataValidPP":"'.date('Y-m-d',strtotime('27-01-1995')).'",
            "passaportPaisEmi":"França","localEmissaoPP":"Paris"}';
        $cliente->info_docAcademico = null;
        $cliente->obsPessoais = null;
        $cliente->obsFinanceiras = null;
        $cliente->obsAcademicas = null;
        $cliente->save();

        /********************          Contas          *********************/

        $conta = new Conta;
        $conta->descricao = 'CGD Leiria';
        $conta->instituicao = 'Caixa Geral de Depósitos';
        $conta->titular = 'Estudar Portugal';
        $conta->morada = 'Praça Goa Damäo e Diu, 2400 - 147 Leiria';
        $conta->numConta = rand(999999, 9999999999);
        $conta->IBAN = 'PT50 123 4321 1345678901 72';
        $conta->SWIFT = 'DS26E HD23D ASD55 62DS6 FWW23';
        $conta->contacto = '244 032 985';
        $conta->obsConta = null;
        $conta->save();

        $conta = new Conta;
        $conta->descricao = 'EuroBic Leiria';
        $conta->instituicao = 'EuroBic';
        $conta->titular = 'Estudar Portugal';
        $conta->morada = 'R. 25 de Abril 168, 2415-602 Leiria';
        $conta->numConta = rand(999999, 9999999999);
        $conta->IBAN = 'PT50 123 5543 1345678901 72';
        $conta->SWIFT = 'TR23R 89DSA GH1H2 KM22N T12G1';
        $conta->contacto = '244 023 034';
        $conta->obsConta = null;
        $conta->save();

        /*******************          Contactos          *******************/

        $contacto = new Contacto;
        $contacto->nome = 'Pedro Costa';
        $contacto->fotografia = null;
        $contacto->telefone1 = null;
        $contacto->telefone2 = null;
        $contacto->email = 'jonh@gmail.com';
        $contacto->fax = null;
        $contacto->observacao = null;
        $contacto->favorito = true;
        $contacto->save();

        $contacto = new Contacto;
        $contacto->nome = 'Maria Pedro';
        $contacto->fotografia = null;
        $contacto->telefone1 = 915642453;
        $contacto->telefone2 = null;
        $contacto->email = 'manie@hotmail.com';
        $contacto->fax = null;
        $contacto->observacao = null;
        $contacto->favorito = false;
        $contacto->save();

        /*****************          Fornecedores          ******************/

        $fornecedor = new Fornecedor;
        $fornecedor->nome = 'Táxi - Leiria';
        $fornecedor->morada = 'Rua Leiria, Leiria';
        $fornecedor->descricao = 'Taxista André Vieira';
        $fornecedor->contacto = '244 025 968';
        $fornecedor->save();

        $fornecedor = new Fornecedor;
        $fornecedor->nome = 'Embaixada de Portugal MX';
        $fornecedor->morada = 'Rua Monterrey, México';
        $fornecedor->descricao = 'Embaixada de Portugal - México';
        $fornecedor->contacto = 'embaixadaportugalmx@mail.com';
        $fornecedor->observacoes = 'Demoram muito tempo a responder... Não perder a esperança :)';
        $fornecedor->save();

        /****************          Produtos Stock          *****************/

        $produtostock = new ProdutoStock;
        $produtostock->descricao = 'Lic 4F fr';
        $produtostock->tipoProduto = 'Licenciatura';
        $produtostock->anoAcademico = '2020/2021';
        $produtostock->save();

        /******************          Fases Stock          ******************/

        $fasestock = new FaseStock;
        $fasestock->descricao = 'Inscricão';
        $fasestock->idProdutoStock = '1';
        $fasestock->save();

        $fasestock = new FaseStock;
        $fasestock->descricao = 'Matricula';
        $fasestock->idProdutoStock = '1';
        $fasestock->save();

        $fasestock = new FaseStock;
        $fasestock->descricao = 'Propinas';
        $fasestock->idProdutoStock = '1';
        $fasestock->save();

        $fasestock = new FaseStock;
        $fasestock->descricao = 'Final';
        $fasestock->idProdutoStock = '1';
        $fasestock->save();

        /******************          Docs Stock          *******************/

        $docstock = new DocStock;
        $docstock->tipo = 'Pessoal';
        $docstock->tipoPessoal = 'Doc. Oficial';
        $docstock->tipoAcademico = null;
        $docstock->idFaseStock = 1;
        $docstock->save();

        $docstock = new DocStock;
        $docstock->tipo = 'Academico';
        $docstock->tipoPessoal = null;
        $docstock->tipoAcademico = 'Certificado';
        $docstock->idFaseStock = 1;
        $docstock->save();

        $docstock = new DocStock;
        $docstock->tipo = 'Pessoal';
        $docstock->tipoPessoal = 'Passaport';
        $docstock->tipoAcademico = null;
        $docstock->idFaseStock = 2;
        $docstock->save();

        $docstock = new DocStock;
        $docstock->tipo = 'Pessoal';
        $docstock->tipoPessoal = 'Cartão Cidadão';
        $docstock->tipoAcademico = null;
        $docstock->idFaseStock = 2;
        $docstock->save();

        $docstock = new DocStock;
        $docstock->tipo = 'Pessoal';
        $docstock->tipoPessoal = 'Carta Condução';
        $docstock->tipoAcademico = null;
        $docstock->idFaseStock = 2;
        $docstock->save();

        $docstock = new DocStock;
        $docstock->tipo = 'Academico';
        $docstock->tipoPessoal = null;
        $docstock->tipoAcademico = 'Exame Universitário';
        $docstock->idFaseStock = 4;
        $docstock->save();

        /*****************          Universidades          *****************/

        $universidade = new Universidade;
        $universidade->nome = 'Ipleiria - ESTG';
        $universidade->morada = 'Ao lado do shopping';
        $universidade->telefone = 1234235346;
        $universidade->email = 'estg.ipleiria.pt';
        $universidade->NIF = 7846575487;
        $universidade->IBAN = 'PT50 6573 4321 1345678901 72';
        $universidade->obsContactos = null;
        $universidade->obsCursos = null;
        $universidade->obsCandidaturas = null;
        $universidade->save();

        $universidade = new Universidade;
        $universidade->nome = 'Universidade de Aveiro';
        $universidade->morada = 'Aveiro, Portugal';
        $universidade->telefone = 912345678;
        $universidade->email = 'aveiro@uni.pt';
        $universidade->NIF = 5478236541;
        $universidade->IBAN = 'PT50 8651 2364 0901678901 12';
        $universidade->obsContactos = null;
        $universidade->obsCursos = null;
        $universidade->obsCandidaturas = null;
        $universidade->save();

        /*********************          Users          *********************/

        $user = new User;
        $user->email = 'nill546@hotmail.com';
        $user->tipo = 'admin';
        $user->password = Hash::make('teste1234');
        $user->password_reset_token = null;
        $user->verification_token = null;
        $user->auth_key = 'sdfglnsdbhkfnjslkdfgn';
        $user->status = '10';
        $user->idAdmin = 2;
        $user->idAgente = null;
        $user->idCliente = null;
        $user->save();

        $user = new User;
        $user->email = 'jose.fer@gmail.com';
        $user->tipo = 'agente';
        $user->password = Hash::make('teste1234');
        $user->password_reset_token = null;
        $user->verification_token = null;
        $user->auth_key = 'sdfglnsdbhkfnjslkdfgn';
        $user->status = '10';
        $user->idAdmin = null;
        $user->idAgente = 1;
        $user->idCliente = null;
        $user->save();

        $user = new User;
        $user->email = 'tiaveira@gmail.com';
        $user->tipo = 'cliente';
        $user->password = Hash::make('teste1234');
        $user->password_reset_token = null;
        $user->verification_token = null;
        $user->auth_key = 'sdfglnsdbhkfnjslkdfgn';
        $user->status = '10';
        $user->idAdmin = null;
        $user->idAgente = null;
        $user->idCliente = 1;
        $user->save();

        /********************          Agendas          ********************/
/*
        $agenda = new Agenda;
        $agenda->descricao = 'Teste';
        $agenda->visibilidade = false;
        $agenda->dataInicio = date('Y-m-d H:i',strtotime('01-03-2020 14:30'));
        $agenda->dataFim = date('Y-m-d H:i',strtotime('20-06-2020 18:25'));
        $agenda->idUser = 2;
        $agenda->save();
 */
        /*******************          Produtos          ********************/

        $produto = new Produto;
        $produto->descricao = 'Licenciatura';
        $produto->tipo = 'Licenciatura';
        $produto->anoAcademico = 5;
        $produto->valorTotal = 1500;
        $produto->valorTotalAgente = 300;
        $produto->valorTotalSubAgente = null;
        $produto->idAgente = 1;
        $produto->idSubAgente = null;
        $produto->idCliente = 1;
        $produto->idUniversidade1 = 1;
        $produto->idUniversidade2 = null;
        $produto->save();

        $produto = new Produto;
        $produto->descricao = 'Mestrado';
        $produto->tipo = 'Mestrado';
        $produto->anoAcademico = 5;
        $produto->valorTotal = 1900;
        $produto->valorTotalAgente = 300;
        $produto->valorTotalSubAgente = null;
        $produto->idAgente = 1;
        $produto->idSubAgente = null;
        $produto->idCliente = 2;
        $produto->idUniversidade1 = 2;
        $produto->idUniversidade2 = 1;
        $produto->save();

        /***************          Responsabilidades          ***************/

        $responsabilidade = new Responsabilidade;
        $responsabilidade->valorCliente = 10;
        $responsabilidade->valorAgente = 0;
        $responsabilidade->valorSubAgente = null;
        $responsabilidade->valorUniversidade1 = 40;
        $responsabilidade->valorUniversidade2 = null;
        $responsabilidade->verificacaoPagoCliente = false;
        $responsabilidade->verificacaoPagoAgente = false;
        $responsabilidade->verificacaoPagoSubAgente = false;
        $responsabilidade->verificacaoPagoUni1 = false;
        $responsabilidade->verificacaoPagoUni2 = false;
        $responsabilidade->save();

        $responsabilidade = new Responsabilidade;
        $responsabilidade->valorCliente = 50;
        $responsabilidade->valorAgente = 50;
        $responsabilidade->valorSubAgente = null;
        $responsabilidade->valorUniversidade1 = 120;
        $responsabilidade->valorUniversidade2 = null;
        $responsabilidade->verificacaoPagoCliente = false;
        $responsabilidade->verificacaoPagoAgente = false;
        $responsabilidade->verificacaoPagoSubAgente = false;
        $responsabilidade->verificacaoPagoUni1 = false;
        $responsabilidade->verificacaoPagoUni2 = false;
        $responsabilidade->save();

        $responsabilidade = new Responsabilidade;
        $responsabilidade->valorCliente = 10;
        $responsabilidade->valorAgente = 0;
        $responsabilidade->valorSubAgente = null;
        $responsabilidade->valorUniversidade1 = 40;
        $responsabilidade->valorUniversidade2 = null;
        $responsabilidade->verificacaoPagoCliente = false;
        $responsabilidade->verificacaoPagoAgente = false;
        $responsabilidade->verificacaoPagoSubAgente = false;
        $responsabilidade->verificacaoPagoUni1 = false;
        $responsabilidade->verificacaoPagoUni2 = false;
        $responsabilidade->save();

        $responsabilidade = new Responsabilidade;
        $responsabilidade->valorCliente = 10;
        $responsabilidade->valorAgente = 0;
        $responsabilidade->valorSubAgente = null;
        $responsabilidade->valorUniversidade1 = 40;
        $responsabilidade->valorUniversidade2 = null;
        $responsabilidade->verificacaoPagoCliente = false;
        $responsabilidade->verificacaoPagoAgente = false;
        $responsabilidade->verificacaoPagoSubAgente = false;
        $responsabilidade->verificacaoPagoUni1 = false;
        $responsabilidade->verificacaoPagoUni2 = false;
        $responsabilidade->save();

        $responsabilidade = new Responsabilidade;
        $responsabilidade->valorCliente = 15;
        $responsabilidade->valorAgente = 0;
        $responsabilidade->valorSubAgente = null;
        $responsabilidade->valorUniversidade1 = 40;
        $responsabilidade->valorUniversidade2 = null;
        $responsabilidade->verificacaoPagoCliente = false;
        $responsabilidade->verificacaoPagoAgente = false;
        $responsabilidade->verificacaoPagoSubAgente = false;
        $responsabilidade->verificacaoPagoUni1 = false;
        $responsabilidade->verificacaoPagoUni2 = false;
        $responsabilidade->save();

        /************          Pago Responsabilidades          *************/

        /*$pago = new PagoResponsabilidade;
        $pago->data = (new DateTime)->format('Y-m-d');
        $pago->nomeAutor = 'Cliente';
        $pago->imagem = '1_1_1_1.png';
        $pago->idFase = 1;
        $pago->idConta = 1;
        $pago->save();

        /*****************          Rel Forn Resp          *****************/

        $relacao = new RelFornResp;
        $relacao->valor = 80;
        $relacao->idResponsabilidade = 2;
        $relacao->idFornecedor = 1;
        $relacao->save();

        $relacao = new RelFornResp;
        $relacao->valor = 150;
        $relacao->idResponsabilidade = 5;
        $relacao->idFornecedor = 1;
        $relacao->save();

        /*********************          Fases          *********************/

        $fase = new Fase;
        $fase->descricao = 'Inscrição';
        $fase->dataVencimento = date('Y-m-d H:i',strtotime('16-03-2020 15:00'));
        $fase->valorFase = 50;
        $fase->verificacaoPago = false;
        $fase->icon = 'cube';
        $fase->idProduto = 1;
        $fase->idResponsabilidade = 1;
        $fase->save();

        $fase = new Fase;
        $fase->descricao = 'Matricula';
        $fase->dataVencimento = date('Y-m-d H:i',strtotime('06-09-2020 18:30'));
        $fase->valorFase = 300;
        $fase->verificacaoPago = false;
        $fase->icon = 'layers';
        $fase->idProduto = 1;
        $fase->idResponsabilidade = 2;
        $fase->save();

        $fase = new Fase;
        $fase->descricao = 'Propinas';
        $fase->dataVencimento = date('Y-m-d H:i',strtotime('25-09-2020 23:59'));
        $fase->valorFase = 1000;
        $fase->verificacaoPago = false;
        $fase->icon = 'school';
        $fase->idProduto = 1;
        $fase->idResponsabilidade = 3;
        $fase->save();

        $fase = new Fase;
        $fase->descricao = 'Final';
        $fase->dataVencimento = date('Y-m-d H:i',strtotime('01-07-2021 18:30'));
        $fase->valorFase = 150;
        $fase->verificacaoPago = false;
        $fase->icon = 'pie-chart';
        $fase->idProduto = 1;
        $fase->idResponsabilidade = 4;
        $fase->save();




        $fase = new Fase;
        $fase->descricao = 'Inscrição';
        $fase->dataVencimento = date('Y-m-d H:i',strtotime('16-03-2020 15:00'));
        $fase->valorFase = 50;
        $fase->verificacaoPago = false;
        $fase->icon = 'cube';
        $fase->idProduto = 2;
        $fase->idResponsabilidade = 5;
        $fase->save();

        $fase = new Fase;
        $fase->descricao = 'Matricula';
        $fase->dataVencimento = date('Y-m-d H:i',strtotime('06-09-2020 18:30'));
        $fase->valorFase = 300;
        $fase->verificacaoPago = false;
        $fase->icon = 'layers';
        $fase->idProduto = 2;
        $fase->idResponsabilidade = 2;
        $fase->save();

        $fase = new Fase;
        $fase->descricao = 'Propinas';
        $fase->dataVencimento = date('Y-m-d H:i',strtotime('25-09-2020 23:59'));
        $fase->valorFase = 1000;
        $fase->verificacaoPago = false;
        $fase->icon = 'school';
        $fase->idProduto = 2;
        $fase->idResponsabilidade = 3;
        $fase->save();

        $fase = new Fase;
        $fase->descricao = 'Final';
        $fase->dataVencimento = date('Y-m-d H:i',strtotime('01-07-2021 18:30'));
        $fase->valorFase = 150;
        $fase->verificacaoPago = false;
        $fase->icon = 'pie-chart';
        $fase->idProduto = 2;
        $fase->idResponsabilidade = 4;
        $fase->save();

        /****************          Docs Academicos          ****************/
/*
        $docacademico = new DocAcademico;
        $docacademico->nome = 'Tiago Oliveira';
        $docacademico->tipo = 'Certificado';
        $docacademico->imagem = 'DocAcademico-001-001-Certificado';
        $docacademico->pais = 'Paris';
        $docacademico->nota = 16;
        $docacademico->pontuacao = '0/20';
        $docacademico->verificacao = false;
        $docacademico->idFase = 1;
        $docacademico->save();

        /*****************          Docs Pessoais          *****************/

        /*$docpessoal = new DocPessoal;
        $docpessoal->nome = '';
        $docpessoal->apelido = '';
        $docpessoal->tipo = '';
        $docpessoal->imagem = '';
        $docpessoal->numDoc = '';
        $docpessoal->dataValidade = '';
        $docpessoal->pais = '';
        $docpessoal->morada = '';
        $docpessoal->verificacao = '';
        $docpessoal->idFase = '';
        $docpessoal->save();*/

        /****************          Docs Transacoes          ****************/

        /*$doctransacao = new DocTransacao;
        $doctransacao->descricao = '';
        $doctransacao->valorRecebido = '';
        $doctransacao->dataOperacao = '';
        $doctransacao->dataRecebido = '';
        $doctransacao->verificacao = '';
        $doctransacao->imagem = '';
        $doctransacao->idConta = '';
        $doctransacao->idFase = '';
        $doctransacao->save();*/

    }
}
