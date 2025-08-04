<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\URL;
use Carbon\Carbon;

class CustomResetPassword extends Notification
{
    public $token;
    public $email;

    public function __construct($token, $email)
    {
        $this->token = $token;
        $this->email = $email;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        // URL valid for 10 minutes
        $url = URL::temporarySignedRoute(
            'password.reset',
            Carbon::now()->addMinutes(10),
            ['token' => $this->token, 'email' => $this->email]
        );

        return (new MailMessage)
            ->subject('Vesper Look password reset 🔄')
            ->markdown('vendor.notifications.email', [ // Use markdown instead of ->line() etc
                'actionUrl' => $url,
                'user' => $notifiable,
            ]);
    }
}
