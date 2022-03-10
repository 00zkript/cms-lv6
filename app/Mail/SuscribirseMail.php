<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SuscribirseMail extends Mailable
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

        $data = (object) $this->data ;


        return $this
            ->from(env('MAIL_FROM_ADDRESS'), $data->email)
            ->to(env('MAIL_TO_ADDRESS'))
            ->subject('Deseo suscribirme')
            ->view('mail.suscribirse')->with(compact('data'));
    }
}
