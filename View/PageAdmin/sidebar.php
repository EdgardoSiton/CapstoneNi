<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>ARGAO CHURCH MANAGEMENT SYSTEM</title>
    <meta
      content="width=device-width, initial-scale=1.0, shrink-to-fit=no"
      name="viewport"
    />
    <link rel="icon" href="../assets/img/kaiadmin/favicon.ico" type="image/x-icon"
    />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <!-- Fonts and icons -->
    <script src="../assets/js/plugin/webfont/webfont.min.js"></script>
    <script>
      WebFont.load({
        google: { families: ["Public Sans:300,400,500,600,700"] },
        custom: {
          families: [
            "Font Awesome 5 Solid",
            "Font Awesome 5 Regular",
            "Font Awesome 5 Brands",
            "simple-line-icons",
          ],
          urls: ["assets/css/fonts.min.css"],
        },
        active: function () {
          sessionStorage.fonts = true;
        },
      });
    </script>

    <!-- CSS Files -->
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="../assets/css/plugins.min.css" />
    <link rel="stylesheet" href="../assets/css/kaiadmin.min.css" />

    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link rel="stylesheet" href="../assets/css/demo.css" />
  </head>
  <body>
  <div class="wrapper">
      <!-- Sidebar -->
      <div class="sidebar" data-background-color="dark">
        <div class="sidebar-logo">
          <!-- Logo Header -->
          <div class="logo-header" data-background-color="dark">
            <a href="index.html" class="logo">
              <img
              src="../assets/img/argaochurch.png"
              alt="navbar brand"
                class="navbar-brand"
                height="46"
              />
            </a>
            <div class="nav-toggle">
              <button class="btn btn-toggle toggle-sidebar">
                <i class="gg-menu-right"></i>
              </button>
              <button class="btn btn-toggle sidenav-toggler">
                <i class="gg-menu-left"></i>
              </button>
            </div>
            <button class="topbar-toggler more">
              <i class="gg-more-vertical-alt"></i>
            </button>
          </div>
          <!-- End Logo Header -->
        </div>
        <div class="sidebar-wrapper scrollbar scrollbar-inner">
          <div class="sidebar-content">
            <ul class="nav nav-secondary">
              <li class="nav-item">
                <a href="AdminDashboard.php">

                  <i class="fas fa-home"></i>
                  <p>Dashboard</p>
                </a>
              
              </li>
             
              <li class="nav-item">
                <a href="BaptismRecords.php">
                  <i class="fas fa-calendar-alt"></i>
                  <p>Event Records</p> 
                </a>
                <li class="nav-item">
                <a href="ConfirmationRecords.php">
                  <i class="fas fa-calendar-alt"></i>
                  <p>Event Records</p> 
                </a>
                <li class="nav-item">
                <a href="DefunctorumRecords.php">
                  <i class="fas fa-calendar-alt"></i>
                  <p>Event Records</p> 
                </a>
                <li class="nav-item">
                <a href="WeddingRecords.php">
                  <i class="fas fa-calendar-alt"></i>
                  <p>Event Records</p> 
                </a>
               
              </li>
              <li class="nav-item active">
                <a href="AdminDonation.php">
                  <i class="fas fa-calendar-alt"></i>
                  <p>Donation Reports</p> 
                </a>
               
              </li>
              <li class="nav-item">
                <a href="AdminFinancial.php">
                  <i class="fas fa-calendar-alt"></i>
                  <p>Acknowledgement Receipt</p> 
                </a>
               
              </li>
              
            </ul>
          </div>
        </div>
      </div>
      </body>
</html>
