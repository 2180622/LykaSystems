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

    public function __construct(string $id){
      $this->id = $id;

    }


    public function build()
    {
        return $this->from('username@hotmail.com', 'Mailtrap')
            ->subject('Email Confirmation')
            ->markdown('mails.confirmation')
            ->with([
                'name' => 'New LYKA User'.$this->id,
                'link' => 'http://lyka.com/confirmation/'.$this->id
            ]);
    }
}
