<?php
if (basename($_SERVER['SCRIPT_FILENAME']) !== 'index.php') {
    // Set the HTTP response code to 403 Forbidden
    http_response_code(403);
    
    // Include the custom 403 error page content
    include '403.php';
    
    // Exit to prevent further script execution
    exit();
}
$page_exists = true; // Replace with your actual logic to check if the page exists

if (!$page_exists) {
    // Set the HTTP response code to 404 Not Found
    http_response_code(404);
    
    // Include the custom 404 error page content
    include '404.php';
    
    // Exit to prevent further script execution
    exit();
}
function handle_error($errno, $errstr, $errfile, $errline) {
    // Set the HTTP response code to 500 Internal Server Error
    http_response_code(500);
    
    // Include the custom 500 error page content
    include '500.php';
    
    // Exit to prevent further script execution
    exit();
}

session_start();

// Set session timeout period in seconds
$timeout_duration = 100; // 30 minutes




// Check if the user is logged in and has the 'admin' role
if (!isset($_SESSION['username']) || $_SESSION['role'] != '1') {
    // Redirect to login page if not logged in or not an admin
    header('Location: ../index.php');
    exit();
}
// Check if the timeout period has passed
if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity']) > $timeout_duration) {
    session_unset();
    session_destroy();
    header('Location: ../index.php');
    exit();
}

$_SESSION['last_activity'] = time(); // Update last activity time

$servername = "localhost";
$username = "root";
$password = "1234";
$dbname = "chekken";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission for deleting employees
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])) {
    // Handle delete employee
    $employeeID = intval($_POST['employeeID']); // Sanitize input
    $stmt = $conn->prepare("DELETE FROM Employee WHERE EmployeeID = ?");
    $stmt->bind_param("i", $employeeID);

    if ($stmt->execute()) {
        echo "Employee deleted successfully";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}

// Define SQL query for employee data
$sqlEmployee = "SELECT * FROM Employee";

// Execute the query and fetch results
$resultEmployee = $conn->query($sqlEmployee);

// Close connection
$conn->close();
?>
