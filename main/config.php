<?php
// Database configuration


// Set custom error handler

$host = 'localhost';
$db = 'chekken';
$user = 'root';
$pass = '1234';

// Create a new mysqli connection
$mysqli = new mysqli($host, $user, $pass, $db);

// Check connection
if ($mysqli->connect_error) {
    die('Connection failed: ' . $mysqli->connect_error);
}
?>
