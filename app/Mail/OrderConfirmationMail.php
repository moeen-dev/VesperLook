<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OrderConfirmationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $order;
    public $attachmentPath;

    /**
     * Create a new message instance.
     */
    public function __construct($order, $attachmentPath)
    {
        $this->order = $order;
        $this->attachmentPath = $attachmentPath;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        $supportEmail = 'support@vesperlook.com';
        $supportPhone = '+880 2 55086633';
        $companyName = config('app.name');

        return $this->from($supportEmail, $companyName)
            ->subject($this->order->name . ', Your Order Confirmation')
            ->html(view('frontend.emails.order_confirmation', [
                'order' => $this->order,
                'supportEmail' => $supportEmail,
                'supportPhone' => $supportPhone,
                'companyName' => $companyName,
            ])->render())
            ->attach($this->attachmentPath);
    }
}
