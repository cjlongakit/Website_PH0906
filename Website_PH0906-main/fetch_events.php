<?php
include 'db.php';

$result = $conn->query("SELECT event_date, event_title FROM events");
$events = [];

while ($row = $result->fetch_assoc()) {
    $events[$row['event_date']][] = $row['event_title']; // Group events by date
}

echo json_encode($events);

$conn->close();
?>
