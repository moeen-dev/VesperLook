<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use App\Models\NewsletterSubscriber;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewsletterWelcomeMail extends Mailable
{
    use Queueable, SerializesModels;

    public $subscriber;

    /**
     * Create a new message instance.
     */
    public function __construct(NewsletterSubscriber $subscriber)
    {
        $this->subscriber = $subscriber;
    }

    /**
     * Get the message envelope.
     */
    public function build()
    {
        return $this->from('newsletter@vesperlook.com', 'Vesper Look')
            ->subject('Welcome to Our Newsletter 📰')
            ->markdown('frontend.emails.newsletter');
    }
}
