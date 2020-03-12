<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendEmailConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    public $id;
    public $name;

    public function __construct(string $id, string $name){
      $this->id = $id;
      $this->name = $name;
    }


    public function build()
    {
        return $this->from('username@hotmail.com', 'LYKA SYSTEMS')
            ->subject('Ativação de conta')
            ->markdown('mails.confirmation')
            ->with([
                'name' => $this->name,
                'link' => 'http://lyka.com/confirmation/'.$this->id
            ]);
    }
}
