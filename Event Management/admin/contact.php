<!DOCTYPE html>
<html>
<head>
  <title>Event Management - Contact Us</title>
  <link rel="stylesheet" type="text/css" href="styles.css">
    <style>
        .contact-section {
  background-color: #808080 ;
  padding: 40px;
}

.container {
  max-width: 800px;
  margin: 0 auto;
  background-color: grey;
}

.contact-details {
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  gap: 20px;
}

.contact-info {
  background-color: #fff;
  padding: 20px;
  border-radius: 10px;
}

.contact-form {
  background-color: #fff;
  padding: 20px;
  border-radius: 10px;
}

.contact-form form {
  display: grid;
  gap: 10px;
}

.contact-form label {
  font-weight: bold;
}

.contact-form input,
.contact-form textarea {
  width: 100%;
  padding: 8px;
  border-radius: 4px;
  border: 1px solid #ccc;
}

.contact-form button {
  background-color: #4CAF50;
  color: #fff;
  padding: 10px 16px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

.contact-form button:hover {
  background-color: #45a049;
}

.col{
  color: white;
}
    </style>
</head>
<body>
  <header class="header">
    <nav>

       <a class="nav-link" href="home.html">Home</a>
       <a class="nav-link" href="about.html">About</a>
       <a class="nav-link" href="contact.html">Contact Us</a>
      <!-- <a class="nav-link" href="location.html">Locate Us</a>-->
       <a class="nav-link" href="services.html">Services Offered</a>
       <a class="nav-link" href="user-inquiry.html">Book Appointment</a>
      
    </nav>
  </header>

  <section class="contact-section">
    <div class="container">
      <h2>Contact Us</h2>
      <p>We would love to hear from you! Reach out to us using the contact details below or fill out the form to send us a message.</p>
      
      <div class="contact-details">
        <div class="contact-info">
          <h3>Contact Information</h3>
          <p class="col"><a href="location.html"><strong>Address:</strong> Besides Gopal Tea Center, near Kranti Chowk, Aurangabad.</a></p>
          <p><strong>Phone:</strong> +91-8888888888</p>
          <p><strong>Email:</strong>info@eliteseo.co</p>
          <p><strong><div class="fa fa-map"><iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1876.1417848717742!2d75.32605078862031!3d19.870244468900662!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3bdb986495555555%3A0x382849c218298c38!2sGopal%20Tea%20Point!5e0!3m2!1sen!2sin!4v1687188237238!5m2!1sen!2sin" width="450" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe></strong></p>
            </div>
        </div>
        
        <div class="contact-form">
          <h3>Send us a message</h3>
          <form action="process_contact.php" method="POST">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>
            
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            
            <label for="message">Message:</label>
            <textarea id="message" name="message" required></textarea>
            
            <label for="subject">Subject:</label>
            <textarea name="subject" id="subject" required></textarea>

            <button type="submit">Send</button>
          </form>
        </div>
      </div>
    </div>
  </section>

  <!-- Rest of your content goes here -->

  <footer>
    <!-- Footer content goes here -->
  </footer>
</body>
</html>

<?php
// contact.php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize the form inputs
    $name = sanitizeInput($_POST["name"]);
    $email = sanitizeInput($_POST["email"]);
    $subject = sanitizeInput($_POST["subject"]);
    $message = sanitizeInput($_POST["message"]);

    // Create a new PDO connection (replace with your own database details)
    $dsn = 'localhost';
    $dbname='event_management';
    $username = 'root';
    $password = '';

    try {
        $conn = new PDO($dsn, $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Prepare and execute the SQL statement
        $sql = "INSERT INTO contact_us (name, email, subject, message) VALUES (:name, :email, :subject, :message)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':subject', $subject);
        $stmt->bindParam(':message', $message);
        $stmt->execute();

        echo "Thank you for contacting us! We will get back to you soon.";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

    // Close the database connection
    $conn = null;
}

// Function to sanitize form inputs
function sanitizeInput($input)
{
    $input = trim($input);
    $input = stripslashes($input);
    $input = htmlspecialchars($input);
    return $input;
}
?>

