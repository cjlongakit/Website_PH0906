<?php
session_start();
include 'db.php';

$ph906 = $_SESSION['ph906'] ?? '';
if ($ph906 === '') {
  echo "<script>alert('No PH906 ID found.'); window.location.href='login.php';</script>";
  exit();
}

$stmt = $conn->prepare("SELECT last_name, first_name, contact_number, address FROM admin WHERE ph906 = ? LIMIT 1");
if (!$stmt) {
  die("Prepare failed: " . $conn->error);
}
$stmt->bind_param("s", $ph906);
$stmt->execute();
$result = $stmt->get_result();
$admin = $result->fetch_assoc();
$stmt->close();

$last_name = $admin['last_name'] ?? '';
$first_name = $admin['first_name'] ?? '';
$contact_number = $admin['contact_number'] ?? '';
$address = $admin['address'] ?? '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Caseworker Profile</title>
  <link rel="stylesheet" href="home.css" />
  <link rel="stylesheet" href="studentprofile.css" />
  <style>
    body {
      background: url('darkbluebackground.png') no-repeat center center fixed;
      background-size: cover;
      color: white;
      margin: 0;
      font-family: 'Segoe UI', Arial, sans-serif;
    }
  </style>
</head>
<body>
  <div class="home-container">
    <div style="display:flex;align-items:center;gap:1rem;">
  <button onclick="window.location.href='home.php'" class="back-btn">BACK</button>
  <img src="icon.png" alt="Profile Icon" class="icon" style="height:3rem;width:3rem;border-radius:50%;object-fit:cover;">
      <h1 style="margin:0;font-size:2.2rem;">CASEWORKER PROFILE</h1>
    </div>
    <div class="profile-card">
      <div class="profile-photo" style="border-radius:18px;overflow:hidden;display:flex;align-items:center;justify-content:center;width:90px;height:90px;background:#e6eaf7;box-shadow:0 2px 8px rgba(0,0,0,0.08);">
        <img src="John.jpg" alt="Profile Photo" style="width:80px;height:80px;object-fit:cover;border-radius:0;">
      </div>
      <div class="profile-info">
        <hr>
        <div class="profile-fields">
          <div><b>Last Name:</b> <?php echo htmlspecialchars($last_name ?? ''); ?></div>
          <div><b>First Name:</b> <?php echo htmlspecialchars($first_name ?? ''); ?></div>
          <div><b>Contact Number:</b> <?php echo htmlspecialchars($contact_number ?? ''); ?></div>
          <div><b>Address:</b> <?php echo htmlspecialchars($address ?? ''); ?></div>
        </div>
      </div>
    </div>
    <button id="edit-profile-btn" class="edit-btn">
      <i class="fas fa-edit"></i> Edit Profile
    </button>

    <div id="edit-profile-modal" class="modal" style="display: none;">
      <div class="modal-content">
        <span id="close-edit-modal" class="close">&times;</span>
        <h3>Edit Profile</h3>
        <form id="edit-profile-form" action="update_caseworker.php" method="post">
          <label for="last_name">Last Name:</label>
          <input type="text" id="last_name" name="last_name" value="<?php echo htmlspecialchars($last_name ?? ''); ?>" required>

          <label for="first_name">First Name:</label>
          <input type="text" id="first_name" name="first_name" value="<?php echo htmlspecialchars($first_name ?? ''); ?>" required>

          <label for="contact_number">Contact Number:</label>
          <input type="text" id="contact_number" name="contact_number" value="<?php echo htmlspecialchars($contact_number ?? ''); ?>" required>

          <label for="address">Address:</label>
          <input type="text" id="address" name="address" value="<?php echo htmlspecialchars($address ?? ''); ?>" required>

          <button type="submit" class="save-btn">Save Changes</button>
        </form>
      </div>
    </div>

    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <script>
      const editBtn = document.getElementById('edit-profile-btn');
      const editModal = document.getElementById('edit-profile-modal');
      const closeEditModal = document.getElementById('close-edit-modal');
      editBtn.onclick = () => { editModal.style.display = 'block'; };
      closeEditModal.onclick = () => { editModal.style.display = 'none'; };
      window.onclick = (event) => {
        if (event.target === editModal) editModal.style.display = 'none';
      };
    </script>
  </div>
</body>
</html>
