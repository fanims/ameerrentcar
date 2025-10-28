<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Order Confirmation</title>
</head>

<body>
    <h2>New Order Received</h2>

    <p><strong>Name:</strong> {{ $order['full_name'] }}</p>
    <p><strong>Email:</strong> {{ $order['email'] }}</p>
    <p><strong>Phone:</strong> {{ $order['phone'] }}</p>
    <p><strong>Nationality:</strong> {{ $order['nationality'] ?? '—' }}</p>

    <p><strong>Pickup Date:</strong> {{ $order['pickup_date'] }}</p>
    <p><strong>Dropoff Date:</strong> {{ $order['dropoff_date'] }}</p>

        <p><strong>Pickup Time:</strong> {{ $order['pickup_time'] }}</p>
    <p><strong>Dropoff Time:</strong> {{ $order['dropoff_time'] }}</p>

    <p><strong>Delivery Location:</strong> {{ $order['delivery_location'] }}</p>
    <p><strong>Receiving Location:</strong> {{ $order['receiving_location'] }}</p>

    <p><strong>License Details:</strong> {{ $order['license_details'] ?? 'N/A' }}</p>
    <p><strong>Special Requests:</strong> {{ $order['special_requests'] ?? 'None' }}</p>

    <p><strong>Total:</strong> AED {{ $order['grand_total'] }}</p>

</body>

</html>