<?php
// Include the database connection
include_once '../../database/dbconnection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    function formatInput($input) {
        return ucwords(strtolower(trim($input)));
    }

    $surname = $conn->real_escape_string(formatInput($_POST['surname']));
    $firstname = $conn->real_escape_string(formatInput($_POST['firstname']));
    $middlename = !empty($_POST['middlename']) ? $conn->real_escape_string(formatInput($_POST['middlename'])) : NULL;
    $gender = $conn->real_escape_string(formatInput($_POST['gender']));
    $birthplace = $conn->real_escape_string(formatInput($_POST['birthplace']));
    $email = $conn->real_escape_string(trim($_POST['email'])); // Email should not be formatted
    $dob = $conn->real_escape_string(trim($_POST['dob'])); // Date should not be formatted
    $street = $conn->real_escape_string(formatInput($_POST['street']));
    $city = $conn->real_escape_string(formatInput($_POST['city']));
    $province = $conn->real_escape_string(formatInput($_POST['province']));
    $zipcode = $conn->real_escape_string(trim($_POST['zipcode'])); // Zipcode should not be formatted
    $parentSurname = $conn->real_escape_string(formatInput($_POST['parentSurname']));
    $parentFirst = $conn->real_escape_string(formatInput($_POST['parentFirst']));
    $parentMiddle = $conn->real_escape_string(formatInput($_POST['parentMiddle']));
    $parentPhone = $conn->real_escape_string(trim($_POST['parentPhone'])); // Phone should not be formatted
    $parentEmail = $conn->real_escape_string(trim($_POST['parentEmail'])); // Email should not be formatted
    $parentOccupation = $conn->real_escape_string(formatInput($_POST['parentOccupation']));
    $status = 'Pending'; // Set the status to Pending
    $created_at = date('Y-m-d H:i:s'); // Get the current timestamp

    // Insert data into the enrollment table
    $sql = "INSERT INTO enrollment (surname, firstname, middlename, gender, birthplace, email, dob, street, city, province, zipcode, parentSurname, parentFirst, parentMiddle, parentPhone, parentEmail, parentOccupation, status, created_at) VALUES ('$surname', '$firstname', " . ($middlename !== NULL ? "'$middlename'" : "NULL") . ", '$gender', '$birthplace', '$email', '$dob', '$street', '$city', '$province', '$zipcode', '$parentSurname', '$parentFirst', '$parentMiddle', '$parentPhone', '$parentEmail', '$parentOccupation', '$status', '$created_at')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>
            alert('Enrollment data has been submitted successfully!');
            window.location.href = 'enroll.php?success=true';
        </script>";
    } else {
        echo "<script>alert('Error: " . $conn->error . "');</script>";
    }

    // Close the database connection
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <link rel="shortcut icon" href="../../images/wrlogo.png" type="image/png">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <title>West Rembo Learning Center</title> 
        <!-- Bootstrap 5 CDN -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Fredoka+One&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Baloo&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Unkempt:wght@400;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="/css/student/enroll.css">
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
    <div class="enrollment-container">
        <form id="enrollmentForm" action="enroll.php" method="POST">
            <!-- Section 1: Data Privacy Notice -->
            <div id="page1" class="page active">
                <section class="not">
                    <h2>Data Privacy Notice</h2>
                    <p>In accordance with the Data Privacy Act of 2012 (Republic Act No. 10173), this app form will take personal important information, solely for identifying and enrolling the said person or student. All data provided will be treated confidentially, used exclusively for processing that student's application, and will not be shared without explicit consent. By participating, you acknowledge your rights as a future student of this school and grant consent for the collection and processing of your data as outlined in the Data Privacy Policy.</p>
                    <p>Do you agree on giving consent to the collection and processing of your information, solely for the enrollment process to take place?</p>
                    <div class="check-container">
                        <input type="radio" id="consent-yes" name="consent" value="yes" required onchange="showPage(2)">
                        <label for="consent-yes">Yes</label>
                        <input type="radio" id="consent-no" name="consent" value="no">
                        <label for="consent-no">No</label>
                    </div>
                    <div class="error-message" style="margin-bottom: 15px;"></div>
                </section>
                <?php
                    if (isset($_GET['success']) && $_GET['success'] === 'true') {
                        echo "<div style='text-align: center; color: green; margin-top: 20px;'>Enrollment successfully submitted</div>";
                    }
                    ?>
            </div>

            <!-- Section 2: Student Information -->
            <div id="page2" class="page">
                <section class="sec">
                    <label for="surname">Surname:</label>
                    <input type="text" id="surname" name="surname" class="form-input" required>
                    <label for="firstname">First name:</label>
                    <input type="text" id="firstname" name="firstname" class="form-input" required>
                    <label for="middlename">Middle Name:</label>
                    <input type="text" id="middlename" name="middlename" class="form-input" placeholder="Middle Name (Optional)">
                </section>
                <section class="sec">
                    <label>Gender:</label>
                    <input type="radio" id="gender-male" name="gender" value="Male" required>
                    <label for="gender-male">Male</label>
                    <input type="radio" id="gender-female" name="gender" value="Female" required>
                    <label for="gender-female">Female</label>
                </section>
                <section class="sec">
                    <label for="birthplace">Birthplace:</label>
                    <input type="text" id="birthplace" name="birthplace" class="form-input" required>
                    <label for="email">Email address:</label>
                    <input type="email" id="email" name="email" class="form-input" required>
                    <label for="dob">Date of Birth:</label>
                    <input type="date" id="dob" name="dob" class="form-input" required>
                </section>
                <div class="error-message" style="margin-bottom: 15px;"></div>
                <div class="center">
                    <button type="button" class="form-nav" data-current-page="2" data-next-page="1">Previous</button>
                    <button type="button" class="form-nav" data-current-page="2" data-next-page="3">Next</button>
                </div>
            </div>

            <!-- Section 3: Address Information -->
            <div id="page3" class="page">
                <h3>Main Address</h3>
                <section class="sec1">
                    <label for="street">Street/House number:</label>
                    <input type="text" id="street" name="street" class="form-input" required>
                    <label for="city">City/Municipality:</label>
                    <input type="text" id="city" name="city" class="form-input" required>
                    <label for="province">Province:</label>
                    <input type="text" id="province" name="province" class="form-input" required>
                </section>
                <section class="sec1">
                    <label for="zipcode">Postal/Zip Code:</label>
                    <input type="text" id="zipcode" name="zipcode" class="form-input" pattern="[0-9]{4}" required>
                </section>
                <div class="error-message" style="margin-bottom: 15px;"></div>
                <div class="center">
                    <button type="button" class="form-nav" data-current-page="3" data-next-page="2">Previous</button>
                    <button type="button" class="form-nav" data-current-page="3" data-next-page="4">Next</button>
                </div>
            </div>

            <!-- Section 4: Parent Information -->
            <div id="page4" class="page">
                <h2>Parent Information</h2>
                <section class="parent-info">
                    <label for="parentSurname">Surname:</label>
                    <input type="text" id="parentSurname" name="parentSurname" class="form-input" required>
                    <label for="parentFirst">First name:</label>
                    <input type="text" id="parentFirst" name="parentFirst" class="form-input" required>
                    <label for="parentMiddle">Middle Name:</label>
                    <input type="text" id="parentMiddle" name="parentMiddle" class="form-input" placeholder="Middle Name (Optional)">
                </section>
                <section class="parent-info">
                    <label for="parentPhone">Phone:</label>
                    <input type="tel" id="parentPhone" name="parentPhone" class="form-input" required>
                    <label for="parentEmail">Email address:</label>
                    <input type="email" id="parentEmail" name="parentEmail" class="form-input" required>
                    <label for="parentOccupation">Occupation:</label>
                    <input type="text" id="parentOccupation" name="parentOccupation" class="form-input" required>
                </section>
                <div class="error-message" style="margin-bottom: 15px;"></div>
                <div class="center">
                    <button type="button" class="form-nav" data-current-page="4" data-next-page="3">Previous</button>
                    <button type="submit" class="submit-btn" data-current-page="4">Submit</button>
                </div>
            </div>
        </form>
    </div>
    </body>

    <script>
    function showPage(pageNumber) {
        // Hide all pages
        const pages = document.querySelectorAll('.page');
        pages.forEach(page => page.classList.remove('active'));

        // Show the selected page
        const selectedPage = document.getElementById(`page${pageNumber}`);
        if (selectedPage) {
            selectedPage.classList.add('active');
        }
    }

    // Add event listener for the 'Yes' radio button
    document.getElementById('consent-yes').addEventListener('change', function() {
        if (this.checked) {
            showPage(2); // Navigate to page 2
        }
    });

    // Updated validation to allow optional fields for middleName and parentMiddle
    function validatePage(pageNumber) {
        const page = document.getElementById(`page${pageNumber}`);
        const inputs = page.querySelectorAll('input, textarea, select');
        let isValid = true;
        const errorMessage = page.querySelector('.error-message');

        // Check if all required inputs are filled
        inputs.forEach(input => {
            if (input.hasAttribute('required') && !input.value.trim()) {
                isValid = false;
                input.classList.add('invalid');
            } else {
                input.classList.remove('invalid');
            }
        });

        // Show or hide error message
        if (!isValid) {
            errorMessage.textContent = 'Please fill out all required fields before proceeding.';
            errorMessage.style.color = 'red';
        } else {
            errorMessage.textContent = '';
        }

        return isValid;
    }

    document.querySelectorAll('.form-nav').forEach(button => {
        button.addEventListener('click', function () {
            const currentPage = parseInt(this.getAttribute('data-current-page'));
            const nextPage = parseInt(this.getAttribute('data-next-page'));

            if (validatePage(currentPage)) {
                showPage(nextPage);
            }
        });
    });

    function validateAge(dob) {
        const today = new Date('2025-04-21'); // Current date
        const birthDate = new Date(dob);
        const age = today.getFullYear() - birthDate.getFullYear();
        const monthDiff = today.getMonth() - birthDate.getMonth();

        // Adjust age if the birthday hasn't occurred yet this year
        if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthDate.getDate())) {
            age--;
        }

        return age >= 5 && age <= 15;
    }

    document.querySelector('.submit-btn').addEventListener('click', function (event) {
        const dobInput = document.getElementById('dob');
        const dob = dobInput.value;
        const errorMessage = document.querySelector('.error-message');

        if (!validateAge(dob)) {
            event.preventDefault();
            errorMessage.textContent = 'Age must be between 5 and 15 years old to enroll.';
            errorMessage.style.color = 'red';
            dobInput.classList.add('invalid');
        } else {
            errorMessage.textContent = '';
            dobInput.classList.remove('invalid');
        }
    });
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
     </html>
