<!DOCTYPE html>
<html>
<head>
  <title>Event List</title>
  <link rel="stylesheet" type="text/css" href="style.css">
  <style>
    .container {
  max-width: 600px;
  margin: 0 auto;
  padding: 20px;
  background-color: #f2f2f2;
}

h1 {
  text-align: center;
  color: #333;
}

.event-box {
  background-color: #fff;
  border: 1px solid #ccc;
  border-radius: 4px;
  padding: 20px;
  margin-bottom: 20px;
}

h2 {
  color: #333;
  margin-top: 0;
  margin-bottom: 10px;
}

.event-details {
  color: #666;
}

.event-details p {
  margin: 0;
}

.event-details strong {
  color: #333;
}

.materials {
  white-space: pre-line;
}

.payment-status {
  font-weight: bold;
}


  </style>
</head>
<body>
  <div class="event-box">
    <h1>Event List</h1>
   <!-- <p><a href="view-events.php">View Events</a></p>-->
    <?php
    require_once('db_connection.php');

    $sql = "SELECT * FROM events";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {

        while ($row = $result->fetch_assoc()) {
            echo "<div class ='event-box'>";
            echo "<h2>" . $row['title'] . "</h2>";
            echo "<p>Date: " . $row['date'] . "</p>";
            echo "<p>Max Attendees: " . $row['max_attendees'] . "</p>";
            echo "<p>Venue: " . $row['venue'] . "</p>";
            echo "<p>Time: " . $row['event_time'] . "</p>";
            echo "<p>Materials Required: " . $row['materials'] . "</p>";
            echo "<p>Payment Status: " . $row['payment_status'] . "</p>";
            echo "</div>";
        }

    } else {
        echo "No events found.";
    }

    $conn->close();
    ?>
  </div>
</body>
</html>
