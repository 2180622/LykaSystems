<?php

namespace App\Http\Controllers;

use App\ExtraFunction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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


class ExtraFunctionsController extends Controller
{
    public function createData(){

        /****************          Administradores          ****************/

        $admin = new Administrador;
        $admin->nome = 'Edgar';
        $admin->apelido = 'Cordeiro';
        $admin->email = 'nill546@hotmail.com';
        $admin->dataNasc = date('Y-m-d',strtotime('17-12-1997'));
        $admin->fotografia = null;
        $admin->telefone1 = 919245453;
        $admin->telefone2 = null;
        $admin->save();

        $admin = new Administrador;
        $admin->nome = 'Neuza';
        $admin->apelido = 'Cordeiro';
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
        $agente->email = 'jose.fer@gmail.com';
        $agente->dataNasc = date('Y-m-d',strtotime('15-07-1990'));
        $agente->fotografia = null;
        $agente->morada = 'Rua dos Agentes, 1234 Amores';
        $agente->pais = 'Portugal';
        $agente->NIF = 123456789;
        $agente->telefoneW = 932354453;
        $agente->telefone2 = null;
        $agente->tipo = 'Agente';
        $agente->save();

        $agente = new Agente;
        $agente->nome = 'Michaela';
        $agente->apelido = 'Silva';
        $agente->email = 'michaela@outlook.com';
        $agente->dataNasc = date('Y-m-d',strtotime('16-03-1993'));
        $agente->fotografia = null;
        $agente->morada = 'Bidoeira de Cima';
        $agente->pais = 'Portugal';
        $agente->NIF = 213455767;
        $agente->telefoneW = 932355555;
        $agente->telefone2 = null;
        $agente->tipo = 'Agente';
        $agente->save();

        $agente = new Agente;
        $agente->nome = 'João';
        $agente->apelido = 'Gama';
        $agente->email = 'gama.jonh@hotmail.com';
        $agente->dataNasc = date('Y-m-d',strtotime('15-07-1995'));
        $agente->fotografia = null;
        $agente->morada = 'Rua dos Agentes, 1274 Amores';
        $agente->pais = 'Portugal';
        $agente->NIF = 987654321;
        $agente->telefoneW = 963423423;
        $agente->telefone2 = null;
        $agente->tipo = 'Subagente';
        $agente->save();

        /******************          Bibliotecas          ******************/

        $biblioteca = new Biblioteca;
        $biblioteca->nome = 'YII2-Intro';
        $biblioteca->imagem = 'docs/Biblioteca-0001_YII2-Intro';
        $biblioteca->save();

        /*******************          Clientes          ********************/

        $cliente = new Cliente;
        $cliente->nome = 'Tiago';
        $cliente->apelido = 'Oliveira';
        $cliente->email = 'tiaveira@gmail.com';
        $cliente->telefone1 = 913432423;
        $cliente->telefone2 = null;
        $cliente->dataNasc = date('Y-m-d',strtotime('27-01-1995'));
        $cliente->numCCid = '9845776436ZZ8';
        $cliente->numPassaport = '9453574976496';
        $cliente->dataValidPP = date('Y-m-d',strtotime('25-03-2022'));
        $cliente->localEmissaoPP = 'Paris';
        $cliente->paisNaturalidade = 'França';
        $cliente->morada = 'Rua francesa';
        $cliente->cidade = 'Paris';
        $cliente->moradaResidencia = 'Paris';
        $cliente->passaportPaisEmi = 'França';
        $cliente->nomePai = 'João Oliveira';
        $cliente->telefonePai = 914535342;
        $cliente->emailPai = 'oliveira.joao@gmail.com';
        $cliente->nomeMae = null;
        $cliente->telefoneMae = null;
        $cliente->emailMae = null;
        $cliente->fotografia = null;
        $cliente->NIF = 3490587685;
        $cliente->IBAN = 'ERH84 3280F 0U23R 237TF RGE89';
        $cliente->nivEstudoAtual = 4;
        $cliente->nomeInstituicaoOrigem = 'Instituto Frances';
        $cliente->cidadeInstituicaoOrigem = 'Paris';
        $cliente->obsPessoais = null;
        $cliente->obsFinanceiras = null;
        $cliente->obsAcademicas = null;
        $cliente->save();

        $cliente = new Cliente;
        $cliente->nome = 'Katherine';
        $cliente->apelido = 'Romaria';
        $cliente->email = 'kathe@mail.ru';
        $cliente->telefone1 = 945345784;
        $cliente->telefone2 = null;
        $cliente->dataNasc = date('Y-m-d',strtotime('02-05-1998'));
        $cliente->numCCid = '4397654378ZO4';
        $cliente->numPassaport = '435444543545';
        $cliente->dataValidPP = date('Y-m-d',strtotime('05-06-2025'));
        $cliente->localEmissaoPP = 'Russia';
        $cliente->paisNaturalidade = 'Russia';
        $cliente->morada = 'Rua Russia';
        $cliente->cidade = 'Cidade Russa';
        $cliente->moradaResidencia = 'Russia';
        $cliente->passaportPaisEmi = 'Russia';
        $cliente->nomePai = 'Arthem Romaria';
        $cliente->telefonePai = 932452343;
        $cliente->emailPai = 'arthem@mail.ru';
        $cliente->nomeMae = 'Vaness Romaria';
        $cliente->telefoneMae = 913343443;
        $cliente->emailMae = 'vaness@mail.ru';
        $cliente->fotografia = null;
        $cliente->NIF = 759456385645;
        $cliente->IBAN = 'FOK04 WDF8Y DSF98 346TJ WE9F9';
        $cliente->nivEstudoAtual = 5;
        $cliente->nomeInstituicaoOrigem = 'Instituto Russo';
        $cliente->cidadeInstituicaoOrigem = 'Cidade Russa';
        $cliente->obsPessoais = null;
        $cliente->obsFinanceiras = null;
        $cliente->obsAcademicas = null;
        $cliente->save();

        /********************          Contas          *********************/

        $conta = new Conta;
        $conta->descricao = 'Paypal';
        $conta->local = 'Internet';
        $conta->numConta = 4345789280523807;
        $conta->IBAN = '8843H ERUE4 G9Y34 G9HG3 EG8U9';
        $conta->instituicao = 'QUALQUER COISA';
        $conta->telefone = 244453765;
        $conta->obsConta = null;

        /*******************          Contactos          *******************/

        $contacto = new Contacto;
        $contacto->nome = 'Pedro Costa';
        $contacto->fotografia = null;
        $contacto->telefone1 = null;
        $contacto->telefone2 = null;
        $contacto->email = 'jonh@gmail.com';
        $contacto->fax = null;
        $contacto->observacao = null;
        $contacto->save();

        $contacto = new Contacto;
        $contacto->nome = 'Maria Pedro';
        $contacto->fotografia = null;
        $contacto->telefone1 = 915642453;
        $contacto->telefone2 = null;
        $contacto->email = 'manie@hotmail.com';
        $contacto->fax = null;
        $contacto->observacao = null;
        $contacto->save();

        /*****************          Fornecedores          ******************/

        $fornecedor = new Fornecedor;
        $fornecedor->nome = 'Taxi';
        $fornecedor->morada = 'Leiria';
        $fornecedor->descricao = 'Taxista???';
        $fornecedor->save();

        /****************          Produtos Stock          *****************/

        $produtostock = new ProdutoStock;
        $produtostock->descricao = 'Lic 4F fr';
        $produtostock->tipo = 'Licenciatura';
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
        $universidade->IBAN = 'RGE0U 4804G 34TJG RG445 ERG89';
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
        $user->idAdmin = 1;
        $user->idAgente = null;
        $user->idCliente = null;
        $user->save();

        /********************          Agendas          ********************/

        $agenda = new Agenda;
        $agenda->descricao = 'Teste';
        $agenda->visibilidade = false;
        $agenda->dataInicio = date('Y-m-d H:i',strtotime('01-03-2020 14:30'));
        $agenda->dataFim = date('Y-m-d H:i',strtotime('20-06-2020 18:25'));
        $agenda->idUser = 2;
        $agenda->save();

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

        /*********************          Fases          *********************/

        $fase = new Fase;
        $fase->descricao = 'Inscrição';
        $fase->dataVencimento = date('Y-m-d H:i',strtotime('11-03-2020 15:00'));
        $fase->valorFase = 50;
        $fase->verificacaoPago = true;
        $fase->valorComissaoAgente = 0;
        $fase->valorComSubAgente = null;
        $fase->idProduto = 1;
        $fase->idFaseStock = 1;
        $fase->save();

        $fase = new Fase;
        $fase->descricao = 'Matricula';
        $fase->dataVencimento = date('Y-m-d H:i',strtotime('06-09-2020 18:30'));
        $fase->valorFase = 300;
        $fase->verificacaoPago = false;
        $fase->valorComissaoAgente = 50;
        $fase->valorComSubAgente = null;
        $fase->idProduto = 1;
        $fase->idFaseStock = 2;
        $fase->save();

        $fase = new Fase;
        $fase->descricao = 'Propinas';
        $fase->dataVencimento = date('Y-m-d H:i',strtotime('25-09-2020 23:59'));
        $fase->valorFase = 1000;
        $fase->verificacaoPago = false;
        $fase->valorComissaoAgente = 100;
        $fase->valorComSubAgente = null;
        $fase->idProduto = 1;
        $fase->idFaseStock = 3;
        $fase->save();

        $fase = new Fase;
        $fase->descricao = 'Final';
        $fase->dataVencimento = date('Y-m-d H:i',strtotime('01-07-2021 18:30'));
        $fase->valorFase = 150;
        $fase->verificacaoPago = false;
        $fase->valorComissaoAgente = 150;
        $fase->valorComSubAgente = null;
        $fase->idProduto = 1;
        $fase->idFaseStock = 4;
        $fase->save();

        /****************          Docs Academicos          ****************/

        $docacademico = new DocAcademico;
        $docacademico->nome = 'Tiago Oliveira';
        $docacademico->tipo = 'Doc. Oficial';
        $docacademico->imagem = 'docs/DocAcademico-3490587685-001-001-Doc_Oficial';
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

        /************          Pago Responsabilidades          *************/

        /*$pago = new PagoResponsabilidade;
        $pago->data = '';
        $pago->nomeAutor = '';
        $pago->imagem = '';
        $pago->idFase = '';
        $pago->save();*/

        /***************          Responsabilidades          ***************/

        /*$responsabilidade = new Responsabilidade;
        $responsabilidade->descricao = '';
        $responsabilidade->valorCliente = '';
        $responsabilidade->valorAgente = '';
        $responsabilidade->valorSubAgente = '';
        $responsabilidade->valorUniversidade1 = '';
        $responsabilidade->valorUniversidade2 = '';
        $responsabilidade->imagem = '';
        $responsabilidade->idFase = '';
        $responsabilidade->idConta = '';
        $responsabilidade->save();*/

        /*****************          Rel Forn Resp          *****************/

        /*$relacao = new RelFornResp;
        $relacao->valor = '';
        $relacao->idResponsabilidade = '';
        $relacao->idFornecedor = '';
        $relacao->save();*/

    }

