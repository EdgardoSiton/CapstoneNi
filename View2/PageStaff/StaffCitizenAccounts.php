<?php
require_once '../../Model/login_mod.php';
require_once '../../Model/db_connection.php';

// Create a new User object and call the getAccount method
$getaccount = new User($conn);
$userInfo = $getaccount->getAccount();

// Start session and retrieve session variables
session_start();
$email = $_SESSION['email'];
$nme = $_SESSION['fullname'];
$regId = $_SESSION['citizend_id'];
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>ARGAO CHURCH MANAGEMENT SYSTEM</title>
    <meta
      content="width=device-width, initial-scale=1.0, shrink-to-fit=no"
      name="viewport"
    />
    <link rel="icon" href="../assets/img/mainlogo.jpg" type="image/x-icon"
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

 
  </head>
  <body>
  <?php  require_once 'sidebar.php'?>
      <div class="main-panel">
      <?php  require_once 'header.php'?>
       
      <form method="POST">
        <div class="container">
            <div class="page-inner">
              
                <div class="col-md-6">
                  <div class="card">
                    <div class="card-header">
                      <div class="card-title">Citizen Account List</div>
                    </div>
                    <div class="card-body">
                      <table class="table table-hover">
                        <thead>
                          <tr>
                            <th scope="col">ID No.</th>
                            <th scope="col">Citizen Name</th>
                            <th scope="col">Phone Number</th>
                            <th scope="col">Email</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody>
    <?php
    // Check if the $userInfo array has data
    if (!empty($userInfo)) {
        // Loop through the result and display each record in a table row
        foreach ($userInfo as $index => $user) {
            $citizendId = htmlspecialchars($user['citizend_id']);
            $fullname = htmlspecialchars($user['fullname']);
            $phone = htmlspecialchars($user['phone']);
            $email = htmlspecialchars($user['email']);
            $status = htmlspecialchars($user['r_status']);
            
            // Create the view button with a link or JavaScript function
            $viewButton = '<a href="viewCitizen.php?id=' . $citizendId . '" class="btn btn-primary">View</a>';

            echo '<tr>';
            echo '<td>' . ($index + 1) . '</td>'; // Display a unique index for each row
            echo '<td>' . $fullname . '</td>'; // Safely display the fullname
            echo '<td>' . $phone . '</td>'; // Safely display the phone
            echo '<td>' . $email . '</td>'; // Safely display the email
            echo '<td>' . $status . '</td>'; // Safely display the status
            echo '<td>' . $viewButton . '</td>'; // Display the view button
            echo '</tr>';
        }
    } else {
        // If no data is returned, show a message in the table
        echo '<tr>';
        echo '<td colspan="6">No pending citizens found.</td>'; // Adjust colspan according to your table
        echo '</tr>';
    }
    ?>
</tbody>
                      </table>
                    </div>
                  </div>
                  
              </div>
            </div>
          </div>
              </div>
            </div>
          </div>
        </div>
        <form>

     
    </div>
    <!--   Core JS Files   -->
    <script src="../assets/js/core/jquery-3.7.1.min.js"></script>
    <script src="../assets/js/core/popper.min.js"></script>
    <script src="../assets/js/core/bootstrap.min.js"></script>

    <!-- jQuery Scrollbar -->
    <script src="../assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>

    <!-- Chart JS -->
    <script src="../assets/js/plugin/chart.js/chart.min.js"></script>

    <!-- jQuery Sparkline -->
    <script src="../assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js"></script>

    <!-- Chart Circle -->
    <script src="../assets/js/plugin/chart-circle/circles.min.js"></script>

    <!-- Datatables -->
    <script src="../assets/js/plugin/datatables/datatables.min.js"></script>


    <!-- jQuery Vector Maps -->
    <script src="../assets/js/plugin/jsvectormap/jsvectormap.min.js"></script>
    <script src="../assets/js/plugin/jsvectormap/world.js"></script>

    <!-- Sweet Alert -->
    <script src="../assets/js/plugin/sweetalert/sweetalert.min.js"></script>

    <!-- Kaiadmin JS -->
    <script src="../assets/js/kaiadmin.min.js"></script>

 
    <script>
      $("#lineChart").sparkline([102, 109, 120, 99, 110, 105, 115], {
        type: "line",
        height: "70",
        width: "100%",
        lineWidth: "    2",
        lineColor: "#177dff",
        fillColor: "rgba(23, 125, 255, 0.14)",
      });

      $("#lineChart2").sparkline([99, 125, 122, 105, 110, 124, 115], {
        type: "line",
        height: "70",
        width: "100%",
        lineWidth: "2",
        lineColor: "#f3545d",
        fillColor: "rgba(243, 84, 93, .14)",
      });

      $("#lineChart3").sparkline([105, 103, 123, 100, 95, 105, 115], {
        type: "line",
        height: "70",
        width: "100%",
        lineWidth: "2",
        lineColor: "#ffa534",
        fillColor: "rgba(255, 165, 52, .14)",
      });
    </script>
  </body>
</html>
