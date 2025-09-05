<?php
session_start();
$conn = new mysqli("localhost", "root", "", "student_dashboard");

$username = $_POST['username'] ?? ''; 
$password = $_POST['password'] ?? '';

// Fetch user by username
$stmt = $conn->prepare("SELECT * FROM admin WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $user = $result->fetch_assoc();
    // Check password (plain text)
    if ($password === $user['password']) {
        $_SESSION['admin'] = $username;
        header("Location: home.php");
        exit();
    }
}

echo "<script>alert('Invalid login.'); window.location.href='login.php';</script>";
?>