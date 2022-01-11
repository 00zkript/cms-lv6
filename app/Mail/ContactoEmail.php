<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactoEmail extends Mailable
{
    use Queueable, SerializesModels;
    private $data;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        $data = (object) $this->data;



        return $this
            ->from(env('MAIL_USERNAME'), $data->correo)
            ->to(env('MAIL_USERNAME'))
            ->subject('Contacto de pagina web')
            ->view('email.contacto.index')->with(compact('data'));
    }
}
