<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id']; // Get the unique id from the form
    $status = $_POST['status']; // Get the new status

    $stmt = $conn->prepare("UPDATE students SET status = ? WHERE id = ?"); // Use id for updating status
    $stmt->bind_param("si", $status, $id);
    $stmt->execute();

    header("Location: home.php");
    exit();
}
?>