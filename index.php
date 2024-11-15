<?php
session_start();
include 'admin/include/db_connection.inc.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>LHM System</title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="./assets/css/index_style.css">
  <style>
    
.hero {
  height: 100vh;
  position: relative;
  display: flex;
  justify-content: center;
  align-items: center;
  text-align: center;
  color: white;
  overflow: hidden;
  background-image: var(--current-background), var(--next-background);
  background-size: cover;
  background-position: center center;
  background-repeat: no-repeat;
  transition: background-image 1s ease-in-out;
}

.hero.fade-transition {
  background-image: var(--next-background), var(--current-background);
}
  </style>
</head>

<body>
  <!-- Header -->
  <header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark py-2">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01"
            aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
            <!-- Logo on the left -->
            <a class="navbar-brand" href="#">
                <img src="./assets/img/logo.png" class="img-fluid" width="170px" height="auto" alt="Logo">
            </a>
            <!-- Navbar Links - Centered -->
            <ul class="navbar-nav mx-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#features">Features</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#services">Services</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#contact">Contact</a>
                </li>
            </ul>
            <!-- User Profile & Authentication - Right aligned -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item mx-3">
                    <a class="nav-link" href="#">
                        <?php 
                            if (isset($_SESSION['user_id'])) {
                                echo 'Hi, ' . $_SESSION['user_name'];
                            } elseif (isset($_SESSION['user'])) {
                                echo 'Hi, ' . $_SESSION['user'];
                            } elseif (isset($_SESSION['St_id'])) {
                                echo 'Hi, ' . $_SESSION['user_name'];
                            }
                        ?>
                    </a>
                </li>
                <?php
                    if (isset($_SESSION['user_id']) || isset($_SESSION['user']) || isset($_SESSION['St_id'])) {
                        echo '<li class="nav-item"> 
                            <a class="nav-link" href="';
                        if (isset($_SESSION['user_id'])) {
                            echo './admin/index.php';
                        } elseif (isset($_SESSION['user'])) {
                            echo './lecturer/lecturer/dashboard.php';
                        } elseif (isset($_SESSION['St_id'])) {
                            echo './student.php';
                        }
                        echo '">My Profile</a></li>';
                    }
                ?>
                <?php
                    if (isset($_SESSION['user_id']) || isset($_SESSION['user']) || isset($_SESSION['St_id'])) {
                        echo '<li class="nav-item">
                            <a class="btn btn-outline-light my-2 my-sm-0" href="./include/logout.php">Sign out</a>
                        </li>';
                    } else {
                        echo '<li class="nav-item">
                            <a class="btn btn-outline-light my-2 my-sm-0" href="./signin.php">Sign in</a>
                        </li>';
                    }
                ?>
            </ul>
        </div>
    </nav>
