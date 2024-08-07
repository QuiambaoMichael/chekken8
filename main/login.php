<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
require 'config.php'; // Ensure this file correctly initializes $mysqli


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve user input safely
    $username = isset($_POST['username']) ? trim($_POST['username']) : '';
    $password = isset($_POST['password']) ? trim($_POST['password']) : '';

    // Validate input
    if (empty($username) || empty($password)) {
        header('Location: index.php?error=Please enter both username and password');
        exit();
    }

    // Check if the mysqli connection is valid
    if ($mysqli->ping()) {
        echo 'Database connection is active.<br>';

        // Prepare SQL statement
        $stmt = $mysqli->prepare('SELECT EmployeeID, Username, Password, RoleID FROM Employee WHERE Username = ?');
        if ($stmt === false) {
            die('Prepare failed: ' . htmlspecialchars($mysqli->error));
        } else {
            echo 'Statement prepared successfully.<br>';
        }

        // Bind and execute statement
        $stmt->bind_param('s', $username);
        $stmt->execute();
        
        // Check for execution errors
        if ($stmt->error) {
            die('Execute failed: ' . htmlspecialchars($stmt->error));
        } else {
            echo 'Query executed successfully.<br>';
        }

        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        // Debug output
        echo '<pre>';
        echo 'Fetched user data:<br>';
        print_r($user);
        echo '</pre>';

        // Verify password and handle login
        if ($user && password_verify($password, $user['Password'])) {
            echo 'Password verification successful.<br>';

            // Store user info in session
            $_SESSION['username'] = $user['Username'];
            $_SESSION['role'] = $user['RoleID'];

            // Redirect based on role
            switch ($user['RoleID']) {
                case 1:
                    header('Location: administrator/index.php');
                    break;
                case 2:
                    header('Location: cashier/cashier.php');
                    break;
                default:
                    header('Location: index.php');
                    break;
            }
            exit();
        } else {
            echo 'Invalid credentials.<br>';
            // Redirect to login page with an error
            header('Location: index.php?error=Invalid credentials');
            exit();
        }
    } else {
        die('Connection error: ' . htmlspecialchars($mysqli->error));
    }
}
?>
