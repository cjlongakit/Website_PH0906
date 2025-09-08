<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id']; // Get the unique id from the form

    $stmt = $conn->prepare("DELETE FROM students WHERE id = ?"); // Use id for deletion
    $stmt->bind_param("i", $id);
    $stmt->execute();

    header("Location: home.php");
    exit();
}
?>

<div class="sidebar-panel">
  <div class="sidebar-header">
    <h2>Dashboard</h2>
  </div>
  <ul class="sidebar-menu">
    <li><a href="home.php">Home</a></li>
    <li><a href="events.php">Events</a></li>
    <li><a href="all_students.php">All Students</a></li>
    <li><a href="logout.php" onclick="return confirm('Are you sure you want to log out?');">Log Out</a></li>
    <li><a href="#" id="change-password-link">Change Password</a></li>
  </ul>
  <div class="sidebar-footer">
    <p>&copy; 2025 PH0906</p>
  </div>
</div>

<!-- Change Password Modal -->
<div id="change-password-modal" class="modal" style="display: none;">
  <div class="modal-content" style="max-width: 400px; margin: auto; padding: 20px; background: white; color: black; border-radius: 10px;">
    <span id="close-password-modal" class="close" style="float: right; cursor: pointer;">&times;</span>
    <h3>Change Password</h3>
    <form id="change-password-form" action="change_password.php" method="post">
      <label for="current-password">Current Password:</label>
      <input type="password" id="current-password" name="current_password" required style="width: 100%; margin-bottom: 10px; padding: 8px;">

      <label for="new-password">New Password:</label>
      <input type="password" id="new-password" name="new_password" required style="width: 100%; margin-bottom: 10px; padding: 8px;">

      <label for="confirm-password">Confirm New Password:</label>
      <input type="password" id="confirm-password" name="confirm_password" required style="width: 100%; margin-bottom: 10px; padding: 8px;">

      <button type="submit" style="width: 100%; padding: 10px; background-color: #007bff; color: white; border: none; border-radius: 5px; cursor: pointer;">Change Password</button>
    </form>
  </div>
</div>

<script>
  const changePasswordLink = document.getElementById('change-password-link');
  const changePasswordModal = document.getElementById('change-password-modal');
  const closePasswordModal = document.getElementById('close-password-modal');

  changePasswordLink.addEventListener('click', () => {
    changePasswordModal.style.display = 'block';
  });

  closePasswordModal.addEventListener('click', () => {
    changePasswordModal.style.display = 'none';
  });

  window.addEventListener('click', (event) => {
    if (event.target === changePasswordModal) {
      changePasswordModal.style.display = 'none';
    }
  });
</script>