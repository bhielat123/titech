<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="../../images/wrlogo.png" type="image/png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Baloo+Paaji+2:wght@400..800&family=DM+Serif+Text:ital@0;1&family=Fredoka:wght@300..700&family=Funnel+Display:wght@300..800&family=Irish+Grover&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Rubik+Puddles&family=Shadows+Into+Light&family=Unkempt:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../css/student/faculty.css">
    <title>Faculty and Staff</title>
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

    <!-- Main Heading -->

    <!-- Faculty Section -->
    <?php
require_once '../../database/dbconnection.php';
$facultyList = $pdo->query("SELECT * FROM faculty ORDER BY id DESC")->fetchAll(PDO::FETCH_ASSOC);
?>
<section class="faculty-section">
    <h2>Meet Our Dedicated Faculty and Staff</h2>
    <div class="faculty-list">
        <?php foreach ($facultyList as $faculty): ?>
        <div class="faculty-item">
            <img class="faculty-photo" src="../../<?= htmlspecialchars($faculty['image']) ?>">
            <p><?= htmlspecialchars($faculty['name']) ?></p>
        </div>
        <?php endforeach; ?>
    </div>
</section>


<!-- Footer -->
<section class="footer mt-auto py-5">
  <div class="container">
    <div class="row footer-row">
      <div class="col-md-3 footer-col mb-4">
        <h4>Info</h4>
        <ul class="links list-unstyled">
          <li><a href="index.php">Home</a></li>
          <li><a href="news.php">News</a></li>
          <li><a href="aboutus.php">About Us</a></li>
          <li><a href="contactus.php">Contacts</a></li>
        </ul>
      </div>
      <div class="col-md-3 footer-col mb-4">
        <h4>Explore</h4>
        <ul class="links list-unstyled">
          <li><a href="../../gallery.php">Gallery</a></li>
          <li><a href="../../faculty.php">Faculty</a></li>
        </ul>
      </div>
      <div class="col-md-3 footer-col mb-4">
        <h4>Legal</h4>
        <ul class="links list-unstyled">
          <li><a href="aboutus.php#mission-vision-container">Mission</a></li>
          <li><a href="aboutus.php#mission-vision-container">Vision</a></li>
          <li><a href="aboutus.php#calendar">School Calendar</a></li>
        </ul>
      </div>
      <div class="col-md-3 footer-col">
        <a href="https://web.facebook.com/wrtclcinc2002" class="text-white text-decoration-none">
          <h4>Facebook</h4>
        </a>
        <p>
          Follow our Facebook page for a weekly dose of news, updates,
          helpful tips, and exclusive offers.
        </p>
      </div>
    </div>
  </div>
</section>

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
