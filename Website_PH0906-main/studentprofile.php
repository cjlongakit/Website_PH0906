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
  <div class="home-container">
    <div style="display:flex;align-items:center;gap:1rem;">
      <button onclick="window.location.href='all_students.php'" class="back-btn">BACK</button>
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
      </div>
    </div>
    <button id="edit-profile-btn" class="edit-btn">
      <i class="fas fa-edit"></i> Edit Profile
    </button>
    <button id="history-btn" class="edit-btn">
      <i class="fas fa-history"></i> History
    </button>

    <div id="edit-profile-modal" class="modal" style="display: none;">
      <div class="modal-content">
        <span id="close-edit-modal" class="close">&times;</span>
        <h3>Edit Profile</h3>
        <form id="edit-profile-form" action="update_student.php" method="post">
          <input type="hidden" name="ph906" value="<?php echo htmlspecialchars($student['ph906'] ?? ''); ?>">

          <label for="last_name">Last Name:</label>
          <input type="text" id="last_name" name="last_name" value="<?php echo htmlspecialchars($student['last_name'] ?? ''); ?>" required>

          <label for="first_name">First Name:</label>
          <input type="text" id="first_name" name="first_name" value="<?php echo htmlspecialchars($student['first_name'] ?? ''); ?>" required>

          <label for="mobile">Mobile:</label>
          <input type="text" id="mobile" name="mobile" value="<?php echo htmlspecialchars($student['mobile'] ?? ''); ?>">

          <label for="nickname">Nickname:</label>
          <input type="text" id="nickname" name="nickname" value="<?php echo htmlspecialchars($student['nickname'] ?? ''); ?>">

          <label for="mobile_number">Mobile #:</label>
          <input type="text" id="mobile_number" name="mobile_number" value="<?php echo htmlspecialchars($student['mobile_number'] ?? ''); ?>">

          <label for="address">Address:</label>
          <input type="text" id="address" name="address" value="<?php echo htmlspecialchars($student['address'] ?? ''); ?>">

          <label for="guardian_name">Guardian’s Full Name:</label>
          <input type="text" id="guardian_name" name="guardian_name" value="<?php echo htmlspecialchars($student['guardian_name'] ?? ''); ?>">

          <label for="guardian_mobile">Guardian’s Mobile #:</label>
          <input type="text" id="guardian_mobile" name="guardian_mobile" value="<?php echo htmlspecialchars($student['guardian_mobile'] ?? ''); ?>">

          <label for="water_baptized">Water Baptized:</label>
          <input type="text" id="water_baptized" name="water_baptized" value="<?php echo htmlspecialchars($student['water_baptized'] ?? ''); ?>">

          <label for="teacher">Teacher:</label>
          <input type="text" id="teacher" name="teacher" value="<?php echo htmlspecialchars($student['teacher'] ?? ''); ?>" required>

          <label for="caseworker_assigned">Caseworker Assigned:</label>
          <input type="text" id="caseworker_assigned" name="caseworker_assigned" value="<?php echo htmlspecialchars($student['caseworker_assigned'] ?? ''); ?>">

          <button type="submit" class="save-btn">Save Changes</button>
        </form>
      </div>
    </div>

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
      const editProfileBtn = document.getElementById('edit-profile-btn');
      const editProfileModal = document.getElementById('edit-profile-modal');
      const closeEditModal = document.getElementById('close-edit-modal');

      editProfileBtn.addEventListener('click', () => {
        editProfileModal.style.display = 'block';
      });

      closeEditModal.addEventListener('click', () => {
        editProfileModal.style.display = 'none';
      });

      window.addEventListener('click', (event) => {
        if (event.target === editProfileModal) {
          editProfileModal.style.display = 'none';
        }
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