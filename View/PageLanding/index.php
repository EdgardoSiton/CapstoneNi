<?php


require_once '../../Controller/login_con.php';
require_once '../../Controller/registration_con.php';
require_once '../../Model/staff_mod.php';

$staff = new Staff($conn);
$announcements = $staff->getAnnouncements();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <title>ARGAO CHURCH MANAGEMENT SYSTEM</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta content="" name="keywords" />
    <meta content="" name="description" />
    <link rel="icon" href="../assets/img/mainlogo.jpg" type="image/x-icon"
    />

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&family=Inter:slnt,wght@-10..0,100..900&display=swap"
      rel="stylesheet"
    />
    <link
      rel="stylesheet"
      href="https://unicons.iconscout.com/release/v4.0.0/css/line.css"
    />
    <!-- Icon Font Stylesheet -->
    <link
      rel="stylesheet"
      href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"
    />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css"
      rel="stylesheet"
    />

    <!-- Libraries Stylesheet -->
    <link rel="stylesheet" href="lib/animate/animate.min.css" />
    <link href="lib/lightbox/css/lightbox.min.css" rel="stylesheet" />
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet" />

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet" />
    <link rel="stylesheet" href="css/rating.css">
    
    <style>
      .days li{
        padding: 20px!important;
      }
    </style>
  </head>

  <body>
    <!-- Spinner End -->
    <section class="home">
      <div class="form_container">
        <i class="uil uil-times form_close"></i>
        <!-- Login From -->
      

        </div>
        <!-- Signup From -->
     

    <!-- Navbar & Hero Start -->
    <div class="container-fluid nav-bar px-0 px-lg-4 py-lg-0">
      <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light">
          <a href="#" class="navbar-brand p-0">
            <img src="assets/img/argaochurch.png" alt="" />
          </a>
          <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarCollapse"
          >
            <span class="fa fa-bars"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav mx-0 mx-lg-auto">
              <a href="index.html" class="nav-item nav-link active">Home</a>
              <a href="" class="nav-item nav-link">About</a>
              <a href="" class="nav-item nav-link">Services</a>
              <a href="" class="nav-item nav-link">Blog</a>
              <div class="nav-item dropdown">
                <a href="#" class="nav-link" data-bs-toggle="dropdown">
                  <span class="dropdown-toggle">Pages</span>
                </a>
                <div class="dropdown-menu">
                  <a href="" class="dropdown-item">Our Features</a>
                  <a href="" class="dropdown-item">Our team</a>
                  <a href="" class="dropdown-item"
                    >Testimonial</a
                  >
                  <a href="" class="dropdown-item">FAQs</a>
                  <a href="" class="dropdown-item">404 Page</a>
                </div>
              </div>
              <a href="#" id="open-modal" class="nav-item nav-link">Rate</a>
            </div>
          </div>
          <div class="nav-btn px-3">
            <a
              href="signin.php"
              id="form-open"
              class="btn btn-primary py-2 px-4 ms-3 flex-shrink-0"
            >
              Signin</a
            >
          </div>
        </nav>
      </div>
    </div>
    <!-- Navbar & Hero End -->
    
    <!-- Carousel Start -->
    <div class="header-carousel owl-carousel">
      <div class="header-carousel-item bg-primary">
        <img src="../assets/img/coverpage.png" alt="" />
      </div>
    </div>

    <!-- Carousel End -->
    <div class="modal" id="modal">
      <div class="modal-content">
        <span class="close">&times;</span>
        <h1 style="color:#ac0727cf">Argao Church System Rating</h1>
        <div class="rating"><span id="rating">0</span>/5</div>
        <div class="stars" id="stars">
          <span class="star" data-value="1">★</span>
          <span class="star" data-value="2">★</span>
          <span class="star" data-value="3">★</span>
          <span class="star" data-value="4">★</span>
          <span class="star" data-value="5">★</span>
        </div>
        <p>Share your review:</p>
        <textarea id="review" placeholder="Write your review here"> </textarea>
        <button id="submit">Submit</button>
        <div class="reviews" id="reviews"></div>
      </div>
    </div>
    <!-- About calendar -->
   <div class="CalendarIndexContainer">
    <!-- About calendar -->
    <?php require_once 'Calendar.php'?>
    </div>
    
