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
</head>
<body>
  <div class="sidebar-panel">
    <div class="sidebar-header">
      <h2>Dashboard</h2>
      <ul class="sidebar-menu" style="margin-top: 10px;">
        <li><a href="home.php">LETTERS</a></li>
        <li><a href="events.php">EVENTS</a></li>
        <li><a href="home.php">ALL STUDENTS</a></li>
        <li><a href="logout.php">LOG OUT</a></li>
      </ul>
    </div>
    <div class="sidebar-footer">
      <div class="abstract-shape"></div>
    </div>
  </div>

  <div class="home-container" style="margin-left: 50px;">
    <header class="main-header">
      <div class="header-group">
        <img src="ph0906logo.png" alt="Church Icon" class="icon" />
        <h1>All Students <span class="highlight">Masterlist</span></h1>
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

    <section class="table-section">
      <table>
        <thead>
          <tr>
            <th>#</th>
            <th>PH906</th>
            <th>Last Name</th>
            <th>First Name</th>
            <th>Sex</th>
            <th>Birthday</th>
            <th>Age</th>
            <th>Caseworker Assigned</th>
            <th>Teacher</th>
          </tr>
        </thead>
        <tbody>
        <?php
        include 'db.php';
        $result = $conn->query("SELECT * FROM masterlist ORDER BY ph906 DESC");
        $count = 1; // Initialize counter
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                <td>{$count}</td>
                <td>{$row['ph906']}</td>
                <td>{$row['last_name']}</td>
                <td>{$row['first_name']}</td>
                <td>{$row['sex']}</td>
                <td>{$row['birthday']}</td>
                <td>{$row['age']}</td>
                <td>{$row['caseworker_assigned']}</td>
                <td>{$row['teacher']}</td>
            </tr>";
            $count++; // Increment counter
        }
        ?>
        </tbody>
      </table>
    </section>
  </div>
</body>
</html>