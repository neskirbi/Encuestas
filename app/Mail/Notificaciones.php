<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Notificaciones extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    
    public $subject="";
    public $title="";
    public $subtitle="";
    public $body="";
    public $links="";
    public function __construct($subject,$title,$subtitle,$body,$links)
    {
        $this->subject=$subject;
        $this->title=$title;
        $this->subtitle=$subtitle;
        $this->body=$body;
        $this->links=$links;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.notificaciones',['title'=> $this->title,'subtitle'=> $this->subtitle,'body'=> $this->body,'links'=>$this->links]);
    }
}
