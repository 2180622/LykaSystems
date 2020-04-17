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
    public $screenshot;

    public function __construct(string $name, string $email, string $text, string $phone, string $screenshot)
    {
      $this->name = $name;
      $this->email = $email;
      $this->text = $text;
      $this->phone = $phone;
      $this->screenshot = $screenshot;
    }

    public function build()
    {
      if ($this->screenshot != null) {
        return $this->from($this->email, $this->name)
            ->subject('Lyka Systems | Relatório de erro - '.$this->name)
            ->attachFromStorage('report-errors/'.$this->screenshot, 'captura_erro.png')
            ->markdown('mails.report')
            ->with([
                'name' => $this->name,
                'email' => $this->email,
                'phone' => $this->phone,
                'text' => $this->text
            ]);
      }else {
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
}
