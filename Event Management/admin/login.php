<?php
// Replace the database credentials with your own
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "event_management";

// Retrieve the username and password from the form
$user = $_POST['username'];
$pass = $_POST['password'];

// Create a database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check for connection errors
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to check if the provided username and password match the manager credentials
$sql = "SELECT * FROM managers WHERE username = '$user' AND password = '$pass'";
$result = $conn->query($sql);

// Check if the query returned any rows
if ($result->num_rows > 0) {
    // Authentication successful, redirect to view-events.php
    header("Location: view-events.php");
} else {
    // Authentication failed, redirect back to the login form with an error message
   // header("Location: login-form.php?error=1");
}

// Close the database connection
$conn->close();
?>
