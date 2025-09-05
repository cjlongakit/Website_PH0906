<?php
<?php
session_start();
// Optional: Uncomment below to require login
// if (!isset($_SESSION['admin'])) {
//   header("Location: login.php");
//   exit();
// }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Edit Student Profile</title>
  <link rel="stylesheet" href="home.css" />
  <link rel="stylesheet" href="editstudentprofile.css" />
</head>
<body>
  <div class="home-container">
    <h2>Edit Student Profile</h2>
    <form id="edit-student-form">
      <label>PH906:
        <input type="text" name="ph906" required>
      </label><br><br>
      <label>Name:
        <input type="text" name="name" required>
      </label><br><br>
      <label>Address:
        <input type="text" name="address" required>
      </label><br><br>
      <label>Type:
        <input type="text" name="type" required>
      </label><br><br>
      <label>Deadline:
        <input type="date" name="deadline" required>
      </label><br><br>
      <button type="submit" class="add-btn">Save Changes</button>
    </form>
    <br>
    <a href="studentprofile.php?idx=" id="back-link">Back to Profile</a>
  </div>
  <script>
    function getQueryParam(name) {
      const url = new URL(window.location.href);
      return url.searchParams.get(name);
    }
    const idx = getQueryParam('idx');
    const students = JSON.parse(localStorage.getItem('students') || '[]');
    const student = students[idx];

    // Fill form with current data
    if (student) {
      const form = document.getElementById('edit-student-form');
      form.ph906.value = student.ph906 || '';
      form.name.value = student.name || '';
      form.address.value = student.address || '';
      form.type.value = student.type || '';
      form.deadline.value = student.deadline || '';
      document.getElementById('back-link').href = `studentprofile.php?idx=${idx}`;
    }

    // Save changes
    document.getElementById('edit-student-form').addEventListener('submit', function(e) {
      e.preventDefault();
      const form = e.target;
      students[idx] = {
        ...students[idx],
        ph906: form.ph906.value,
        name: form.name.value,
        address: form.address.value,
        type: form.type.value,
        deadline: form.deadline.value,
        status: students[idx].status || 'PENDING'
      };
      localStorage.setItem('students', JSON.stringify(students));
      alert('Student updated!');
      window.location.href = `studentprofile.php?idx=${idx}`;
    });
  </script>
</body>
</html>