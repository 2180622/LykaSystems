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
        return $this->from('lykasystems@mail.com', 'Lyka Systems')
            ->subject('Lyka Systems | Ativação Conta - '.$this->name)
            ->markdown('mails.confirmation')
            ->with([
                'name' => $this->name,
                'link' => 'http://lyka.test/confirmation/'.$this->id
            ]);
    }
}
