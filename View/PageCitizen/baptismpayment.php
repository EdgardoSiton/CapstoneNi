<?php
require_once '../../Model/staff_mod.php';
require_once '../../Model/db_connection.php';
require_once '../../Controller/profilefetchpending_con.php';
require_once '../../Model/citizen_mod.php';

// Initialize the Staff class
$staff = new Staff($conn);

$citizen = new Citizen($conn);
$citizenData = $citizen->getPendingCitizens(null, $regId);
$baptismfill_id = isset($_GET['id']) ? intval($_GET['id']) : null;
$step = isset($_GET['step']) ? (int)$_GET['step'] : 2;

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
    <style>
        /* Container for the stepper */
.stepper-wrapper {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

/* Individual step */
.step {
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
}

/* Step circle (icon) */
.step-icon {
    width: 40px;
    height: 40px;
    background-color: #e0e0e0;
    border-radius: 50%;
    display: flex;
    justify-content: center;
    align-items: center;
    font-size: 18px;
    color: white;
}

/* Label below step */
.step-label p {
    margin: 5px 0;
    font-size: 14px;
    color: #333;
}

.step-label small {
    color: #999;
}

/* Line between steps */
.step-line {
    flex-grow: 1;
    height: 2px;
    background-color: #e0e0e0;
    margin: 0 10px;
}

/* Completed step styles */
.completed .step-icon {
    background-color: #28a745; /* Green for completed */
}

.completed .step-label small {
    color: #28a745; /* Green label for completed */
}

/* In-progress step styles */
.in-progress .step-icon {
    background-color: #007bff; /* Blue for in-progress */
}

.in-progress .step-label small {
    color: #007bff; /* Blue label for in-progress */
}

/* Pending step styles */
.pending .step-icon {
    background-color: #e0e0e0; /* Gray for pending */
    color: #007bff; /* Border or icon color for pending */
}

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
    .stepper .step {
        padding: 10px;
        border-radius: 5px;
        margin-right: 10px;
        font-weight: bold;
    }
    .stepper .active {
        background-color: #28a745; /* Green background for active step */
        color: white;
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

  <div class="container">

    <div class="page-inner">
        <div class="row">
            <div class="col-md-12">
            <div class="card">
    <div class="card-header">
        <div class="card-title">Payment</div>
        <div class="container mt-5">
        <div class="stepper-wrapper">
            <!-- Step 1 -->
            <div class="step completed">
                <div class="step-icon">
                    <i class="fa fa-check"></i>
                </div>
                <div class="step-label">
                    <p>Step 1</p>
                    <p>Check Details Information</p>
             
                </div>
            </div>

            <div class="step-line"></div>

            <!-- Step 2 -->
            <div class="step completed">
                <div class="step-icon">
                    <i class="fa fa-check"></i>
                </div>
                <div class="step-label">
                    <p>Step 2</p>
                    <p>Check Payment</p>
            
                </div>
            </div>
            <div class="step-line"></div>
            <div class="step pending">
    <div class="step-icon">
        <i class="fa fa-circle-o"></i>
    </div>
    <div class="step-label">
        <p>Step 3</p>
        <p>Payment Method</p>
    
    </div>
</div>
        </div>
        
    </div>

    </div>
    <div class="card-body">
        <div class="row">
            <!-- First Column -->
            <div class="col-md-6 col-lg-4">
                
          
                <div class="form-group">
                            <label>Please choose a Payment Method</label><br>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="payment_method" id="over_the_counter" value="over_the_counter">
                                <label class="form-check-label" for="over_the_counter">
                                    Over the counter
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="payment_method" id="credit_card" value="credit_card" checked>
                                <label class="form-check-label" for="credit_card">
                                   Online /Payment
                                </label>
                            </div>
                        </div>

                        <div class="form-group">
                            <input type="checkbox" id="terms_conditions" name="terms_conditions">
                            <label for="terms_conditions">
                                By checking this box, you agree to the <strong>terms and conditions</strong> for this service.
                            </label>
                        </div>

                        <!-- Summary Table -->
                        <?php if (!empty($citizenData)) : ?>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Particulars</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($citizenData as $event) : ?>
                    <tr>
                        <td><?php echo $event['event_name']; ?></td>
                        <td><?php echo 'PHP ' . number_format($event['pay_amount'], 2); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <th>Total Amount</th>
                    <th>
                        <?php 
                            // Sum all the payment amounts from the array
                            $totalAmount = array_sum(array_column($citizenData, 'pay_amount'));
                            // Add a service fee of PHP 20
                            echo 'PHP ' . number_format($totalAmount + 20, 2); 
                        ?>
                    </th>
                </tr>
            </tfoot>
        </table>
    </div>
<?php else : ?>
    <p>No records found for <?php echo $eventType; ?>.</p>
<?php endif; ?>

<!-- Additional Information -->
<p class="text-muted">
    Note: *If you are using online payment, a service charge will be applied.
</p>

<div class="form-group">
    <div class="d-flex">
        <!-- You can add form inputs or buttons here -->
    </div>
</div>

            
            <!-- Second Column -->
            <div class="col-md-6 col-lg-4">
        


          
            </div>
            
            <!-- Third Column -->
            <div class="col-md-6 col-lg-4">
               
            </div>
        </div>
        <div class="card-action">
        <button type="button" class="btn btn-success" onclick="window.history.back();">Back</button>
    <button type="submit" class="btn btn-success">Pay</button>
      
          
        </div>
    </div>
</div>

    </div>
</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

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
