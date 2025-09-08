<?php
session_start();
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ph906 = $_POST['ph906'] ?? '';
    $history_text = $_POST['history_text'] ?? '';

    if ($ph906 === '' || $history_text === '') {
        echo "<script>alert('Invalid input.'); window.history.back();</script>";
        exit();
    }

    // Insert history entry without admin name
    $stmt = $conn->prepare("INSERT INTO student_history (ph906, history_text, timestamp) VALUES (?, ?, NOW())");
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }
    $stmt->bind_param("ss", $ph906, $history_text);
    if ($stmt->execute()) {
        echo "<script>alert('History saved successfully.'); window.location.href='studentprofile.php?ph906=" . $ph906 . "';</script>";
    } else {
        echo "<script>alert('Failed to save history.'); window.history.back();</script>";
    }
    $stmt->close();
}
?>
