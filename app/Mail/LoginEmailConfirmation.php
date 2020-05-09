<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class LoginEmailConfirmation extends Mailable
{
    public $key;
    public $name;

    public function __construct(string $name)
    {
        $this->name = $name;
        $key = rand(10000 , 99999);
        $this->key = $key;
    }

    public function build()
    {
        return $this->from('lykasystems@mail.com', 'Lyka Systems')
            ->subject('Lyka Systems | Login Check ')
            ->markdown('mails.loginverification')
            ->with([
                'name' => $this->name,
                'key' => $this->key,
                'link' => url('/').'/login-verification/'.post_slug($this->name)
            ]);
    }
}