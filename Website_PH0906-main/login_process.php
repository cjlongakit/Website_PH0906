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
    // Debugging: Check fetched user data
    error_log("Fetched user: " . print_r($user, true));

    // Check password directly
    if ($password === $user['password']) {
        $_SESSION['admin'] = $username;
        $_SESSION['ph906'] = $user['ph906']; // Store ph906 in session
        error_log("Session ph906 set to: " . $_SESSION['ph906']);
        header("Location: home.php");
        exit();
    }
}

echo "<script>alert('Invalid login.'); window.location.href='login.php';</script>";
?>