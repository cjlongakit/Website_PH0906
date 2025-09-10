<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ph906 = $_POST['ph906'] ?? '';
    $last_name = $_POST['last_name'] ?? '';
    $first_name = $_POST['first_name'] ?? '';
    $teacher = $_POST['teacher'] ?? '';
    $mobile = $_POST['mobile'] ?? '';
    $nickname = $_POST['nickname'] ?? '';
    $mobile_number = $_POST['mobile_number'] ?? '';
    $address = $_POST['address'] ?? '';
    $guardian_name = $_POST['guardian_name'] ?? '';
    $guardian_mobile = $_POST['guardian_mobile'] ?? '';
    $water_baptized = $_POST['water_baptized'] ?? '';
    $caseworker_assigned = $_POST['caseworker_assigned'] ?? '';

    if ($ph906 === '' || $last_name === '' || $first_name === '' || $teacher === '') {
        echo "<script>alert('All fields are required.'); window.history.back();</script>";
        exit();
    }

    $stmt = $conn->prepare("UPDATE masterlist SET last_name=?, first_name=?, teacher=?, mobile=?, nickname=?, mobile_number=?, address=?, guardian_name=?, guardian_mobile=?, water_baptized=?, caseworker_assigned=? WHERE ph906=?");
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }
    $stmt->bind_param("ssssssssssss", $last_name, $first_name, $teacher, $mobile, $nickname, $mobile_number, $address, $guardian_name, $guardian_mobile, $water_baptized, $caseworker_assigned, $ph906);

    if ($stmt->execute()) {
        echo "<script>alert('Profile updated successfully!'); window.location.href='studentprofile.php?ph906=$ph906';</script>";
    } else {
        echo "<script>alert('Update failed.'); window.location.href='studentprofile.php?ph906=$ph906';</script>";
    }
    $stmt->close();
    $conn->close();
}
?>
