<x-mail::message>
# Hi Mr/Mrs,

Thank you for subscribing to our newsletter, {{ $subscriber->email }}.

You’ll start receiving updates and news soon!

<x-mail::button :url="'https://www.vesperlook.com'">
Go to shop
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
