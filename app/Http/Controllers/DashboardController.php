<?php
namespace App\Http\Controllers;

use App\Agente;
use App\Notificacao;
use App\Cliente;
use App\Universidade;
use Illuminate\Http\Request;

class DashboardController extends Controller{

    protected $NotController;

    public function __construct(NotificationController $NotController)
    {
        $this->middleware('auth');
        $this->NotController = $NotController;
    }

    public function index(){
        $agente = Agente::all();
        $cliente = Cliente::all();
        $universidade = Universidade::all();

        $agenteCount = count($agente);
        $clienteCount = count($cliente);
        $universidadeCount = count($universidade);
        /**/
        // Para utilizar este pedaço de codigo têm de ir para vendor/laravel/framework/src/illuminate/Notifications/DatabaseNotification.php
        //      e mudar:    "protected $table = 'notification';" 
        //      para        "protected $table = 'Notificacao';"
        
        $AllNotifications = Notificacao::all();

        $this->NotController->getNotificacaoAniversario($AllNotifications);
        $this->NotController->getNotificacaoInicioProduto($AllNotifications);
        $this->NotController->getNotificacaoFaseAcaba($AllNotifications);
        $this->NotController->getNotificacaoDocFalta($AllNotifications);

        $Notificacoes = Auth()->user()->getNotifications();
        
        return view('index', compact('agenteCount', 'clienteCount', 'universidadeCount', 'Notificacoes'));
    }

    public function report(){
        return view('report');
    }
}
