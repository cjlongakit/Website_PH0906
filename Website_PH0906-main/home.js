const STATUS_OPTIONS = [
  { value: "PENDING", label: "PENDING", color: "#444d5c" },
  { value: "OUTDATED", label: "OUTDATED", color: "#e11d48" },
  { value: "TURN IN", label: "TURN IN", color: "#39ff14" },
  { value: "TURN IN LATE", label: "TURN IN LATE", color: "#ff9100" }
];

function getStatusColor(status) {
  switch (status) {
    case "OUTDATED": return "#e11d48";
    case "TURN IN": return "#39ff14";
    case "TURN IN LATE": return "#ff9100";
    default: return "#444d5c";
  }
}

let currentFilter = null;

function renderStudents() {
  let students = JSON.parse(localStorage.getItem('students') || '[]');
  const today = new Date();

  students.forEach(student => {
    if (student.deadline) {
      const deadlineDate = new Date(student.deadline);
      if (today >= deadlineDate && student.status !== "OUTDATED") {
        student.status = "OUTDATED";
      }
    }
  });

  if (currentFilter === 'asc') {
    students.sort((a, b) => a.name.localeCompare(b.name));
  } else if (currentFilter === 'desc') {
    students.sort((a, b) => b.name.localeCompare(a.name));
  } else if (currentFilter === 'phasc') {
    students.sort((a, b) => a.ph906 - b.ph906);
  } else if (currentFilter === 'phdesc') {
    students.sort((a, b) => b.ph906 - a.ph906);
  } else if (currentFilter === 'outdated') {
    students.sort((a, b) => {
      if (a.status === 'OUTDATED' && b.status !== 'OUTDATED') return -1;
      if (a.status !== 'OUTDATED' && b.status === 'OUTDATED') return 1;
      return 0;
    });
  }

  const tbody = document.getElementById('students-tbody');
  tbody.innerHTML = '';
  students.forEach((student, idx) => {
    const tr = document.createElement('tr');
    tr.innerHTML = `
      <td>${student.ph906}</td>
      <td><a href="studentprofile.php?idx=${idx}" class="student-link">${student.name}</a></td>
      <td>${student.address}</td>
      <td>${student.type}</td>
      <td>${student.deadline}</td>
      <td>
        <select class="status-dropdown" data-idx="${idx}" style="background:${getStatusColor(student.status)};">
          ${STATUS_OPTIONS.map(opt => `
            <option value="${opt.value}" ${student.status === opt.value ? 'selected' : ''}>${opt.label}</option>
          `).join('')}
        </select>
      </td>
      <td><button class="remove-btn" data-idx="${idx}">&times;</button></td>
    `;
    tbody.appendChild(tr);
  });

  document.querySelectorAll('.remove-btn').forEach(btn => {
    btn.addEventListener('click', () => {
      const idx = btn.dataset.idx;
      students.splice(idx, 1);
      localStorage.setItem('students', JSON.stringify(students));
      renderStudents();
    });
  });

  document.querySelectorAll('.status-dropdown').forEach(select => {
    select.addEventListener('change', () => {
      const idx = select.dataset.idx;
      students[idx].status = select.value;
      localStorage.setItem('students', JSON.stringify(students));
      renderStudents();
    });
  });
}

document.addEventListener('DOMContentLoaded', () => {
  renderStudents();

  const filterBtn = document.getElementById('filter-btn');
  const filterDropdown = document.getElementById('filter-dropdown');
  filterBtn.addEventListener('click', e => {
    e.stopPropagation();
    filterDropdown.style.display = filterDropdown.style.display === 'block' ? 'none' : 'block';
  });
  document.addEventListener('click', () => {
    filterDropdown.style.display = 'none';
  });
  filterDropdown.querySelectorAll('button').forEach(btn => {
    btn.addEventListener('click', () => {
      currentFilter = btn.getAttribute('data-filter');
      filterDropdown.style.display = 'none';
      renderStudents();
    });
  });

  const modal = document.getElementById('add-student-modal');
  document.getElementById('open-add-modal').addEventListener('click', () => {
    modal.style.display = 'flex';
  });
  document.getElementById('close-add-modal').addEventListener('click', () => {
    modal.style.display = 'none';
  });
  window.addEventListener('click', e => {
    if (e.target === modal) modal.style.display = 'none';
  });

  document.getElementById('add-student-form').addEventListener('submit', e => {
    e.preventDefault();
    const form = e.target;
    const student = {
      ph906: form.ph906.value,
      name: form.name.value,
      address: form.address.value,
      type: form.type.value,
      deadline: form.deadline.value,
      status: "PENDING"
    };
    const students = JSON.parse(localStorage.getItem('students') || '[]');
    students.push(student);
    localStorage.setItem('students', JSON.stringify(students));
    form.reset();
    document.getElementById('add-student-modal').style.display = 'none';
    renderStudents();
  });

  // Filter dropdown logic
  document.getElementById('filter-btn').onclick = function () {
    const dropdown = document.getElementById('filter-dropdown');
    dropdown.style.display = dropdown.style.display === 'none' ? 'block' : 'none';
  };

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
});

document.addEventListener('DOMContentLoaded', function() {
  const addBtn = document.querySelector('.add-btn');
  const modal = document.getElementById('add-student-modal');
  if (addBtn && modal) {
    addBtn.addEventListener('click', function() {
      modal.style.display = 'flex';
    });
  }
});

alert("home.js loaded!");
console.log("home.js loaded!");
