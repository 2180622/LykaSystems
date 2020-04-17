<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ReportProblemMail extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $email;
    public $text;
    public $phone;
    public $errorfile;

    public function __construct($name, $email, $text, $phone, $errorfile)
    {
      $this->name = $name;
      $this->email = $email;
      $this->text = $text;
      $this->phone = $phone;
      $this->errorfile = $errorfile;
    }

    public function build()
    {
        return $this->from($this->email, $this->name)
            ->subject('Lyka Systems | Relatório de erro - '.$this->name)
            ->attach($this->errorfile->getRealPath(), [
                    'as' => 'captura.'.$this->errorfile->getClientOriginalExtension(),
                    'mime' => $this->errorfile->getMimeType(),
            ])
            ->markdown('mails.report')
            ->with([
                'name' => $this->name,
                'email' => $this->email,
                'phone' => $this->phone,
                'text' => $this->text
            ]);
   }
}
