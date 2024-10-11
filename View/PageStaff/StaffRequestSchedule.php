<?php
session_start();
$email = $_SESSION['email'];
$nme = $_SESSION['fullname'];
$regId = $_SESSION['citizend_id'];
require_once '../../Model/staff_mod.php';
require_once '../../Model/db_connection.php';
$staff = new Staff($conn);
$pendingItems = $staff->getRequestSchedule();

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
    <!-- CSS Just for demo purpose, don't include it in your project -->

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
                    <h4 class="card-title">Citizen Request Form Scheduling</h4>
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
            <th>Request Category</th>
            <th>Request Person</th>
            <th>Request Appointment Date</th>
            <th>Request Appointment Time</th>
            <th>Request Address</th>
            <th>Request Phone Number</th>
            <th>Date of Follow Up</th>
            <th>Request Chapel</th>
            <th>Priest Name</th>
            <th>Status</th>
                            <th>Action</th>
                            priest_name                   </tr>
                        </thead>
                        <tfoot>
                          
                        <tbody>
    <?php if (isset($pendingItems) && !empty($pendingItems)): ?>
        <?php foreach ($pendingItems as $index => $item): ?>
            <tr>
            <td><?php echo htmlspecialchars($index + 1); ?></td>
                    <td><?php echo htmlspecialchars($item['req_category']); ?></td>
                    <td><?php echo htmlspecialchars($item['req_person']); ?></td>
                    <td><?php echo htmlspecialchars(date('Y/m/d', strtotime($item['date']))); ?></td>
                    <td><?php echo htmlspecialchars(date('g:i A', strtotime($item['start_time']))); ?></td>
                    <td><?php echo htmlspecialchars($item['req_address']); ?></td>
                    <td><?php echo htmlspecialchars($item['req_pnumber']); ?></td>
                    <td><?php echo htmlspecialchars($item['cal_date']); ?></td>
                    <td><?php echo htmlspecialchars($item['req_chapel']); ?></td> 
                    <td>
    <?php
    if ($item['pr_status'] == 'Pending') {
        echo 'Waiting for approval';
    } else {
        echo htmlspecialchars($item['priest_name']);
    }
    ?>
</td>

                     <td><?php echo htmlspecialchars($item['req_status']); ?></td>
                <td>
                    <?php
                    $viewUrl = '';
                    if ($item['req_id']) {
                        $viewUrl = 'FillBaptismForm.php';
                    } 
                    ?>
                    <a href="<?php echo htmlspecialchars($viewUrl . '?req_id=' . $item['req_id']); ?>" class="btn btn-primary btn-xs" style="background-color: #31ce36!important; border-color:#31ce36!important;">View</a>
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
        $("#basic-datatables").DataTable({});

        $("#multi-filter-select").DataTable({
          pageLength: 5,
          initComplete: function () {
            this.api()
              .columns()
              .every(function () {
                var column = this;
                var select = $(
                  '<select class="form-select"><option value=""></option></select>'
                )
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
                    select.append(
                      '<option value="' + d + '">' + d + "</option>"
                    );
                  });
              });
          },
        });

        // Add Row
        $("#add-row").DataTable({
          pageLength: 5,
        });

        var action =
          '<td> <div class="form-button-action"> <button type="button" data-bs-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Edit Task"> <i class="fa fa-edit"></i> </button> <button type="button" data-bs-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Remove"> <i class="fa fa-times"></i> </button> </div> </td>';

        $("#addRowButton").click(function () {
          $("#add-row")
            .dataTable()
            .fnAddData([
              $("#addName").val(),
              $("#addPosition").val(),
              $("#addOffice").val(),
              action,
            ]);
          $("#addRowModal").modal("hide");
        });
      });
    </script>
  </body>
</html>
