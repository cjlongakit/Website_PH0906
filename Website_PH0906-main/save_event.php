<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $event_date = $_POST['event_date'];
    $event_title = $_POST['event_title'];

    $stmt = $conn->prepare("INSERT INTO events (event_date, event_title) VALUES (?, ?)");
    $stmt->bind_param("ss", $event_date, $event_title);

    if ($stmt->execute()) {
        echo json_encode(["success" => true, "message" => "Event saved successfully."]);
    } else {
        echo json_encode(["success" => false, "message" => "Failed to save event."]);
    }

    $stmt->close();
    $conn->close();
}
?>
