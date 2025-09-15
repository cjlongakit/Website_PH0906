<?php
include 'db.php';

// Reset the password for PH906 ID 0906700
$ph906 = '0906700';
$newPassword = '123456';

// Update the password in the database
$stmt = $conn->prepare("UPDATE admin SET password = ? WHERE ph906 = ?");
$stmt->bind_param("ss", $newPassword, $ph906);

if ($stmt->execute()) {
    echo "<script>alert('Password reset successfully to 123456.'); window.location.href='login.php';</script>";
} else {
    echo "<script>alert('Failed to reset password. Please try again.'); window.history.back();</script>";
}

$stmt->close();
?>