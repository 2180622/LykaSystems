<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use DateTime;
use DateInterval;

use App\Notificacao;
use App\Notifications\Adicionado;
use App\Notifications\Aniversario;
use App\Notifications\Atraso;
use App\Notifications\AtrasoCliente;


class ExtraFunctionsController extends Controller
{
    public function getNotificacaoAniversario($AllNotifications)
    {
        if(!Auth()->user()){
            return null;
        }
        $Assunto = null;
        $dataNasc = null;
        if(Auth()->user()->tipo == 'admin' && Auth()->user()->idAdmin != null){
            $Admin = Auth()->user()->admin;
            $dataNasc = new DateTime($Admin->dataNasc);
            $Assunto = 'PARABÉNS '.Auth()->user()->admin->nome.' '.Auth()->user()->admin->apelido;
        }
        if(Auth()->user()->tipo == 'agente' && Auth()->user()->idAgente != null){
            $Agente = Auth()->user()->agente;
            $dataNasc = new DateTime($Agente->dataNasc);
            $Assunto = 'PARABÉNS '.Auth()->user()->agente->nome.' '.Auth()->user()->agente->apelido;
        }
        if(Auth()->user()->tipo == 'cliente' && Auth()->user()->idCliente != null){
            $Cliente = Auth()->user()->cliente;
            $dataNasc = new DateTime($Cliente->dataNasc);
            $Assunto = 'PARABÉNS '.Auth()->user()->cliente->nome.' '.Auth()->user()->cliente->apelido;
        }
        $diff = $dataNasc->diff(new DateTime());
        if($diff->d >= 0 && $diff->d <= 30){
            $Descricao = 'Hoje um ciclo de sua vida se finaliza e outro recomeça. Faça deste novo recomeço uma nova oportunidade para fazer tudo o que sempre sonhou! \nParabéns!';
            $date = (new DateTime())->add(new DateInterval('P'.$diff->d.'D'));
            $code = Auth()->user()->idUser.'_aniversario_'.$date->format('d-m-Y');
            $existe=false;
            if($AllNotifications){
                foreach($AllNotifications as $notification){
                    $dados = json_decode($notification->data);
                    if($dados->code == $code){
                        $existe = true;
                    }
                }
            }
            if(!$existe){
                $Notdate = (new DateTime())->sub(new DateInterval('P'.$diff->d.'D'));
                Auth()->user()->notify(new Aniversario($code,false,$Notdate->format('Y-m-d'),'Aniversario',null,null,$Assunto,$Descricao));
            }
        }
    }
    public function getNotificacaoInicioProduto($AllNotifications)
    {
        /*************************** NOTIFICAÇÕES PARA INICIO PRODUTOS **************************/

    }
    public function getNotificacaoFaseAcaba($AllNotifications)
    {
        if(Auth()->user()->tipo == 'agente' && Auth()->user()->idAgente != null){
            $Fases = null;
            $Assunto = 'Clientes com documentos ou pagamentos em atraso';
            $Descricao = null;
            $todasFases = Fase::where('dataVencimento','>=', new DateTime())
                ->where('dataVencimento','<=',(new DateTime())->add(new DateInterval('P7D')))
                ->get()->all();
            $agenteProdutos = Auth()->user()->agente->produtoA->all();
            if($agenteProdutos && $todasFases){
                foreach($agenteProdutos as $produto){
                    $fasesProduto = $produto->fase->all();
                    foreach($todasFases as $fase){
                        foreach($fasesProduto as $faseP){
                            if($faseP == $fase){
                                $DocsAcademicos = $fase->docAcademico->where('verificacao','=',0)->all();
                                $DocsPessoais = $fase->docPessoal->where('verificacao','=',0)->all();
                                if(count($DocsAcademicos) >=1 || count($DocsAcademicos) >=1 || $fase->verificacaoPago == 0){
                                    $Fases[] = $fase;
                                }
                            }
                        }
                    }
                }
            }
            if($Fases){
                $urgencia = false;
                $Descricao = 'Clientes: ';
                foreach($Fases as $fase){
                    $produto = $fase->produto;
                    $cliente = $produto->cliente;
                    $diff = (new DateTime($fase->dataVencimento))->diff(new DateTime());
                    $Descricao = $Descricao.'\n - '.$cliente->nome.' '.$cliente->apelido.' -> '.$diff->d.' dias';
                    if($diff->d <= 0){
                        $urgencia = true;
                    }
                }
                $date = (new DateTime())->add(new DateInterval('P'.$diff->d.'D'));
                $code = Auth()->user()->idUser.'_atraso_'.$date->format('d-m-Y');
                $existe=false;
                if($AllNotifications){
                    foreach($AllNotifications as $notification){
                        $dados = json_decode($notification->data);
                        if($dados->code == $code){
                            $existe = true;
                        }
                    }
                }
                if(!$existe){
                    Auth()->user()->notify(new Aniversario($code,$urgencia,(new DateTime())->format('Y-m-d'),'Aniversario',null,null,$Assunto,$Descricao));
                }
            }
        }
    }
    public function getNotificacaoDocFalta($AllNotifications)
    {
        $FasesFalta = null;
        if(Auth()->user()->tipo == 'cliente' && Auth()->user()->idCliente != null){
            $produtosCliente = Auth()->user()->cliente->produto->all();
            $fasesCliente = null;
            foreach($produtosCliente as $produto){
                $fasesProduto = null;
                foreach($produto->fase as $fase){
                    if((new DateTime($fase->dataVencimento))>=(new DateTime()) && (new DateTime($fase->dataVencimento))<=((new DateTime())->add(new DateInterval('P14D')))){
                        $fasesProduto[] = $fase;
                    }
                }
                if($fasesProduto){
                    foreach($fasesProduto as $fase){
                        $fasesCliente[] = $fase;
                    }
                }
            }
            if($fasesCliente){
                foreach($fasesCliente as $fase){
                    $falta = false;
                    $docsAcademicos = $fase->docAcademico->where('verificacao','=',0)->all();
                    $docsPessoais = $fase->docPessoal->where('verificacao','=',0)->all();
                    if($fase->verificacaoPago = 0 || $docsAcademicos || $docsPessoais){
                        $falta = true;
                    }
                    if($falta){
                        $FasesFalta[] = $fase;
                    }
                }
            }
        }
        if($FasesFalta){
            foreach($FasesFalta as $Fase){
                $DocsAcademicos = $Fase->docAcademico->where('verificacao','=',0)->all();
                $DocsPessoais = $Fase->docPessoal->where('verificacao','=',0)->all();
                $novaNot = null;
                $Assunto = null;
                $Descricao = null;
                $diff = (new DateTime($Fase->dataVencimento))->diff(new DateTime());
                $DataLimite = 'Falta '.$diff->d.' dias';
                if($diff->d == 0){
                    $DataLimite = 'Só falta hoje';
                }
                $NumDocumentos = count($DocsAcademicos) + count($DocsPessoais);
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
                    $Notificacoes[] = $novaNot;
                }
            }
        }
    }
}

