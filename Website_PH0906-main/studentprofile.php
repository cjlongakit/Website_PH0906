<?php
session_start();
include 'db.php';

$ph906 = $_GET['ph906'] ?? '';
if ($ph906 === '') {
    echo "<script>alert('No PH906 ID provided.'); window.history.back();</script>";
    exit();
}


$stmt = $conn->prepare("SELECT ph906, first_name, last_name, teacher, mobile, nickname, mobile_number, address, guardian_name, guardian_mobile, water_baptized, caseworker_assigned FROM masterlist WHERE ph906 = ? LIMIT 1");
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
  <style>
    .modal-content {
      max-height: 80vh; /* Limit modal height to 80% of the viewport */
      overflow-y: auto; /* Enable vertical scrolling */
      padding: 20px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
      border-radius: 10px;
    }
    .modal-content form {
      display: grid;
      grid-template-columns: 1fr 1fr; /* Two columns for better layout */
      gap: 15px; /* Add spacing between fields */
    }
    .modal-content label {
      grid-column: span 2; /* Labels span both columns */
    }
    .modal-content input {
      grid-column: span 2; /* Inputs span both columns */
    }
    .modal-content button {
      grid-column: span 2; /* Buttons span both columns */
      margin-top: 10px;
    }
    .edit-btn {
      display: flex;
      align-items: center;
      justify-content: center;
      background-color: #007bff;
      color: white;
      border: none;
      border-radius: 5px;
      padding: 10px 15px;
      font-size: 16px;
      cursor: pointer;
      transition: background-color 0.3s, transform 0.2s;
      gap: 8px;
    }
    .edit-btn:hover {
      background-color: #0056b3;
      transform: scale(1.05);
    }
    .edit-btn i {
      font-size: 18px;
    }
  </style>
  <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
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
  <div class="home-container" style="margin-left:500px;">
    <div style="display:flex;align-items:center;gap:1rem;">
        <img src="ph0906logo.png" alt="Church Icon" class="icon" style="height:3rem;">
        <h1 style="margin:0;font-size:2.2rem;">HELLO, <span class="highlight">PH0906!</span></h1>
    </div>
      <div class="profile-card" id="profile-card">
        <div class="profile-photo"></div>
        <div class="profile-info">
          <h2 id="profile-ph906">PH0906- <?php echo htmlspecialchars($student['ph906'] ?? ''); ?></h2>
          <hr>
          <form id="edit-profile-form" action="update_student.php" method="post" style="display:none;">
            <input type="hidden" name="ph906" value="<?php echo htmlspecialchars($student['ph906'] ?? ''); ?>">
            <div class="profile-fields">
              <div><b>Last Name:</b> <input type="text" name="last_name" value="<?php echo htmlspecialchars($student['last_name'] ?? ''); ?>" required></div>
              <div><b>First Name:</b> <input type="text" name="first_name" value="<?php echo htmlspecialchars($student['first_name'] ?? ''); ?>" required></div>
              <div><b>Mobile:</b> <input type="text" name="mobile" value="<?php echo htmlspecialchars($student['mobile'] ?? ''); ?>"></div>
              <div><b>Nickname:</b> <input type="text" name="nickname" value="<?php echo htmlspecialchars($student['nickname'] ?? ''); ?>"></div>
              <div><b>Mobile #:</b> <input type="text" name="mobile_number" value="<?php echo htmlspecialchars($student['mobile_number'] ?? ''); ?>"></div>
              <div><b>Address:</b> <input type="text" name="address" value="<?php echo htmlspecialchars($student['address'] ?? ''); ?>"></div>
              <div><b>Guardian’s Full name:</b> <input type="text" name="guardian_name" value="<?php echo htmlspecialchars($student['guardian_name'] ?? ''); ?>"></div>
              <div><b>Guardian’s mobile #:</b> <input type="text" name="guardian_mobile" value="<?php echo htmlspecialchars($student['guardian_mobile'] ?? ''); ?>"></div>
              <div><b>Water Baptized:</b> <input type="text" name="water_baptized" value="<?php echo htmlspecialchars($student['water_baptized'] ?? ''); ?>"></div>
              <div><b>Teacher:</b> <input type="text" name="teacher" value="<?php echo htmlspecialchars($student['teacher'] ?? ''); ?>" required></div>
              <div><b>Caseworker Assigned:</b> <input type="text" name="caseworker_assigned" value="<?php echo htmlspecialchars($student['caseworker_assigned'] ?? ''); ?>"></div>
            </div>
            <div style="margin-top:1rem;display:flex;gap:1rem;">
              <button type="submit" class="edit-btn" style="background:#22c55e;"><i class="fas fa-save"></i> Save</button>
              <button type="button" id="cancel-edit-btn" class="edit-btn" style="background:#ef4444;"><i class="fas fa-times"></i> Cancel</button>
            </div>
          </form>
          <div class="profile-fields" id="profile-fields-view">
            <div><b>Last Name:</b> <?php echo htmlspecialchars($student['last_name'] ?? ''); ?></div>
            <div><b>First Name:</b> <?php echo htmlspecialchars($student['first_name'] ?? ''); ?></div>
            <div><b>Mobile:</b> <?php echo htmlspecialchars($student['mobile'] ?? ''); ?></div>
            <div><b>Nickname:</b> <?php echo htmlspecialchars($student['nickname'] ?? ''); ?></div>
            <div><b>Mobile #:</b> <?php echo htmlspecialchars($student['mobile_number'] ?? ''); ?></div>
            <div><b>Address:</b> <?php echo htmlspecialchars($student['address'] ?? ''); ?></div>
            <div><b>Guardian’s Full name:</b> <?php echo htmlspecialchars($student['guardian_name'] ?? ''); ?></div>
            <div><b>Guardian’s mobile #:</b> <?php echo htmlspecialchars($student['guardian_mobile'] ?? ''); ?></div>
            <div><b>Water Baptized:</b> <?php echo htmlspecialchars($student['water_baptized'] ?? ''); ?></div>
            <div><b>Teacher:</b> <?php echo htmlspecialchars($student['teacher'] ?? ''); ?></div>
            <div><b>Caseworker Assigned:</b> <?php echo htmlspecialchars($student['caseworker_assigned'] ?? ''); ?></div>
          </div>
          <div style="margin-top:1rem;">
            <button id="edit-profile-btn" class="edit-btn"><i class="fas fa-edit"></i> Edit Profile</button>
          </div>
        </div>
      </div>
    <button id="history-btn" class="edit-btn">
      <i class="fas fa-history"></i> History
    </button>

  <!-- Edit Profile Modal removed, now using inline editing -->

    <div id="history-modal" class="modal" style="display: none;">
      <div class="modal-content">
        <span id="close-history-modal" class="close">&times;</span>
        <h3>Student History</h3>
        <form id="history-form" action="save_history.php" method="post">
          <input type="hidden" name="ph906" value="<?php echo htmlspecialchars($student['ph906'] ?? ''); ?>">
          <label for="history_text">Enter History:</label>
          <textarea id="history_text" name="history_text" rows="4" required></textarea>
          <button type="submit" class="save-btn">Save History</button>
        </form>
        <div id="history-list">
          <h4>History Log:</h4>
          <?php
          $history_stmt = $conn->prepare("SELECT history_text, timestamp FROM student_history WHERE ph906 = ? ORDER BY timestamp DESC");
          $history_stmt->bind_param("s", $ph906);
          $history_stmt->execute();
          $history_result = $history_stmt->get_result();
          while ($history = $history_result->fetch_assoc()) {
              echo "<div><b>" . htmlspecialchars($history['timestamp']) . "</b> - " . htmlspecialchars($history['history_text']) . "</div>";
          }
          $history_stmt->close();
          ?>
        </div>
      </div>
    </div>

    <script>
        // Inline edit logic for student profile
        const editProfileBtn = document.getElementById('edit-profile-btn');
        const editProfileForm = document.getElementById('edit-profile-form');
        const profileFieldsView = document.getElementById('profile-fields-view');
        const cancelEditBtn = document.getElementById('cancel-edit-btn');

        editProfileBtn.addEventListener('click', () => {
          editProfileForm.style.display = 'block';
          profileFieldsView.style.display = 'none';
          editProfileBtn.style.display = 'none';
        });

        cancelEditBtn.addEventListener('click', () => {
          editProfileForm.style.display = 'none';
          profileFieldsView.style.display = 'block';
          editProfileBtn.style.display = 'inline-flex';
        });

      const historyBtn = document.getElementById('history-btn');
      const historyModal = document.getElementById('history-modal');
      const closeHistoryModal = document.getElementById('close-history-modal');

      historyBtn.addEventListener('click', () => {
        historyModal.style.display = 'block';
      });

      closeHistoryModal.addEventListener('click', () => {
        historyModal.style.display = 'none';
      });

      window.addEventListener('click', (event) => {
        if (event.target === historyModal) {
          historyModal.style.display = 'none';
        }
      });
    </script>
  </div>
</body>
</html>