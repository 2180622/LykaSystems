<?php
namespace App\Http\Controllers;

use App\Agente;
use App\Notificacao;
use App\Cliente;
use App\Universidade;
use Illuminate\Http\Request;

class DashboardController extends Controller{

    protected $Extrafuntions;

    public function __construct(ExtraFunctionsController $Extrafuntions)
    {
        $this->middleware('auth');
        $this->Extrafuntions = $Extrafuntions;
    }

    public function index(){
        $agente = Agente::all();
        $cliente = Cliente::all();
        $universidade = Universidade::all();

        $agenteCount = count($agente);
        $clienteCount = count($cliente);
        $universidadeCount = count($universidade);
        /* 
        // Para utilizar este pedaço de codigo têm de ir para vendor/laravel/framework/src/illuminate/Notifications/DatabaseNotification.php
        //      e mudar:    "protected $table = 'notification';" 
        //      para        "protected $table = 'Notificacao';"
        
        $AllNotifications = Notificacao::all();

        $this->Extrafuntions->getNotificacaoAniversario($AllNotifications);
        $this->Extrafuntions->getNotificacaoInicioProduto($AllNotifications);
        $this->Extrafuntions->getNotificacaoFaseAcaba($AllNotifications);
        $this->Extrafuntions->getNotificacaoDocFalta($AllNotifications);
        */
        return view('index', compact('agenteCount', 'clienteCount', 'universidadeCount'));
    }

    public function report(){
        return view('report');
    }
}
