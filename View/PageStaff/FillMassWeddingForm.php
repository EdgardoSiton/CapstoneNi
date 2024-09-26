<?php


require_once '../../Model/staff_mod.php';
require_once '../../Model/db_connection.php';
require_once '../../Controller/Massfetchpending_con.php';
require_once '../../Model/citizen_mod.php';

// Initialize the Staff class
$staff = new Staff($conn);
$massweddingffill_id = isset($_GET['id']) ? intval($_GET['id']) : null;

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
    <script src="assets/js/plugin/webfont/webfont.min.js"></script>
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
     <style>
        .birthday-input {
    font-family: Arial, sans-serif;
    margin-bottom: 10px;
}

.birthday-input label {
    display: block;
    font-weight: bold;
    margin-bottom: 5px;
}

.birthday-selectors {
    display: flex;
    gap: 5px;
}


.birthday-selectors select {
    padding: 5px;
    border: 1px solid #0a58ca;
    border-radius: 5px;
    width: 100px;
    font-size: 14px;
    color: #555;
}

.birthday-selectors select:focus {
    outline: none;
    border-color: #0a58ca;
}


small {
    display: block;
    color: #555;
    margin-top: 5px;
}
.error {
        color: red;
        font-size: 0.875em;
        margin-top: 0.25em;
    }
    .form-control.error {
        border: 1px solid red;
    }

    </style>
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
  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Approval for Schedule Baptism</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="modalForm" method="POST" action="../../Controller/addwedding_con.php">
                <div class="modal-body">
            <input type="hidden" name="massmarriage_id" value="<?php echo htmlspecialchars($massweddingffill_id); ?>" />
    
                 
                    <div class="form-group">
                        <label for="eventTitle">Payable Amount</label>
                        <input type="number" class="form-control" id="eventTitle" name="eventTitle" placeholder="Enter Amount">
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

    <div class="page-inner">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
    <div class="card-header">
        <div class="card-title">MassWedding View Information Form</div>
    </div>
    <div class="card-body">
       
            <div class="row">
                <!-- Display fields only if they exist and are relevant -->
                <div class="col-md-6 col-lg-4">
                    <!-- Date -->
                    <div class="form-group">
                        <label for="date">Date</label>
                        <input type="text" class="form-control" id="date" name="date" value="<?php echo htmlspecialchars($pendingItem['schedule_date'] ?? ''); ?>" readonly />
                    </div>

                    <!-- Groom Firstname -->
                    <div class="form-group">
                        <label for="firstname">Firstname of Groom</label>
                        <input type="text" class="form-control" id="firstname" name="firstname" placeholder="Enter Firstname"
                        value="<?php echo htmlspecialchars($firstname); ?>" />
                    </div>

                    <!-- Groom Lastname -->
                    <div class="form-group">
                        <label for="lastname">Last Name of Groom</label>
                        <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Enter Lastname"
                        value="<?php echo htmlspecialchars($lastname); ?>" />
                    </div>

                    <!-- Groom Middlename -->
                    <div class="form-group">
                        <label for="middlename">Middle Name of Groom</label>
                        <input type="text" class="form-control" id="middlename" name="middlename" placeholder="Enter Middlename"
                        value="<?php echo htmlspecialchars($middlename); ?>" />
                    </div>

                    <!-- Groom Date of Birth -->
                    <div class="form-group">
                        <label for="groom_dob">Groom Date of Birth</label>
                        <div class="birthday-selectors">
            <select id="months" name="month">
                <option value="">Month</option>
                <option value="01"<?php echo ($month == '01') ? 'selected' : ''; ?>>January</option>
                <option value="02"<?php echo ($month == '02') ? 'selected' : ''; ?>>February</option>
                <option value="03"<?php echo ($month == '03') ? 'selected' : ''; ?>>March</option>
                <option value="04"<?php echo ($month == '04') ? 'selected' : ''; ?>>April</option>
                <option value="05"<?php echo ($month == '05') ? 'selected' : ''; ?>>May</option>
                <option value="06"<?php echo ($month == '06') ? 'selected' : ''; ?>>June</option>
                <option value="07"<?php echo ($month == '07') ? 'selected' : ''; ?>>July</option>
                <option value="08"<?php echo ($month == '08') ? 'selected' : ''; ?>>August</option>
                <option value="09"<?php echo ($month == '09') ? 'selected' : ''; ?>>September</option>
                <option value="10"<?php echo ($month == '10') ? 'selected' : ''; ?>>October</option>
                <option value="11"<?php echo ($month == '11') ? 'selected' : ''; ?>>November</option>
                <option value="12"<?php echo ($month == '12') ? 'selected' : ''; ?>>December</option>
            </select>

            <select id="days" name="day">
    <option value="">Day</option>
    <?php for ($i = 1; $i <= 31; $i++): ?>
        <option value="<?php echo sprintf('%02d', $i); ?>" <?php echo ($day == sprintf('%02d', $i)) ? 'selected' : ''; ?>>
            <?php echo $i; ?>
        </option>
    <?php endfor; ?>
