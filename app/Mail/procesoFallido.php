<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class procesoFallido extends Mailable
{
    use Queueable, SerializesModels;
    public $infoProceso;//es necesario hacer publica la variable
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($infoProceso)
    {
        $this->infoProceso=$infoProceso;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('19170141@utt.edu.mx')    //correo sobre quien lo manda
            ->view('CorreoProcesoFallido');       //envio de informacion
    }
}
