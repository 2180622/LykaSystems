<?php
namespace App\Http\Controllers;

use Mail;
use App\Agente;
use App\Cliente;
use App\Notificacao;
use App\Universidade;
use App\RelatorioProblema;
use Illuminate\Http\Request;
use App\Mail\ReportProblemMail;
use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller{

    protected $NotController;

    public function __construct(NotificationController $NotController)
    {
        $this->middleware('auth');
        $this->NotController = $NotController;
    }

    public function index(){
        $agentes = Agente::all();
        $clientes = Cliente::all();
        $universidades = Universidade::all();

        $AllNotifications = Notificacao::all();

        $this->NotController->getNotificacaoAniversario($AllNotifications);
        $this->NotController->getNotificacaoInicioProduto($AllNotifications);
        $this->NotController->getNotificacaoFaseAcaba($AllNotifications);
        $this->NotController->getNotificacaoDocFalta($AllNotifications);

        return view('index', compact('agentes', 'clientes', 'universidades'));
    }

    public function report()
    {
        return view('report');
    }

    public function reportmail(Request $request)
    {
      $fields = $request->validate(
        [
          'nome' => 'required',
          'email' => 'required',
          'telemovel' => 'nullable',
          'screenshot' => 'nullable',
          'relatorio' => 'required'
        ]);

      $report = new RelatorioProblema;
      $report->fill($fields);
      $report->save();

      if ($request->hasFile('screenshot')) {
          $errorfile = $request->file('screenshot');
          $errorimg = 'error_'.strtolower($report->idRelatorioProblema).'.'.$errorfile->getClientOriginalExtension();
          Storage::disk('public')->putFileAs('report-errors/', $errorfile, $errorimg);
          $report->screenshot = $errorimg;
          $report->save();
      }

      $name = $report->nome;
      $email = $report->email;
      $text = $report->relatorio;
      $phone = $report->telemovel;
      $screenshot = $report->screenshot;

      Mail::to('lykasystems@mail.com')->send(new ReportProblemMail($name, $email, $phone, $text, $screenshot));
      return redirect()->route('report')->with('success', 'Relatório enviado com sucesso. Obrigado!');
    }
}
