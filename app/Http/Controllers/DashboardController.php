<?php
namespace App\Http\Controllers;

use Mail;
use App\Agente;
use App\Cliente;
use App\Notificacao;
use App\Universidade;
use Illuminate\Http\Request;
use App\Mail\ReportProblemMail;

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

    public function reportmail(Request $request)
    {
      $name = $request->input('nomeCompleto');
      $email = $request->input('email');
      $phone = $request->input('telemovel');
      $text = $request->input('relatorio');

      Mail::to('lykasystems@mail.com')->send(new ReportProblemMail($name, $email, $phone, $text));
      return redirect()->route('report')->with('success', 'Relatório enviado com sucesso. Obrigado!');
    }
}
