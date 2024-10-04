<?php
session_start();
$email = $_SESSION['email'];
$nme = $_SESSION['fullname'];
$regId = $_SESSION['citizend_id'];
require_once '../../Model/staff_mod.php';
require_once '../../Model/db_connection.php';
$staff = new Staff($conn);
$pendingItems = $staff->getPendingCitizen();

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
    <link rel="stylesheet" href="../css/table.css" />

   
  </head>
  <body>
  <?php  require_once 'sidebar.php'?>
      <div class="main-panel">
      <?php  require_once 'header.php'?>
        <div class="container">
          <div class="page-inner">
            
              <div class="col-md-12">
                <div class="card">
                  <div class="card-header">
                    <h4 class="card-title">Citizen Solo Scheduling</h4>
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
                            <th>Citizen Name</th>
                            <th>Event Name</th>
                            <th>Schedule Date</th>
                            <th>Schedule Time</th>
                      
                            <th>Schedule Type</th>
                            <th>Status</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tfoot>
                          
                        <tbody>
    <?php if (isset($pendingItems) && !empty($pendingItems)): ?>
        <?php foreach ($pendingItems as $index => $item): ?>
            <tr>
                <td><?php echo htmlspecialchars($index + 1); ?></td>
                <td><?php echo htmlspecialchars($item['citizen_name']); ?></td>
                <td><?php echo htmlspecialchars($item['event_name']); ?></td>
                <td><?php echo htmlspecialchars(date('Y/m/d', strtotime($item['schedule_date']))); ?></td>
                <td><?php echo htmlspecialchars(date('g:i A', strtotime($item['schedule_start_time']))); ?></td>
                <td><?php echo htmlspecialchars($item['roles']); ?></td>
                <td><?php echo htmlspecialchars($item['approval_status']); ?></td>
                <td>
                    <?php
                    $viewUrl = '';
                    if ($item['event_name'] === 'Baptism') {
                        $viewUrl = 'FillBaptismForm.php';
                    } elseif ($item['event_name'] === 'Wedding') {
                        $viewUrl = 'FillWeddingForm.php';
                    } elseif ($item['event_name'] === 'Funeral') {
                        $viewUrl = 'FillFuneralForm.php';
                    }
                    ?>
                    <a href="<?php echo htmlspecialchars($viewUrl . '?id=' . $item['id']); ?>" class="btn btn-primary btn-xs" style="background-color: #31ce36!important; border-color:#31ce36!important;">View</a>
                  </td>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr>
            <td colspan="8">No pending Citizen found.</td>
        </tr>
    <?php endif; ?>
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
