<?php
session_start();
$email = $_SESSION['email'];
$nme = $_SESSION['fullname'];
$regId = $_SESSION['citizend_id'];
require_once '../../Model/staff_mod.php';
require_once '../../Model/db_connection.php';
$staff = new Staff($conn);
$announcements = $staff->getAnnouncements();
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

    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link rel="stylesheet" href="../assets/css/demo.css" />
  </head>
  <body>
    <!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Announcement</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="modalForm" method="POST" action="../../Controller/addannounce_con.php">
    <div class="modal-body">
        <div class="form-group">
            <label for="eventDate">Event Date</label>
            <input type="hidden" name="announcement" value = "announcement">
            <input type="date" class="form-control" id="eventDate" name="eventDate" placeholder="Enter event date" >
        </div>
        <div class="form-group">
            <label for="startTime">Start Time</label>
            <input type="time" class="form-control" id="startTime" name="startTime" placeholder="Enter start time" >
        </div>
        <div class="form-group">
            <label for="endTime">End Time</label>
            <input type="time" class="form-control" id="endTime" name="endTime" placeholder="Enter end time" >
        </div>
        <div class="form-group">
            <label for="eventType">Event Type</label>
            <select class="form-control" id="eventType" name="eventType" >
                <option value="" disabled selected>Select Event</option>
                <option value="MassBaptism">Mass Baptism</option>
                <option value="MassMarriage">Mass Marriage</option>
                <option value="MassConfirmation">Mass Confirmation</option>
            </select>
        </div>
        <div class="form-group">
            <label for="eventTitle">Event Title</label>
            <input type="text" class="form-control" id="eventTitle" name="eventTitle" placeholder="Enter title">
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <input type="text" class="form-control" id="description" name="description" placeholder="Enter description">
        </div>
        <div class="form-group">
            <label for="capacity">Capacity</label>
            <input type="number" class="form-control" id="capacity" name="capacity" placeholder="Enter capacity">
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</form>

        </div>
    </div>
</div>


  <?php  require_once 'sidebar.php'?>
      <div class="main-panel">
      <?php  require_once 'header.php'?>
        <div class="container">
            <div class="page-inner">
                <div
                  class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4"
                >
                  <div>
                    <h3 class="fw-bold mb-3">Staff Announcement</h3>
                  </div>
                  <div class="ms-md-auto py-2 py-md-0">
                    <a href="FillScheduleForm.php?type=Announcement"   class="btn btn-primary btn-round">Add Announcement</a>
                    

                  </div>
                </div>
                <div class="row">
        <?php foreach ($announcements as $announcement): ?>
            <div class="col-md-4">
                <div class="card card-post card-round">
                    <div class="card-body">
                        <div class="separator-solid"></div>
                        <p class="card-category text-info mb-1">
                        <h3 class="card-title">
                            <a href="#">Priest:<?php echo htmlspecialchars($announcement['fullname']) ?></a>
                        </h3>
                        <a href="#">
                        Event Date:  <?php 
       $date = htmlspecialchars(date('F j, Y', strtotime($announcement['schedule_date'])));
        $startTime = htmlspecialchars(date('g:i a', strtotime($announcement['schedule_start_time'])));
        $endTime = htmlspecialchars(date('g:i a', strtotime($announcement['schedule_end_time'])));
        echo "$date - $startTime - $endTime ";
        ?>
    </a>
    <br>
    <a href="#">
                       Seminar Date:  <?php 
       $date = htmlspecialchars(date('F j, Y', strtotime($announcement['seminar_date'])));
        $startTime = htmlspecialchars(date('g:i a', strtotime($announcement['seminar_start_time'])));
        $endTime = htmlspecialchars(date('g:i a', strtotime($announcement['seminar_end_time'])));
        echo "$date - $startTime - $endTime ";
        ?>
    </a>
                        </p>
                        <h3 class="card-title">
                            <a href="#"><?php echo htmlspecialchars($announcement['title']) ?></a>
                        </h3>
                        <p class="card-text">
                            <?php echo htmlspecialchars($announcement['description']) ?>
                        </p>
                        <h3 class="card-title">
                            <a href="#">Capacity: <?php echo htmlspecialchars($announcement['capacity']) ?></a>
                        </h3>
                        <?php
                        // Determine the form link based on event type
                        $eventType = htmlspecialchars($announcement['event_type']);
                        $formLink = '#'; // Default link in case none match

                        // Set form link based on event type
                        switch ($eventType) {
                            case 'MassBaptism':
                                $formLink = 'MassFillBaptismForm.php';
                                break;
                            case 'MassConfirmation':
                                $formLink = 'MassFillConfirmationForm.php';
                                break;
                            case 'MassMarriage':
                                $formLink = 'MassFillWeddingForm.php';
                                break;
                            // Add more cases as needed for other event types
                        }

                        // Check if capacity is zero
                        if ($announcement['capacity'] > 0) {
                            // Show Register button if capacity is available
                            echo '<a href="' . $formLink . '?announcement_id=' . htmlspecialchars($announcement['announcement_id']) . '" class="btn btn-primary btn-rounded btn-sm register-btn" data-announcement-id="' . htmlspecialchars($announcement['announcement_id']) . '">Register Now</a>';
                        } else {
                            // Show Fully Booked message in red if capacity is zero
                            echo '<p class="text-danger"><strong>Fully Booked</strong></p>';
                        }
                    ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
</div>

    </div>
    
   
    <!-- jQuery, Popper.js, and Bootstrap JS -->
    <!-- jQuery first -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<!-- Popper.js (required for Bootstrap 4) -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
<!-- Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <!-- Sweet Alert -->
  <script src="../assets/js/plugin/sweetalert/sweetalert.min.js"></script>
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
      <script>
      //== Class definition
      var SweetAlert2Demo = (function () {
        //== Demos
        var initDemos = function () {
          //== Sweetalert Demo 1
        

        


          $("#alert_demo_6").click(function (e) {
            swal("Event added successfully!", {
              icon: "success",  
              buttons: false,
              timer: 1000,
            });
          });

       

        };

        return {
          //== Init
          init: function () {
            initDemos();
          },
        };
      })();

      //== Class Initialization
      jQuery(document).ready(function () {
        SweetAlert2Demo.init();
      });
    </script>
  </body>
</html>