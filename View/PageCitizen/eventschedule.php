<?php
require_once __DIR__ . '/../../Model/db_connection.php';
require_once __DIR__ . '/../../Model/citizen_mod.php';

session_start();
$nme = $_SESSION['fullname'];
$regId = $_SESSION['citizend_id'];
$citizenController = new Citizen($conn);

$pendingAppointments = $citizenController->getPendingCitizenss(null, $regId);
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
   <!-- Bootstrap CSS -->
   <link href="css/bootstrap.min.css" rel="stylesheet" />
    <link href="css/style.css" rel="stylesheet" />
    <link rel="stylesheet" href="css/rating.css">
    <!-- CSS Files -->
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="../assets/css/plugins.min.css" />
    <link rel="stylesheet" href="../assets/css/kaiadmin.min.css" />

    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link rel="stylesheet" href="assets/css/demo.css" />
  </head>
  <body>
 <!-- Navbar & Hero Start -->
 <div class="container-fluid nav-bar px-0 px-lg-4 py-lg-0">
      <div class="container">
       
      <?php require_once 'header.php'?>

      </div>
    </div>
    <!-- Navbar & Hero End -->
    
  <?php require_once 'profheader.php'?>

        <div class="container">
          <div class="page-inner">
            
              <div class="col-md-12">
                <div class="card">
                  <div class="card-header">
                    <h4 class="card-title">My Event Schedule</h4>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table
                        id="multi-filter-select"
                        class="display table table-striped table-hover"
                      >
                        <thead>
                          <tr>
                            <th>ID NO.</th>
                            <th>Name of Applicant</th>
                            <th>Event Name</th>
                            <th>Appointment Date</th>
                            <th>Appointment Time</th>
                            <th>Schedule Type</th>
                            <th>Status</th>
                  
                          </tr>
                        </thead>
                        <tfoot>
                          
                        <tbody>
    <?php if (!empty($pendingAppointments)) {
        foreach ($pendingAppointments as $index => $appointment) {
            // Convert the schedule start and end times to 12-hour format
            $scheduleStart = date('g:i A', strtotime($appointment['schedule_start_time']));
            $scheduleEnd = date('g:i A', strtotime($appointment['schedule_end_time']));
            $scheduleTime = $scheduleStart . ' - ' . $scheduleEnd;
            
           
            ?>

            <tr>
                <td><?= $index + 1; ?></td>
                <td><?= htmlspecialchars($appointment['citizen_name']); ?></td>
                <td><?= htmlspecialchars($appointment['type']); ?></td>
                <td><?= htmlspecialchars(date('F j, Y', strtotime($appointment['schedule_date']))); ?></td>
                <td><?= htmlspecialchars($scheduleTime); ?></td>
                <td><?= htmlspecialchars($appointment['roles']); ?></td>
                <td>
                    <?php 
                    if ($appointment['approval_status'] === 'Pending') {
                        echo 'Waiting for Approval';
                    } else {
                        echo htmlspecialchars($appointment['approval_status']);
                    }
                    ?>
                </td>
               
            </tr>
            <?php
        }
    } else { ?>
        <tr>
            <td colspan="9">No pending appointments found.</td>
        </tr>
    <?php } ?>
</tbody>


                      </table>
                    </div>
                  </div>
                </div>
              </div>

            

        
      </div>

   
    </div>
    <!--   Core JS Files   -->
    <script src="../assets/js/core/jquery-3.7.1.min.js"></script>
    <script src="../assets/js/core/popper.min.js"></script>
    <script src="../assets/js/core/bootstrap.min.js"></script>

    <!-- jQuery Scrollbar -->
    <script src="../assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>
    <!-- Datatables -->
    <script src="../assets/js/plugin/datatables/datatables.min.js"></script>
    <!-- Kaiadmin JS -->
    <script src="../assets/js/kaiadmin.min.js"></script>
    <!-- Kaiadmin DEMO methods, don't include it in your project! -->
    <script src="../assets/js/setting-demo2.js"></script>
    <script>
  $(document).ready(function () {
  $("#multi-filter-select").DataTable({
    pageLength: 5,
    columnDefs: [
      { targets: '_all', orderable: false }  // Disable sorting for all columns
    ],
    initComplete: function () {
      this.api()
        .columns()
        .every(function () {
          var column = this;
          var select = $('<select class="form-select"><option value=""></option></select>')
            .appendTo($(column.footer()).empty())
            .on("change", function () {
              var val = $.fn.dataTable.util.escapeRegex($(this).val());

              column
                .search(val ? "^" + val + "$" : "", true, false)
                .draw();
            });

          column
            .data()
            .unique()
            .sort()
            .each(function (d, j) {
              select.append('<option value="' + d + '">' + d + "</option>");
            });
        });
    },
  });
});


    </script>
  </body>
</html>