<?php

namespace App\Http\Controllers;

use Mail;
use App\Agente;
use App\Cliente;
use App\Fornecedor;
use App\Universidade;
use App\RelatorioProblema;
use Illuminate\Http\Request;
use App\Mail\ReportProblemMail;
use Illuminate\Support\Facades\Storage;

class ExtraFunctionsController extends Controller
{
    /* Reportar Problema -> Vista Principal */
    public function report()
    {
        return view('report');
    }

    /* Reportar Problema -> Envio de Mail + Store na base de dados */
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
      $phone = $report->telemovel;
      $text = $report->relatorio;

      if (isset($errorfile)) {
        Mail::to('lykasystems@mail.com')->send(new ReportProblemMail($name, $email, $phone, $text, $errorfile));
      }else {
        $errorfile = null;
        Mail::to('lykasystems@mail.com')->send(new ReportProblemMail($name, $email, $phone, $text, $errorfile));
      }

      return redirect()->route('report')->with('success', 'Relatório enviado com sucesso. Obrigado pela sua contribuição!');
    }

    /* Procura de contactos */
    public function searchcontact(Request $request)
    {
        $usertype = $request->input('users');
        $name = $request->input('name');

        switch ($usertype) {
          case 'clientes':
              $result = Cliente::where('nome', 'like', '%'.$name.'%')->select('nome', 'apelido', 'telefone1', 'telefone2', 'email')->first();
            break;

          case 'agentes':
              $result = Agente::all();
            break;

          case 'universidades':
              $result = Universidade::all();
            break;

          case 'fornecedores':
              $result = Fornecedor::all();
            break;
        }

        if ($result == null) {
            return response()->json('NOK', 500);
        }else {
            return response()->json($result, 200);
        }
    }
}
