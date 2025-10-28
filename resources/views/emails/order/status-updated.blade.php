<html>
    <head>
        <title>Order Status Updated</title>
    </head>
    <body>
        <h1>Order Status Updated</h1>
        <p>Hello {{ $order->full_name }},</p>
        <p>Your car rental order status has been updated to:</p>
        <p><strong>{{ ucfirst($order->status) }}</strong></p>
        <h2>Order Details</h2>
        <ul>
            <li><strong>Car:</strong> {{ trans_field(optional($order->car)->name) ?? 'N/A' }}</li>
            <li><strong>Pickup:</strong> {{ \Carbon\Carbon::parse($order->pickup_datetime)->format('d M Y H:i') }}</li>
            <li><strong>Dropoff:</strong> {{ \Carbon\Carbon::parse($order->dropoff_datetime)->format('d M Y H:i') }}</li>
            <li><strong>Total:</strong> {{ number_format($order->grand_total, 2) }} AED</li>
        </ul>
        <p>If you have any questions, please contact us.</p>
        <p>Thanks,</p>
        <p>{{ config('app.name') }}</p>
    </body>
</html>

