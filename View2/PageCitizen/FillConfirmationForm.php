<?php

require_once '../../Model/db_connection.php';
require_once '../../Controller/citizen_con.php';
$nme = $_SESSION['fullname'];
$regId = $_SESSION['citizend_id'];
require_once '../../Model/db_connection.php';

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
 //    sessionStorage.removeItem('selectedDate');
 //    sessionStorage.removeItem('selectedTime');
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
       
  <div class="container">
    <div class="page-inner">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">ConfirmationFill-up Form</div>
                    </div>
                    <div class="card-body">
                    <form method="post" action="../../Controller/citizen_con.php" onsubmit="return validateForm()">
    <input type="hidden" name="confirmation_id" name="form_type" value="confirmation">
    <div class="row">
        <div class="col-md-6 col-lg-4">
            <div class="form-group">
                <label for="date">Date</label>
                <input type="text" class="form-control" id="date" name="date" placeholder="" readonly />
                <span class="error" id="dateError"></span>
            </div>

            <div class="form-group">    
                <label for="firstname">Firstname of person to be baptized:</label>
                <input type="text" class="form-control" id="firstname" name="firstname" placeholder="Enter Firstname"
                <?php if (isset($userDetails)) echo 'value="' . htmlspecialchars($userDetails['firstname']) . '"'; ?> />
                <span class="error" id="firstnameError"></span>
            </div>

            <div class="form-group">
                <label for="lastname">Last Name of person to be baptized:</label>
                <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Enter Lastname"
                <?php if (isset($userDetails)) echo 'value="' . htmlspecialchars($userDetails['lastname']) . '"'; ?> />
                <span class="error" id="lastnameError"></span>
            </div>

            <div class="form-group">
                <label for="middlename">Middle Name of person to be baptized:</label>
                <input type="text" class="form-control" id="middlename" name="middlename" placeholder="Enter Middlename"
                <?php if (isset($userDetails)) echo 'value="' . htmlspecialchars($userDetails['middlename']) . '"'; ?> />
                <span class="error" id="middlenameError"></span>
            </div>

            <input type="hidden" id="fullname" name="fullname" />

            <div class="form-group">
                <label for="address">Address</label>
                <textarea class="form-control" id="address" name="c_address" placeholder="Enter Address"><?php if (isset($userDetails)) echo htmlspecialchars($userDetails['address']); ?></textarea>
                <span class="error" id="addressError"></span>
            </div>

            <div class="form-group">
                <label>Gender</label><br />
                <div class="d-flex">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="c_gender" id="flexRadioDefault1" value="Male"
                        <?php echo (isset($userDetails) && $userDetails['gender'] == 'Male') ? 'checked' : ''; ?> />
                        <label class="form-check-label" for="flexRadioDefault1">Male</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="c_gender" id="flexRadioDefault2" value="Female"
                        <?php echo (isset($userDetails) && $userDetails['gender'] == 'Female') ? 'checked' : ''; ?> />
                        <label class="form-check-label" for="flexRadioDefault2">Female</label>
                    </div>
                </div>
                <span class="error" id="genderError"></span>
            </div>

            <div class="form-group">
                <div class="birthday-input">
                    <label for="month">Date of Person Who Baptism</label>
                    <div class="birthday-selectors">
                        <select id="month" name="months">
                            <option value="">Month</option>
                            <option value="01">January</option>
                            <option value="02">February</option>
                            <option value="03">March</option>
                            <option value="04">April</option>
                            <option value="05">May</option>
                            <option value="06">June</option>
                            <option value="07">July</option>
                            <option value="08">August</option>
                            <option value="09">September</option>
                            <option value="10">October</option>
                            <option value="11">November</option>
                            <option value="12">December</option>
                        </select>
                        <select id="day" name="days">
                            <option value="">Day</option>
                            <?php for ($i = 1; $i <= 31; $i++): ?>
                                <option value="<?php echo sprintf('%02d', $i); ?>"><?php echo $i; ?></option>
                            <?php endfor; ?>
                        </select>
                        <select id="year" name="years">
                            <option value="">Year</option>
                            <?php for ($i = date('Y'); $i >= 1900; $i--): ?>
                                <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                            <?php endfor; ?>
                        </select>
                    </div>
                    <span class="error" id="dobError"></span>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-4">
            <div class="form-group">
                <label for="start_time">Start Time</label>
                <input type="text" class="form-control" id="start_time" name="start_time" placeholder="" readonly />
                <span class="error" id="startTimeError"></span>
            </div>
            <div class="form-group">
                <label for="pbirth">Name Of Church</label>
                <input type="text" class="form-control" id="pbirth" name="name_of_church" placeholder="Enter Name Of Church" />
                <span class="error" id="pbirthError"></span>
            </div>
            <div class="form-group">
                <div class="birthday-input">
                    <label for="month">Date of Birth</label>
                    <div class="birthday-selectors">
                        <select id="months" name="month">
                            <option value="">Month</option>
                            <option value="01">January</option>
                            <option value="02">February</option>
                            <option value="03">March</option>
                            <option value="04">April</option>
                            <option value="05">May</option>
                            <option value="06">June</option>
                            <option value="07">July</option>
                            <option value="08">August</option>
                            <option value="09">September</option>
                            <option value="10">October</option>
                            <option value="11">November</option>
                            <option value="12">December</option>
                        </select>
                        <select id="days" name="day">
                            <option value="">Day</option>
                            <?php for ($i = 1; $i <= 31; $i++): ?>
                                <option value="<?php echo sprintf('%02d', $i); ?>"><?php echo $i; ?></option>
                            <?php endfor; ?>
                        </select>
                        <select id="years" name="year">
                            <option value="">Year</option>
                            <?php for ($i = date('Y'); $i >= 1900; $i--): ?>
                                <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                            <?php endfor; ?>
                        </select>
                    </div>
                    <span class="error" id="dobErrors"></span>
                </div>
            </div>
            <div class="form-group">
                <label for="father_name">Father's Fullname</label>
                <input type="text" class="form-control" id="father_name" name="father_fullname" placeholder="Enter Father's Fullname" />
                <span class="error" id="fatherNameError"></span>
            </div>
            <div class="form-group">
                <label for="mother_name">Mother's Fullname</label>
                <input type="text" class="form-control" id="mother_name" name="mother_fullname" placeholder="Enter Mother's Fullname" />
                <span class="error" id="motherNameError"></span>
            </div>
        </div>

        <div class="col-md-6 col-lg-4">
            <div class="form-group">
                <label for="end_time">End Time</label>
                <input type="text" class="form-control" id="end_time" name="end_time" placeholder="" readonly />
                <span class="error" id="endTimeError"></span>
            </div>
            <div class="form-group">
                <label for="parents_residence">Permission to Confirm</label>
                <textarea class="form-control" id="parents_residence" name="permission_to_confirm" placeholder="Enter Permission to Confirm"></textarea>
                <span class="error" id="parentsResidenceError"></span>
            </div>
            <div class="form-group">
                <label for="godparents">Church Address</label>
                <textarea class="form-control" id="godparents" name="church_address" placeholder="Enter Church Address"></textarea>
                <span class="error" id="churchAddressError"></span>
            </div>
        </div>
    </div>
    <div class="card-action">
        <button type="submit" name="submit" class="btn btn-success">Submit</button>
        <a href="javascript:history.back()" class="btn btn-danger">Cancel</a>
        <button type="button" class="btn btn-info" onclick="clearForm()">Clear</button>
    </div>
