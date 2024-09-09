<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = isset($_POST['username']) ? trim($_POST['username']) : '';
    $password = isset($_POST['password']) ? trim($_POST['password']) : '';

    if (empty($username) || empty($password)) {
        header('Location: index.php?error=Please enter both username and password');
        exit();
    }

    if ($mysqli->ping()) {
        $stmt = $mysqli->prepare('SELECT * FROM Employee WHERE Username = ?');
        if ($stmt === false) {
            die('Prepare failed: ' . htmlspecialchars($mysqli->error));
        }

        $stmt->bind_param('s', $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        // Debug output to check fetched user data
    

        // if ($user && password_verify($password, $user['Password'])) {
            if ($user && $password) {
            $_SESSION['username'] = $user['Username'];
            $_SESSION['role'] = $user['RoleID'];
            $_SESSION['emp'] = $user['EmployeeID'];
            $_SESSION['empName'] = $user['Name'];// Store EmployeeID in session
        
            // Debug output to check session variables
         

            switch ($user['RoleID']) {
                case 1:
                    header('Location: administrator/index.php');
                    break;
                case 2:
                    header('Location: cashier/index.php');
                    break;
                default:
                    header('Location: index.php');
                    break;
            }
            exit();
        } else {
            header('Location: index.php?error=Invalid credentials');
            exit();
        }
    } else {
        die('Connection error: ' . htmlspecialchars($mysqli->error));
    }
}
?>
