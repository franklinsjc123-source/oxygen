<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AuctionWinnerMail extends Mailable
{
    use Queueable, SerializesModels;

    public $winnerName;
    public $productName;
    public $bidAmount;
    public $couponCode;
    public $productImage;

    /**
     * Create a new message instance.
     */
    public function __construct($winnerName, $productName, $bidAmount, $couponCode, $productImage = null)
    {
        $this->winnerName = $winnerName;
        $this->productName = $productName;
        $this->bidAmount = $bidAmount;
        $this->couponCode = $couponCode;
        $this->productImage = $productImage;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('🎉 Congratulations! You Won the Auction!')
            ->view('emails.auction-winner');
    }
}
