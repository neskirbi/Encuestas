<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MailRecuperar extends Mailable
{
    use Queueable, SerializesModels;
    public $subject="Recuperar Contraseña.";
    /**
     * Create a new message instance.
     *
     * @return void
     */
    private $mail;
    private $id;
    public function __construct($mail,$id)
    {
        $this->mail=$mail;
        $this->id=$id;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.recuperar',['mail'=> $this->mail,'id'=>$this->id]);
    }
}
