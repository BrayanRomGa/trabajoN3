<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class informacionActualizada extends Mailable
{    
    use Queueable, SerializesModels;
    public $informacionActalizada;//es necesario hacer publica la variable
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($informacionActalizada)
    {
        $this->informacionActalizada=$informacionActalizada;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('19170141@utt.edu.mx')    //correo sobre quien lo manda
            ->view('CorreoRegistroCambios');       //envio de informacion
    }
}
