<!DOCTYPE html>
<html>
<head>
  <title>Create Event</title>
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

form {
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
}

label {
  font-weight: bold;
  color: #333;
  margin-bottom: 5px;
}

input[type="text"],
input[type="date"],
input[type="number"],
input[type="time"],
textarea,
select {
  width: 100%;
  padding: 10px;
  margin-bottom: 10px;
  border: 1px solid #ccc;
  border-radius: 4px;
}

input[type="submit"] {
  background-color: #007bff;
  color: #fff;
  border: none;
  padding: 10px 20px;
  cursor: pointer;
}

input[type="submit"]:hover {
  background-color: #0056b3;
}
.hompg{
    align: right;
}

  </style>
</head>
<body>
    <div class="hompg">
    <a href="index.html">Go to HomePage</a>
  </div>
    <div class="container">
    <h1>Create Event</h1>
    <div>
      <form action="create-event.php" method="post">
        <label for="title">Event Title:</label>
        <input type="text" name="title" id="title" required>
        <label for="date">Event Date:</label>
        <input type="date" name="date" id="date" required>
        <label for="max_attendees">Max Attendees:</label>
        <input type="number" name="max_attendees" id="max_attendees" required>
        <label for="venue">Venue:</label>
        <input type="text" name="venue" id="venue" required>
        <label for="event_time">Time:</label>
        <input type="time" name="event_time" id="event_time" required>
        <label for="materials">Materials Required:</label>
        <textarea name="materials" id="materials"></textarea>
        <label for="payment_status">Payment Status:</label>
        <select name="payment_status" id="payment_status">
          <option value="pending">Pending</option>
          <option value="paid">Paid</option>
        </select>
        <input type="submit" name="submit" value="Create Event">
      </form>
    </div>
    <?php
    if (isset($_POST['submit'])) {
      require_once('db_connection.php');

      $title = $_POST['title'];
      $date = $_POST['date'];
      $maxAttendees = $_POST['max_attendees'];
      $venue = $_POST['venue'];
      $eventTime = $_POST['event_time'];
      $materials = $_POST['materials'];
      $paymentStatus = $_POST['payment_status'];

      // Validate event date
      if (strtotime($date) < strtotime('today')) {
        echo "Error: Invalid event date. Please select a future date.";
      } else {
        // Check if event title already exists
        $checkQuery = "SELECT COUNT(*) AS count FROM events WHERE title = ?";
        $checkStatement = $conn->prepare($checkQuery);
        $checkStatement->bind_param("s", $title);
        $checkStatement->execute();
        $checkResult = $checkStatement->get_result();
        $count = $checkResult->fetch_assoc()['count'];
        $checkStatement->close();

        if ($count > 0) {
          echo "Error: Event title already exists. Please choose a different title.";
        } else {
          $insertQuery = "INSERT INTO events (title, date, max_attendees, venue, event_time, materials, payment_status) 
                          VALUES (?, ?, ?, ?, ?, ?, ?)";
          $insertStatement = $conn->prepare($insertQuery);
          $insertStatement->bind_param("ssissss", $title, $date, $maxAttendees, $venue, $eventTime, $materials, $paymentStatus);
          if ($insertStatement->execute()) {
            echo "Event created successfully.";
          } else {
            echo "Error: " . $insertStatement->error;
          }
          $insertStatement->close();
        }
      }
      $conn->close();
    }
    ?>
  </div>

</body>
</html>