    public function getNotificacoes()
    {
        if(!Auth()->user()){
            return null;
        }
        $idNot = 0;
        $Notificacoes = null;
        /*************************** NOTIFICAÇÕES PARA SEU ANIVERSARIO **************************/
        $dataNasc = null;
        if(Auth()->user()->tipo == 'admin' && Auth()->user()->idAdmin != null){
            $Admin = Auth()->user()->admin()->one();
            $dataNasc = new DateTime($Admin->dataNasc);
        }
        if(Auth()->user()->tipo == 'agente' && Auth()->user()->idAgente != null){
            $Agente = Auth()->user()->agente()->one();
            $dataNasc = new DateTime($Agente->dataNasc);
        }
        if(Auth()->user()->tipo == 'cliente' && Auth()->user()->idCliente != null){
            $Cliente = Auth()->user()->cliente()->one();
            $dataNasc = new DateTime($Cliente->dataNasc);
        }
        $diff = $dataNasc->diff(new DateTime());
        if($diff->d == 0 && $diff->m == 0){
            $Assunto = 'PARABÉNS '.Auth()->user()->nome.' '.Auth()->user()->apelido;
            $Descricao = 'Hoje um ciclo de sua vida se finaliza e outro recomeça. Faça deste novo recomeço uma nova oportunidade para fazer tudo o que sempre sonhou! \nParabéns!';
            $idNot++;
            $Notificacoes = [
                'Id' => $idNot,
                'Tipo' => 'Aniversario',
                'Assunto' => $Assunto,
                'Descricao' => $Descricao,
                'DataLimite' => null,
                'DataInicio' => null,
            ];
        }        
        /*************************** NOTIFICAÇÕES PARA INICIO PRODUTOS **************************/

        /*************************** NOTIFICAÇÕES PARA VENCIMENTO FASES *************************/
        if(Auth()->user()->tipo == 'agente'){
            $Fases = null;
            $Assunto = 'Clientes com documentos ou pagamentos em atraso';
            $Descricao = null;
            $todasFases = Fase::all()
                ->where('dataVencimento','>=', new DateTime())
                ->where('dataVencimento','<=',(new DateTime())->sub(new DateInterval('P7D')))
                ->get();
            $agenteProdutos = Auth()->user()->produtoA()->get();
            if($agenteProdutos && $todasFases){
                foreach($agenteProdutos as $produto){
                    $fasesProduto = $produto->fase()->get();
                    foreach($todasFases as $fase){
                        foreach($fasesProduto as $faseP){
                            if($faseP == $fase){
                                $DocsAcademicos = $fase->docAcademico()->where('verificacao','=',0)->get();
                                $DocsPessoais = $fase->docPessoal()->where('verificacao','=',0)->get();
                                if(count($DocsAcademicos) >=1 || count($DocsAcademicos) >=1 || $fase->verificacaoPago == 0){
                                    if($Fases){
                                        $Fases[] = $fase;
                                    }else{
                                        $Fases = $fase;
                                    }
                                }
                            }
                        }
                    }
                }
            }
            if($Fases){
                $Descricao = 'Clientes: ';
                foreach($Fases as $fase){
                    $produto = $fase->produto()->get();
                    $cliente = $produto->cliente()->get();
                    $diff = (new DateTime($fase->dataVencimento))->diff(new DateTime());
                    $Descricao = $Descricao.'\n - '.$cliente->nome.' '.$cliente->apelido.' -> '.$diff->d.' dias';
                }
                $idNot++;
                $novaNot = [
                    'Id' => $idNot,
                    'Tipo' => 'Fases',
                    'Assunto' => $Assunto,
                    'Descricao' => $Descricao,
                    'DataLimite' => null,
                    'DataInicio' => null,
                ];
                if($Notificacoes){
                    $Notificacoes[] = $novaNot;
                }else{
                    $Notificacoes = $novaNot;
                }
            }
        }
        /******************* NOTIFICAÇÕES PARA DOCUMENTOS E PAGAMENTOS EM FALTA *****************/
        $FasesFalta = null;
        if(Auth()->user()->tipo == 'cliente'){
            $produtosCliente = Auth()->user()->produto()->get();
            $fasesCliente = null;
            foreach($produtosCliente as $produto){
                $fasesProduto = $produto->fase()
                    ->where('dataVencimento','>=',new DateTime())
                    ->where('dataVencimento','<=',(new DateTime())->sub(new DateInterval('P14D')))
                    ->get();
                if($fasesProduto){
                    if($fasesCliente){
                        foreach($fasesProduto as $fase){
                            $fasesCliente[] = $fase;
                        }
                    }else{
                        $fasesCliente = $fasesProduto;
                    }
                }
            }
            if($fasesCliente){
                foreach($fasesCliente as $fase){
                    $falta = false;
                    $docsAcademicos = $fase->docAcademico()->where('verificacao','=',0)->get();
                    $docsPessoais = $fase->docPessoal()->where('verificacao','=',0)->get();
                    if($fase->verificacaoPago = 0 || $docsAcademicos || $docsPessoais){
                        $falta = true;
                    }
                    if($falta){
                        if($FasesFalta){
                            $FasesFalta[] = $fase;
                        }else{
                            $FasesFalta = $fase;
                        }
                    }
                }
            }
        }
        if($FasesFalta){
            foreach($FasesFalta as $Fase){
                $DocsAcademicos = $Fase->docAcademico()->where('verificacao','=',0)->get();
                $DocsPessoais = $Fase->docPessoal()->where('verificacao','=',0)->get();
                $novaNot = null;
                $Assunto = null;
                $Descricao = null;
                $diff = (new DateTime($Fase->dataVencimento))->diff(new DateTime());
                $DataLimite = 'Falta '.$diff->d.' dias';
                if($diff == 0){
                    $DataLimite = 'Só falta hoje';
                }
                $NumDocumentos = $NumDocumentos + count($DocsAcademicos) + count($DocsPessoais);
                if($Fase->verificacaoPago == 0 && $NumDocumentos >= 1){
                    $Assunto = 'Pagamento e documentos em Falta';
                    $Descricao = 'Pagamento em falta: \n - '.$Fase->descricao.' -> '.$Fase->valorFase.'€ \n\nDocumentos em Falta: \n - '.count($DocsAcademicos).' Documentos Académicos \n - '.count($DocsPessoais).' Documentos Pessoais';
                }else{
                    if($Fase->verificacaoPago == 0){
                        $Assunto = 'Pagamento em Falta';
                        $Descricao = 'Pagamento em falta: \n - '.$Fase->descricao.' -> '.$Fase->valorFase.'€';
                    }
                    if($NumDocumentos >= 1){
                        $Assunto = 'Documentos em Falta';
                        $Descricao = 'Documentos em Falta: \n - '.count($DocsAcademicos).' Documentos Académicos \n - '.count($DocsPessoais).' Documentos Pessoais';
                    }
                }
                if($Fase->verificacaoPago == 0 || $NumDocumentos >= 1){
                    $idNot++;
                    $novaNot = [
                        'Id' => $idNot,
                        'Tipo' => 'Falta',
                        'Assunto' => $Assunto,
                        'Descricao' => $Descricao,
                        'DataLimite' => $DataLimite,
                        'DataInicio' => null,
                    ];
                    if($Notificacoes){
                        $Notificacoes[] = $novaNot;
                    }else{
                        $Notificacoes = $novaNot;
                    }
                }
            }
        }
        return $Notificacoes;
    }
}

