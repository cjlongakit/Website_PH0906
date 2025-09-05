<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Events Calendar</title>
  <link rel="stylesheet" href="home.css" />
</head>
<body>
  <div class="sidebar-panel">
    <div class="sidebar-header">
      <h2>Dashboard</h2>
      <ul class="sidebar-menu" style="margin-top: 10px;">
        <li><a href="home.php">LETTERS</a></li>
        <li><a href="events.php" class="active">EVENTS</a></li>
        <li><a href="all_students.php">ALL STUDENTS</a></li>
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
        <h1>Events Calendar</h1>
      </div>
    </header>

    <section class="table-section">
      <h2>September 2025</h2>
      <div class="calendar-grid">
        <div class="day-name">Sun</div>
        <div class="day-name">Mon</div>
        <div class="day-name">Tue</div>
        <div class="day-name">Wed</div>
        <div class="day-name">Thu</div>
        <div class="day-name">Fri</div>
        <div class="day-name">Sat</div>

        <!-- Empty days for alignment -->
        <div class="day empty"></div>
        <div class="day empty"></div>
        <div class="day empty"></div>
        <div class="day empty"></div>
        <div class="day empty"></div>

        <!-- Days of the month -->
        <div class="day">1</div>
        <div class="day">2</div>
        <div class="day">3</div>
        <div class="day">4</div>
        <div class="day">5</div>
        <div class="day">6</div>
        <div class="day">7</div>
        <div class="day">8</div>
        <div class="day">9</div>
        <div class="day">10</div>
        <div class="day">11</div>
        <div class="day">12</div>
        <div class="day">13</div>
        <div class="day">14</div>
        <div class="day">15</div>
        <div class="day">16</div>
        <div class="day">17</div>
        <div class="day">18</div>
        <div class="day">19</div>
        <div class="day">20</div>
        <div class="day">21</div>
        <div class="day">22</div>
        <div class="day">23</div>
        <div class="day">24</div>
        <div class="day">25</div>
        <div class="day">26</div>
        <div class="day">27</div>
        <div class="day">28</div>
        <div class="day">29</div>
        <div class="day">30</div>
      </div>
    </section>
  </div>
</body>
</html>