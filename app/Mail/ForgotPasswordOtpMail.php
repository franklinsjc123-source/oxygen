<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ForgotPasswordOtpMail extends Mailable
{
    use Queueable, SerializesModels;

    public $otp;
    public $customerName;

    public function __construct($otp, $customerName)
    {
        $this->otp = $otp;
        $this->customerName = $customerName;
    }

    public function build()
    {
        return $this->subject('Password Reset OTP')
            ->view('emails.forgot-password-otp');
    }
}
