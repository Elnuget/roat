<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Pago;

class PagoNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $pago;

    public function __construct(Pago $pago)
    {
        $this->pago = $pago;
    }

    public function build()
    {
        return $this->subject('Nuevo Pago Registrado')
                    ->view('emails.pago-notification');
    }
}
