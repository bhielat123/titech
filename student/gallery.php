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
    <link href="https://fonts.googleapis.com/css2?family=Baloo+Paaji+2:wght@400..800&family=Fredoka:wght@300..700&family=Irish+Grover&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Rubik+Puddles&family=Shadows+Into+Light&family=Unkempt:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/css/student/gallery.css">
    <title>School Album</title>
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
        <li><a href="/index.php" class="nav-link">Home</a></li>
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

    <!-- Main Heading -->

    </header>

    <!-- Main Content -->
    <main>
    <!-- Buwan ng Wika Section -->
    <section class="album" id="buwan-ng-wika">
        <h2>Buwan ng Wika</h2>
        <div class="wrapper">
            <div class="item">
                <div class="polaroid">
                    <img src="../../images/Buwan ng Wika/69245948_2301111250200236_7728002980032544768_n.jpg" onclick="openModal(this)">
                    <div class="caption">Language, Culture, History, Fun!</div>
                </div>
            </div>

            <div class="item">
                <div class="polaroid">
                    <img src="../../images/Buwan ng Wika/69440666_2301111573533537_410773751680991232_n.jpg" onclick="openModal(this)">
                    <div class="caption">Celebrate Language and Culture!</div>
                </div>
            </div>

            <div class="item">
                <div class="polaroid">
                    <img src="../../images/Buwan ng Wika/69465640_2301110516866976_3421471914084794368_n.jpg" onclick="openModal(this)">
                    <div class="caption">Our Country, Our Pride!.</div>
                </div>
            </div>

            <!-- Add other images here in the same pattern -->
        </div>
    </section>

    <!-- Field Trip Section -->
    <section class="album" id="field-trip">
        <h2>Field Trip</h2>
        <div class="wrapper">
            <div class="item">
                <div class="polaroid">
                    <img src="../../images/FieldTrip/70903573_2325375344440493_8427325313402273792_n.jpg" onclick="openModal(this)">
                    <div class="caption">Fun and Learning Adventure!</div>
                </div>
            </div>

            <div class="item">
                <div class="polaroid">
                    <img src="../../images/FieldTrip/70147368_2325375891107105_3566101123846635520_n.jpg" onclick="openModal(this)">
                    <div class="caption">Explore, Learn, Enjoy Together!</div>
                </div>
            </div>

            <div class="item">
                <div class="polaroid">
                    <img src="../../images/FieldTrip/71495220_2325376957773665_5273882521346506752_n (1).jpg" onclick="openModal(this)">
                    <div class="caption">Discover, Experience, Have Fun!</div>
                </div>
            </div>

            <!-- Add other images here in the same pattern -->
        </div>
    </section>

    <!-- Moving Up Section -->
    <section class="album" id="moving-up">
        <h2>Moving Up</h2>
        <div class="wrapper">
            <div class="item">
                <div class="polaroid">
                    <img src="../../images/Moving Up/54358724_2190882734556422_5074548484934205440_n.jpg" onclick="openModal(this)">
                    <div class="caption">Ready for New Challenges!</div>
                </div>
            </div>

            <div class="item">
                <div class="polaroid">
                    <img src="../../images/Moving Up/54364788_2190882491223113_5993153715085770752_n.jpg" onclick="openModal(this)">
                    <div class="caption">Next Step, New Adventures!</div>
                </div>
            </div>

            <div class="item">
                <div class="polaroid">
                    <img src="../../images/Moving Up/54434692_2190883414556354_4034634974408736768_n.jpg" onclick="openModal(this)">
                    <div class="caption">Growing, Learning, Moving Forward!</div>
                </div>
            </div>

            <!-- Add other images here in the same pattern -->
        </div>
    </section>

    <!-- Nutrition Month Section -->
    <section class="album" id="nutrition-month">
        <h2>Nutrition Month</h2>
        <div class="wrapper">
            <div class="item">
                <div class="polaroid">
                    <img src="../../images/Nutrition Month/66645696_2276933225951372_4448492233435381760_n.jpg" onclick="openModal(this)">
                    <div class="caption">Eat Healthy, Stay Strong!</div>
                </div>
            </div>

            <div class="item">
                <div class="polaroid">
                    <img src="../../images/Nutrition Month/67117757_2276933269284701_3134708973639303168_n.jpg" onclick="openModal(this)">
                    <div class="caption">Healthy Food, Happy Life!</div>
                </div>
            </div>

            <div class="item">
                <div class="polaroid">
                    <img src="../../images/Nutrition Month/67155312_2276934252617936_5740382567454998528_n.jpg" onclick="openModal(this)">
                    <div class="caption">Nourish, Grow, Be Strong!</div>
                </div>
            </div>

            <!-- Add other images here in the same pattern -->
        </div>
    </section>

    <!-- Trick or Treat Section -->
    <section class="album" id="trick-or-treat">
        <h2>Trick or Treat</h2>
        <div class="wrapper">
            <div class="item">
                <div class="polaroid">
                    <img src="../../images/Trick or Treat/72984311_2347603118884382_7432198961630281728_n.jpg" onclick="openModal(this)">
                    <div class="caption">Spooky Fun, Sweet Treats!</div>
                </div>
            </div>

            <div class="item">
                <div class="polaroid">
                    <img src="../../images/Trick or Treat/72996087_2347599102218117_4596043098995294208_n.jpg" onclick="openModal(this)">
                    <div class="caption">Trick, Treat, Smile, Repeat!</div>
                </div>
            </div>

            <div class="item">
                <div class="polaroid">
                    <img src="../../images/Trick or Treat/73051044_2347604318884262_6123998381929922560_n.jpg" onclick="openModal(this)">
                    <div class="caption">Costumes, Candy, Lots of Fun!</div>
                </div>
            </div>

            <!-- Add other images here in the same pattern -->
        </div>
    </section>

    <!-- United Nations Section -->
    <section class="album" id="united-nations">
        <h2>United Nations</h2>
        <div class="wrapper">
            <div class="item">
                <div class="polaroid">
                    <img src="../../images/United Nations/72674485_2340748762903151_1860302588193275904_n.jpg" onclick="openModal(this)">
                    <div class="caption">Diverse Nations, One World!</div>
                </div>
            </div>

            <div class="item">
                <div class="polaroid">
                    <img src="../../images/United Nations/74460898_2340745862903441_8529386569717514240_n.jpg" onclick="openModal(this)">
                    <div class="caption">Celebrate Peace and Unity!</div>
                </div>
            </div>

            <div class="item">
                <div class="polaroid">
                    <img src="../../images/United Nations/74340100_2340745609570133_3158958358992519168_n.jpg" onclick="openModal(this)">
                    <div class="caption">Together in Harmony, Always!</div>
                </div>
            </div>

            <!-- Add other images here in the same pattern -->
        </div>
    </section>
 <!-- Closing Party Section -->
    <section class="album" id="united-nations">
        <h2>Closing Party</h2>
        <div class="wrapper">
            <div class="item">
                <div class="polaroid">
                    <img src="../../images/Closing Party/53184625_2189291814715514_2116466266066649088_n.jpg" onclick="openModal(this)">
                    <div class="caption">Goodbye, Fun Memories Forever!</div>
                </div>
            </div>

            <div class="item">
                <div class="polaroid">
                    <img src="../../images/Closing Party/54228919_2189291204715575_8235241246210129920_n.jpg" onclick="openModal(this)">
                    <div class="caption">Cheers to New Beginnings!</div>
                </div>
            </div>

            <div class="item">
                <div class="polaroid">
                    <img src="../../images/Closing Party/54255987_2189290401382322_712057096085962752_n.jpg" onclick="openModal(this)">
                    <div class="caption">Celebrate, Laugh, and Enjoy!</div>
                </div>
            </div>

            <!-- Add other images here in the same pattern -->
        </div>
    </section>
 <!-- Birthday Section -->
    <section class="album" id="Birthday">
        <h2>Birthdays</h2>
        <div class="wrapper">
            <div class="item">
                <div class="polaroid">
                    <img src="../../images/Birthday/72436171_2337981739846520_5234883123082166272_n.jpg" onclick="openModal(this)">
                    <div class="caption">Happy Birthday, Little Stars!</div>
                </div>
            </div>

            <div class="item">
                <div class="polaroid">
                    <img src="../../images/Birthday/75226300_2343718305939530_7294973480917794816_n.jpg" onclick="openModal(this)">
                    <div class="caption">Wishing You Happy Days!</div>
                </div>
            </div>

            <div class="item">
                <div class="polaroid">
                    <img src="../../images/Birthday/74242739_2343833152594712_3310747781747965952_n.jpg" onclick="openModal(this)">
                    <div class="caption">Wishing You Tons of Fun!</div>
                </div>
            </div>

            <!-- Add other images here in the same pattern -->
        </div>
    </section>

    <!-- Modal HTML Structure -->
    <div id="myModal" class="modal">
      <span class="close" onclick="closeModal()">&times;</span>
      <img class="modal-content" id="img01">
      <a class="prev" onclick="changeImage(-1)">&#10094;</a>
      <a class="next" onclick="changeImage(1)">&#10095;</a>
    </div>

    </main>

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

    <script>
        // Open modal
        let currentImageIndex = 0;
        const images = Array.from(document.querySelectorAll('.polaroid img'));

        function openModal(img) {
            const modal = document.getElementById("myModal");
            const modalImg = document.getElementById("img01");
            modal.style.display = "flex";
            modalImg.src = img.src;
            currentImageIndex = images.indexOf(img);
        }

        // Close modal
        function closeModal() {
            const modal = document.getElementById("myModal");
            modal.style.display = "none";
        }

        // Change image in modal
        function changeImage(direction) {
            currentImageIndex += direction;
            if (currentImageIndex < 0) {
                currentImageIndex = images.length - 1;
            } else if (currentImageIndex >= images.length) {
                currentImageIndex = 0;
            }
            const modalImg = document.getElementById("img01");
            modalImg.src = images[currentImageIndex].src;
        }
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
