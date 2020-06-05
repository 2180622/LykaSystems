<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\ProdutoStock;
use App\FaseStock;
use App\DocStock;

use App\Cliente;
use App\Produto;
use App\Agente;
use App\Universidade;

class StockController extends Controller
{
    public function produtos(){
        $produtos = ProdutoStock::all();
        return ['results' => $produtos];
    }
    public function produto($id){
        $produto = ProdutoStock::where('idProdutoStock','=',$id)->get();
        $fases = FaseStock::where('idProdutoStock','=',$id)->get();
        return ['produto' => $produto, 'fases' => $fases];
    }
    public function fases($id){
        $fases = FaseStock::where('idProdutoStock','=',$id)->get();
        return ['results' => $fases];
    }
    public function documentos($id){
        $documentos = DocStock::where('idFaseStock','=',$id)->get();
        return ['results' => $documentos];
    }




    public function getList(String $pesquisa)
    {/*String $pais, String $cidade, Agente $agente, Agente $subagente, Universidade $universidade, String $curso, String $intitutoOrigem, String $atividade*/
        $result = explode("_", $pesquisa);
        $final=null;
        $Clientes = null;
        foreach($result as $res){
            $explode = explode("-", $res);
            if($explode[1] == 'null'){
                $final[$explode[0]] = null;
            }else{
                $final[$explode[0]] = $explode[1];
            }
        }
        $where = null;
        $join = false;
        if($final['pais']){
            if($where){
                $where = $where.' and ';
            }
            $where = $where.'Cliente.paisNaturalidade like "'.$final['pais'].'"';
        }
        if($final['cidade']){
            if($where){
                $where = $where.' and ';
            }
            $where = $where.'Cliente.cidade like "'.$final['cidade'].'"';
        }
        if($final['agente']){
            if($where){
                $where = $where.' and ';
            }
            $where = $where.'Cliente.idAgente = '.$final['agente'].' or Produto.idAgente = '.$final['agente'];
            $join = true;
        }
        if($final['subagente']){
            if($where){
                $where = $where.' and ';
            }
            $where = $where.'Produto.idSubAgente = '.$final['subagente'];
            $join = true;
        }
        if($final['universidade']){
            if($where){
                $where = $where.' and ';
            }
            $where = $where.'Cliente.idUniversidade = '.$final['universidade'];
        }
        if($final['curso']){
            if($where){
                $where = $where.' and ';
            }
            $where = $where.'Produto.tipo like "'.$final['curso'].'"';
            $join = true;
        }
        if($final['institutoOrigem']){
            if($where){
                $where = $where.' and ';
            }
            $where = $where.'Cliente.nomeInstituicaoOrigem like "'.$final['intitutoOrigem'].'"';
        }
        if($final['atividade']){
            if($where){
                $where = $where.' and ';
            }
            $where = $where.'Cliente.estado like "'.$final['atividade'].'"';
        }
        if($join){
            $Clientes = Cliente::leftJoin('Produto','Cliente.idCliente','=','Produto.idCliente')->whereRaw($where)->get();
        }else{
            $Clientes = Cliente::whereRaw($where)->get();
        }
        return $Clientes;
    }
}
