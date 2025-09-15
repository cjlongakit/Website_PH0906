<?php
session_start();
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $currentPassword = $_POST['current_password'];
    $newPassword = $_POST['new_password'];
    $confirmPassword = $_POST['confirm_password'];

    // Validate new password and confirmation match
    if ($newPassword !== $confirmPassword) {
        echo "<script>alert('New password and confirmation do not match.'); window.history.back();</script>";
        exit();
    }

    // Debugging: Check session variable
    error_log("Session ph906: " . $_SESSION['ph906']);

    // Fallback for testing
    if (!isset($_SESSION['ph906'])) {
        $_SESSION['ph906'] = '0906700'; // Manually set for testing
        error_log("Fallback ph906 set to: " . $_SESSION['ph906']);
    }

    // Fetch the current password from the database
    $stmt = $conn->prepare("SELECT password FROM admin WHERE ph906 = ?");
    $stmt->bind_param("s", $_SESSION['ph906']); // Assuming ph906 is stored in session
    $stmt->execute();
    $result = $stmt->get_result();
    $admin = $result->fetch_assoc();
    $stmt->close();

    // Debugging: Check fetched password
    if (!$admin) {
        echo "<script>alert('No admin found for the given PH906 ID.'); window.history.back();</script>";
        exit();
    }

    if ($currentPassword !== $admin['password']) {
        echo "<script>alert('Current password is incorrect.'); window.history.back();</script>";
        exit();
    }

    // Update the password in the database
    $stmt = $conn->prepare("UPDATE admin SET password = ? WHERE ph906 = ?");
    $stmt->bind_param("ss", $newPassword, $_SESSION['ph906']);
    if ($stmt->execute()) {
        echo "<script>alert('Password changed successfully.'); window.location.href='home.php';</script>";
    } else {
        echo "<script>alert('Failed to change password. Please try again.'); window.history.back();</script>";
    }
    $stmt->close();
}
?>
