<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id']; // Get the unique id from the form
    $status = $_POST['status']; // Get the new status

    // Update the status of the student in the database
    $stmt = $conn->prepare("UPDATE students SET status = ? WHERE id = ?");
    if ($stmt) {
        $stmt->bind_param("si", $status, $id);
        $stmt->execute();
        $stmt->close();
    }

    // Redirect back to the home page
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

  </ul>
  <div class="sidebar-footer">
    <p>&copy; 2025 PH0906</p>
  </div>
</div>


  });
</script>