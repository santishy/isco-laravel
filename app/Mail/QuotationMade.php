<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class QuotationMade extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    protected $data=null;
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
        return $this->from("iscosahuayo@gmail.com","ISCO COMPUTADORAS")->subject('Cotizacion')->view('admin.quotation.email',['data' => $this->data])
                    ->attachData($this->data->pdf,'cotizacion.pdf', [
                        'mime' => 'application/pdf',
                    ]);
    }
}
