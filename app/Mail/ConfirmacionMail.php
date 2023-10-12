<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ConfirmacionMail extends Mailable
{
    use Queueable, SerializesModels;

    public $subject="Confirmación de Correo";
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $cliente="";
    public function __construct($cliente)
    {
        $this->cliente = $cliente;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $id=$this->cliente->id;
        $mail=$this->cliente->mail;
        $pass=$this->cliente->pass;
        $nombre=$this->cliente->nombres.' '.$this->cliente->apellidos;
        return $this->view('mails.confirmacion',['id'=>$id,
        'mail'=>$mail,
        'pass'=>$pass,
        'nombre'=>$nombre]);
    }
}
