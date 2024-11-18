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

    .hero::before {
      content: "";
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(0, 0, 0, 0.5);
      z-index: 1;
    }

    .hero-content {
      position: relative;
      z-index: 2;
      color: #fff;
      text-align: center;
    }

    .hero-content h1 {
      font-weight: 400;
      font-size: 4rem;
      margin-bottom: 20px;
      animation: fadeInDown 2s ease-out;
    }

    .hero-content p {
      font-size: 1.5rem;
      margin-bottom: 20px;
      animation: fadeInUp 2s ease-out;
    }

    .hbtn {
      padding: 10px 20px;
      background: #ff7f50;
      color: #fff;
      text-decoration: none;
      font-size: 1.2rem;
      border-radius: 5px;
    }

    .hbtn:hover {
      background: #ff4500;
      text-decoration: none;
    }

    @keyframes fadeInDown {
      from {
        opacity: 0;
        transform: translateY(-50px);
      }

      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    @keyframes fadeInUp {
      from {
        opacity: 0;
        transform: translateY(50px);
      }

      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .section-heading {
      margin: 30px 0;
      font-weight: bold;
      text-align: center;
    }

    .card {
      border: none;
      border-radius: 15px;
      overflow: hidden;
    }

    img {
      height: 375px;
    }

    .testimonial-item {
      text-align: center;
      padding: 20px;
    }

    .icon-box {
      padding: 30px;
      border-radius: 10px;
      transition: all 0.3s ease;
    }

    .icon-box:hover {
      transform: scale(1.05);
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    }

    .imgcard {
      transition: all 0.3s ease;
    }

    .imgcard:hover {
      transform: scale(1.05);
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    }

    .img-fluid.rounded-circle {
      width: 100px;
      height: 100px;
      object-fit: cover;
    }

    footer {
      background-color: #343a40;
      color: white;
      padding: 20px 0;
      text-align: center;
    }

    .nav-link:hover {
      background-color: #B5B4D9;
      color: blue !important;
    }

    .nav-link {
            display: inline-block;
            color: #d2e4f7 !important;
            text-decoration: none;
            overflow: hidden;
          }

          .hover-underline {
            position: absolute;
            width: 100%;
            height: 2px;
            background-color: #ff4500;
            bottom: 0;
            left: 0;
            transform: translateX(-100%);
            transition: transform 0.3s ease;
          }

          .nav-link:hover .hover-underline {
            transform: translateX(0);
          }
  </style>
</head>

<body>

  <!-- Header -->
  <!-- <header class="bg-light py-3">
      <div class="container text-center">
        <nav>
          <a href="#features" class="mx-3">Features</a>
          <a href="#services" class="mx-3">Services</a>
          <a href="#testimonials" class="mx-3">Testimonials</a>
          <a href="#contact" class="mx-3">Contact</a>
        </nav>
      </div>
    </header> -->

  <header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark py-2">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01"
        aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
        
        <!-- Logo on the left -->
        <a class="navbar-brand" href="#">
          <img src="./assets/img/logo.png" class="img-fluid" width="300px" height="auto" alt="Logo">
        </a>

        <!-- Navbar Links - Centered -->
        <ul class="navbar-nav mx-auto">
          <li class="nav-item">
            <a class="nav-link" href="#features" style="position: relative;">
              Features
              <span class="hover-underline"></span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#services" style="position: relative;">
              Services
              <span class="hover-underline"></span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#contact" style="position: relative;">
              Contact
              <span class="hover-underline"></span>
            </a>
          </li>
        </ul>

        <!-- Navbar Links - Right -->
        <ul class="navbar-nav ml-auto d-flex justify-content-end ">
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
        <div class="col-md-3" data-aos="fade-up">
          <div class="testimonial-item text-center">
            <img src="./assets/img/index/Dev/Tharuka.jpg" alt="User 1: Jane Doe" class="rounded-circle" />
            <h5>Tharuka</h5>
            <p>
              "Co-developer and main Co-Leader of the Developer Team"
            </p>
          </div>
        </div>

        <!-- Testimonial 2 -->
        <div class="col-md-3" data-aos="fade-up">
          <div class="testimonial-item">
            <img src="./assets/img/index/Dev/Ravindu.jpg" alt="User 2: John Smith" class="rounded-circle" />
            <h5>Ravindu</h5>
            <p>
              "Main Developer And Leader Of Develper Team."
            </p>
          </div>
        </div>

        <!-- Testimonial 3 -->
        <div class="col-md-3" data-aos="fade-up">
          <div class="testimonial-item">
            <img src="./assets/img/index/Dev/Shehani.jpg" alt="User 3: Sarah Lee" class=" rounded-circle" />
            <h5>Shehani</h5>
            <p>
              "Main Desgner and Main Qulity Checker Of The Team"
            </p>
          </div>
        </div>


        <!-- Testimonial 4 -->
        <div class="col-md-3" data-aos="fade-up">
          <div class="testimonial-item">
            <img src="./assets/img/index/Dev/Dilan.jpg" alt="User 3: Sarah Lee" class=" rounded-circle" />
            <h5>Dilan</h5>
            <p>
              "Main Co-Leader and project manager of the Developer Team"
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