</select>
<select id="years" name="year">
    <option value="">Year</option>
    <?php for ($i = date('Y'); $i >= 1900; $i--): ?>
        <option value="<?php echo $i; ?>" <?php echo ($year == $i) ? 'selected' : ''; ?>>
            <?php echo $i; ?>
        </option>
    <?php endfor; ?>
</select>
                        </div>
                    </div>

                    <!-- Groom Place of Birth -->
                    <div class="form-group">
                        <label for="address">Groom Place of Birth</label>
                        <textarea class="form-control" id="address" name="groom_place_of_birth" placeholder="Enter Address"><?php echo htmlspecialchars($pendingItem['groom_place_of_birth'] ?? ''); ?></textarea>
                    </div>

                    <!-- Groom Citizenship -->
                    <div class="form-group">
                        <label for="groom_citizenship">Groom Citizenship</label>
                        <input type="text" class="form-control" id="groom_citizenship" name="groom_citizenship" placeholder="Enter Groom Citizenship" value="<?php echo htmlspecialchars($pendingItem['groom_citizenship'] ?? ''); ?>" />
                    </div>

                    <!-- Groom Address -->
                    <div class="form-group">
                        <label for="parents_residence">Groom Address</label>
                        <textarea class="form-control" id="parents_residence" name="groom_address" placeholder="Enter Address"><?php echo htmlspecialchars($pendingItem['groom_address'] ?? ''); ?></textarea>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4">
                    <!-- Start Time -->
                    <div class="form-group">
                        <label for="start_time">Start Time</label>
                        <input type="text" class="form-control" id="start_time" name="start_time" value="<?php echo htmlspecialchars($startTime); ?>" readonly />
                    </div>

                    <!-- Groom Religion -->
                    <div class="form-group">
                        <label for="groom_religion">Groom Religion</label>
                        <input type="text" class="form-control" id="groom_religion" name="groom_religion" placeholder="Enter Groom Religion" value="<?php echo htmlspecialchars($pendingItem['groom_religion'] ?? ''); ?>" />
                    </div>

                    <!-- Groom Previously Married -->
                    <div class="form-group">
                        <label for="groom_previously_married">Groom Previously Married</label>
                        <input type="text" class="form-control" id="groom_previously_married" name="groom_previously_married" placeholder="Enter Groom Previously Married" value="<?php echo htmlspecialchars($pendingItem['groom_previously_married'] ?? ''); ?>" />
                    </div>

                    <!-- Bride Firstname -->
                    <div class="form-group">
                        <label for="firstnames">Firstname of Bride</label>
                        <input type="text" class="form-control" id="firstnames" name="firstnames" placeholder="Enter Firstname" value="<?php echo htmlspecialchars($firstnames); ?>" />
                    </div>

                    <!-- Bride Lastname -->
                    <div class="form-group">
                        <label for="lastnames">Last Name of Bride</label>
                        <input type="text" class="form-control" id="lastnames" name="lastnames" placeholder="Enter Lastname" value="<?php echo htmlspecialchars($lastnames); ?>" />
                    </div>

                    <!-- Bride Middlename -->
                    <div class="form-group">
                        <label for="middlenames">Middle Name of Bride</label>
                        <input type="text" class="form-control" id="middlenames" name="middlenames" placeholder="Enter Middlename" value="<?php echo htmlspecialchars($middlenames); ?>" />
                    </div>

                    <!-- Bride Date of Birth -->
                    <div class="form-group">
                        <label for="bride_dob">Bride Date of Birth</label>
                        <div class="birthday-selectors">
            <select id="months" name="month">
                <option value="">Month</option>
                <option value="01"<?php echo ($months == '01') ? 'selected' : ''; ?>>January</option>
                <option value="02"<?php echo ($months == '02') ? 'selected' : ''; ?>>February</option>
                <option value="03"<?php echo ($months == '03') ? 'selected' : ''; ?>>March</option>
                <option value="04"<?php echo ($months == '04') ? 'selected' : ''; ?>>April</option>
                <option value="05"<?php echo ($months == '05') ? 'selected' : ''; ?>>May</option>
                <option value="06"<?php echo ($months == '06') ? 'selected' : ''; ?>>June</option>
                <option value="07"<?php echo ($months == '07') ? 'selected' : ''; ?>>July</option>
                <option value="08"<?php echo ($months == '08') ? 'selected' : ''; ?>>August</option>
                <option value="09"<?php echo ($months == '09') ? 'selected' : ''; ?>>September</option>
                <option value="10"<?php echo ($months == '10') ? 'selected' : ''; ?>>October</option>
                <option value="11"<?php echo ($months == '11') ? 'selected' : ''; ?>>November</option>
                <option value="12"<?php echo ($months == '12') ? 'selected' : ''; ?>>December</option>
            </select>

            <select id="days" name="day">
    <option value="">Day</option>
    <?php for ($i = 1; $i <= 31; $i++): ?>
        <option value="<?php echo sprintf('%02d', $i); ?>" <?php echo ($days == sprintf('%02d', $i)) ? 'selected' : ''; ?>>
            <?php echo $i; ?>
        </option>
    <?php endfor; ?>
