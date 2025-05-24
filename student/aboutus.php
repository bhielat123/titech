<?php
require_once '../../database/dbconnection.php';

$missions = $pdo->query("SELECT * FROM about_mission_vision WHERE type='mission'")->fetchAll(PDO::FETCH_ASSOC);
$visions = $pdo->query("SELECT * FROM about_mission_vision WHERE type='vision'")->fetchAll(PDO::FETCH_ASSOC);
$events = $pdo->query("SELECT * FROM about_calendar_events ORDER BY event_date ASC")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="../../images/wrlogo.png" type="image/png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us</title>

    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Unkempt:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&family=Roboto:wght@300;400;500&family=Open+Sans:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Baloo+Paaji+2:wght@400..800&family=Fredoka:wght@300..700&family=Irish+Grover&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Rubik+Puddles&family=Shadows+Into+Light&family=Unkempt:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../css/student/aboutus.css">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Font Awesome for extra icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>
    <!-- Hamburger Toggle Button (Mobile Only) -->
    <button class="nav-toggle btn d-md-none" aria-label="toggle navigation">☰</button>

    <!-- Overlay for mobile sidebar -->
    <div class="overlay"></div>

    <!-- Header -->
<header class="d-flex flex-row align-items-center justify-content-between px-4 py-3">
  <h1 class="m-0">
    <a href="../../index.php">
      <img src="../../images/newlogo1.png" alt="Logo" style="height: 50px;">
    </a>
  </h1>
    <div class="nav-container d-none d-md-flex flex-row align-items-center">
        <ul id="nav-menu" class="d-flex flex-row list-unstyled gap-3 mb-0">
        <li><a href="../../index.php" class="nav-link">Home</a></li>
        <li><a href="news.php" class="nav-link">News</a></li>
        <li><a href="faculty.php" class="nav-link">Faculty</a></li>
        <li><a href="gallery.php" class="nav-link">Gallery</a></li>
        <li><a href="aboutus.php" class="nav-link">About Us</a></li>
        <li><a href="contactus.php" class="nav-link">Contacts</a></li>
        </ul>
        <div class="search-bar d-flex ms-3">
        <input type="text" class="form-control" placeholder="Search...">
        <button class="btn btn-danger ms-2">Search</button>
        </div>
    </div>
    </header>

    <!-- Sidebar Navigation (Mobile Only) -->
    <div class="mobile-sidebar">
    <ul id="nav-menu-mobile" class="list-unstyled">
        <li><a href="../../index.php" class="nav-link">Home</a></li>
        <li><a href="news.php" class="nav-link">News</a></li>
        <li><a href="faculty.php" class="nav-link">Faculty</a></li>
        <li><a href="gallery.php" class="nav-link">Gallery</a></li>
        <li><a href="aboutus.php" class="nav-link">About Us</a></li>
        <li><a href="contactus.php" class="nav-link">Contacts</a></li>
    </ul>
    <div class="search-bar mt-2 px-3 d-flex">
        <input type="text" class="form-control" placeholder="Search...">
        <button class="btn btn-danger d-flex align-items-center justify-content-center" style="width: 45px; padding: 0;">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="white" class="bi bi-search" viewBox="0 0 20 20">
            <path d="M11 6a5 5 0 1 1-10 0 5 5 0 0 1 10 0zm-1.225 4.02a6.5 6.5 0 1 1 1.225-1.225l3.85 3.85a.75.75 0 0 1-1.06 1.06l-3.85-3.85z"/>
        </svg>
        </button>
    </div>
    </div>
<body1 class="mx-3 mx-md-5">
    <section id="mission-vision-container" class="container my-5">
  <div class="row justify-content-center">
    <div class="col-md-5 mb-4">
      <div class="card shadow-sm h-100">
        <div class="card-body">
          <h3 class="card-title text-primary mb-3">
            <i class="fas fa-bullseye"></i> Mission
          </h3>
          <ul class="list-unstyled mb-0">
            <?php foreach ($missions as $mv): ?>
              <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i><?= htmlspecialchars($mv['content']) ?></li>
            <?php endforeach; ?>
          </ul>
        </div>
      </div>
    </div>
    <div class="col-md-5 mb-4">
      <div class="card shadow-sm h-100">
        <div class="card-body">
          <h3 class="card-title text-success mb-3">
            <i class="fas fa-eye"></i> Vision
          </h3>
          <ul class="list-unstyled mb-0">
            <?php foreach ($visions as $mv): ?>
              <li class="mb-2"><i class="bi bi-star-fill text-warning me-2"></i><?= htmlspecialchars($mv['content']) ?></li>
            <?php endforeach; ?>
          </ul>
        </div>
      </div>
    </div>
  </div>
