<?php
// Include the database connection
include_once '../../database/dbconnection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $phone = htmlspecialchars($_POST['phone']);
    $message = htmlspecialchars($_POST['message']);
    $created_at = date('Y-m-d H:i:s'); // Get the current timestamp

    try {
        // Insert data into the contactus table using PDO
        $sql = "INSERT INTO contactus (name, email, phone, message, created_at) VALUES (:name, :email, :phone, :message, :created_at)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':name' => $name,
            ':email' => $email,
            ':phone' => $phone,
            ':message' => $message,
            ':created_at' => $created_at,
        ]);

        echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                const responseMessage = document.getElementById('formErrorMessage');
                responseMessage.textContent = 'Your message has been sent successfully!';
                responseMessage.style.color = 'green';
            });
        </script>";
    } catch (PDOException $e) {
        echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                const responseMessage = document.getElementById('formErrorMessage');
                responseMessage.textContent = 'Error: " . $e->getMessage() . "';
                responseMessage.style.color = 'red';
            });
        </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="../../images/wrlogo.png" type="image/png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>

        <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
		 <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
   <link href="https://fonts.googleapis.com/css2?family=Unkempt:wght@400;700&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&family=Roboto:wght@300;400;500&family=Open+Sans:wght@300;400;600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Patrick+Hand&display=swap" rel="stylesheet"> <!-- Handwritten font -->
    <link rel="stylesheet" href="../../css/student/contact.css">
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
        <li><a href="album.php" class="nav-link">Gallery</a></li>
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
        <li><a href="album.php" class="nav-link">Gallery</a></li>
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

    <div class="container">
        <div class="description">
            <h1><b>Contact Us</b></h1>
            <p>If you have any questions or feedback, feel free to reach out to us! You can also connect with us on social media.</p>
            <div class="social-icons">
                <a href="https://www.facebook.com/wrtclcinc2002" target="_blank" aria-label="Facebook"><i class="fab fa-facebook"></i></a>
                <a href="#" target="_blank" aria-label="Email"><i class="fas fa-envelope"></i></a>
            </div>
        </div>

        <!-- Contact Form -->
        <form id="contactForm" class="contact-form" action="ContactUs.php" method="POST" novalidate>
            <div id="formErrorMessage" style="margin-bottom: 15px;"></div>
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required aria-required="true" placeholder="Your Name">
                <span class="error-message" id="nameError"></span>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required aria-required="true" placeholder="Your Email">
                <span class="error-message" id="emailError"></span>
            </div>
            <div class="form-group">
                <label for="phone">Contact Number:</label>
                <input type="tel" id="phone" name="phone" required aria-required="true" placeholder="09XX-XXXX-XXXX" pattern="^\d{4}-\d{4}-\d{4}$" maxlength="13">
                <span class="error-message" id="phoneError"></span>
            </div>
            <div class="form-group">
                <label for="message">Message:</label>
                <textarea id="message" name="message" required aria-required="true" placeholder="Your Message"></textarea>
                <span class="error-message" id="messageError"></span>
            </div>
            <div id="responseMessage" class="response-message">
                <button type="submit">Send Message</button>
            </div>
        </form>

        <!-- Google Maps Section -->
        <h2><b>Our Location</b></h2>
        <iframe
            src="https://www.google.com/maps/embed/v1/place?key=AIzaSyD1VnYC6EugmolDY9RjsZ77TeXstyj0288&q=H364%2BWXH+West+Rembo+Teachers&#39;+Compound+Learning+Center,+Teachers+Compound,+Taguig,+1215+Metro+Manila&zoom=17"
            width="600"
            height="450"
            style="border:0;"
            allowfullscreen=""
            loading="lazy"></iframe>

        <!-- FAQ Section -->
        <h2><b>Frequently Asked Questions</b></h2>
        <div class="faq-section">
            <div class="faq-item">
                <h3>What are your operating hours?</h3>
                <p>We are open Monday to Friday from 9 AM to 5 PM.</p>
            </div>
            <div class="faq-item">
                <h3>How can I track my message?</h3>
                <p>You will receive a confirmation email once your message has been received.</p>
            </div>
            <div class="faq-item">
                <h3>Do you offer support on weekends?</h3>
                <p>Currently, we do not offer weekend support, but we will respond to your inquiry as soon as possible during business hours.</p>
            </div>
        </div>

    </div>
</div>
</div>
</div>

    </body>
    

    

    <!-- JavaScript for form validation -->
    <script src="./lala.js"></script> 

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

    <script>
    document.getElementById('contactForm').addEventListener('submit', function(event) {
        // Prevent form submission
        event.preventDefault();

        // Get form values
        const email = document.getElementById('email').value.trim();
        const phone = document.getElementById('phone').value.trim();
        const message = document.getElementById('message').value.trim();

        // Error message container
        const errorMessage = document.getElementById('formErrorMessage');

        // Validate email format (allow any valid email)
        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailPattern.test(email)) {
            errorMessage.textContent = 'Please enter a valid email address.';
            errorMessage.style.color = 'red';
            return;
        }

        // Validate required fields
        if (!email || !phone || !message) {
            errorMessage.textContent = 'Email, phone, and message are required fields. Please fill them out.';
            errorMessage.style.color = 'red';
        } else {
            errorMessage.textContent = 'Message successfully submitted!';
            errorMessage.style.color = 'green';
            this.submit(); // Submit the form
        }
    });

    // Add input mask for phone number
    document.getElementById('phone').addEventListener('input', function(event) {
        let value = event.target.value.replace(/[^0-9]/g, ''); // Remove non-numeric characters
        if (value.length > 4 && value.length <= 7) {
            value = value.slice(0, 4) + '-' + value.slice(4);
        } else if (value.length > 7) {
            value = value.slice(0, 4) + '-' + value.slice(4, 7) + '-' + value.slice(7, 11);
        }
        event.target.value = value;
    });
    </script>
</body>
</html>
