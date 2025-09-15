<?php
session_start();
include 'db.php';

$ph906 = $_SESSION['ph906'] ?? '';
if ($ph906 === '') {
    echo "<script>alert('No PH906 ID found.'); window.location.href='login.php';</script>";
    exit();
}

$last_name = $_POST['last_name'] ?? '';
$first_name = $_POST['first_name'] ?? '';
$contact_number = $_POST['contact_number'] ?? '';
$address = $_POST['address'] ?? '';

$stmt = $conn->prepare("UPDATE admin SET last_name=?, first_name=?, contact_number=?, address=? WHERE ph906=?");
$stmt->bind_param("sssss", $last_name, $first_name, $contact_number, $address, $ph906);
if ($stmt->execute()) {
    echo "<script>alert('Profile updated successfully!'); window.location.href='caseworkerprofile.php';</script>";
} else {
    echo "<script>alert('Update failed.'); window.location.href='caseworkerprofile.php';</script>";
}
$stmt->close();
$conn->close();
?>