</section>


    <!-- Modal Code -->
    <div id="calendar-modal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Calendar Details</h2>
            <p>Event Details will be shown here.</p>
        </div>
    </div>
  
    <!-- Calendar -->
    <div class="calendar-container">
        <div id="calendar-controls">
            <button id="prev-month">Prev</button>
            <span id="current-month"></span>
            <button id="next-month">Next</button>
        </div>
        <div id="calendar-content"></div>
    </div>
  </main>

<script src="../../https://kit.fontawesome.com/a076d05399.js"></script>
<script>
const calendarEvents = <?= json_encode($events) ?>;

const monthNames = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
let currentDate = new Date();
let currentMonth = currentDate.getMonth();
let currentYear = currentDate.getFullYear();

// Parse events into a map for quick lookup
const eventMap = {};
calendarEvents.forEach(ev => {
    eventMap[ev.event_date] = ev;
});

function renderCalendar() {
    const monthName = monthNames[currentMonth];
    const year = currentYear;
    document.getElementById('current-month').innerText = `${monthName} ${year}`;

    // Get number of days in this month
    const daysInMonth = new Date(year, currentMonth + 1, 0).getDate();
    // First day of the month (0=Sun, 1=Mon, ...)
    const firstDay = new Date(year, currentMonth, 1).getDay();

    let calendarHTML = `<table class="table table-bordered"><tr>`;
    // Empty cells for days before the 1st
    for (let i = 0; i < firstDay; i++) {
        calendarHTML += `<td></td>`;
    }
    for (let day = 1; day <= daysInMonth; day++) {
        const dateStr = `${year}-${String(currentMonth+1).padStart(2,'0')}-${String(day).padStart(2,'0')}`;
        const event = eventMap[dateStr];
        let cellClass = event ? 'bg-warning text-dark calendar-event' : '';
        calendarHTML += `<td class="${cellClass}" data-date="${dateStr}">${day}${event ? '<br><i class="bi bi-calendar-event"></i>' : ''}</td>`;
        if ((firstDay + day) % 7 === 0) calendarHTML += `</tr><tr>`;
    }
    calendarHTML += `</tr></table>`;
    document.getElementById('calendar-content').innerHTML = calendarHTML;

    // Add click listeners to event days
    document.querySelectorAll('.calendar-event').forEach(td => {
        td.addEventListener('click', function() {
            const date = this.getAttribute('data-date');
            const ev = eventMap[date];
            if (ev) {
                showEventModal(ev);
            }
        });
    });
}

function showEventModal(ev) {
    const modal = document.getElementById('calendar-modal');
    modal.querySelector('h2').innerText = ev.title;
    modal.querySelector('p').innerHTML = `<strong>Date:</strong> ${ev.event_date}<br><strong>Description:</strong> ${ev.description || 'No description.'}`;
    modal.style.display = 'block';
}

document.getElementById('prev-month').addEventListener('click', function() {
    currentMonth--;
    if (currentMonth < 0) {
        currentMonth = 11;
        currentYear--;
    }
    renderCalendar();
});

document.getElementById('next-month').addEventListener('click', function() {
    currentMonth++;
    if (currentMonth > 11) {
        currentMonth = 0;
        currentYear++;
    }
    renderCalendar();
});

// Modal close
document.querySelector('#calendar-modal .close').onclick = function() {
    document.getElementById('calendar-modal').style.display = 'none';
};

renderCalendar();
</script>

<!-- Bootstrap JS (for dropdowns, etc.) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- Responsive Nav Script -->
<script>
  const navToggle = document.querySelector('.nav-toggle');
  const mobileSidebar = document.querySelector('.mobile-sidebar');
  const overlay = document.querySelector('.overlay');

  navToggle.addEventListener('click', () => {
    mobileSidebar.classList.toggle('active');
    overlay.classList.toggle('active');
  });

  overlay.addEventListener('click', () => {
    mobileSidebar.classList.remove('active');
    overlay.classList.remove('active');
  });
</script>

<style>
.calendar-event {
    cursor: pointer;
    font-weight: bold;
    border-radius: 4px;
    transition: background 0.2s;
}
.calendar-event:hover {
    background: #ffc107 !important;
}
#calendar-modal {
    display: none;
    position: fixed;
    z-index: 9999;
    left: 0; top: 0; right: 0; bottom: 0;
    background: rgba(0,0,0,0.5);
    align-items: center; justify-content: center;
}
#calendar-modal .modal-content {
    background: #fff;
    padding: 2rem;
    border-radius: 8px;
    max-width: 400px;
    margin: 10% auto;
    position: relative;
}
#calendar-modal .close {
    position: absolute;
    right: 1rem;
    top: 1rem;
    font-size: 1.5rem;
    cursor: pointer;
}
</style>
</body1>
</body>
</html>

