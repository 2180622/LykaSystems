<?php

namespace App\Http\Controllers;

use Mail;
use App\RelatorioProblema;
use Illuminate\Http\Request;
use App\Mail\ReportProblemMail;
use Illuminate\Support\Facades\Storage;

class ExtraFunctionsController extends Controller
{
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
    $phone = $report->telemovel;
    $text = $report->relatorio;

    if (isset($errorfile)) {
      Mail::to('lykasystems@mail.com')->send(new ReportProblemMail($name, $email, $phone, $text, $errorfile));
    }else {
      $errorfile = null;
      Mail::to('lykasystems@mail.com')->send(new ReportProblemMail($name, $email, $phone, $text, $errorfile));
    }

    return redirect()->route('report')->with('success', 'Relatório enviado com sucesso. Obrigado!');
  }
}
