<x-mail::message>
    # Hi,

    Thank you for subscribing to our newsletter, {{ $contact['name']}}.

    Subject: {{ $contact['subject'] }}
    
    Message: {{ $contact['message'] }}

    Our team will review your message and get back to you as soon as possible — typically within 24 hours.

    Thanks again for reaching out!

    Regards,
    The {{ config('app.name') }} Team
</x-mail::message>