</select>

<select id="years" name="year">
    <option value="">Year</option>
    <?php for ($i = date('Y'); $i >= 1900; $i--): ?>
        <option value="<?php echo $i; ?>" <?php echo ($years == $i) ? 'selected' : ''; ?>>
            <?php echo $i; ?>
        </option>
    <?php endfor; ?>
</select>
                        </div>
                    </div>

                    <!-- Bride Place of Birth -->
                    <div class="form-group">
                        <label for="bride_place_of_birth">Bride Place of Birth</label>
                        <textarea class="form-control" id="bride_place_of_birth" name="bride_place_of_birth" placeholder="Enter Address"><?php echo htmlspecialchars($pendingItem['bride_place_of_birth'] ?? ''); ?></textarea>
                    </div>

                    <!-- Bride Citizenship -->
                    <div class="form-group">
                        <label for="bride_citizenship">Bride Citizenship</label>
                        <input type="text" class="form-control" id="bride_citizenship" name="bride_citizenship" placeholder="Enter Bride Citizenship" value="<?php echo htmlspecialchars($pendingItem['bride_citizenship'] ?? ''); ?>" />
                    </div>
                </div>

                <div class="col-md-6 col-lg-4">
                    <!-- End Time -->
                    <div class="form-group">
                        <label for="end_time">End Time</label>
                        <input type="text" class="form-control" id="end_time" name="end_time" value="<?php echo htmlspecialchars($endTime); ?>" readonly />
                    </div>

                    <!-- Bride Religion -->
                    <div class="form-group">
                        <label for="bride_religion">Bride Religion</label>
                        <input type="text" class="form-control" id="bride_religion" name="bride_religion" placeholder="Enter Bride Religion" value="<?php echo htmlspecialchars($pendingItem['bride_religion'] ?? ''); ?>" />
                    </div>

                    <!-- Bride Previously Married -->
                    <div class="form-group">
                        <label for="bride_previously_married">Bride Previously Married</label>
                        <input type="text" class="form-control" id="bride_previously_married" name="bride_previously_married" placeholder="Enter Bride Previously Married" value="<?php echo htmlspecialchars($pendingItem['bride_previously_married'] ?? ''); ?>" />
                    </div>
        </div>
                                
                            </div>
                            <div class="card-action">
                            <button type="submit" data-toggle="modal" data-target="#myModal" class="btn btn-success">Approve</button>
                            <button class="btn btn-primary ">Decline</button>
           
              <button type="button" class="btn btn-danger" onclick="window.location.href='StaffSoloSched.php'">Cancel</button>
                    
                            </div>
                   
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

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
