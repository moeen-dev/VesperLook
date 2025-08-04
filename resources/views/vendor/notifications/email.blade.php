@component('mail::message')
{{-- Company Logo --}}
<div style="text-align: center; margin-bottom: 20px;">
    <img src="{{ url('assets/frontend/media/images/logo.png') }}" alt="Vesper Look" width="150">
</div>

@component('mail::panel')
Hello {{ $user->name ?? 'User' }}!
@endcomponent


You are receiving this email because we received a password reset request for your account.

<table role="presentation" border="0" cellpadding="0" cellspacing="0" class="btn btn-primary" style="margin: 20px 0;">
    <tbody>
        <tr>
            <td align="center">
                <a href="{{ $actionUrl }}" target="_blank" style="background-color: #d19e66; border: solid 1px #d19e66; border-radius: 5px; box-sizing: border-box; color: #ffffff; cursor: pointer; display: inline-block; font-size: 16px; font-weight: bold; margin: 0; padding: 12px 25px; text-decoration: none;">
                    Reset Password
                </a>
            </td>
        </tr>
    </tbody>
</table>


This password reset link will expire in 10 minutes.

If you did not request a password reset, no further action is required.

**Need help or have questions?**
<br>
Feel free to reach out to us anytime at,<br> 
<a style="text-decoration: none; color: #d19e66;" href="mailto:info@vesperlook.com">info@vesperlook.com</a>

<br><br>

<div style="margin-top: 30px;">
    Regards,<br>
    <strong>Vesper Look</strong><br>
    <a style="text-decoration: none; color: #d19e66;" href="mailto:info@vesperlook.com">info@vesperlook.com</a>
</div>

{{-- Copyright --}}
@slot('footer')
© {{ date('Y') }} Vesper Look. All rights reserved.
@endslot
@endcomponent