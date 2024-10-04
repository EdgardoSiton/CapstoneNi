<?php
require_once '../../Controller/getCitizen_con.php';
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="assets/js/plugin/webfont/webfont.min.js"></script>
     <style>
     /* CSS to ensure the modal only shows the image with no extra white space */
/* Ensure the modal takes up the full screen */
.modal-dialog {
    margin: 0;
    width: 100%;
    height: 100%;
    max-width: none;
}

.modal-content {
    height: 100%;
    border: none;
    border-radius: 0;
    background: transparent; /* Ensure no background color */
    box-shadow: none; /* Remove shadow */
}

.modal-body {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100%;
    padding: 0;
    background: transparent; /* Ensure no background color */
}

.modal-body img {
    max-width: 200%;
    max-height: 200%;
    object-fit: contain; /* Keeps the image aspect ratio */
}

     </style>
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
    
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
 integrity="sha384-KyZXEAg3QhqLMpG8r+Knujsl7/1L_dstPt3HV5HzF6Gvk/e3s4Wz6iJgD/+ub2oU" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <!-- CSS Files -->
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="../assets/css/plugins.min.css" />
    <link rel="stylesheet" href="../assets/css/kaiadmin.min.css" />

    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link rel="stylesheet" href="../assets/css/demo.css" />
   
  </head>
  <body> 
  <?php require_once 'header.php'?>
  <?php require_once 'sidebar.php'?>
  <div class="container"> 
    <div class="page-inner">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Citizen Account Details</div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <!-- Display Citizen Information -->
                            <div class="col-md-6 col-lg-4">
                                <div class="form-group">
                                    <label for="fullname">Full Name:</label>
                                    <input type="text" class="form-control" id="fullname" value="<?php echo $fullname; ?>" readonly />
                                </div>
                                <div class="form-group">
                                    <label for="gender">Gender:</label>
                                    <input type="text" class="form-control" id="gender" value="<?php echo $gender; ?>" readonly />
                                </div>
                                <div class="form-group">
                                    <label for="phone">Phone:</label>
                                    <input type="text" class="form-control" id="phone" value="<?php echo $phone; ?>" readonly />
                                </div>
                            </div>

                            <div class="col-md-6 col-lg-4">
                                <div class="form-group">
                                    <label for="email">Email:</label>
                                    <input type="text" class="form-control" id="email" value="<?php echo $email; ?>" readonly />
                                </div>
                                <div class="form-group">
                                    <label for="status">Birth Date:</label>
                                    <input type="text" class="form-control" id="status" value="<?php echo  $c_date_birth; ?>" readonly />
                                </div>

                                <div class="form-group">
                                    <label for="address">Address:</label>
                                    <textarea class="form-control" id="address" readonly><?php echo $address; ?></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="validId">Valid ID:</label>
                                    <img class="form-control" src="<?php echo !empty($validId) ? '../PageLanding/' . htmlspecialchars($validId) : 'img/default-placeholder.png'; ?>" alt="Valid ID" style="max-width: 200px; max-height: 200px; cursor: pointer;" data-bs-toggle="modal" data-bs-target="#imageModal">   
                                </div>
                            </div>
                        </div>

                        <div class="card-action">
                        <button class="btn btn-success approve-btn" data-id="<?php echo $citizenId; ?>">Approve</button>

                        <button class="btn btn-danger delete-btn" data-id="<?php echo $citizenId; ?>">Delete</button>

                        <button type="button" class="btn btn-danger" onclick="history.back()">Cancel</button>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-body">
            <img src="<?php echo !empty($validId) ? '../PageLanding/' . htmlspecialchars($validId) : 'img/default-placeholder.png'; ?>" alt="Valid ID">
        </div>
    </div>
</div>

<script>
 document.addEventListener('DOMContentLoaded', function() {
    document.querySelector('.approve-btn').addEventListener('click', function() {
        // Existing approve functionality
    });

    document.querySelector('.delete-btn').addEventListener('click', function() {
        var citizenId = this.getAttribute('data-id');

        Swal.fire({
            title: 'Are you sure?',
            text: "This action will permanently delete the account!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                var xhr = new XMLHttpRequest();
                xhr.open('POST', '../../Controller/getCitizen_con.php', true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                xhr.onload = function() {
                    if (xhr.status === 200) {
                        Swal.fire(
                            'Deleted!',
                            'The citizen account has been deleted.',
                            'success'
                        ).then(() => {
                            window.location.href = 'StaffCitizenAccounts.php'; // Redirect after deletion
                        });
                    } else {
                        Swal.fire(
                            'Error!',
                            'There was an issue deleting the account.',
                            'error'
                        );
                    }
                };
                xhr.send('citizenId=' + encodeURIComponent(citizenId) + '&action=delete');
            }
        });
    });
});

 document.addEventListener('DOMContentLoaded', function() {
    document.querySelector('.approve-btn').addEventListener('click', function() {
        var citizenId = this.getAttribute('data-id');

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, approve it!'
        }).then((result) => {
            if (result.isConfirmed) {
                var xhr = new XMLHttpRequest();
                xhr.open('POST', '../../Controller/getCitizen_con.php', true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                xhr.onload = function() {
    if (xhr.status === 200) {
        Swal.fire(
            'Approved!',
            'The citizen has been approved.',
            'success'
        ).then(() => {
            // Redirect to StaffCitizenAccounts.php after approval
            window.location.href = 'StaffCitizenAccounts.php';
        });
    } else {
        console.error("Error response: ", xhr.responseText); // Log error response
        Swal.fire(
            'Error!',
            'There was an issue approving the citizen.',
            'error'
        );
    }
};

                xhr.send('citizenId=' + encodeURIComponent(citizenId));
            }
        });
    });
});


</script>

<!-- Bootstrap CSS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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

  </body>
</html>
