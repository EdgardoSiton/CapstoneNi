

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
      .mb-0{
        text-align: left;
      }
      i{
            margin-right: 0!important;
        }
        .mb-0 {
        text-align: left;
      }

      i {
        margin-right: 0 !important;
      }

      /* Redesigned Rating Section Styles */
      .footer-item {
        background-color: #20232a4a;
        padding: 20px;
        border-radius: 10px;
        text-align: center;
      }

      .rating-section {
        font-size: 20px;
        color: #fff;
        margin-bottom: 10px;
      }

      .stars {
        display: flex;
        justify-content: center;
        gap: 5px;
        margin-bottom: 10px;
      }

      .star {
        font-size: 24px;
        cursor: pointer;
        color: #ddd;
      }

      textarea {
        width: 100%;
        height: 60px;
        border: 1px solid #444;
        border-radius: 5px;
        padding: 10px;
        color: #000;
        margin-bottom: 10px;
      }

      button {
        background-color: #ac0727cf;
        color: #fff;
        padding: 8px 15px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
      }

      .reviews {
        margin-top: 10px;
        color: #ddd;
      }

      /* Responsive Adjustments */
      @media (max-width: 768px) {
        .footer-item {
          padding: 15px;
        }

        .rating-section {
          font-size: 16px;
        }

        .star {
          font-size: 20px;
        }

        textarea {
          height: 50px;
        }

        button {
          padding: 6px 12px;
        }

        .col-md-6, .col-lg-6, .col-xl-3 {
          width: 100%!important;
        }
      }

      @media (max-width: 576px) {
        .footer-item {
          padding: 10px;
        }

        .rating-section {
          font-size: 14px;
        }

        .star {
          font-size: 18px;
        }

        textarea {
          height: 40px;
        }

        button {
          padding: 5px 10px;
        }

        h4 {
          font-size: 18px;
        }

        .reviews {
          font-size: 12px;
        }
      }
      /* Ensure text does not overflow the container */
.footer-item .text-container {
    max-width: 100%;
    word-wrap: break-word;
    padding-right: 10px;
}

.d-flex {
    display: flex;
    align-items: center;
    flex-wrap: wrap; /* Ensures the content wraps on small screens */
}

.d-flex .btn-lg-square {
    flex-shrink: 0; /* Prevent the icon box from shrinking */
}

.d-flex .text-container {
    flex-grow: 1; /* Allow the text container to take the remaining space */
}

/* Adjust the font size for smaller screens */
@media (max-width: 768px) {
    .footer-item h5, .footer-item p {
        font-size: 14px;
    }
    
    .btn-lg-square {
        padding: 2px; /* Adjust padding for smaller screen sizes */
    }
    
    .d-flex .btn-lg-square i {
        font-size: 1.5rem; /* Smaller icon size on mobile */
    }
}
/* Ensure the containers fit beside each other */
.row.g-5 {
    display: flex;
    justify-content: space-between; /* Align containers side by side */
    flex-wrap: wrap; /* Wrap to the next line on smaller screens */
}

.col-md-6, .col-lg-6, .col-xl-3, .col-xl-4, .col-xl-5 {
    flex: 1 1 calc(33.333% - 10px); /* 3 containers side by side with space */
    margin-bottom: 20px;
}

@media (max-width: 768px) {
    .col-md-6, .col-lg-6, .col-xl-3, .col-xl-4, .col-xl-5 {
        flex: 1 1 100%; /* Full width on smaller screens */
    }
}
.text-container {
        text-align: left; /* Ensure text is aligned to the left */
    }

    </style>
  </head>

  <body>
  <!-- Footer Start -->
<div class="container-fluid footer py-5 wow fadeIn" data-wow-delay="0.2s" style="padding-bottom: 10px !important;">
    <div class="container py-5" style="padding-bottom: 10px !important;padding-top: 5px !important;">
        <div class="row g-5">
            <!-- Parish Office Hours -->
            <div class="col-md-6 col-lg-6 col-xl-5">
                <div class="footer-item">
                    <a href="index.html" class="p-0">
                        <img src="img/argaochurch.png" alt="" style="width: 300px;" />
                    </a>
                    <p class="text-white mb-4">
                        <span style="font-weight: 700;">Parish Office Hours</span> <br>
                        <span style="font-weight: 700;">Morning:</span> 8:00 AM - 12:00 PM <br>
                        <span style="font-weight: 700;">Afternoon:</span> 1:30 PM - 5:00 PM
                    </p>
                </div>
            </div>

            <!-- Address, Phone, Email -->
            <div class="col-md-6 col-lg-6 col-xl-4">
                <div class="footer-item">
                    <div class="row g-3">
                        <div class="d-flex align-items-center">
                            <div class="btn-lg-square rounded-circle bg-white text-white p-4 me-4">
                                <i class="fas fa-map-marker-alt fa-2x" style="color: green;"></i>
                            </div>
                            <div class="text-container">
                                <h5 class="text-white" style="font-weight: 700;">Address</h5>
                                <p class="mb-0 text-white">Poblacion, Argao, Cebu</p>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <div class="btn-lg-square rounded-circle bg-white text-white p-4 me-4">
                                <i class="fa fa-phone-alt fa-2x" style="color: darkblue;"></i>
                            </div>
                            <div class="text-container">
                                <h5 class="text-white" style="font-weight: 700;">Telephone</h5>
                                <p class="mb-0 text-white"> (032) 367 7442</p>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <div class="btn-lg-square rounded-circle bg-white text-white p-4 me-4">
                                <i class="fas fa-envelope fa-2x" style="color: red;"></i>
                            </div>
                            <div class="text-container">
                                <h5 class="text-white" style="font-weight: 700;">Mail Us</h5>
                                <p class="mb-0 text-white">argaochurchcebu@gmail.com</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Rating Section -->
            <div class="col-md-6 col-lg-6 col-xl-3">
                <div class="footer-item">
                    <h4 style="color: white; margin-bottom: 10px; font-size:20px; font-weight:700;">Argao Church System Rating</h4>
                    <div class="rating-section">
                        <span id="rating" style="font-weight: bold;">0</span>/5
                    </div>
                    <div class="stars" id="stars">
                        <span class="star" data-value="1">★</span>
                        <span class="star" data-value="2">★</span>
                        <span class="star" data-value="3">★</span>
                        <span class="star" data-value="4">★</span>
                        <span class="star" data-value="5">★</span>
                    </div>
                    <p style="color: #ddd; margin-bottom: 10px;">Share your review about this website:</p>
                    <textarea id="review" placeholder="Write your review here"></textarea>
                    <button id="submit">Submit</button>
                    <div class="reviews" id="reviews"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Footer End -->

   <!-- Copyright Start -->
   <div class="container-fluid copyright py-4">
      <div class="container">
        <div class="text-center">
          <span class="text-body">
            <a href="#" class="text-white">
              Archdiocesan Shrine of San Miguel Arcangel Argao, Cebu. Some Rights Reserved.
            </a>
          </span>
        </div>
      </div>
    </div>
    <!-- Copyright End -->
 
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
