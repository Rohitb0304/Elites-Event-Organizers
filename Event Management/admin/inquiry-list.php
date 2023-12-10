<!DOCTYPE html>
<html>
<head>
  <title>Inquiry List</title>
  <style>
    body {
      background-color: #f2f2f2;
      font-family: Arial, sans-serif;
    }

    .container {
      max-width: 800px;
      margin: 0 auto;
      padding: 20px;
      background-color: #fff;
      border-radius: 5px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    h1 {
      text-align: center;
      color: #333;
    }

    .inquiry {
      border: 1px solid #ccc;
      border-radius: 5px;
      padding: 20px;
      margin-bottom: 20px;
    }

    .inquiry h2 {
      color: #333;
      margin-bottom: 10px;
    }

    .inquiry p {
      color: #555;
      margin-bottom: 5px;
    }

    .inquiry .details {
      color: #777;
      margin-bottom: 10px;
    }

    .inquiry .details strong {
      color: #333;
    }

    .inquiry .product {
      font-weight: bold;
      color: #007bff;
    }

    .inquiry .event-type {
      font-style: italic , bold;
      color: #007bff;
    }

    .button-container {
      margin-top: 10px;
    }

    .button-container form {
      display: inline-block;
    }

    .button-container form input[type="submit"] {
      background-color: #007bff;
      color: #fff;
      border: none;
      padding: 5px 10px;
      cursor: pointer;
    }

    .button-container form input[type="submit"]:hover {
      background-color: #0056b3;
    }

  </style>
</head>
<body>
  <div class="container">
    <h1>Inquiry List</h1>
    <?php
    // Fetch and display inquiries from the database
    require_once('db_connection.php');

    $query = "SELECT * FROM inquiries";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $inquiryId = $row['id'];
        $name = $row['name'];
        $email = $row['email'];
        $contactNumber = $row['contact_number'];
        $eventName = $row['event_name'];
        $eventDetails = $row['event_details'];
        $productInterest = $row['product_interest'];
        $eventType = $row['event_type'];
        $isApproved = $row['is_approved'];

        echo '<div class="inquiry">';
        echo '<h2>Inquiry Subject</h2>';
        echo '<p>Name: '.$name.'</p>';
        echo '<p>Email: '.$email.'</p>';
        echo '<p>Contact Number: '.$contactNumber.'</p>';
        echo '<p>Event Name: '.$eventName.'</p>';
        echo '<p>Event Details: '.$eventDetails.'</p>';
        echo '<p>Product Interest: <span class="product">'.$productInterest.'</span></p>';
        echo '<p>Event Type: <span class="event-type">'.$eventType.'</span></p>';

        // Show approve/delete buttons if inquiry is not approved
      
        echo '</div>';
      }
    } else {
      echo '<p>No inquiries found.</p>';
    }

    $conn->close();
    ?>
  </div>
</body>
</html>
