<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>ARGAO CHURCH MANAGEMENT SYSTEM</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <link rel="icon" href="View/assets/img/mainlogo.jpg" type="image/x-icon" />

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;700&family=Inter:wght@400;700&display=swap" rel="stylesheet" />

    <!-- Bootstrap CSS -->
    <link href="View/PageLanding/css/bootstrap.min.css" rel="stylesheet" />
    <link href="View/PageLanding/css/style.css" rel="stylesheet" />
    <link rel="stylesheet" href="View/PageLanding/css/rating.css">

    <style>
        .navbar {
            padding: 1rem; /* Add some padding */
        }

        .navbar-nav .nav-link {
            color: white; /* Set default link color */
        }

        .navbar-nav .nav-link:hover {
            color: #ffc107; /* Change color on hover */
        }
    </style>
</head>

<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a href="#" class="navbar-brand p-0">
        <img src="View/assets/img/argaochurch.png" alt="Logo" />
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <div class="navbar-nav mx-auto">
            <a href="index.php" class="nav-item nav-link active">Home</a>
            <div class="nav-item dropdown">
            <a href="#" data-bs-toggle="dropdown" style="color:white;">
                  <span class="dropdown-toggle">About Us</span>
                </a>               
                 <div class="dropdown-menu">
                    <a href="View/PageLanding/history.php" class="dropdown-item">History</a>
                    <a href="View/PageLanding/architecture.php" class="dropdown-item">Architecture</a>
                </div>
            </div>
            

<div class="nav-item dropdown">
                <a href="#" data-bs-toggle="dropdown" style="color:white;">
                  <span class="dropdown-toggle">Services</span>
                </a>
                <div class="dropdown-menu">
                  <a href="View/PageLanding/baptismal.php" class="dropdown-item">Baptismal</a>
                  <a href="View/PageLanding/Wedding.php" class="dropdown-item">Wedding</a>
                  <a href="View/PageLanding/Confirmation.php" class="dropdown-item">Confirmation</a>
                  <a href="View/PageLanding/Funeral.php" class="dropdown-item">Funeral</a>
                  <a href="View/PageLanding/eucharistic.php" class="dropdown-item">Eucharistic Masses</a>
                </div>
              </div>          
            <a href="View/PageLanding/map.php" class="nav-item nav-link">Vicinity Map</a>
            <a href="View/PageLanding/ContactUs.php" class="nav-item nav-link">Contact Us</a>
        </div>
        <div class="nav-btn px-3">
            <a href="View/PageLanding/signin.php" class="btn btn-primary py-2 px-4 ms-3">Signin</a>
        </div>
    </div>
</nav>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<script>
    // Collapse the navbar when a nav item is clicked
    const navLinks = document.querySelectorAll('.navbar-nav .nav-link');
    const navbarCollapse = document.getElementById('navbarCollapse');

    navLinks.forEach(link => {
        link.addEventListener('click', () => {
            if (navbarCollapse.classList.contains('show')) {
                navbarCollapse.classList.remove('show');
            }
        });
    });
</script>

<script src="View/PageLanding/lib/wow/wow.min.js"></script>
<script src="View/PageLanding/lib/easing/easing.min.js"></script>
<script src="View/PageLanding/lib/waypoints/waypoints.min.js"></script>
<script src="View/PageLanding/lib/counterup/counterup.min.js"></script>
<script src="View/PageLanding/lib/lightbox/js/lightbox.min.js"></script>
<script src="View/PageLanding/lib/owlcarousel/owl.carousel.min.js"></script>
<script src="View/PageLanding/js/main.js"></script>
</body>
</html>
