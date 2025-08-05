<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>OTP Verification</title>
</head>

<body style="margin: 0; padding: 0; background-color: #f1f5f9; font-family: Arial, sans-serif;">
    <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
            <td align="center" style="padding: 30px 0;">
                <table width="600" cellpadding="0" cellspacing="0" style="background-color: #ffffff; border-radius: 6px; overflow: hidden;">
                    <tr>
                        <td align="center" style="padding: 20px;">
                            <img src="{{ asset('assets/frontend/media/images/logo.png') }}" alt="Vesper Look" width="120" style="margin-bottom: 10px;">
                        </td>
                    </tr>
                    <tr>
                        <td style="background-color: #f8fafc; padding: 20px;">
                            <p style="margin: 0; font-size: 16px;">Hello, {{ $name }}!</p>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 20px; font-size: 16px; color:rgb(0, 0, 0);">
                            <p>You are receiving this email to verify your identity.</p>
                            <p>Please use the OTP code below to complete your verification process:</p>
                            <div style="margin: 20px 0; text-align: center;">
                                <span style="display: inline-block; background-color: #d4a15d; color: white; font-size: 22px; font-weight: bold; padding: 12px 24px; border-radius: 6px;">{{ $otp }}</span>
                            </div>
                            <p>This OTP code will expire in 1 minute.</p>
                            <p>If you did not request this, you can safely ignore this email.</p>
                            <p><strong>Need help or have questions?</strong><br>
                                Feel free to reach out to us anytime at,<br>
                                <a href="mailto:info@vesperlook.com" style="color: #d4a15d; text-decoration: none;">info@vesperlook.com</a>
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 20px; text-align: left; font-size: 14px; color: #64748b;">
                            Regards,<br>
                            <strong>{{ config('app.name') }}</strong><br>
                            <a href="mailto:info@vesperlook.com" style="color: #d4a15d; text-decoration: none;">info@vesperlook.com</a>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>

</html>