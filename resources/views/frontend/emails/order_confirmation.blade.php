<div style="font-family: Arial, sans-serif; font-size: 16px; color: #333;">
    <p>Hi <strong>{{ $order->name }}</strong>,</p>

    <p>🎉 Thank you for your order! We’re excited to let you know that we have received your purchase and it is now
        being processed.</p>

    <h3>Order Details:</h3>
    <ul>
        <li><strong>Order Number:</strong> #{{ $order->id }}</li>
        <li><strong>Date:</strong> {{ $order->created_at->format('F j, Y') }}</li>
        <li><strong>Total Amount:</strong> ${{ number_format($order->total, 2) }}</li>
    </ul>

    <p>You will receive another email once your order has shipped.<br>
        Meanwhile, if you have any questions or need assistance,<br>
        feel free to contact our support team at <br>
        <a style="color: #d4a15d;" href="mailto:{{ $supportEmail }}">{{ $supportEmail }}</a> or call us at {{
        $supportPhone }}.
    </p>

    <p>Thank you for choosing <strong style="color: #d4a15d;">{{ $companyName }}</strong>! We look forward to serving
        you again.</p>

    <br>
    <p>Best regards,<br>{{ $companyName }} Team</p>
</div>