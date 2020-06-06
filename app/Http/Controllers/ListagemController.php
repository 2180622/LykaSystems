<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cliente;
use App\Produto;

class ListagemController extends Controller
{
    public function index()
    {
        if(Auth()->user()->tipo == 'admin' && Auth()->user()->idAdmin != null && Auth()->user()->admin->superAdmin){
            return view('listagens.list');
        }else{
            abort(401);
        }
    }

    public function getList(String $tipo, String $pais, String $cidade, Agente $agente, Agente $subagente, Universidade $universidade, String $curso, String $intitutoOrigem, String $atividade)
    {
        if(Auth()->user()->tipo == 'admin' && Auth()->user()->idAdmin != null && Auth()->user()->admin->superAdmin){
            if($tipo == 'Cliente'){
                $where = null;
                $join = false;
                if($pais){
                    if($where){
                        $where = $where.' and ';
                    }
                    $where = $where.'Cliente.paisNaturalidade like "'.$pais.'"';
                }
                if($cidade){
                    if($where){
                        $where = $where.' and ';
                    }
                    $where = $where.'Cliente.cidade like "'.$cidade.'"';
                }
                if($agente){
                    if($where){
                        $where = $where.' and ';
                    }
                    $where = $where.'Cliente.idAgente = '.$agente->idAgente.' or Produto.idAgente = '.$agente->idAgente;
                    $join = true;
                }
                if($subagente){
                    if($where){
                        $where = $where.' and ';
                    }
                    $where = $where.'Produto.idSubAgente = '.$subagente->idAgente;
                    $join = true;
                }
                if($universidade){
                    if($where){
                        $where = $where.' and ';
                    }
                    $where = $where.'Cliente.idUniversidade = '.$universidade->idUniversidade;
                }
                if($curso){
                    if($where){
                        $where = $where.' and ';
                    }
                    $where = $where.'Produto.tipo like "'.$curso.'"';
                    $join = true;
                }
                if($intitutoOrigem){
                    if($where){
                        $where = $where.' and ';
                    }
                    $where = $where.'Cliente.nomeInstituicaoOrigem like "'.$intitutoOrigem.'"';
                }
                if($atividade){
                    if($where){
                        $where = $where.' and ';
                    }
                    $where = $where.'Cliente.estado like "'.$atividade.'"';
                }
                if($join){
                    $Clientes = Cliente::leftJoin('Produto','Cliente.idCliente','=','Produto.idCliente')->whereRaw($where)->get();
                }else{
                    $Clientes = Cliente::whereRaw($where)->get();
                }
            }elseif($tipo == 'Agente'){

            }elseif($tipo == 'Sub-Agente'){
                
            }elseif($tipo == 'Produto'){
                
            }elseif($tipo == 'Universidade'){
                
            }else{
                return null;
            }
        }else{
            abort(401);
        }
    }
}
