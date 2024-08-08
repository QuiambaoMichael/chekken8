<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
require '../config.php'; // Ensure this file correctly initializes $mysqli

// Query to get the total amount from the money_on_hand table
$query = "SELECT SUM(Amount) AS totalAmount FROM money_on_hand";
$result = $mysqli->query($query);

if (!$result) {
    die('Query failed: ' . htmlspecialchars($mysqli->error));
}

$row = $result->fetch_assoc();
$totalAmount = $row['totalAmount'] ? $row['totalAmount'] : 0.00; // Default to 0.00 if NULL

$mysqli->close();

// Output the total amount as a JSON response
header('Content-Type: application/json');
echo json_encode(['totalAmount' => number_format($totalAmount, 2)]);
?>