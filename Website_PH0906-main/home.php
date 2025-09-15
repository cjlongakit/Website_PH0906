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
  <title>PH0906 Dashboard</title>
  <link rel="stylesheet" href="home.css" />
</head>
<body>
  <div class="sidebar-panel" style="position: fixed; top: 0; left: 0; width: 250px; height: 100%; background: #1e293b; color: white; box-shadow: 2px 0 8px rgba(0,0,0,0.15); display: flex; flex-direction: column; justify-content: space-between; z-index: 1000;">
    <div>
      <div class="sidebar-header" style="padding: 1.5rem 1rem 1rem 1rem; border-bottom: 1px solid #334155; text-align: center;">
        <img src="ph0906logo.png" alt="Logo" style="width: 118px; height: 128px; margin-bottom: 0.5rem;">
        <h2 style="font-size: 1.7rem; color: #38bdf8; margin: 0;">Dashboard</h2>
      </div>
  <ul class="sidebar-menu" style="list-style: none; padding: 1.2rem 0; margin: 0; display: flex; flex-direction: column; gap: 0.5rem; align-items: flex-start;">
        <li><a href="home.php" style="display: flex; align-items: center; gap: 10px; padding: 10px 24px; color: #38bdf8;background: #334155;  text-decoration: underline; font-weight: bold; border-radius: 8px;box-shadow: 0 2px 8px rgba(56,189,248,0.10);"><span style="font-size:1.2em;">&#128221;</span> Letters</a></li>
        <li><a href="events.php" style="display: flex; align-items: center; gap: 10px; padding: 10px 24px; color: white; text-decoration: none; font-weight: bold; border-radius: 8px; transition: background 0.2s;"><span style="font-size:1.2em;">&#128197;</span> Events</a></li>
        <li><a href="all_students.php" style="display: flex; align-items: center; gap: 10px; padding: 10px 24px; color: white; text-decoration: none; font-weight: bold; border-radius: 8px; transition: background 0.2s;"><span style="font-size:1.2em;">&#128100;</span> All Students</a></li>
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

  <div class="home-container">
    <header class="main-header">
      <div class="header-group">
        <img src="ph0906logo.png" alt="Church Icon" class="icon" />
        <h1>HELLO, <span class="highlight">PH0906!</span></h1>
      </div>
            <div class="profile-icon" style="margin-right: 10px; text-align: center;">
        <a href="caseworkerprofile.php">
          <img src="icon.png" alt="Profile" style="width: 40px; height: 40px; border-radius: 50%; object-fit: cover; box-shadow: 0 2px 8px rgba(0,0,0,0.15);" />
        </a>
        <div style="font-size: 0.95em; color: #38bdf8; margin-top: 4px;">Profile</div>
      </div>
    </header>

    <section class="search-section">
      <button class="filter-btn" id="filter-btn">&#x1F5C2;</button>
      <div class="filter-dropdown" id="filter-dropdown" style="display:none;">
        <button data-filter="asc">Name Ascending (A-Z)</button>
        <button data-filter="desc">Name Descending (Z-A)</button>
        <button data-filter="phasc">PH906 Ascending (0-1000)</button>
        <button data-filter="phdesc">PH906 Descending (1000-0)</button>
        <button data-filter="outdated">Outdated First</button>
      </div>
      <input type="text" class="search-input" placeholder="Search" id="search-input" />
      <button class="add-btn" id="open-add-modal">ADD <span>+</span></button>
    </section>

    <section class="table-section">
      <table>
        <thead>
          <tr>
            <th>PH906</th>
            <th>NAME</th>
            <th>ADDRESS</th>
            <th>TYPE</th>
            <th>DEADLINE</th>
            <th>STATUS</th>
            <th>ACTIONS</th>
          </tr>
        </thead>
        <tbody id="students-tbody">
        <?php
        include 'db.php';
        $result = $conn->query("SELECT * FROM students ORDER BY id DESC"); // Use id for ordering
        while ($row = $result->fetch_assoc()) {
            // Determine the button color based on the status
            $statusColor = '';
            switch ($row['status']) {
                case 'PENDING':
                    $statusColor = 'background-color: gray; color: white;';
                    break;
                case 'TURN IN':
                    $statusColor = 'background-color: green; color: white;';
                    break;
                case 'ON HAND':
                    $statusColor = 'background-color: blue; color: white;';
                    break;
                case 'OUTDATED':
                    $statusColor = 'background-color: red; color: white;';
                    break;
                case 'TURN IN LATE':
                    $statusColor = 'background-color: orange; color: white;';
                    break;
            }

            echo "<tr>
                <td><a href='studentprofile.php?ph906={$row['ph906']}' style='color: blue; text-decoration: underline;'>{$row['ph906']}</a></td>
                <td>{$row['name']}</td>
                <td>{$row['address']}</td>
                <td>{$row['type']}</td>
                <td>{$row['deadline']}</td>
                <td>
                    <form action='update_status.php' method='post' style='display:inline;'>
                        <input type='hidden' name='id' value='{$row['id']}'>
                        <select name='status' class='status-dropdown' style='{$statusColor}' onchange='this.form.submit()'>
                            <option value='PENDING' " . ($row['status'] === 'PENDING' ? 'selected' : '') . ">PENDING</option>
                            <option value='TURN IN' " . ($row['status'] === 'TURN IN' ? 'selected' : '') . ">TURN IN</option>
                            <option value='ON HAND' " . ($row['status'] === 'ON HAND' ? 'selected' : '') . ">ON HAND</option>
                            <option value='OUTDATED' " . ($row['status'] === 'OUTDATED' ? 'selected' : '') . ">OUTDATED</option>
                            <option value='TURN IN LATE' " . ($row['status'] === 'TURN IN LATE' ? 'selected' : '') . ">TURN IN LATE</option>
                        </select>
                    </form>
                </td>
                <td>
                    <form action='delete_student.php' method='post' style='display:inline;'>
                        <input type='hidden' name='id' value='{$row['id']}'>
                        <button type='submit' class='remove-btn'>&times;</button>
                    </form>
                </td>
            </tr>";
        }
        ?>
        </tbody>
      </table>
    </section>
  </div>

  <!-- Modal -->
  <div class="modal" id="add-student-modal">
    <div class="modal-content">
      <span class="close-modal" id="close-add-modal">&times;</span>
      <h2>Add Student</h2>
      <form id="add-student-form" action="add_student.php" method="post">
        <label for="ph906">PH906:</label>
        <input type="text" id="ph906" name="ph906" required>
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>
        <label for="address">Address:</label>
        <input type="text" id="address" name="address" required>
        <label for="type">Type:</label>
        <input type="text" id="type" name="type" required>
        <label for="deadline">Deadline:</label>
        <input type="date" id="deadline" name="deadline" required>
        <button type="submit" class="add-btn">Add Letter</button>
      </form>
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
  // Modal open/close logic
  document.getElementById('open-add-modal').onclick = function() {
    document.getElementById('add-student-modal').style.display = 'flex';
  };
  document.getElementById('close-add-modal').onclick = function() {
    document.getElementById('add-student-modal').style.display = 'none';
  };
  window.onclick = function(e) {
    if (e.target === document.getElementById('add-student-modal')) {
      document.getElementById('add-student-modal').style.display = 'none';
    }
  };

  // Change Password modal logic
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

  // Filter dropdown logic
  document.getElementById('filter-btn').onclick = function () {
    const dropdown = document.getElementById('filter-dropdown');
    dropdown.style.display = dropdown.style.display === 'none' ? 'block' : 'none';
  };

  // Close filter dropdown when clicking outside
  window.addEventListener('click', function(event) {
    const dropdown = document.getElementById('filter-dropdown');
    const filterBtn = document.getElementById('filter-btn');
    if (!dropdown.contains(event.target) && event.target !== filterBtn) {
      dropdown.style.display = 'none';
    }
  });

  // Filter functionality
  document.querySelectorAll('#filter-dropdown button').forEach(button => {
    button.onclick = function () {
      const filterType = this.getAttribute('data-filter');
      const rows = Array.from(document.querySelectorAll('#students-tbody tr'));
      rows.sort((a, b) => {
        let aValue, bValue;
        if (filterType === 'asc' || filterType === 'desc') {
          aValue = a.cells[1].textContent.toLowerCase(); // Name column
          bValue = b.cells[1].textContent.toLowerCase();
        } else if (filterType === 'phasc' || filterType === 'phdesc') {
          aValue = parseInt(a.cells[0].textContent); // PH906 column
          bValue = parseInt(b.cells[0].textContent);
        } else if (filterType === 'outdated') {
          aValue = new Date(a.cells[4].textContent); // Deadline column
          bValue = new Date(b.cells[4].textContent);
        }
        return filterType.includes('asc') || filterType === 'outdated'
          ? aValue > bValue ? 1 : -1
          : aValue < bValue ? 1 : -1;
      });
      rows.forEach(row => document.querySelector('#students-tbody').appendChild(row));
    };
  });

  // Search functionality
  document.getElementById('search-input').oninput = function () {
    const searchValue = this.value.toLowerCase();
    const rows = document.querySelectorAll('#students-tbody tr');
    rows.forEach(row => {
      const name = row.cells[1].textContent.toLowerCase();
      const ph906 = row.cells[0].textContent.toLowerCase();
      row.style.display = name.includes(searchValue) || ph906.includes(searchValue) ? '' : 'none';
    });
  };
  </script>
</body>
</html>