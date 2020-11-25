<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

use Illuminate\Support\Facades\Mail;

class envioVerificacionCorreo extends Mailable
{
    use Queueable, SerializesModels;


    public $datosUsuCorreo;//es necesario hacer publica la variable


    public function __construct($datosUsuCorreo)
    {
        $this->datosUsuCorreo=$datosUsuCorreo;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('19170141@utt.edu.mx')    //correo sobre quien lo manda
            ->view('CorreoVerificacion');       //envio de informacion
    }
}
