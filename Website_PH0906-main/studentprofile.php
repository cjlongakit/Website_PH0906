<?php
session_start();
include 'db.php';

$ph906 = $_GET['ph906'] ?? '';
if ($ph906 === '') {
    echo "<script>alert('No PH906 ID provided.'); window.history.back();</script>";
    exit();
}

$stmt = $conn->prepare("SELECT ph906, first_name, last_name, teacher FROM masterlist WHERE ph906 = ? LIMIT 1");
if (!$stmt) {
    die("Prepare failed: " . $conn->error);
}
$stmt->bind_param("s", $ph906);
$stmt->execute();
$result = $stmt->get_result();
$student = $result->fetch_assoc();
$stmt->close();

if (!$student) {
    echo "<script>alert('Student not found.'); window.history.back();</script>";
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Student Profile</title>
  <link rel="stylesheet" href="home.css" />
  <link rel="stylesheet" href="studentprofile.css" />
</head>
<body>
  <div class="home-container">
    <div style="display:flex;align-items:center;gap:1rem;">
      <button onclick="window.history.back()" class="back-btn">BACK</button>
      <img src="ph0906logo.png" alt="Church Icon" class="icon" style="height:3rem;">
      <h1 style="margin:0;font-size:2.2rem;">HELLO, <span class="highlight">PH0906!</span></h1>
    </div>
    <div class="profile-card">
      <div class="profile-photo"></div>
      <div class="profile-info">
        <h2 id="profile-ph906">PH0906- <?php echo htmlspecialchars($student['ph906'] ?? ''); ?></h2>
        <hr>
        <div class="profile-fields">
          <div><b>Last Name:</b> <?php echo htmlspecialchars($student['last_name'] ?? ''); ?></div>
          <div><b>First Name:</b> <?php echo htmlspecialchars($student['first_name'] ?? ''); ?></div>
          <div><b>Mobile:</b> </div>
          <div><b>Nickname:</b> </div>
          <div><b>Mobile #:</b> </div>
          <div><b>Address:</b> </div>
          <div><b>Guardian’s Full name:</b> </div>
          <div><b>Guardian’s mobile #:</b> </div>
          <div><b>Water Baptized:</b> </div>
          <div><b>Teacher:</b> <?php echo htmlspecialchars($student['teacher'] ?? ''); ?></div>
          <div><b>Type:</b> </div>
          <div><b>Deadline:</b> </div>
          <div><b>Status:</b> </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>