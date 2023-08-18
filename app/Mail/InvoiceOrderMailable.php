<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Contracts\Queue\ShouldQueue;

class InvoiceOrderMailable extends Mailable
{
    use Queueable, SerializesModels;
    // public $order;
    public $data1;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    // public function __construct($order)
    // {
    //     $this->order=$order;
    // }

    public function __construct($data1)
    {
        $this->data1=$data1;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Order Invoice',
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            view: 'admin.orders.generate-pdf',with:$this->data1
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [
            Attachment::fromData(fn()=>$this->data1['pdf']->output(),'Invoice.pdf')
            ->withMime('application/pdf')
        ];
    }
}
