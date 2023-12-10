<!DOCTYPE html>
<html>
<head>
  <title>View Events</title>
  <link rel="stylesheet" type="text/css" href="style.css">
<style>
  /* style.css */
body {
  background-color: #f2f2f2;
  font-family: Arial, sans-serif;
}

.container {
  max-width: 600px;
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

.event-box {
  border: 1px solid #ccc;
  border-radius: 5px;
  padding: 10px;
  margin-bottom: 10px;
}

.event-box h2 {
  color: #007bff;
}

.event-details p {
  margin-bottom: 5px;
}

.event-details .materials {
  font-weight: bold;
}

.event-details .payment-status {
  color: #28a745;
}


</style>
</head>
<body>
  <div class="container">
    <h1>Upcoming Events</h1>
    <?php
    // Check if the user is authenticated as staff
    // You can implement your own authentication logic here

    // If the user is not authenticated or not staff, redirect them to a login page or display an access denied message

    // Assuming the user is authenticated as staff, continue with displaying the events

    require_once('db_connection.php');

    $sql = "SELECT * FROM events";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $eventId = $row['id'];
            $title = $row['title'];
            $date = $row['date'];
            $maxAttendees = $row['max_attendees'];
            $venue = $row['venue'];
            $eventTime = $row['event_time'];
            $materials = $row['materials'];
            $paymentStatus = $row['payment_status'];

            echo '<div class="event-box">';
            echo '<h2>' . $title . '</h2>';
            echo '<div class="event-details">';
            echo '<p><strong>Date:</strong> ' . $date . '</p>';
            echo '<p><strong>Max Attendees:</strong> ' . $maxAttendees . '</p>';
            echo '<p><strong>Venue:</strong> ' . $venue . '</p>';
            echo '<p><strong>Time:</strong> ' . $eventTime . '</p>';
            echo '<p class="materials"><strong>Materials Required:</strong> ' . $materials . '</p>';
            echo '<p class="payment-status"><strong>Payment Status:</strong> ' . $paymentStatus . '</p>';
            echo '</div>';
            echo '</div>';
        }
    } else {
        echo 'No events found.';
    }

    $conn->close();
    ?>
  </div>
</body>
</html>