</header>



  <!-- <?php include 'pages/hero.html'; ?> -->

  <!-- Hero section -->
  <section class="hero" id="hero-section">
    <div class="hero-content">
      <h1>Welcome to SLIATE Campus</h1>
      <p>Manage your campus profile effortlessly with this platform.</p>
    </div>
  </section>

  <!-- Features Section -->
  <section id="features" class="section features">
    <div class="container">
      <h2 class="section-heading" data-aos="fade-up">Our Features</h2>
      <div class="row">
        <div class="col-md-4" data-aos="fade-right">
          <div class="card shadow-lg imgcard">
            <img src="./assets/img/Admin1.jpg" class="card-img-top" alt="Feature" />
            <div class="card-body text-center">
              <h5 class="card-title">Booking Hall</h5>
              <p class="card-text">
                Ability to find details about lecture halls and book a lecture
                hall with necessary facilities for the lecturer.
              </p>
            </div>
          </div>
        </div>

        <div class="col-md-4" data-aos="fade-up">
          <div class="card shadow-lg imgcard">
            <img src="./assets/img/ATI 05.jpg" class="card-img-top" alt="Feature" />
            <div class="card-body text-center">
              <h5 class="card-title">Searching</h5>
              <p class="card-text">
                Lecturer and Student schedule details, lecture hall details,
                lecturer and student details search facility.
              </p>
            </div>
          </div>

        </div>

        <div class="col-md-4" data-aos="fade-left">
          <div class="card shadow-lg imgcard">
            <img src="./assets/img/ATI 07.jpg" class="card-img-top" alt="Feature" />
            <div class="card-body text-center">
              <h5 class="card-title">Updating</h5>
              <p class="card-text">
                Change required textures, delete unnecessary details and quick
                update facility.
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Services Section -->
  <section id="services" class="section services">
    <div class="container">
      <h2 class="section-heading" data-aos="zoom-in">Our Services</h2>
      <div class="row">
        <!-- Service 1: 24/7 Customer Support -->
        <div class="col-md-4" data-aos="zoom-in">
          <div class="icon-box text-center bg-light">
            <div class="icon">
              <i class="fas fa-calendar-alt fa-3x"></i>
            </div>
            <h4>24/7 Timetable</h4>
            <p>
              Our dedicated support team is available around the clock to
              assist you with any queries or issues.
            </p>
          </div>
        </div>

        <!-- Service 2: Live Chat -->
        <div class="col-md-4" data-aos="zoom-in">
          <div class="icon-box text-center bg-light">
            <div class="icon">
              <i class="fas fa-university fa-3x"></i>
            </div>
            <h4>Check hall</h4>
            <p>
              Connect with us instantly via our live chat for real-time
              assistance and quick responses.
            </p>
          </div>
        </div>

        <!-- Service 3: Technical Workshops -->
        <div class="col-md-4" data-aos="zoom-in">
          <div class="icon-box text-center bg-light">
            <div class="icon">
              <i class="fas fa-table fa-3x"></i>
            </div>
            <h4>shedule manage</h4>
            <p>
              Join our interactive workshops to learn the latest technical
              skills and stay ahead in the industry.
            </p>
          </div>
        </div>
      </div>
    </div>
  </section>


    <!-- Testimonials Section -->
    <section id="testimonials" class="section bg-light">
    <div class="container">
      <h2 class="section-heading" data-aos="zoom-in">Our Developers</h2>
      <div class="row">
        <!-- Testimonial 1 -->
        <div class="col-md-4" data-aos="fade-up">
          <div class="testimonial-item text-center">
            <img src="./assets/img/index/Dev/Tharuka.jpg" alt="User 1: Jane Doe" class="rounded-circle" />
            <h5>Tharuka</h5>
            <p>
              "Co-developer and main Co-Leader of the Developer Team"
            </p>
          </div>
        </div>

        <!-- Testimonial 2 -->
        <div class="col-md-4" data-aos="fade-up">
          <div class="testimonial-item">
            <img src="./assets/img/index/Dev/Ravindu.jpg" alt="User 2: John Smith" class="rounded-circle" />
            <h5>Ravindu</h5>
            <p>
              "Main Developer And Leader Of Develper Team."
            </p>
          </div>
        </div>

        <!-- Testimonial 3 -->
        <div class="col-md-4" data-aos="fade-up">
          <div class="testimonial-item">
            <img src="./assets/img/index/Dev/Shehani.jpg" alt="User 3: Sarah Lee" class=" rounded-circle" />
            <h5>Shehani</h5>
            <p>
              "Main Desgner and Main Qulity Checker Of The Team"
            </p>
          </div>
        </div>
      </div>
    </div>
  </section>


  <!-- Footer -->
  <footer>
    <div class="container">
      <p>&copy; 2024 Create By Loku. All Rights Reserved.</p>
      <p>
        <a href="#" class="text-white">Privacy Policy</a> |
        <a href="#" class="text-white">Terms of Service</a>
      </p>
    </div>
  </footer>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
  <script>
    AOS.init();

    const images = ["assets/img/hnd1.jpg", "assets/img/hnd2.jpg", "assets/img/hnd3.jpg"];
    let currentImageIndex = 0;

    function changeBackgroundImage() {
      const heroSection = document.getElementById("hero-section");
      const nextImageIndex = (currentImageIndex + 1) % images.length;

      heroSection.style.setProperty(
        "--next-background",
        `url(${images[nextImageIndex]})`
      );

      heroSection.classList.add("fade-transition");

      setTimeout(() => {
        heroSection.style.setProperty(
          "--current-background",
          `url(${images[nextImageIndex]})`
        );
        heroSection.classList.remove("fade-transition");
        currentImageIndex = nextImageIndex;
      }, 1000);
    }

    document
      .getElementById("hero-section")
      .style.setProperty(
        "--current-background",
        `url(${images[currentImageIndex]})`
      );

    window.addEventListener("load", function() {
      changeBackgroundImage();
      setInterval(changeBackgroundImage, 5000);
    });
  </script>
</body>

</html>