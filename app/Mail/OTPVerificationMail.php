<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OTPVerificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $otp;
    public $name;

    /**
     * Create a new message instance.
     */
    public function __construct($otp, $name)
    {
        $this->otp = $otp;
        $this->name = $name;

    }

    public function build()
    {
        return $this->subject('Vesper Look OTP Verification 🔒')
            ->view('frontend.emails.user-otp')
            ->with([
                'otp' => $this->otp,
                'name' => $this->name,
            ]);
    }
}