</form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
function validateForm() {
    var isValid = true;

    // Clear previous errors
    document.querySelectorAll('.error').forEach(el => el.innerText = '');

    // Helper function to validate field
    function validateField(id, errorId, errorMessage) {
        var value = document.getElementById(id).value.trim();
        if (value === '') {
            document.getElementById(errorId).innerText = errorMessage;
            isValid = false;
        }
    }

    // Validating all fields
    validateField('date', 'dateError', 'Date is required.');
    validateField('firstname', 'firstnameError', 'Firstname is required.');
    validateField('lastname', 'lastnameError', 'Lastname is required.');
    validateField('address', 'addressError', 'Address is required.');

    if (!document.querySelector('input[name="c_gender"]:checked')) {
        document.getElementById('genderError').innerText = 'Gender is required.';
        isValid = false;
    }

    validateField('month', 'dobError', 'Complete Date of Birth is required.');
    validateField('day', 'dobError', 'Complete Date of Birth is required.');
    validateField('year', 'dobError', 'Complete Date of Birth is required.');
    validateField('months', 'dobErrors', 'Complete Date of Birth is required.');
    validateField('days', 'dobErrors', 'Complete Date of Birth is required.');
    validateField('years', 'dobErrors', 'Complete Date of Birth is required.');
    validateField('start_time', 'startTimeError', 'Start Time is required.');
    validateField('pbirth', 'pbirthError', 'Name of Church is required.');
    validateField('father_name', 'fatherNameError', 'Father\'s Fullname is required.');
    validateField('mother_name', 'motherNameError', 'Mother\'s Fullname is required.');
    validateField('end_time', 'endTimeError', 'End Time is required.');
    validateField('parents_residence', 'parentsResidenceError', 'Permission to Confirm is required.');
    validateField('godparents', 'churchAddressError', 'Church Address is required.');

    return isValid; // Prevent form submission if any validation fails
}

</script>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"
        integrity="sha384-KyZXEAg3QhqLMpG8r+8auK+4szKfEFbpLHsTf7iJgD/+ub2oU" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.js"></script>
    <!--   Core JS Files   -->
    <script src="../assets/js/core/jquery-3.7.1.min.js"></script>
    <script src="../assets/js/core/popper.min.js"></script>
    <script src="../assets/js/core/bootstrap.min.js"></script>

    <!-- jQuery Scrollbar -->
    <script src="../assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>

  
    <!-- Kaiadmin JS -->
    <script src="../assets/js/kaiadmin.min.js"></script>

  
    </script>
  </body>
</html>
