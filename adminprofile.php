<?php
session_start();
include 'db.php';

// Fetch admin profile data
$admin_username = $_SESSION['admin_username'] ?? '';
$stmt = $conn->prepare("SELECT last_name, first_name, mobile, address FROM admin WHERE username = ?");
$stmt->bind_param("s", $admin_username);
$stmt->execute();
$admin_profile = $stmt->get_result()->fetch_assoc();
$stmt->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Profile</title>
  <link rel="stylesheet" href="home.css">
  <style>
    .profile-container {
      max-width: 600px;
      margin: 50px auto;
      padding: 20px;
      background: white;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
      border-radius: 10px;
    }
    .profile-container h2 {
      text-align: center;
      margin-bottom: 20px;
    }
    .profile-container form label {
      display: block;
      margin-bottom: 5px;
    }
    .profile-container form input {
      width: 100%;
      margin-bottom: 10px;
      padding: 8px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }
    .profile-container form button {
      padding: 10px;
      background-color: #007bff;
      color: white;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }
    .profile-container form button:hover {
      background-color: #0056b3;
    }
  </style>
</head>
<body>
  <div class="profile-container">
    <h2>Admin Profile</h2>
    <form action="update_admin_profile.php" method="post">
      <label for="last-name">Last Name:</label>
      <input type="text" id="last-name" name="last_name" value="<?php echo htmlspecialchars($admin_profile['last_name'] ?? ''); ?>" required>

      <label for="first-name">First Name:</label>
      <input type="text" id="first-name" name="first_name" value="<?php echo htmlspecialchars($admin_profile['first_name'] ?? ''); ?>" required>

      <label for="mobile">Mobile Number:</label>
      <input type="text" id="mobile" name="mobile" value="<?php echo htmlspecialchars($admin_profile['mobile'] ?? ''); ?>" required>

      <label for="address">Address:</label>
      <input type="text" id="address" name="address" value="<?php echo htmlspecialchars($admin_profile['address'] ?? ''); ?>" required>

      <button type="submit">Save Changes</button>
    </form>
  </div>
</body>
</html>
