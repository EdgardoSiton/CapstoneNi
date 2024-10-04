<?php
session_start();
$nme = $_SESSION['fullname'];
$regId = $_SESSION['citizend_id'];
require_once '../../Model/db_connection.php';
require_once '../../Model/staff_mod.php';

$loggedInUserEmail = isset($_SESSION['email']) ? $_SESSION['email'] : null;

$staff = new Staff($conn);

if (!$loggedInUserEmail) {
  header("Location: login.php");
  exit();
}
$announcements = $staff->getAnnouncements(); // Fetch all announcements
?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <title>ARGAO CHURCH MANAGEMENT SYSTEM</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta content="" name="keywords" />
    <meta content="" name="description" />
    <link rel="icon" href="../assets/img/mainlogo.jpg" type="image/x-icon"
    />

        <!-- Google Web Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&family=Inter:slnt,wght@-10..0,100..900&display=swap" rel="stylesheet">

        <!-- Icon Font Stylesheet -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"/>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

        <!-- Libraries Stylesheet -->
        <link rel="stylesheet" href="lib/animate/animate.min.css"/>
        <link href="lib/lightbox/css/lightbox.min.css" rel="stylesheet">
        <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">


        <!-- Customized Bootstrap Stylesheet -->
        <link href="css/bootstrap.min.css" rel="stylesheet">

        <!-- Template Stylesheet -->
        <link href="css/style.css" rel="stylesheet">
        <style>
        .text-center p{
    color:#3b3b3b; text-align: justify; text-justify: inter-word; font-size: 15px; line-height: 1.6; margin-top: 10px; margin-left: 10px;
}


        .gallery {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            margin-top: 2rem;
            margin-bottom: 3rem;
        }
        .gallery img {
            width: 40%;
            max-width: calc(25% - 1rem);
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }
        .back-button {
float:right;       
margin-right:110px;  
margin-top:20px;  

            padding: 0.5rem 1rem;
            background-color: #0066a8;
            color: #fff;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            font-size: 1rem;
            transition: background-color 0.3s ease;
        }
        .back-button:hover {
            background-color: #004a80;
        }
        .schedule {
float:left;       
margin-LEFT:20px;  

            padding: 10px;
            color: #3b3b3b;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            font-size: 12PX;
            transition: background-color 0.3s ease;
        }
       
        .schedule:hover{
            color:wheat!important;
        }
      .baptismalreq i{
            font-size:7px;
            margin-right:15px;
            color:black;
        }
    </style>
    </head>

    <body>
 <!-- Navbar & Hero Start -->
 <div class="container-fluid nav-bar px-0 px-lg-4 py-lg-0">
      <div class="container">
      <?php require_once 'header.php'?>

      </div>
    </div>
    <!-- Navbar & Hero End -->
      

        <!-- Header Start -->
        <div class="container-fluid bg-breadcrumb">
            <div class="container text-center py-5" style="max-width: 900px;">
                <h4 class="text-white display-4 mb-4 wow fadeInDown" data-wow-delay="0.1s">BAPTISMAL</h4>
                <ol class="breadcrumb d-flex justify-content-center mb-0 wow fadeInDown" data-wow-delay="0.3s">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">About Us</a></li>
                    <li class="breadcrumb-item active text-primary">History</li>
                </ol>    
            </div>
        </div>
        <!-- Header End -->
<!-- Service Start -->
<a href="history.php" class="back-button">Back</a>

<div class="container-fluid service py-5">
  
        <div class="container py-5" style="padding-top:0!important;">
        
        <div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.2s">

          <div class="gallery">
            
          <img src="assets/img/faq.png" alt="Etymology Image" class="float-right"> 
          <img src="assets/img/faq.png" alt="Etymology Image" class="float-right">
          <img src="assets/img/faq.png" alt="Etymology Image" class="float-right">
          <img src="assets/img/faq.png" alt="Etymology Image" class="float-right">
          </div>
            <P>Baptism holds a significant role within the Christian faith as it formally welcomes a new member into the church. It serves as the cornerstone of the entire Christian journey, acting as the entryway to a life guided by the Holy Spirit and granting access to other sacred sacraments. Through this sacred ritual, individuals are cleansed of their sins and spiritually reborn as children of God. They become an integral part of the body of Christ, joining the church and participating in its mission.
</P>
            <P>Beyond its religious significance, baptism has evolved into a cultural tradition characterized by family gatherings and the strengthening of societal bonds. As a religious institution, the parish is dedicated to ensuring the solemnity of this celebration for the newly initiated member.
</P>

        </div>
        <div class="baptismalreq">
        <h5 style="font-weight: BOLDER; padding-left:10px;">REQUIREMENTS</h5>
        <br>

        <P><i class="fas fa-circle"></i>
        Birth certificate from either the National Statistics Office or Civil Registrar; 1 original and 1 photocopy</P>
</div>
<BR>
<br>
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
<BR>
<br>
<div class="baptismalreq">
        <h5 style="font-weight: BOLDER; padding-left:10px;">FEES</h5>
        <br>

        <P><i class="fas fa-circle"></i>
        Sunday baptisms - PHP 600.00 + PHP 10.00 for every sponsor (ninong or ninang)
        <P><i class="fas fa-circle"></i>
        Individual baptisms - PHP 1450.00 + PHP 10.00 for every sponsor (ninong or ninang)
</P>
</div>
<BR>
<br>
<div class="baptismalreq">
        <h5 style="font-weight: BOLDER; padding-left:10px;">REMINDERS</h5>
       <br>
        <P><i class="fas fa-circle"></i>
        Registration should be done one week before the actual date of baptism.
                <P><i class="fas fa-circle"></i>
                Observe punctuality
                <P><i class="fas fa-circle"></i>
                Candles for sponsors (godfathers and godmothers) can be bought for PHP 3.00 a piece.
</P>
<P><i class="fas fa-circle"></i>
If there is a wedding on the scheduled time of baptism, it will be held inside the sacristy. Three sponsors (3 godfathers and 3 godmothers are allowed to join inside; others will stay in the garden)</P>
</div>
        </div>
    </div>
    </div>
        </div>
    </div>

    <?php require_once 'footer.php'?>



        <!-- Back to Top -->
        <a href="#" class="btn btn-primary btn-lg-square rounded-circle back-to-top"><i class="fa fa-arrow-up"></i></a>   

        <script>
    var acc = document.getElementsByClassName("accordion");
    var i;

    for (i = 0; i < acc.length; i++) {
        acc[i].addEventListener("click", function() {
            this.classList.toggle("active");
            var panel = this.nextElementSibling;
            if (panel.style.display === "block") {
                panel.style.display = "none";
            } else {
                panel.style.display = "block";
            }
        });
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