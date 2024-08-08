<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
require '../config.php'; // Ensure this file correctly initializes $mysqli

// Verify that EmployeeID is set correctly
if (!isset($_SESSION['emp']) || $_SESSION['emp'] === 'Unknown') {
    die('EmployeeID is not set or is unknown.');
}

// Retrieve values from POST request
$employeeID = $_SESSION['emp'];
$transactionID = isset($_POST['transactionID']) ? trim($_POST['transactionID']) : '';
$amount = isset($_POST['amount']) ? floatval($_POST['amount']) : 0.0;
$datetime = isset($_POST['datetime']) ? trim($_POST['datetime']) : '';

// Prepare and execute insert into transaction table
$transactionQuery = $mysqli->prepare("INSERT INTO transaction (EmployeeID, TransactionID, Amount, date, Type) VALUES (?, ?, ?, ?, ?)");
if ($transactionQuery === false) {
    die('Prepare failed: ' . htmlspecialchars($mysqli->error));
}
$type = 'Cash-in'; // Default value for Type
$transactionQuery->bind_param('ssiss', $employeeID, $transactionID, $amount, $datetime, $type);
$transactionQuery->execute();
if ($transactionQuery->error) {
    die('Execute failed: ' . htmlspecialchars($transactionQuery->error));
}
$transactionQuery->close();

// Prepare and execute insert into money_on_hand table
$moneyOnHandQuery = $mysqli->prepare("INSERT INTO money_on_hand (EmployeeID, TransactionID, Amount, date,Type) VALUES (?, ?, ?, ?, ?)");
if ($moneyOnHandQuery === false) {
    die('Prepare failed: ' . htmlspecialchars($mysqli->error));
}
$moneyOnHandQuery->bind_param('ssiss', $employeeID, $transactionID, $amount, $datetime,$type);
$moneyOnHandQuery->execute();
if ($moneyOnHandQuery->error) {
    die('Execute failed: ' . htmlspecialchars($moneyOnHandQuery->error));
}
$moneyOnHandQuery->close();

// Close the database connection
$mysqli->close();

// Redirect to index page
header('Location: index.php');
exit();
?>
