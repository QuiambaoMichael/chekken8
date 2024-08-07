<?php
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

// Handle form submission for adding and deleting events
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['delete'])) {
        // Handle delete event
        $eventID = $_POST['eventID'];
        $sql = "DELETE FROM event WHERE EventID = $eventID";

        if ($conn->query($sql) === TRUE) {
            echo "Event deleted successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        // Handle add event
        $name = $_POST['name'];
        $date = $_POST['date'];
        $description = $_POST['description'];

        $sql = "INSERT INTO event (Name, Date, Description) VALUES ('$name', '$date', '$description')";

        if ($conn->query($sql) === TRUE) {
            echo "New event created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

// Fetch the event data
$sql = "SELECT EventID, Name, Date, Description FROM event";
$result = $conn->query($sql);
?>
