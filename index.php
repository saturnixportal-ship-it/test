<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book a redelivery | Royal Mail</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        body {font-family: Arial, Helvetica, sans-serif; margin:0; background:#f8f8f8;}
        .dualheader {background:#2A2A2D; color:white; padding:15px 0;}
        .container {max-width:1100px; margin:auto; padding:0 20px;}
        .header-content {display:flex; align-items:center; justify-content:space-between;}
        .logo img {height:45px;}
        .main-content {background:white; max-width:800px; margin:40px auto; padding:40px; box-shadow:0 4px 12px rgba(0,0,0,0.1);}
        h1 {color:#2A2A2D; font-size:28px;}
        label {font-weight:600; display:block; margin:20px 0 8px;}
        input[type=text] {width:100%; padding:14px; border:2px solid #ccc; font-size:16px;}
        button {background:#E4002B; color:white; padding:16px 32px; border:none; font-size:18px; cursor:pointer; margin-top:20px;}
        button:hover {background:#c40025;}
        .breadcrumb {font-size:14px; color:#666; margin-bottom:20px;}
    </style>
</head>
<body>

<header class="dualheader">
    <div class="container header-content">
        <div class="logo">
            <img src="https://www.royalmail.com/themes/custom/rmlcwr/dualrmglogo.svg" alt="Royal Mail">
        </div>
        <div style="font-size:18px;">Redelivery Booking</div>
    </div>
</header>

<div class="container main-content">
    <div class="breadcrumb">Home &gt; Receiving mail &gt; Redelivery</div>
    
    <h1>Book a redelivery</h1>
    <p style="font-size:17px;">Enter your booking reference or tracking number below.</p>

    <form action="step1.php" method="POST">
        <label>Booking ID or Tracking Number</label>
        <input type="text" name="booking_id" placeholder="e.g. RM123456789GB" required>
        
        <button type="submit">Continue</button>
    </form>
</div>

<footer style="background:#2A2A2D; color:#ccc; text-align:center; padding:30px; font-size:14px;">
    © Royal Mail Group Limited 2025<br>
    <a href="#" style="color:#ccc; margin:0 10px;">Privacy</a>
    <a href="#" style="color:#ccc; margin:0 10px;">Terms</a>
    <a href="#" style="color:#ccc; margin:0 10px;">Cookies</a>
</footer>

</body>
</html>