</div>
    <!-- About calendar -->

    <!-- Service Start -->
    <div class="container-fluid service py-5">
      <div class="container py-5">
        <div
          class="text-center mx-auto pb-5 wow fadeInUp"
          data-wow-delay="0.2s"
          style="max-width: 800px"
        >
          <h4 class="text-primary">Our Services</h4>
          <h1 class="display-4 mb-4">We Provide Best Services</h1>
          <p class="mb-0">
            Explore our comprehensive system for managing and scheduling various
            church events, masses, and services. From mass events and solo
            events to feast days and special occasions, we've got you covered.
            Discover how our system can help you stay connected with your faith
            community and deepen your relationship with God.
          </p>
        </div>
        <div class="row g-4 justify-content-center">
          <div
            class="col-md-6 col-lg-6 col-xl-3 wow fadeInUp"
            data-wow-delay="0.2s"
          >
            <div class="service-item">
              <div class="service-img">
                <img
                  src="img/baptism (1).jpg"
                  class="img-fluid rounded-top w-100"
                  alt=""
                />
              </div>
              <div class="service-content p-4">
                <div class="service-content-inner">
                  <a href="#" class="d-inline-block h4 mb-4"
                    ><span style="font-weight: bold">Baptism</span></a
                  >
                  <p class="mb-4">
                    Welcome your child into the Catholic faith. Celebrate this
                    sacred milestone through the baptismal process and help your
                    child take their first steps in their spiritual journey.
                  </p>
                  <a class="btn btn-primary rounded-pill py-2 px-4" href="#"
                    >Schedule Now</a
                  >
                </div>
              </div>
            </div>
          </div>
          <div
            class="col-md-6 col-lg-6 col-xl-3 wow fadeInUp"
            data-wow-delay="0.4s"
          >
            <div class="service-item">
              <div class="service-img">
                <img
                  src="img/confirmation.jpg"
                  class="img-fluid rounded-top w-100"
                  alt=""
                />
              </div>
              <div class="service-content p-4">
                <div class="service-content-inner">
                  <a href="#" class="d-inline-block h4 mb-4"
                    ><span style="font-weight: bold">Confirmation</span>
                  </a>
                  <p class="mb-4">
                    Deepen your commitment to your faith. This important sacrament marks a significant
                    milestone in your spiritual journey, and we're here to
                    support you every step of the way.
                  </p>
                  <a class="btn btn-primary rounded-pill py-2 px-4" href="#"
                    >Schedule Now</a
                  >
                </div>
              </div>
            </div>
          </div>
          <div
            class="col-md-6 col-lg-6 col-xl-3 wow fadeInUp"
            data-wow-delay="0.6s"
          >
            <div class="service-item">
              <div class="service-img">
                <img
                  src="img/wedding.jpg"
                  class="img-fluid rounded-top w-100"
                  alt=""
                />
              </div>
              <div class="service-content p-4">
                <div class="service-content-inner">
                  <a href="#" class="d-inline-block h4 mb-4"
                    ><span style="font-weight: bold">Wedding</span>
                  </a>
                  <p class="mb-4">
                    Begin your new life together with a sacred and joyful
                    celebration. Our wedding services provide a beautiful and
                    meaningful way to exchange your vows and receive God's
                    blessing on your marriage.
                  </p>
                  <a class="btn btn-primary rounded-pill py-2 px-4" href="#"
                    >Schedule Now</a
                  >
                </div>
              </div>
            </div>
          </div>
          <div
            class="col-md-6 col-lg-6 col-xl-3 wow fadeInUp"
            data-wow-delay="0.8s"
          >
            <div class="service-item">
              <div class="service-img">
                <img
                  src="img/funeral.jpg"
                  class="img-fluid rounded-top w-100"
                  alt=""
                />
              </div>
              <div class="service-content p-4">
                <div class="service-content-inner">
                  <a href="#" class="d-inline-block h4 mb-4"
                    ><span style="font-weight: bold">Funeral</span></a
                  >
                  <p class="mb-4">
                    In times of sorrow, find comfort and hope in our funeral
                    services. We're here to support you and your loved ones as
                    you say goodbye to a cherished family member or friend, and
                    celebrate their life and legacy.
                  </p>
                  <a class="btn btn-primary rounded-pill py-2 px-4" href="#"
                    >Schedule Now</a
                  >
                </div>
              </div>
            </div>
          </div>
          <div class="col-12 text-center wow fadeInUp" data-wow-delay="0.2s">
            <a class="btn btn-primary rounded-pill py-3 px-5" href="#"
              >More Services</a
            >
          </div>
        </div>
      </div>
    </div>
    <!-- Service End -->

    <!-- Testimonial Start -->
    <div class="container-fluid testimonial pb-5">
      <div class="container pb-5">
        <div
          class="text-center mx-auto pb-5 wow fadeInUp"
          data-wow-delay="0.2s"
          style="max-width: 800px"
        >
          <h1 class="display-4 mb-4">ANNOUNCEMENT</h1>
          <p class="mb-0">
            Upcoming Events in the Church: Mark your calendars for our upcoming
            Mass Wedding, Mass Confirmation, Baptism Seminar, and First
            Communion. Registration is required for each event.
          </p>
        </div>
        <div
          class="owl-carousel testimonial-carousel wow fadeInUp"
          data-wow-delay="0.2s"
        >
        <?php foreach ($announcements as $announcement): ?>
   
     
          <div class="testimonial-item bg-light rounded">
            <div class="row g-0">
              <div class="col-8 col-lg-8 col-xl-9">
                <div class="d-flex flex-column my-auto text-start p-4">
                  <div class="small">
                    <span class="fa fa-calendar text-primary"></span>  <?php 
        $date = htmlspecialchars(date('F j, Y', strtotime($announcement['date'])));
        $startTime = htmlspecialchars(date('g:i a', strtotime($announcement['start_time'])));
   
        echo "$date - $startTime ";
        ?>
    </a>
                  </div>

                  <h4 class="text-dark mb-0">
                  <?php echo htmlspecialchars($announcement['title']) ?>
                  </h4>
                  <br />
                  <p class="mb-0">
                  <?php echo htmlspecialchars($announcement['description']) ?>
                  </p>
                </div>
              </div>
            </div>

          </div>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
    <!-- Testimonial End -->

    <!-- Copyright Start -->
    <div class="container-fluid copyright py-4">
      <div class="container">
        <div class="row g-4 align-items-center">
          <div class="col-md-6 text-center text-md-end mb-md-0">
            <span class="text-body"
              ><a href="#" class="border-bottom text-white"
                ><i class="fas fa-copyright text-light me-2"></i>Team Alpha Coders</a
              >, All right reserved.</span
            >
          </div>
          <div class="col-md-6 text-center text-md-start text-body">
           Capstone Project 1
            <a class="border-bottom text-white" href="https://htmlcodex.com"
              ></a
            >
            Distributed By
            <a class="border-bottom text-white" href="https://themewagon.com"
              >Team Alpha Coders</a
            >
          </div>
        </div>
      </div>
    </div>
    <!-- Copyright End -->

    <!-- Back to Top -->
    <a href="#" class="btn btn-primary btn-lg-square rounded-circle back-to-top"
      ><i class="fa fa-arrow-up"></i
    ></a>
    <link rel="stylesheet" href="assets/css/login.css" />
    <script>
      const formOpenBtn = document.querySelector("#form-open"),
        home = document.querySelector(".home"),
        formContainer = document.querySelector(".form_container"),
        formCloseBtn = document.querySelector(".form_close"),
        signupBtn = document.querySelector("#signup"),
        loginBtn = document.querySelector("#login"),
        pwShowHide = document.querySelectorAll(".pw_hide");

      formOpenBtn.addEventListener("click", () => home.classList.add("show"));
      formCloseBtn.addEventListener("click", () =>
        home.classList.remove("show")
      );

      pwShowHide.forEach((icon) => {
        icon.addEventListener("click", () => {
          let getPwInput = icon.parentElement.querySelector("input");
          if (getPwInput.type === "password") {
            getPwInput.type = "text";
            icon.classList.replace("uil-eye-slash", "uil-eye");
          } else {
            getPwInput.type = "password";
            icon.classList.replace("uil-eye", "uil-eye-slash");
          }
        });
      });

      signupBtn.addEventListener("click", (e) => {
        e.preventDefault();
        formContainer.classList.add("active");
      });
      loginBtn.addEventListener("click", (e) => {
        e.preventDefault();
        formContainer.classList.remove("active");
      });
    </script>
     <script>
      const openModalButton = document.getElementById("open-modal");
      const modal = document.getElementById("modal");
      const closeModalButton = document.querySelector('.close');

