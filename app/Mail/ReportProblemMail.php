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
    public $phone;
    public $text;

    public function __construct(string $name, string $email, string $phone, string $text)
    {
      $this->name = $name;
      $this->email = $email;
      $this->phone = $phone;
      $this->text = $text;
    }

    public function build()
    {
      return $this->from($this->email, $this->name)
          ->subject('Lyka Systems | Relatório de erro - '.$this->name)
          ->markdown('mails.report')
          ->with([
              'name' => $this->name,
              'email' => $this->email,
              'phone' => $this->phone,
              'text' => $this->text
          ]);
    }
}
