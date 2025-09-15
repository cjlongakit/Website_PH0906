<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['validate_ph906'])) {
    $ph906 = $_POST['ph906'];

    // Check if ph906 exists in the database
    $checkStmt = $conn->prepare("SELECT first_name, last_name FROM masterlist WHERE ph906 = ?");
    if (!$checkStmt) {
        die(json_encode(["error" => "Prepare failed: " . $conn->error]));
    }
    $checkStmt->bind_param("s", $ph906);
    $checkStmt->execute();
    $checkStmt->bind_result($firstName, $lastName);

    if ($checkStmt->fetch()) {
        echo json_encode(["valid" => true, "first_name" => $firstName, "last_name" => $lastName]);
    } else {
        echo json_encode(["valid" => false]);
    }
    $checkStmt->close();
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ph906 = $_POST['ph906'];
    $name = $_POST['name'];
    $address = $_POST['address'];
    $type = $_POST['type'];
    $deadline = $_POST['deadline'];
    $status = 'PENDING';

    // Check if ph906 exists in the database
    $checkStmt = $conn->prepare("SELECT COUNT(*) FROM masterlist WHERE ph906 = ?");
    if (!$checkStmt) {
        die("Prepare failed: " . $conn->error);
    }
    $checkStmt->bind_param("s", $ph906);
    $checkStmt->execute();
    $checkStmt->bind_result($count);
    $checkStmt->fetch();
    $checkStmt->close();

    if ($count === 0) {
        echo "<script>alert('No ID found'); window.history.back();</script>";
        exit();
    }

    $stmt = $conn->prepare("INSERT INTO students (ph906, name, address, type, deadline, status) VALUES (?, ?, ?, ?, ?, ?)");
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }
    $stmt->bind_param("ssssss", $ph906, $name, $address, $type, $deadline, $status);
    if (!$stmt->execute()) {
        die("Execute failed: " . $stmt->error);
    }

    header("Location: home.php");
    exit();
}
?>