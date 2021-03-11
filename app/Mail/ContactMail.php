<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactMail extends Mailable
{
    use Queueable, SerializesModels;
    public $email;
    public $name;
    public $message;


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
    $this->email=$data['email'];
    $this->name=$data['name'];
    $this->message=$data['message'];
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('mail.contact')->with(['name'=>$this->name,'email'=>$this->email,'message'=>$this->message])->subject('Nuevo Contacto');
    }
}
