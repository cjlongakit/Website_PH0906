<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>All Students</title>
  <link rel="stylesheet" href="home.css" />
  <style>
    .sticky-table th {
      position: sticky;
      top: 0;
      background: #1e293b;
      color: white;
      z-index: 2;
    }
    .sticky-table td, .sticky-table th {
      padding: 0.75rem;
      border-bottom: 1px solid #e5e7eb;
      text-align: left;
    }
    .sticky-table tbody tr:hover {
      background: #f1f5f9;
    }
    .sticky-table {
      font-size: 1rem;
      width: 100%;
      border-radius: 8px;
      overflow: hidden;
      background: white;
    }
    .sticky-table a {
      color: #2563eb;
      text-decoration: underline;
      font-weight: 500;
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

  <div class="home-container">
    <header class="main-header">
      <div class="header-group">
        <img src="ph0906logo.png" alt="Logo" style="width: 30px; height: 30px;" />
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
      <button class="filter-btn" id="filter-btn">&#x1F50D;</button>
      <div class="filter-dropdown" id="filter-dropdown" style="display:none;">
        <button data-filter="asc">Last Name Ascending (A-Z)</button>
        <button data-filter="desc">Last Name Descending (Z-A)</button>
        <button data-filter="phasc">PH906 Ascending (0-1000)</button>
        <button data-filter="phdesc">PH906 Descending (1000-0)</button>
        <button data-filter="ageasc">Age Ascending</button>
        <button data-filter="agedesc">Age Descending</button>
        <button data-filter="teacherasc">Teacher Ascending (A-Z)</button>
        <button data-filter="teacherdesc">Teacher Descending (Z-A)</button>
        <button data-filter="caseworkerasc">Caseworker Ascending (A-Z)</button>
        <button data-filter="caseworkerdesc">Caseworker Descending (Z-A)</button>
        <button data-filter="birthdayasc">Birthday Ascending (Oldest First)</button>
        <button data-filter="birthdaydesc">Birthday Descending (Youngest First)</button>
      </div>
      <input type="text" class="search-input" placeholder="Search" id="search-input" />
    </section>

    <script>
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
        const rows = Array.from(document.querySelectorAll('tbody tr'));
        rows.sort((a, b) => {
          let aValue, bValue;
          if (filterType === 'asc' || filterType === 'desc') {
            aValue = a.cells[2].textContent.toLowerCase(); // Last Name column
            bValue = b.cells[2].textContent.toLowerCase();
          } else if (filterType === 'phasc' || filterType === 'phdesc') {
            aValue = parseInt(a.cells[1].textContent); // PH906 column
            bValue = parseInt(b.cells[1].textContent);
          } else if (filterType === 'ageasc' || filterType === 'agedesc') {
            aValue = parseInt(a.cells[6].textContent); // Age column
            bValue = parseInt(b.cells[6].textContent);
          } else if (filterType === 'teacherasc' || filterType === 'teacherdesc') {
            aValue = a.cells[8].textContent.toLowerCase(); // Teacher column
            bValue = b.cells[8].textContent.toLowerCase();
          } else if (filterType === 'caseworkerasc' || filterType === 'caseworkerdesc') {
            aValue = a.cells[7].textContent.toLowerCase(); // Caseworker column
            bValue = b.cells[7].textContent.toLowerCase();
          } else if (filterType === 'birthdayasc' || filterType === 'birthdaydesc') {
            aValue = new Date(a.cells[5].textContent); // Birthday column
            bValue = new Date(b.cells[5].textContent);
          }
          return filterType.includes('asc')
            ? aValue > bValue ? 1 : -1
            : aValue < bValue ? 1 : -1;
        });
        rows.forEach(row => document.querySelector('tbody').appendChild(row));
      };
    });

    // Universal search functionality
    document.getElementById('search-input').oninput = function () {
      const searchValue = this.value.toLowerCase();
      const rows = document.querySelectorAll('tbody tr');
      rows.forEach(row => {
        const rowData = Array.from(row.cells).map(cell => cell.textContent.toLowerCase());
        row.style.display = rowData.some(data => data.includes(searchValue)) ? '' : 'none';
      });
    };
    </script>

    <section class="table-section" style="max-width: 100%;">
      <div style="max-height: 480px; overflow-y: auto; border-radius: 10px; box-shadow: 0 2px 8px rgba(0,0,0,0.08); background: white;">
        <table class="sticky-table" style="width: 100%; border-collapse: collapse;">
          <thead style="display: block; width: 100%;">
            <tr>
              <th style="min-width: 40px;">#</th>
              <th style="min-width: 80px;">PH906</th>
              <th style="min-width: 120px;">Last Name</th>
              <th style="min-width: 120px;">First Name</th>
              <th style="min-width: 60px;">Sex</th>
              <th style="min-width: 110px;">Birthday</th>
              <th style="min-width: 60px;">Age</th>
              <th style="min-width: 160px;">Caseworker Assigned</th>
              <th style="min-width: 100px;">Teacher</th>
            </tr>
          </thead>
          <tbody style="display: block; width: 100%;">
          <?php
          include 'db.php';
          $result = $conn->query("SELECT * FROM masterlist ORDER BY ph906 DESC");
          $count = 1; // Initialize counter
          while ($row = $result->fetch_assoc()) {
              echo "<tr>
                  <td style='min-width: 40px;'>$count</td>
                  <td style='min-width: 80px;'><a href='studentprofile.php?ph906={$row['ph906']}' style='color: blue; text-decoration: underline;'>{$row['ph906']}</a></td>
                  <td style='min-width: 120px;'>{$row['last_name']}</td>
                  <td style='min-width: 120px;'>{$row['first_name']}</td>
                  <td style='min-width: 60px;'>{$row['sex']}</td>
                  <td style='min-width: 110px;'>{$row['birthday']}</td>
                  <td style='min-width: 60px;'>{$row['age']}</td>
                  <td style='min-width: 160px;'>{$row['caseworker_assigned']}</td>
                  <td style='min-width: 100px;'>{$row['teacher']}</td>
              </tr>";
              $count++; // Increment counter
          }
          ?>
          </tbody>
        </table>
      </div>
    </section>
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

  <!-- Removed duplicate sticky header CSS from modal -->
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
</body>
</html>