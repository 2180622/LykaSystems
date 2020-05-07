<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RestorePasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    public $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function build()
    {
      return $this->from('lykasystems@mail.com', 'Lyka Systems')
          ->subject('Lyka Systems | Recuperar palavra-chave - '.$this->name)
          ->markdown('mails.restore')
          ->with([
              'name' => $this->name,
              'link' => url('/').'/restaurar-password/'.post_slug($this->name)
          ]);
    }
}
