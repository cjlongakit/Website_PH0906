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
  <div class="sidebar-panel" style="position: fixed; top: 0; left: 0; width: 250px; height: 100%; background: #1e293b; color: white; box-shadow: 2px 0 8px rgba(0,0,0,0.15); display: flex; flex-direction: column; justify-content: space-between; z-index: 1000;">
    <div>
      <div class="sidebar-header" style="padding: 1.5rem 1rem 1rem 1rem; border-bottom: 1px solid #334155; text-align: center;">
        <img src="ph0906logo.png" alt="Logo" style="width: 118px; height: 128px; margin-bottom: 0.5rem;">
        <h2 style="font-size: 1.7rem; color: #38bdf8; margin: 0;">Dashboard</h2>
      </div>
      <ul class="sidebar-menu" style="list-style: none; padding: 1.2rem 0; margin: 0; display: flex; flex-direction: column; gap: 0.5rem; align-items: flex-start;">
        <li><a href="home.php" style="display: flex; align-items: center; gap: 10px; padding: 10px 24px; color: white; text-decoration: none; font-weight: bold; border-radius: 8px; transition: background 0.2s;"><span style="font-size:1.2em;">&#128221;</span> Letters</a></li>
        <li><a href="events.php" style="display: flex; align-items: center; gap: 10px; padding: 10px 24px; color: white; text-decoration: none; font-weight: bold; border-radius: 8px; transition: background 0.2s;"><span style="font-size:1.2em;">&#128197;</span> Events</a></li>
        <li><a href="all_students.php" style="display: flex; align-items: center; gap: 10px; padding: 10px 24px; color: #38bdf8; background: #334155; text-decoration: underline; font-weight: bold; border-radius: 8px; box-shadow: 0 2px 8px rgba(56,189,248,0.10);"> <span style="font-size:1.2em;">&#128100;</span> All Students</a></li>
        <div style="width: 80%; margin: 0.5rem auto 1.5rem auto;">
          <hr style="border: none; border-bottom: 1px solid #334155;">
        </div>
        <li><a href="logout.php" onclick="return confirm('Are you sure you want to log out?');" style="display: flex; align-items: center; gap: 10px; padding: 10px 24px; color: white; text-decoration: none; font-weight: bold; border-radius: 8px; transition: background 0.2s;"><span style="font-size:1.2em;">&#128274;</span> Log Out</a></li>
        <li><a href="#" id="change-password-link" style="display: flex; align-items: center; gap: 10px; padding: 10px 24px; color: white; text-decoration: none; font-weight: bold; border-radius: 8px; transition: background 0.2s;"><span style="font-size:1.2em;">&#128273;</span> Change Password</a></li>
      </ul>
    </div>
    <div class="sidebar-footer" style="padding: 1rem; text-align: center; font-size: 0.95rem; color: #94a3b8; border-top: 1px solid #334155;">
      <p style="margin:0;">&copy; 2025 PH0906</p>
    </div>
  </div>
  <div class="home-container" style="margin-left:500px; max-width:600px; margin-right:auto; margin-top:0;">
    <div style="display:flex;flex-direction:column;align-items:center;justify-content:center;margin-top:2rem;">
      <img src="icon.png" alt="Profile Icon" class="icon" style="height:4rem;width:4rem;border-radius:50%;object-fit:cover;margin-bottom:1rem;">
      <h1 style="margin:0;font-size:2.2rem;text-align:center;">CASEWORKER PROFILE</h1>
    </div>
    <div class="profile-card" style="margin:2rem auto 0 auto;max-width:400px;display:flex;flex-direction:column;align-items:center;">
      <div class="profile-photo" style="border-radius:18px;overflow:hidden;display:flex;align-items:center;justify-content:center;width:90px;height:90px;background:#e6eaf7;box-shadow:0 2px 8px rgba(0,0,0,0.08);">
        <img src="John.jpg" alt="Profile Photo" style="width:80px;height:80px;object-fit:cover;border-radius:0;">
      </div>
      <div class="profile-info">
        <hr>
        <form id="edit-profile-form" action="update_caseworker.php" method="post" style="width:100%;">
          <div class="profile-fields" id="profile-fields-view">
            <div><b>Last Name:</b> <span id="last_name_view"><?php echo htmlspecialchars($last_name ?? ''); ?></span></div>
            <div><b>First Name:</b> <span id="first_name_view"><?php echo htmlspecialchars($first_name ?? ''); ?></span></div>
            <div><b>Contact Number:</b> <span id="contact_number_view"><?php echo htmlspecialchars($contact_number ?? ''); ?></span></div>
            <div><b>Address:</b> <span id="address_view"><?php echo htmlspecialchars($address ?? ''); ?></span></div>
          </div>
          <div class="profile-fields" id="profile-fields-edit" style="display:none;">
            <div><b>Last Name:</b> <input type="text" name="last_name" id="last_name_input" value="<?php echo htmlspecialchars($last_name ?? ''); ?>" required></div>
            <div><b>First Name:</b> <input type="text" name="first_name" id="first_name_input" value="<?php echo htmlspecialchars($first_name ?? ''); ?>" required></div>
            <div><b>Contact Number:</b> <input type="text" name="contact_number" id="contact_number_input" value="<?php echo htmlspecialchars($contact_number ?? ''); ?>" required></div>
            <div><b>Address:</b> <input type="text" name="address" id="address_input" value="<?php echo htmlspecialchars($address ?? ''); ?>" required></div>
          </div>
          <div style="margin-top:1.5rem;text-align:center;">
            <button type="button" id="edit-profile-btn" class="edit-btn"><i class="fas fa-edit"></i> Edit Profile</button>
            <button type="submit" id="save-profile-btn" class="edit-btn" style="display:none;background:#38bdf8;"><i class="fas fa-save"></i> Save Changes</button>
            <button type="button" id="cancel-edit-btn" class="edit-btn" style="display:none;background:#e11d48;" onclick="toggleEdit(false)">Cancel</button>
          </div>
        </form>
      </div>
    </div>

    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <script>
      function toggleEdit(editMode) {
        document.getElementById('profile-fields-view').style.display = editMode ? 'none' : '';
        document.getElementById('profile-fields-edit').style.display = editMode ? '' : 'none';
        document.getElementById('edit-profile-btn').style.display = editMode ? 'none' : '';
        document.getElementById('save-profile-btn').style.display = editMode ? '' : 'none';
        document.getElementById('cancel-edit-btn').style.display = editMode ? '' : 'none';
      }
      document.getElementById('edit-profile-btn').onclick = function() { toggleEdit(true); };
      document.getElementById('cancel-edit-btn').onclick = function() { toggleEdit(false); };
      // On form submit, keep in view mode
      document.getElementById('edit-profile-form').onsubmit = function() { toggleEdit(false); };
    </script>
  </div>
</body>
</html>
