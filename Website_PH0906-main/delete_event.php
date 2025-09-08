<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $event_date = $_POST['event_date'] ?? '';
    $event_title = $_POST['event_title'] ?? '';
    if ($event_date !== '' && $event_title !== '') {
        $stmt = $conn->prepare("DELETE FROM events WHERE event_date = ? AND event_title = ? LIMIT 1");
        $stmt->bind_param("ss", $event_date, $event_title);
        $success = $stmt->execute();
        $stmt->close();
        echo json_encode(['success' => $success]);
    } else {
        echo json_encode(['success' => false]);
    }
} else {
    echo json_encode(['success' => false]);
}
$conn->close();
?>
