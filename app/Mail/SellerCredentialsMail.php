<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SellerCredentialsMail extends Mailable
{
    use Queueable, SerializesModels;

    public $vendor;
    public $username;
    public $password;
    public $loginUrl;

    /**
     * Create a new message instance.
     *
     * @param object $vendor
     * @param string $username
     * @param string $password
     * @param string|null $loginUrl
     */
    public function __construct($vendor, $username, $password, $loginUrl = null)
    {
        $this->vendor = $vendor;
        $this->username = $username;
        $this->password = $password;
        $this->loginUrl = $loginUrl ?: url('/seller/login');
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $appName = config('app.name', 'Trymenow');
        return $this->subject('Welcome to ' . $appName . ' - Your Seller Account Login Credentials')
            ->view('emails.seller-credentials');
    }
}