openModalButton.addEventListener('click', () => {
    modal.style.display = 'flex';
});

closeModalButton.addEventListener('click', () => {
    modal.style.display = 'none';
});
      openModalButton.addEventListener("click", () => {
        modal.style.display = "block";
      });

      closeModalButton.addEventListener("click", () => {
        modal.style.display = "none";
      });
      const stars = document.querySelectorAll(".star");
      const rating = document.getElementById("rating");
      const reviewText = document.getElementById("review");
      const submitBtn = document.getElementById("submit");
      const reviewsContainer = document.getElementById("reviews");

      stars.forEach((star) => {
        star.addEventListener("click", () => {
          const value = parseInt(star.getAttribute("data-value"));
          rating.innerText = value;

          // Remove all existing classes from stars
          stars.forEach((s) =>
            s.classList.remove("one", "two", "three", "four", "five")
          );

          // Add the appropriate class to
          // each star based on the selected star's value
          stars.forEach((s, index) => {
            if (index < value) {
              s.classList.add(getStarColorClass(value));
            }
          });

          // Remove "selected" class from all stars
          stars.forEach((s) => s.classList.remove("selected"));
          // Add "selected" class to the clicked star
          star.classList.add("selected");
        });
      });

      submitBtn.addEventListener("click", () => {
        const review = reviewText.value;
        const userRating = parseInt(rating.innerText);

        if (!userRating || !review) {
          alert(
            "Please select a rating and provide a review before submitting."
          );
          return;
        }

        if (userRating > 0) {
          const reviewElement = document.createElement("div");
          reviewElement.classList.add("review");
          reviewElement.innerHTML = `<p><strong>Rating: ${userRating}/5</strong></p><p>${review}</p>`;
          reviewsContainer.appendChild(reviewElement);

          // Reset styles after submitting
          reviewText.value = "";
          rating.innerText = "0";
          stars.forEach((s) =>
            s.classList.remove(
              "one",
              "two",
              "three",
              "four",
              "five",
              "selected"
            )
          );
        }
      });

      function getStarColorClass(value) {
        switch (value) {
          case 1:
            return "one";
          case 2:
            return "two";
          case 3:
            return "three";
          case 4:
            return "four";
          case 5:
            return "five";
          default:
            return "";
        }
      }
    </script>
    <script>
function validateLoginForm() {
    var email = document.getElementById("email").value;
    var password = document.getElementById("password").value;
    var errorMessage = document.getElementById("error_message");
    
    if (email === "" || password === "") {
        errorMessage.textContent = "Please fill in both email and password.";
        return false;
    }
    errorMessage.textContent = "";
    return true;
}
</script>
  
    <!-- JavaScript Libraries -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/counterup/counterup.min.js"></script>
    <script src="lib/lightbox/js/lightbox.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
  </body>
</html>
