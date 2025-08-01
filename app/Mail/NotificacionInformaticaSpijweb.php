<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NotificacionInformaticaSpijweb extends Mailable
{
    use Queueable, SerializesModels;

    public $dni,$datos,$cargo,$sede,$dependencia,$usuariospijweb,$passwordspijweb;

    public function __construct($dni,$datos,$cargo,$sede,$dependencia,$usuariospijweb,$passwordspijweb)
    {
        $this->dni = $dni;
        $this->datos = $datos;
        $this->cargo = $cargo;
        $this->sede = $sede;
        $this->dependencia = $dependencia;
        $this->usuariospijweb = $usuariospijweb;
        $this->passwordspijweb = $passwordspijweb;
    }


    public function build()
    {
        return $this->subject('DFJunin: Notificación Informática')
                    ->view('emails.email_spijweb_userpass')
                    ->with([
                        'dni' => $this->dni,
                        'datos' => $this->datos,
                        'cargo' => $this->cargo,
                        'sede' => $this->sede,
                        'dependencia' => $this->dependencia,
                        'usuariospijweb' => $this->usuariospijweb,
                        'passwpordspijweb' => $this->passwordspijweb,
                    ]);
    }
}
