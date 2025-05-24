<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <link rel="shortcut icon" href="../../images/wrlogo.png" type="image/png">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>West Rembo Learning Center</title> 

    <!-- Bootstrap 5 CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
   <link href="https://fonts.googleapis.com/css2?family=Unkempt:wght@400;700&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&family=Roboto:wght@300;400;500&family=Open+Sans:wght@300;400;600&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="/css/student/news.css">
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

<div class="header1">
  <h1>News Section</h1>
</div>

  <!-- Main Content Area with F-layout -->
  <div class="content">
    <!-- Main Content -->
	
    <div class="main">
      <h2>Elevating Dreams, One Step at a Time!</h2>
      <p>A moment to celebrate the hard work, growth, and bright futures of our students as they take the next big step on their educational
	  journey.Let’s cheer them on as they move up and shine even brighter!</p>
      <!-- Image Section -->
      <img src="/images//movUp.jpg" alt="Moving Up">
      
    </div>

    <!-- Sidebar Content -->
    <div class="sidebar">
	<div class="header1">
	<ul>
	<h2>Other Notable Events</h2>
	</div>

    <!-- Wrap each image with a link to the album -->
    <h3>Halloween Party</h3>
    <a href="gallery.php">
      <img src="/images/halloween.jpg" alt="Halloween">
    </a>
    <p>The Halloween celebration was a hit, featuring fun activities, creative costumes, and plenty of treats for everyone.</p>
    
    <h3>Wikang Katutubo Day</h3>
    <a href="gallery.php">
      <img src="/images//Wikatu.jpg" alt="Wika">
    </a>
    <p>Wikang Katutubo Day was successfully celebrated, highlighting the importance of preserving indigenous languages in the Philippines.</p>
    
    <h3>United Nations Day</h3>
    <a href="gallery.php">
      <img src="/images//und.jpg" alt="UND">
    </a>
    <p>United Nations Day was observed with various activities that focused on promoting global peace and unity.</p>
    
    <h3>Lakbay Aral</h3>
    <a href="gallery.php">
      <img src="/images//la.jpg" alt="LA">
    </a>
    <p>The Lakbay Aral trip provided students with valuable hands-on learning experiences as they explored new environments.</p>
    
    <h3>Celebrate Birthday with Us</h3>
    <a href="gallery.php">
      <img src="/images//bday.jpg" alt="BDay">
    </a>
    <p>Students gathered to celebrate the birthdays of their peers in a joyous and lively celebration.</p>
    </ul>
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