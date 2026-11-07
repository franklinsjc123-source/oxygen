<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderMail extends Mailable
{
    use Queueable, SerializesModels;

    public $orderData;

    /**
     * Create a new message instance.
     */
    public function __construct($orderData)
    {
        $this->orderData = $orderData;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        $fromAddress = config('mail.from.address') ?: 'info@tryneww.com';
        $fromName = config('mail.from.name') ?: 'Trymenow';

        return $this->from($fromAddress, $fromName)
            ->subject('Order Confirmation - ' . ($this->orderData['order_id'] ?? ''))
            ->view('emails.order-confirmation');
    }
}
