<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id']; // Get the unique id from the form

    $stmt = $conn->prepare("DELETE FROM students WHERE id = ?"); // Use id for deletion
    $stmt->bind_param("i", $id);
    $stmt->execute();

    header("Location: home.php");
    exit();
}
?>