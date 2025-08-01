<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NotificacionInformatica extends Mailable
{
    use Queueable, SerializesModels;

    public $dni,$datos,$cargo,$sede,$dependencia,$pdf,$pdftutorial;

    public function __construct($dni,$datos,$cargo,$sede,$dependencia,$pdf,$pdftutorial)
    {
        $this->dni = $dni;
        $this->datos = $datos;
        $this->cargo = $cargo;
        $this->sede = $sede;
        $this->dependencia = $dependencia;
        $this->pdf = $pdf;
        $this->pdftutorial = $pdftutorial;
    }

    public function build()
    {
        return $this->subject('DFJunin: Notificación Informática')
                    ->view('emails.email_spijweb')
                    ->with([
                        'dni' => $this->dni,
                        'datos' => $this->datos,
                        'cargo' => $this->cargo,
                        'sede' => $this->sede,
                        'dependencia' => $this->dependencia,
                    ])
                    ->attachData($this->pdf, 'spij_'.$this->dni.'.pdf', [
                        'mime' => 'application/pdf',
                    ])
                    ->attachData(file_get_contents($this->pdftutorial), 'tutorial_spij.pdf', [
                        'mime' => 'application/pdf',
                    ]);
    }


}
