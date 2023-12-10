<!DOCTYPE html>
<html>
<head>
  <title>Event Details</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <div class="container">
    <h1>Event Details</h1>
    <?php
    require_once('db_connection.php');

    if (isset($_GET['id'])) {
        $event_id = $_GET['id'];

        $sql = "SELECT * FROM events WHERE id = $event_id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $event = $result->fetch_assoc();
            echo "<h2>" . $event['title'] . "</h2>";
            echo "<p>Date: " . $event['date'] . "</p>";
        } else {
            echo "Event not found.";
        }
    } else {
        echo "Invalid event ID.";
    }

    $conn->close();
    ?>
  </div>
</body>
</html>
