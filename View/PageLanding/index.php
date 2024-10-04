<?php
require_once '../../Controller/login_con.php';
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
      
        p {
          color:#3b3b3b;
      }
   

@media (max-width: 1024px) {
    .faq-image {
        display: none; /* Hide the image on smaller screens */
    }
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
       
      <?php require_once 'navbar.php'?>

      </div>
    </div>
    <!-- Navbar & Hero End -->
    
    <!-- Carousel Start -->
    <div class="header-carousel owl-carousel" disabled>
      <div class="header-carousel-item bg-primary">
        <img src="assets/img/cover.jpeg" alt="" />
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
  
</div>
    <!-- About calendar --> 
<!-- Feature Start -->
<div class="container-fluid feature bg-light py-5">
    <div class="container py-5" style="padding-bottom: 0 !important;">
        <div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.2s">
            <h4 class="welcome-title mb-4" style="font-weight: 700;">WELCOME TO THE PARISH OFFICIAL WEBSITE</h4>
            <p class="welcome-text mb-2" style="color:#3b3b3b; text-justify: inter-word;">
                The Archdiocesan Shrine of San Miguel Arcangel, also known as Argao Church, is a Roman Catholic church located in Argao, Cebu, Philippines. Established as a parish in 1703 under the Augustinian order, the church stands as a significant religious site in the region. Construction of the stone church began in 1734 and was completed in 1788, serving as a center of faith and devotion dedicated to Saint Michael the Archangel.
            </p>
        </div>
        <hr>
    </div>
</div>
<!-- Feature End -->
<div class="CalendarIndexContainer">
    <!-- About calendar -->
    <?php require_once 'Calendar.php'?>
    </div>
  <!-- Service Start -->
<div class="container-fluid service py-5">
  <div class="container py-5">
    <div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.2s">
      <h1 class="display-6 mb-6" >WE PROVIDE BEST SERVICES</h1>
      <p class="mb-0" style="color:#3b3b3b; text-justify: inter-word;">
       Explore our comprehensive system for managing and scheduling various
            church events, masses, and services. From mass events and solo
            events to feast days and special occasions, we've got you covered.
            Discover how our system can help you stay connected with your faith
            community and deepen your relationship with God.
      </p>
    </div>
    <div class="row g-4 justify-content-center">
      <div class="col-md-4 wow fadeInUp" data-wow-delay="0.2s">
        <div class="service-item">
          <div class="service-img">
            <img src="img/baptism (1).jpg" class="img-fluid rounded-top w-100" alt="" />
          </div>
          <div class="service-content p-4">
            <div class="service-content-inner">
              <a href="#" class="d-inline-block h4 mb-4"><span style="font-weight: bold">Baptism</span></a>
              <p class="mb-4">Welcome your child into the Catholic faith...</p>
              <a class="btn btn-primary rounded-pill py-2 px-4" href="signin.php">Schedule Now</a>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-4 wow fadeInUp" data-wow-delay="0.4s">
        <div class="service-item">
          <div class="service-img">
            <img src="img/confirmation.jpg" class="img-fluid rounded-top w-100" alt="" />
          </div>
          <div class="service-content p-4">
            <div class="service-content-inner">
              <a href="#" class="d-inline-block h4 mb-4"><span style="font-weight: bold">Confirmation</span></a>
              <p class="mb-4">Deepen your commitment to your faith...</p>
              <a class="btn btn-primary rounded-pill py-2 px-4" href="signin.php">Schedule Now</a>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-4 wow fadeInUp" data-wow-delay="0.6s">
        <div class="service-item">
          <div class="service-img">
            <img src="img/wedding.jpg" class="img-fluid rounded-top w-100" alt="" />
          </div>
          <div class="service-content p-4">
            <div class="service-content-inner">
              <a href="#" class="d-inline-block h4 mb-4"><span style="font-weight: bold">Wedding</span></a>
              <p class="mb-4">Begin your new life together...</p>
              <a class="btn btn-primary rounded-pill py-2 px-4" href="signin.php">Schedule Now</a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row g-4 justify-content-center mt-4">
      <div class="col-md-4 wow fadeInUp" data-wow-delay="0.8s">
        <div class="service-item">
          <div class="service-img">
            <img src="img/funeral.jpg" class="img-fluid rounded-top w-100" alt="" />
          </div>
          <div class="service-content p-4">
            <div class="service-content-inner">
              <a href="#" class="d-inline-block h4 mb-4"><span style="font-weight: bold">Funeral</span></a>
              <p class="mb-4">In times of sorrow...</p>
              <a class="btn btn-primary rounded-pill py-2 px-4" href="signin.php">Schedule Now</a>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-4 wow fadeInUp" data-wow-delay="0.8s">
        <div class="service-item">
          <div class="service-img">
            <img src="img/funeral.jpg" class="img-fluid rounded-top w-100" alt="" />
          </div>
          <div class="service-content p-4">
            <div class="service-content-inner">
              <a href="#" class="d-inline-block h4 mb-4"><span style="font-weight: bold">Request Form</span></a>
              <p class="mb-4">Fill out our request form for any services...</p>
              <a class="btn btn-primary rounded-pill py-2 px-4" href="signin.php">Schedule Now</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Service End -->


    <!-- Testimonial Start -->
    <div class="container-fluid testimonial pb-5"style="padding-bottom: 0 !important;" >
      <div class="container pb-5" style="padding-bottom: 0 !important;">
        <div
          class="text-center mx-auto pb-5 wow fadeInUp"
          data-wow-delay="0.2s" >
          <h1 class="display-6 mb-6">ANNOUNCEMENT</h1>
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
   
     
          <div class="testimonial-item bg-light rounded" style="background-color: #f2f5f9 !important;">
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
        </div> </div>
      </div>
    </div>
    <!-- Testimonial End -->
 <!-- FAQs Start -->
 <div class="container-fluid faq-section bg-light py-5">
            <div class="container py-5">
                <div class="row g-5 align-items-center">
                    <div class="col-xl-6 wow fadeInLeft" data-wow-delay="0.2s">
                        <div class="h-100">
                            <div class="mb-5">
                                <h4 class="text-primary">Some Important FAQ's</h4>
                                <h1 class="display-6 mb-6">COMMON FREQUENTLY ASKED QUESTIONS</h1>
                            </div>
                            <div class="accordion" id="accordionExample">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingOne">
                                        <button class="accordion-button border-0" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                            Q: What are the different services and programs offered by the church?
                                        </button>
                                    </h2>
                                    <div id="collapseOne" class="accordion-collapse collapse show active" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                        <div class="accordion-body rounded" style="color:#3b3b3b;">
                                            A:Argao Church offers a range of services and programs including regular mass schedules, sacramental preparation (e.g., baptism, marriage), religious education, and community outreach programs. Details about these services can be found on this website or by contacting the church office.
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingTwo">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                            Q: How can I donate to Argao Church?
                                        </button>
                                    </h2>
                                    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                        <div class="accordion-body" style="color:#3b3b3b;">
                                            A: Donations to Argao Church can only be made through in-person donations at the church office. For details on how to make a donation, contact the church office.
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingThree">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                            Q: What should I do if I need to cancel or reschedule a booking or event at the church? 
                                        </button>
                                    </h2>
                                    <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                        <div class="accordion-body" style="color:#3b3b3b;">
                                            A: If you need to cancel or reschedule a booking or event, please inform the church office as soon as possible. They will assist you with the necessary changes and provide guidance on the next steps.
                                        </div>
                                    </div>  
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 wow fadeInRight" data-wow-delay="0.4s">
                    <div style="position: relative; display: inline-block;">
        <img src="assets/img/FAQ.png" class="faq-image"  style="display: block; width: 100%; height: auto;" alt="FAQ">
        <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background-color: #0066a8; opacity: 0.4; pointer-events: none;"></div>
    </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- FAQs End -->
        <?php require_once 'footer.php'?>

    <!-- Back to Top -->
    <a href="#" class="btn btn-primary btn-lg-square rounded-circle back-to-top"
      ><i class="fa fa-arrow-up"></i
    ></a>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="assets/css/login.css" />
    <script>
            document.addEventListener('DOMContentLoaded', function() {
    <?php
    if (isset($_SESSION['status']) && $_SESSION['status'] == 'success') {
        echo "Swal.fire({
            icon: 'success',
            title: 'Form submitted successfully!',
            text: 'Waiting for Approval.',
            text: 'By The Management.',
        });";
        unset($_SESSION['status']);
    }
    ?>
});


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
