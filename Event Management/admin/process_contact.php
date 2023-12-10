<?php
// process_contact.php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate and sanitize the form data
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $subject = filter_input(INPUT_POST, 'subject', FILTER_SANITIZE_STRING);
    $message = filter_input(INPUT_POST, 'message', FILTER_SANITIZE_STRING);

    // Check if all required fields are filled
    if ($name && $email && $subject && $message) {
        // Database connection
        require_once('db_connection.php');

        // Insert the contact information into the database
        $insertQuery = "INSERT INTO contact_us (name, email, subject, message) VALUES (?, ?, ?, ?)";
        $insertStatement = $conn->prepare($insertQuery);
        $insertStatement->bind_param("ssss", $name, $email, $subject, $message);

        if ($insertStatement->execute()) {
            echo "Thank you for contacting us! We will get back to you soon.";
        } else {
            echo "Error inserting contact information: " . $insertStatement->error;
        }

        $insertStatement->close();
        $conn->close();
    } else {
        echo "Please fill in all required fields.";
    }
} else {
    echo "Invalid request.";
}
