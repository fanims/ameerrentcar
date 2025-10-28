<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Deleted</title>
</head>

<body>
    <h1>Order Deleted</h1>

    <p>Dear {{ $order->full_name }},</p>

    <p>We want to inform you that your recent car rental order has been deleted from our system.</p>

    <hr>

    <h2>🚗 Order Details</h2>

    <ul>
        <li><strong>Order ID:</strong> #{{ $order->id }}</li>
        <li><strong>Car:</strong> {{ trans_field(optional($order->car)->name) ?? 'N/A' }}</li>
        <li><strong>Pickup Location:</strong> {{ $order->pickup_location ?? 'N/A' }}</li>
        <li><strong>Pickup Date:</strong> {{ \Carbon\Carbon::parse($order->pickup_datetime)->format('d M Y') }}</li>
        <li><strong>Dropoff Location:</strong> {{ $order->dropoff_location ?? 'N/A' }}</li>
        <li><strong>Dropoff Date:</strong> {{ \Carbon\Carbon::parse($order->dropoff_datetime)->format('d M Y') }}</li>
        <li><strong>Pickup Time:</strong> {{ \Carbon\Carbon::parse($order->pickup_datetime)->format('H:i') }}</li>
        <li><strong>Dropoff Time:</strong> {{ \Carbon\Carbon::parse($order->dropoff_datetime)->format('H:i') }}</li>
        <li><strong>Total Amount:</strong> {{ number_format($order->grand_total, 2) }} AED</li>

        @if($order->additional_driver)
        <li><strong>Additional Driver:</strong> Yes</li>
        @endif

        @if($order->special_request)
        <li><strong>Special Request:</strong> {{ $order->special_request }}</li>
        @endif
    </ul>

    <hr>

    <p>If this was a mistake or you need assistance, please contact our support team.</p>

    <!-- Uncomment the following line if you want to include a contact button -->
    <!-- <a href="{{ url('/') }}" style="display: inline-block; background-color: #007BFF; color: #FFFFFF; padding: 10px 20px; text-decoration: none; border-radius: 5px;">Contact Us</a> -->

    <p>Thanks,<br>{{ config('app.name') }}</p>

</body>

</html>

