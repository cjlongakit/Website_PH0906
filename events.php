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
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Events Calendar</title>
  <link rel="stylesheet" href="home.css">
  <style>
    body {
      background-image: url('darkbluebackground.png');
      background-size: cover;
      background-position: center;
      color: white; /* Ensure text is visible on dark background */
    }
    .calendar {
      display: grid;
      grid-template-columns: repeat(7, 1fr);
      gap: 10px;
      margin: 20px;
    }
    .calendar-header {
      grid-column: span 7;
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 20px;
    }
    .day {
      border: 1px solid #ccc;
      padding: 10px;
      text-align: center;
      cursor: pointer;
      border-radius: 5px;
      transition: background-color 0.3s, transform 0.2s;
      background-color: rgba(255, 255, 255, 0.8); /* Light background for day cells */
      color: black; /* Dark text for contrast */
    }
    .day:hover {
      background-color: rgba(255, 255, 255, 1); /* Brighter hover effect */
      transform: scale(1.05);
    }
    .day-header {
      font-weight: bold;
      text-transform: uppercase;
      text-align: center;
      margin-bottom: 10px;
    }
    .event-modal {
      display: none;
      position: fixed;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      background: white;
      padding: 20px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
      z-index: 1000;
      border-radius: 10px;
      background-color: #f9f9f9; /* Softer background */
      color: #333; /* Darker text for readability */
      border: 2px solid #007bff; /* Add a border for better visibility */
    }
    .event-modal h3 {
      color: #007bff; /* Highlighted header */
    }
    .modal-overlay {
      display: none;
      position: fixed;
      top: 0;
      /* Static Sidebar Panel */
      .sidebar-panel {
        position: fixed;
        top: 0;
        left: 0;
        width: 250px; /* Sidebar width */
        height: 100%;
        background-color: #1e293b; /* Match the sidebar color with other pages */
        color: white;
        display: flex;
        flex-direction: column;
        justify-content: flex-start; /* Move items to the top */
        z-index: 1000;
        box-shadow: 2px 0 5px rgba(0, 0, 0, 0.5);
      }
      .sidebar-header {
        padding: 1rem;
        border-bottom: 1px solid #334155;
        text-align: center;
      }
      .sidebar-header h2 {
        font-size: 1.5rem;
        color: #38bdf8;
      }
      .sidebar-menu {
        list-style: none;
        padding: 1rem 0;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 0.5rem; /* Reduce gap to make items closer */
      }
      .sidebar-menu li {
        margin: 0;
      }
      .sidebar-menu a {
        display: block;
        padding: 10px 20px;
        color: white;
        text-decoration: none;
        font-weight: bold;
        text-align: center;
        text-transform: uppercase; /* Make text uppercase */
        transition: background-color 0.3s;
      }
      .sidebar-menu a:hover {
        background-color: #334155;
      }
      .sidebar-menu a span {
        display: block;
      }
      .sidebar-footer {
        padding: 1rem;
        text-align: center;
        font-size: 0.9rem;
        color: #94a3b8;
      }
      width: 80%;
      max-width: 500px;
      border-radius: 10px;
    }
    .close {
      color: #aaa;
      float: right;
      font-size: 28px;
      font-weight: bold;
    }
    .close:hover,
    .close:focus {
      color: black;
      text-decoration: none;
      cursor: pointer;
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
        <li><a href="events.php" style="display: flex; align-items: center; gap: 10px; padding: 10px 24px; color: #38bdf8;background: #334155;  text-decoration: underline; font-weight: bold; border-radius: 8px;box-shadow: 0 2px 8px rgba(56,189,248,0.10);"><span style="font-size:1.2em;">&#128197;</span> Events</a></li>
        <li><a href="all_students.php" style="display: flex; align-items: center; gap: 10px; padding: 10px 24px; color: white;  text-decoration: none; font-weight: bold; border-radius: 8px; "> <span style="font-size:1.2em;">&#128100;</span> All Students</a></li>
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
    <header class="main-header" style="display: flex; justify-content: space-between; align-items: center;">
      <div class="header-group" style="display: flex; align-items: center;">
        <img src="ph0906logo.png" alt="Logo" style="width: 30px; height: 30px;" />
        <h1 style="margin-left: 10px;">HELLO, <span class="highlight">PH0906!</span></h1>
      </div>
      <div class="profile-icon" style="margin-right: 10px; text-align: center;">
        <a href="caseworkerprofile.php">
          <img src="icon.png" alt="Profile" style="width: 40px; height: 40px; border-radius: 50%; object-fit: cover; box-shadow: 0 2px 8px rgba(0,0,0,0.15);" />
        </a>
        <div style="font-size: 0.95em; color: #38bdf8; margin-top: 4px;">Profile</div>
      </div>
    </header>

    <div class="calendar-container">
      <div class="calendar-header">
        <div class="month-navigation" style="display: flex; align-items: center; justify-content: center; gap: 20px;">
          <button id="prev-month">&lt; Prev</button>
          <h2 id="calendar-month" style="margin: 0 20px;">January</h2>
          <button id="next-month">Next &gt;</button>
        </div>
        <div style="display: flex; align-items: center; gap: 10px;">
          <label for="calendar-year-select">Year:</label>
          <select id="calendar-year-select" style="font-size: 1rem; padding: 4px 8px;"></select>
          <h3 id="calendar-year">2025</h3>
        </div>
      </div>
      <div class="calendar" id="calendar">
        <div class="day-header">Sun</div>
        <div class="day-header">Mon</div>
        <div class="day-header">Tue</div>
        <div class="day-header">Wed</div>
        <div class="day-header">Thu</div>
        <div class="day-header">Fri</div>
        <div class="day-header">Sat</div>
      </div>
    </div>

    <div class="modal-overlay" id="modal-overlay"></div>
    <div class="event-modal" id="event-modal">
      <h3 style="margin-bottom: 1rem; color: #007bff;">Add Event</h3>
      <form id="event-form" style="display: flex; flex-direction: column; gap: 0.7rem;">
        <label for="event-date" style="font-weight: bold; color: #007bff;">Date:</label>
        <input type="date" id="event-date" name="event-date" required>
        <label for="event-title" style="font-weight: bold; color: #007bff;">Title:</label>
        <input type="text" id="event-title" name="event-title" required>
        <label for="event-desc" style="font-weight: bold; color: #007bff;">Description:</label>
        <textarea id="event-desc" name="event-desc" rows="2" style="resize: vertical; border-radius: 6px; padding: 6px;"></textarea>
        <div style="display: flex; gap: 0.5rem; margin-top: 0.5rem;">
          <button type="submit" style="background: #38bdf8; color: white; border: none; border-radius: 6px; padding: 8px 16px; font-weight: bold;">Save</button>
          <button type="button" id="close-modal" style="background: #e11d48; color: white; border: none; border-radius: 6px; padding: 8px 16px; font-weight: bold;">Cancel</button>
        </div>
      </form>
      <div id="event-list-container" style="margin-top: 1.5rem; background: #f0f4fa; border-radius: 8px; padding: 1rem; box-shadow: 0 2px 8px rgba(0,0,0,0.08);">
        <h4 style="color: #007bff; margin-bottom: 0.7rem;">Events for this day</h4>
        <div id="event-display" class="event-list"></div>
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
      const calendar = document.getElementById('calendar');
      const monthDisplay = document.getElementById('calendar-month');
      const yearDisplay = document.getElementById('calendar-year');
      const prevMonthBtn = document.getElementById('prev-month');
      const nextMonthBtn = document.getElementById('next-month');
      const eventModal = document.getElementById('event-modal');
      const modalOverlay = document.getElementById('modal-overlay');
      const eventForm = document.getElementById('event-form');
      const eventDateInput = document.getElementById('event-date');
      const eventTitleInput = document.getElementById('event-title');
      const closeModalBtn = document.getElementById('close-modal');

      const changePasswordLink = document.getElementById('change-password-link');
      const changePasswordModal = document.getElementById('change-password-modal');
      const closePasswordModal = document.getElementById('close-password-modal');

      const months = [
        'January', 'February', 'March', 'April', 'May', 'June',
        'July', 'August', 'September', 'October', 'November', 'December'
      ];

  // Set to current month/year
  const today = new Date();
  let currentYear = today.getFullYear();
  let currentMonth = today.getMonth();
      const events = {};

      function renderCalendar(year, month) {
        calendar.innerHTML = '<div class="day-header">Sun</div><div class="day-header">Mon</div><div class="day-header">Tue</div><div class="day-header">Wed</div><div class="day-header">Thu</div><div class="day-header">Fri</div><div class="day-header">Sat</div>';
        const firstDay = new Date(year, month, 1).getDay();
        const daysInMonth = new Date(year, month + 1, 0).getDate();

        for (let i = 0; i < firstDay; i++) {
          const emptyCell = document.createElement('div');
          calendar.appendChild(emptyCell);
        }

        for (let day = 1; day <= daysInMonth; day++) {
          const dayCell = document.createElement('div');
          dayCell.className = 'day';
          dayCell.textContent = day;
          const date = `${year}-${String(month + 1).padStart(2, '0')}-${String(day).padStart(2, '0')}`;
          dayCell.dataset.date = date;

          if (events[date]) {
            dayCell.style.backgroundColor = '#ffeb3b';
            dayCell.title = events[date]; // Tooltip to show event title
          }

          dayCell.addEventListener('click', () => openEventModal(date));
          calendar.appendChild(dayCell);
        }
      }

      function openEventModal(date) {
        eventDateInput.value = date;
        eventTitleInput.value = '';
        document.getElementById('event-desc').value = '';
        const eventDisplay = document.getElementById('event-display');
        eventDisplay.innerHTML = '';

        if (events[date]) {
          events[date].forEach((eventObj, idx) => {
            // eventObj: {title, desc}
            const eventItem = document.createElement('div');
            eventItem.style.display = 'flex';
            eventItem.style.alignItems = 'center';
            eventItem.style.justifyContent = 'space-between';
            eventItem.style.marginBottom = '8px';

            const infoDiv = document.createElement('div');
            infoDiv.style.flex = '1';
            infoDiv.innerHTML = `<span style='font-weight:bold;'>${eventObj.title}</span><br><span style='font-size:0.95em; color:#555;'>${eventObj.desc || ''}</span>`;
            eventItem.appendChild(infoDiv);

            const btnGroup = document.createElement('div');
            btnGroup.style.display = 'flex';
            btnGroup.style.gap = '6px';

            const editBtn = document.createElement('button');
            editBtn.textContent = 'Edit';
            editBtn.style.background = '#38bdf8';
            editBtn.style.color = '#fff';
            editBtn.style.border = 'none';
            editBtn.style.borderRadius = '4px';
            editBtn.style.padding = '2px 8px';
            editBtn.style.cursor = 'pointer';
            editBtn.onclick = function() {
              eventTitleInput.value = eventObj.title;
              document.getElementById('event-desc').value = eventObj.desc || '';
              eventDateInput.value = date;
              eventForm.setAttribute('data-edit-idx', idx);
            };
            btnGroup.appendChild(editBtn);

            const deleteBtn = document.createElement('button');
            deleteBtn.textContent = 'Delete';
            deleteBtn.style.background = '#e74c3c';
            deleteBtn.style.color = '#fff';
            deleteBtn.style.border = 'none';
            deleteBtn.style.borderRadius = '4px';
            deleteBtn.style.padding = '2px 8px';
            deleteBtn.style.cursor = 'pointer';
            deleteBtn.onclick = async function() {
              await deleteEvent(date, eventObj.title);
              eventItem.remove();
            };
            btnGroup.appendChild(deleteBtn);

            eventItem.appendChild(btnGroup);
            eventDisplay.appendChild(eventItem);
          });
        } else {
          eventDisplay.textContent = 'No events for this day.';
        }

        eventModal.style.display = 'block';
        modalOverlay.style.display = 'block';
        eventForm.removeAttribute('data-edit-idx');
      }
      async function deleteEvent(date, title) {
        try {
          const response = await fetch('delete_event.php', {
            method: 'POST',
            headers: {
              'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `event_date=${encodeURIComponent(date)}&event_title=${encodeURIComponent(title)}`,
          });
          if (!response.ok) {
            alert('Network error: Could not reach delete_event.php');
            return;
          }
          const result = await response.json();
          if (result.success) {
            await fetchEvents(); // Refresh events from server after deletion
          } else {
            alert('Failed to delete event. Server response: ' + JSON.stringify(result));
          }
        } catch (err) {
          alert('Error deleting event: ' + err);
        }
      }

      function closeEventModal() {
        eventModal.style.display = 'none';
        modalOverlay.style.display = 'none';
      }

      async function fetchEvents() {
        const response = await fetch('fetch_events.php');
        const data = await response.json();
        // Convert old format to new: {date: [{title, desc}]} or fallback
        for (const date in data) {
          events[date] = data[date].map(ev => {
            if (typeof ev === 'string') return {title: ev, desc: ''};
            return ev;
          });
        }
        renderCalendar(currentYear, currentMonth);
      }

      async function saveEvent(date, title, desc, editIdx = null) {
        const response = await fetch('save_event.php', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
          },
          body: `event_date=${encodeURIComponent(date)}&event_title=${encodeURIComponent(title)}&event_desc=${encodeURIComponent(desc)}&edit_idx=${editIdx !== null ? editIdx : ''}`,
        });

        const result = await response.json();
        if (result.success) {
          if (!events[date]) {
            events[date] = [];
          }
          if (editIdx !== null) {
            events[date][editIdx] = {title, desc};
          } else {
            events[date].push({title, desc});
          }
          renderCalendar(currentYear, currentMonth);
        } else {
          alert('Failed to save event.');
        }
      }

      eventForm.addEventListener('submit', async (e) => {
        e.preventDefault();
        const date = eventDateInput.value;
        const title = eventTitleInput.value;
        const desc = document.getElementById('event-desc').value;
        const editIdx = eventForm.getAttribute('data-edit-idx');
        await saveEvent(date, title, desc, editIdx !== null ? parseInt(editIdx) : null);
        closeEventModal();
      });

      closeModalBtn.addEventListener('click', closeEventModal);
      modalOverlay.addEventListener('click', closeEventModal);

      prevMonthBtn.addEventListener('click', () => {
        if (currentMonth === 0) {
          currentMonth = 11;
          currentYear--;
        } else {
          currentMonth--;
        }
        monthDisplay.textContent = months[currentMonth];
        yearDisplay.textContent = currentYear;
        renderCalendar(currentYear, currentMonth);
      });

      nextMonthBtn.addEventListener('click', () => {
        if (currentMonth === 11) {
          currentMonth = 0;
          currentYear++;
        } else {
          currentMonth++;
        }
        monthDisplay.textContent = months[currentMonth];
        yearDisplay.textContent = currentYear;
        renderCalendar(currentYear, currentMonth);
      });

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

      // Year dropdown setup
      const yearSelect = document.getElementById('calendar-year-select');
      function populateYearSelect() {
        yearSelect.innerHTML = '';
        for (let y = today.getFullYear() - 5; y <= today.getFullYear() + 5; y++) {
          const opt = document.createElement('option');
          opt.value = y;
          opt.textContent = y;
          if (y === currentYear) opt.selected = true;
          yearSelect.appendChild(opt);
        }
      }
      yearSelect.addEventListener('change', function() {
        currentYear = parseInt(this.value);
        yearDisplay.textContent = currentYear;
        renderCalendar(currentYear, currentMonth);
      });

      monthDisplay.textContent = months[currentMonth];
      yearDisplay.textContent = currentYear;
      populateYearSelect();
      renderCalendar(currentYear, currentMonth);
      document.addEventListener('DOMContentLoaded', fetchEvents);
    </script>
  </div>
</body>
</html>

