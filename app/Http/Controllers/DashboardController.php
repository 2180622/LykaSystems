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

        $AllNotifications = Notificacao::all();

        $this->NotController->getNotificacaoAniversario($AllNotifications);
        $this->NotController->getNotificacaoInicioProduto($AllNotifications);
        $this->NotController->getNotificacaoFaseAcaba($AllNotifications);
        $this->NotController->getNotificacaoDocFalta($AllNotifications);

        return view('index', compact('agente', 'cliente', 'universidade'));
    }

    public function report()
    {
        return view('report');
    }
}
