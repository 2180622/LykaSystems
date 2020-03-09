<?php

namespace App\Http\Controllers;

use App\ExtraFunction;
use Illuminate\Http\Request;

class ExtraFunctionController extends Controller
{
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

            $fase = Fase::all()->where()->get();

            User::all()->where('deleted_at', '=', 'NULL');

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

