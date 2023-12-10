<?php
// Process and save the inquiry form data

if (isset($_POST['submit'])) {
  require_once('db_connection.php');

  $name = $_POST['name'];
  $email = $_POST['email'];
  $contactNumber = $_POST['contact_number'];
  $eventName = $_POST['event_name'];
  $eventDetails = $_POST['event_details'];
  $productInterest = $_POST['product_interest'];
  $eventType = $_POST['event_type'];

  // Insert the inquiry into the database
  $insertQuery = "INSERT INTO inquiries (name, email, contact_number, event_name, event_details, product_interest, event_type) 
                  VALUES (?, ?, ?, ?, ?, ?, ?)";
  $insertStatement = $conn->prepare($insertQuery);
  $insertStatement->bind_param("sssssss", $name, $email, $contactNumber, $eventName, $eventDetails, $productInterest, $eventType);

  if ($insertStatement->execute()) {
    echo "Inquiry submitted successfully.";
  } else {
    echo "Error: " . $insertStatement->error;
  }

  $insertStatement->close();
  $conn->close();
}

header("Location: home.html"); // Redirect to the user dashboard
exit();
?>
