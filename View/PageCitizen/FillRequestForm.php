<?php
require_once '../../Model/db_connection.php';
require_once '../../Controller/citizen_con.php';

$nme = $_SESSION['fullname'];
$regId = $_SESSION['citizend_id'];
require_once '../../Model/db_connection.php';
require_once '../../Model/staff_mod.php';
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
      
      document.addEventListener('DOMContentLoaded', function() {
    const selectedDate = sessionStorage.getItem('selectedDate');
    const selectedTimeRange = sessionStorage.getItem('selectedTime');

    if (selectedDate) {
        document.getElementById('date').value = selectedDate;
    }

    if (selectedTimeRange) {
        const [startTime, endTime] = selectedTimeRange.split('-');
        document.getElementById('start_time').value = startTime;
        document.getElementById('end_time').value = endTime;
    }

    // Optionally, clear the session storage if you don't want to persist the data
  //   sessionStorage.removeItem('selectedDate');
   //  sessionStorage.removeItem('selectedTime');
});
document.addEventListener('DOMContentLoaded', function() {
    document.querySelector('.btn-info').addEventListener('click', function() {
        // Select all input and textarea fields within the form
        document.querySelectorAll('.form-control').forEach(function(element) {
            console.log('Clearing element:', element.id, element.type, element.value); // Debug info
            // Clear text inputs, textareas, and date inputs
            if (element.type === 'text' || element.tagName === 'TEXTAREA' || element.type === 'date') {
                if (element.id !== 'date' && element.id !== 'start_time' && element.id !== 'end_time') {
                    element.value = ''; // Clear the value
                }
            } else if (element.type === 'radio' || element.type === 'checkbox') {
                element.checked = false; // Uncheck radio and checkbox inputs
            }
        });
    });
});

document.getElementById('baptismForm').addEventListener('submit', function(event) {
    // Get the values of the first name, last name, and middle name
    var firstname = document.getElementById('firstname').value.trim();
    var lastname = document.getElementById('lastname').value.trim();
    var middlename = document.getElementById('middlename').value.trim();

    // Concatenate them into a full name
    var fullname = firstname + ' ' + middlename + ' ' + lastname;

    // Set the concatenated full name into the hidden fullname input
    document.getElementById('fullname').value = fullname;
});
function toggleChapelInput() {
    const select = document.getElementById('exampleFormControlSelect1');
    const chapelInputGroup = document.getElementById('chapelInputGroup');
    
    if (select.value === 'Fiesta Mass') {
      chapelInputGroup.style.display = 'block';
    } else {
      chapelInputGroup.style.display = 'none';
    }
  }

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
  <body style="background: #eee; ">
  
     
  <?php require_once 'header.php'?>
          <!-- End Navbar -->
        </div>
        <div class="container">
            <div class="page-inner">
           
              <div class="row">
                <div class="col-md-12">
                  <div class="card">
                    <div class="card-header">
                      <div class="card-title">REQUEST FORM</div>
                    </div>
                    <div class="card-body">
                    <form method="post" action="../../Controller/citizen_con.php" onsubmit="return validateForm()">
                    <input type="hidden" name="form_type" value="requestform">
    
                    <div class="row">
                        <div class="col-md-6 col-lg-4">
                        <div class="form-group">
  <label for="exampleFormControlSelect1">Select Type of Request Form</label>
  <select class="form-select" id="exampleFormControlSelect1" onchange="toggleChapelInput()">
  <option>Select</option>
    <option>Fiesta Mass</option>
    <option>Novena Mass</option>
    <option>Wake Mass</option>
    <option>Monthly Mass</option>
    <option>1st Friday Mass</option>
    <option>Cemetery Chapel Mass</option>
    <option>Baccalaureate Mass</option>
    <option>Anointing of the Sick</option>
    <option>Blessing</option>
    <option>Special Mass</option>
  </select>
</div>

<div class="form-group" id="chapelInputGroup" style="display: none;">
  <label for="chapel">Chapel</label>
  <input
    type="text"
    class="form-control"
    id="chapel"
    placeholder="Enter Chapel Name"
  />
</div>
                       <div class="form-group">
                <label for="firstname">Firstname of Person Requesting</label>
                <input type="text" class="form-control" id="firstname" name="firstname" placeholder="Enter Firstname"
                    value="<?php echo isset($userDetails) ? htmlspecialchars($userDetails['firstname']) : ''; ?>" />
                <div id="firstnameError" class="error text-danger"></div>
            </div>

            <!-- Groom Lastname -->
            <div class="form-group">
                <label for="lastname">Last Name of Person Requesting</label>
                <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Enter Lastname"
                    value="<?php echo isset($userDetails) ? htmlspecialchars($userDetails['lastname']) : ''; ?>" />
                <div id="lastnameError" class="error text-danger"></div>
            </div>

            <!-- Groom Middlename -->
            <div class="form-group">
                <label for="middlename">Middle Name of Person Requesting</label>
                <input type="text" class="form-control" id="middlename" name="middlename" placeholder="Enter Middlename"
                    value="<?php echo isset($userDetails) ? htmlspecialchars($userDetails['middlename']) : ''; ?>" />
                <div id="middlenameError" class="error text-danger"></div>
            </div>
                        <BR><br></BR>
                       
                        </div>

                        <div class="col-md-6 col-lg-4">
                        <div class="form-group">
                <label for="date">Date</label>
                <input type="text" class="form-control" id="date" name="date" placeholder="" readonly />
                <span class="error" id="dateError"></span>
            </div>
                             
                          
                            <div class="form-group">
                                <label for="password">Address</label>
                                <input type="text" class="form-control" id="password" placeholder="Enter  Address"  value="<?php echo isset($userDetails) ? htmlspecialchars($userDetails['address']) : ''; ?>"/>
                              </div>
                              
                              <div class="form-group">
                                <label for="password">Date of Follow-up</label>
                                <input
                                  type="password"
                                  class="form-control"
                                  id="password"
                                  placeholder="Enter Contact Number"
                                />
                              </div>
                              <BR><br></BR>
                             
                             
                            
                            </div>
                            <div class="col-md-6 col-lg-4">
                            <div class="form-group">
                <label for="start_time">Start Time</label>
                <input type="text" class="form-control" id="start_time" name="start_time" placeholder="" readonly />
              <span class="error" id="startTimeError"></span>
            </div>
                                  <div class="form-group">
                                    <label for="password">Contact Number</label>
                                    <input type="text"class="form-control" id="cpnumber"placeholder="Enter Contact Number"  value="<?php echo isset($userDetails) ? htmlspecialchars($userDetails['phone']) : ''; ?>"/>
                                  </div>
                                 
                                
                                </div>
                          </div>    
                     
                    <div class="card-action">
                      <button class="btn btn-success">Submit</button>
                      <button type="button" class="btn btn-info" onclick="clearForm()">Clear</button>
                      <button class="btn btn-danger">Cancel</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
  
            
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"
        integrity="sha384-KyZXEAg3QhqLMpG8r+8auK+4szKfEFbpLHsTf7iJgD/+ub2oU" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.js"></script>
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

   



    <!-- Sweet Alert -->
    <script src="../assets/js/plugin/sweetalert/sweetalert.min.js"></script>

    <!-- Kaiadmin JS -->
    <script src="../assets/js/kaiadmin.min.js"></script>

  </body>
</html>
