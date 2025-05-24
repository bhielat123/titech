<?php
require_once '../../database/dbconnection.php';

function safeOutput($value) {
    return htmlspecialchars($value ?? '', ENT_QUOTES, 'UTF-8');
}

// Fetch the latest main news
$mainNews = $pdo->query("SELECT * FROM main_news ORDER BY id DESC LIMIT 1")->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <link rel="shortcut icon" href="../../images/wrlogo.png" type="image/png">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>West Rembo Learning Center</title> 
  <link href="https://fonts.googleapis.com/css2?family=Unkempt:wght@400;700&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../../css/student/news.css">
</head>
<body>
<!-- Hamburger Toggle Button (Mobile Only) -->
<button class="nav-toggle btn d-md-none" aria-label="toggle navigation">☰</button>

<!-- Overlay for mobile sidebar -->
<div class="overlay"></div>

<!-- Header -->
<header style= "font-size:1rem;" class="d-flex flex-row align-items-center justify-content-between px-4 py-3">
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

<div class="header1">
  <h1>News Section</h1>
</div>

<!-- Main Content Area with F-layout -->
<div class="content">
  <!-- Main Content Placeholder -->
  <div class="main d-flex flex-column align-items-center justify-content-center" style="min-height:350px;">
  <?php if ($mainNews): ?>
        <h2 style="font-size:2rem; color:#FFFFFF;"><?= safeOutput($mainNews['title']) ?></h2>
          <p style="font-size:1rem; color:#FFFFFF;">
        <?= safeOutput($mainNews['content']) ?>
      </p>
      <?php if (!empty($mainNews['image'])): ?>
        <img src="../../<?= safeOutput($mainNews['image']) ?>" alt="Main News" style="max-width:800px; border-radius:14px; margin-bottom:18px;">
      <?php endif; ?>
      
      
    <?php else: ?>
      <h2 style="font-size:2rem; color:#FFFFFF;">No News Yet</h2>
      <img src="../../images/sample-event.jpg" alt="Sample News" style="max-width:800px; border-radius:14px; margin-bottom:18px;">
      
      <p style="font-size:1rem; color:#FFFFFF;">
        News and updates will appear here soon. Please check back later!
      </p>
    <?php endif; ?>
  </div>

  <!-- Sidebar Content Placeholder -->
  <div class="sidebar">
    <?php
    // Fetch latest news (limit to 3 for sidebar)
    $newsSidebar = $pdo->query("SELECT * FROM news ORDER BY created_at DESC LIMIT 3")->fetchAll(PDO::FETCH_ASSOC);
    ?>
    <?php if (empty($newsSidebar)): ?>
      <div class="sample-event mb-4" style="background: rgba(0,0,0,0.6); border-radius: 10px; padding: 20px 10px; color: #fff; text-align: center;">
        <h2 style="font-size:1rem; color:#FFFFFF;">Sample Event</h2>
        <a href="gallery.php">
          <img src="../../images/sample-event.jpg" alt="Sample Event" style="max-width: 100%; border-radius: 8px;">
        </a>
        <p style="font-size:0.90rem; color:#FFFFFF;">
          This is a sample event description. Add news in the admin panel to replace this sample.
        </p>
      </div>
    <?php else: ?>
      <?php foreach ($newsSidebar as $item): ?>
        <div class="mb-4" style="background: rgba(0,0,0,0.6); border-radius: 10px; padding: 20px 10px; color: #fff; text-align: center;">
          <h2 style="font-size:1rem; color:#FFFFFF;"><?= safeOutput($item['title']) ?></h2>
          <?php if (!empty($item['image'])): ?>
            <img src="../../<?= safeOutput($item['image']) ?>" alt="News Image" style="max-width: 100%; border-radius: 8px;">
          <?php endif; ?>
          <p style="font-size:0.90rem; color:#FFFFFF;"><?= safeOutput($item['content']) ?></p>
          <small class="text-muted"><?= safeOutput($item['created_at']) ?></small>
        </div>
      <?php endforeach; ?>
    <?php endif; ?>
  </div>
</div>

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
          <li><a href="gallery.php">Gallery</a></li>
          <li><a href="faculty.php">Faculty</a></li>
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
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
.content {
  display: flex;
  flex: 1;
}

.main {
  width: 70%;
  padding: 20px 10px 20px 10px;
  background: rgba(0,0,0,0.6);
  border-radius: 10px;
  box-shadow: 0 2px 8px rgba(0,0,0,0.04);
  color: #fff;
  min-height: 350px;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
}

.main img {
  margin-top: 20px;
  width: 100%;
  height: auto;
  margin-bottom: 20px;
  max-width: 320px;
}

.sidebar {
  width: 30%;
  padding: 20px 10px 20px 10px;
  background: rgba(0,0,0,0.6);
  border-radius: 10px;
  box-shadow: 0 2px 8px rgba(0,0,0,0.04);
  margin-left: 20px;
  height: fit-content;
  max-height: 100vh;
  overflow-y: auto;
  color: #fff;
}
.sidebar img {
  width: 100%;
  height: auto;
  border-radius: 8px;
  margin-bottom: 10px;
}
</style>
</body>
</html>