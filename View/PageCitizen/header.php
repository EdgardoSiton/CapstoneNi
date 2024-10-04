
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

    <link
      href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&family=Inter:slnt,wght@-10..0,100..900&display=swap"
      rel="stylesheet"
    />
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
   <!-- Bootstrap CSS -->
   <link href="css/bootstrap.min.css" rel="stylesheet" />
    <link href="css/style.css" rel="stylesheet" />
    <link rel="stylesheet" href="css/rating.css">
</head>
<style>
  
</style>
<body>
<nav class="navbar navbar-expand-lg navbar-light">
    <a href="#" class="navbar-brand p-0">
        <img src="assets/img/argaochurch.png" alt="Logo" />
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <div class="navbar-nav mx-auto">
            <a href="Citizenpage.php" class="nav-item nav-link active">Home</a>
            <div class="nav-item dropdown">
            <a href="#" data-bs-toggle="dropdown" style="color:white;">
                  <span class="dropdown-toggle">About Us</span>
                </a>               
                 <div class="dropdown-menu">
                    <a href="history.php" class="dropdown-item">History</a>
                    <a href="architecture.php" class="dropdown-item">Architecture</a>
                </div>
            </div>
            

<div class="nav-item dropdown">
                <a href="#" data-bs-toggle="dropdown" style="color:white;">
                  <span class="dropdown-toggle">Services</span>
                </a>
                <div class="dropdown-menu">
                  <a href="baptismal.php" class="dropdown-item">Baptismal</a>
                  <a href="Wedding.php" class="dropdown-item">Wedding</a>
                  <a href="Confirmation.php" class="dropdown-item">Confirmation</a>
                  <a href="Funeral.php" class="dropdown-item">Funeral</a>
                  <a href="eucharistic.php" class="dropdown-item">Eucharistic Masses</a>
                </div>
              </div>          
            <a href="map.php" class="nav-item nav-link" style="color:white!important;">Vicinity Map</a>
            <a href="ContactUs.php" class="nav-item nav-link" style="color:white!important;">Contact Us</a>
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

    </div>
    
</nav>
  <!-- Bootstrap JS and Popper.js -->

</body>
</html>
