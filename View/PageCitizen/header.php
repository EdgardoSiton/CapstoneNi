<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>ARGAO CHURCH MANAGEMENT SYSTEM</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="icon" href="../assets/img/mainlogo.jpg" type="image/x-icon" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&family=Inter:slnt,wght@-10..0,100..900&display=swap"
      rel="stylesheet"
    />
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet" />
    <link rel="stylesheet" href="lib/animate/animate.min.css" />
    <link href="lib/lightbox/css/lightbox.min.css" rel="stylesheet" />
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet" />
    <link href="css/bootstrap.min.css" rel="stylesheet" />
    <link href="css/style.css" rel="stylesheet" />
    <link rel="stylesheet" href="css/rating.css">
</head>
<style>
  
</style>
<body>
  <div class="container-fluid nav-bar px-0 px-lg-4 py-lg-0">
    <div class="container">
      <nav class="navbar navbar-expand-lg navbar-light">
        <a href="CitizenPage.php" class="navbar-brand p-0">
          <img src="assets/img/argaochurch.png" alt="Argao Church Logo" />
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
          <span class="fa fa-bars"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
          <div class="navbar-nav mx-0 mx-lg-auto">
            <a href="index.html" class="nav-item nav-link active">Home</a>
            <a href="" class="nav-item nav-link">About</a>
            <a href="" class="nav-item nav-link">Services</a>
            <a href="" class="nav-item nav-link">Blog</a>
            <div class="nav-item dropdown">
              <a href="" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Pages</a>
              <div class="dropdown-menu">
                <a href="" class="dropdown-item">Our Features</a>
                <a href="" class="dropdown-item">Our team</a>
                <a href="" class="dropdown-item">Testimonial</a>
                <a href="" class="dropdown-item">FAQs</a>
                <a href="" class="dropdown-item">404 Page</a>
              </div>
            </div>
            <a href="" id="open-modal" class="nav-item nav-link">Rate</a>
          </div>
        </div>
        <div class="nav-btn px-3">
          <div class="dropdown">
            <a href="" id="form-open" class="btn btn-primary py-2 px-4 ms-3 flex-shrink-0 dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
              <?php echo htmlspecialchars($nme); ?>
            </a>
            <ul class="dropdown-menu" aria-labelledby="form-open">
                <li><a class="dropdown-item" href="profile.php">My Profile</a></li>
                <li><a class="dropdown-item" href="">My Appointment </a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="">Need Help?</a></li>
                <li><a class="dropdown-item" href="">Switch to User Panel</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="../../index.php">Sign Out</a></li>
            </ul>
          </div>
        </div>
      </nav>
    </div>
  </div>

  <!-- Bootstrap JS and Popper.js -->

</body>
</html>
