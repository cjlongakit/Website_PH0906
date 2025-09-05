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
  <div class="sidebar-panel">
    <div class="sidebar-header">
      <h2>Dashboard</h2>
    </div>
    <ul class="sidebar-menu">
      <li><a href="home.php">LETTERS</a></li>
      <li><a href="events.php">EVENTS</a></li>
      <li><a href="all_students.php">ALL STUDENTS</a></li>
      <li><a href="logout.php">LOG OUT</a></li>
    </ul>
    <div class="sidebar-footer">
      <div class="abstract-shape"></div>
    </div>
  </div>

  <div class="home-container">
    <header class="main-header">
      <div class="header-group">
        <img src="ph0906logo.png" alt="Church Icon" class="icon" />
        <h1>HELLO, <span class="highlight">PH0906!</span></h1>
      </div>
    </header>

    <section class="search-section">
      <button class="filter-btn" id="filter-btn">&#x1F50D;</button>
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
        <label>PH906:
          <input type="text" name="ph906" required>
        </label>
        <label>Name:
          <input type="text" name="name" required>
        </label>
        <label>Address:
          <input type="text" name="address" required>
        </label>
        <label>Type:
          <input type="text" name="type" required>
        </label>
        <label>Deadline:
          <input type="date" name="deadline" required>
        </label>
          <button type="submit" class="add-btn">Add Student</button>
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