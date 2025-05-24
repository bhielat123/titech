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
    <link rel="stylesheet" href="/css/student/aboutus.css">
</head>
<body>
    <!-- Hamburger Toggle Button (Mobile Only) -->
    <button class="nav-toggle btn d-md-none" aria-label="toggle navigation">☰</button>

    <!-- Overlay for mobile sidebar -->
    <div class="overlay"></div>

    <!-- Header -->
<header class="d-flex flex-row align-items-center justify-content-between px-4 py-3">
  <h1 class="m-0">
    <a href="/index.php">
      <img src="../../images/newlogo1.png" alt="Logo" style="height: 50px;">
    </a>
  </h1>
    <div class="nav-container d-none d-md-flex flex-row align-items-center">
        <ul id="nav-menu" class="d-flex flex-row list-unstyled gap-3 mb-0">
        <li><a href="/index.php" class="nav-link">Home</a></li>
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
        <li><a href="/index.php" class="nav-link">Home</a></li>
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
  
  <main>
    <section id="about-mission-vision">
        <div class="content-container">
            <h2>Mission and Vision</h2>
            <p>Our mission is to educate and empower students to become leaders and responsible citizens.</p>

            <div class="mission-vision-container">
                <div class="mission-item">
                    <i class="fas fa-bullseye"></i>
                    <h3>Mission</h3>
                    <p>To provide quality education and develop strong ethical values.</p>
                </div>

                <div class="separator"></div>

                <div class="vision-item">
                    <i class="fas fa-eye"></i>
                    <h3>Vision</h3>
                    <p>To create a community of learners who are empowered to make positive changes in society.</p>
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

<script src="https://kit.fontawesome.com/a076d05399.js"></script>
<script>
// JavaScript code to manage calendar functionality

const monthNames = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];

let currentDate = new Date();
let currentMonth = currentDate.getMonth();
let currentYear = currentDate.getFullYear();

// Render the calendar
function renderCalendar() {
    const monthName = monthNames[currentMonth];
    const year = currentYear;
    document.getElementById('current-month').innerText = `${monthName} ${year}`;

    let calendarHTML = `<table role='grid'><tr>`;
    for (let i = 1; i <= 31; i++) {
        calendarHTML += `<td>${i}</td>`;
        if (i % 7 === 0) {
            calendarHTML += `</tr><tr>`;
        }
    }
    calendarHTML += `</tr></table>`;
    document.getElementById('calendar-content').innerHTML = calendarHTML;
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
</body>
</html>
