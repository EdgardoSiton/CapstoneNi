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
  
 <!-- Navbar & Hero Start -->
 <div class="container-fluid nav-bar px-0 px-lg-4 py-lg-0">
      <div class="container">
       
      <?php require_once 'header.php'?>

      </div>
    </div>
    <!-- Navbar & Hero End -->

       
  <div class="container">
    <div class="page-inner">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">WeddingFill-up Form</div>
                    </div>
                    <div class="card-body">
                    <form method="post" action="../../Controller/citizen_con.php" onsubmit="return validateForm()">
    <div class="row">
    <input type="hidden" name="wedding_id" name="form_type" value="Wedding">
        <div class="col-md-6 col-lg-4">
            <!-- Date -->
  
            <div class="form-group">
                <label for="date">Date</label>
                <input type="text" class="form-control" id="date" name="date" placeholder="" readonly />
                <div id="dateError" class="error text-danger"></div>
            </div>
            <div class="card-title" ><label style="font-size:15px!important;font-weight:700; margin-left:10px;  border-bottom: 1px solid black;
">Fillup Groom Details</label></div>

            <!-- Groom Firstname -->
            <div class="form-group">
                <label for="firstname">Firstname of Groom</label>
                <input type="text" class="form-control" id="firstname" name="firstname" placeholder="Enter Firstname"
                    value="<?php echo isset($userDetails) ? htmlspecialchars($userDetails['firstname']) : ''; ?>" />
                <div id="firstnameError" class="error text-danger"></div>
            </div>

            <!-- Groom Lastname -->
            <div class="form-group">
                <label for="lastname">Last Name of Groom</label>
                <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Enter Lastname"
                    value="<?php echo isset($userDetails) ? htmlspecialchars($userDetails['lastname']) : ''; ?>" />
                <div id="lastnameError" class="error text-danger"></div>
            </div>

            <!-- Groom Middlename -->
            <div class="form-group">
                <label for="middlename">Middle Name of Groom</label>
                <input type="text" class="form-control" id="middlename" name="middlename" placeholder="Enter Middlename"
                    value="<?php echo isset($userDetails) ? htmlspecialchars($userDetails['middlename']) : ''; ?>" />
                <div id="middlenameError" class="error text-danger"></div>
            </div>

            <!-- Groom Date of Birth -->
            <div class="form-group">
                <label for="month">Groom Date of Birth</label>
                <div class="birthday-selectors">
                    <select id="month" name="month">
                        <option value="">Month</option>
                        <!-- Month options -->
                        <?php for ($i = 1; $i <= 12; $i++): ?>
                            <option value="<?php echo sprintf('%02d', $i); ?>"><?php echo date('F', mktime(0, 0, 0, $i, 10)); ?></option>
                        <?php endfor; ?>
                    </select>

                    <select id="day" name="day">
                        <option value="">Day</option>
                        <!-- Day options -->
                        <?php for ($i = 1; $i <= 31; $i++): ?>
                            <option value="<?php echo sprintf('%02d', $i); ?>"><?php echo $i; ?></option>
                        <?php endfor; ?>
                    </select>

                    <select id="year" name="year">
                        <option value="">Year</option>
                        <!-- Year options -->
                        <?php for ($i = date('Y'); $i >= 1900; $i--): ?>
                            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                        <?php endfor; ?>
                    </select>
                </div>
                <div id="dobError" class="error text-danger"></div>
            </div>

            <!-- Groom Place of Birth -->
            <div class="form-group">
                <label for="address">Groom Place of Birth</label>
                <textarea class="form-control" id="address" name="groom_place_of_birth" placeholder="Enter Address"><?php
                    echo isset($userDetails) ? htmlspecialchars($userDetails['address']) : '';
                ?></textarea>
                <div id="addressError" class="error text-danger"></div>
            </div>

            <!-- Groom Citizenship -->
            <div class="form-group">
                <label for="groom_citizenship">Groom Citizenship</label>
                <input type="text" class="form-control" id="groom_citizenship" name="groom_citizenship" placeholder="Enter Groom Citizenship" />
                <div id="groomCitizenshipError" class="error text-danger"></div>
            </div>

            <!-- Groom Address -->
            <div class="form-group">
                <label for="parents_residence">Groom Address</label>
                <textarea class="form-control" id="parents_residence" name="groom_address" placeholder="Enter Address"></textarea>
                <div id="groomAddressError" class="error text-danger"></div>
            </div>
             <!-- Groom Religion -->
             <div class="form-group">
                <label for="groom_religion">Groom Religion</label>
                <input type="text" class="form-control" id="groom_religion" name="groom_religion" placeholder="Enter Groom Religion" />
                <div id="groomReligionError" class="error text-danger"></div>
            </div>

            <!-- Groom Previously Married -->
            <div class="form-group">
                <label for="groom_previously_married">Groom Previously Married</label>
                <select class="form-control" id="groom_previously_married" name="groom_previously_married">
                    <option value="">-- Select --</option>
                    <option value="Yes">Yes</option>
                    <option value="No">No</option>
                </select>
                <div id="groomPreviouslyMarriedError" class="error text-danger"></div>
            </div>
        </div>

        <div class="col-md-6 col-lg-4">
            <!-- Start Time -->
            <div class="form-group">
                <label for="start_time">Start Time</label>
                <input type="text" class="form-control" id="start_time" name="start_time" placeholder="" readonly />
            </div>

           

        
        </div>

        <div class="col-md-6 col-lg-4">
            <!-- End Time -->
            <div class="form-group">
                <label for="end_time">End Time</label>
                <input type="text" class="form-control" id="end_time" name="end_time" placeholder="" readonly />
            </div>
            <div class="card-title" ><label style="font-size:15px!important;font-weight:700; margin-left:10px;  border-bottom: 1px solid black;
">Fillup Bride Details</label></div>
    <!-- Bride Firstname -->
    <div class="form-group">
                <label for="firstnames">Firstname of Bride</label>
                <input type="text" class="form-control" id="firstnames" name="firstnames" placeholder="Enter Firstname"
                    value="<?php echo isset($userDetails) ? htmlspecialchars($userDetails['firstname']) : ''; ?>" />
                <div id="brideFirstnameError" class="error text-danger"></div>
            </div>

            <!-- Bride Lastname -->
            <div class="form-group">
                <label for="lastnames">Last Name of Bride</label>
                <input type="text" class="form-control" id="lastnames" name="lastnames" placeholder="Enter Lastname"
                    value="<?php echo isset($userDetails) ? htmlspecialchars($userDetails['lastname']) : ''; ?>" />
                <div id="brideLastnameError" class="error text-danger"></div>
            </div>

            <!-- Bride Middlename -->
            <div class="form-group">
                <label for="middlenames">Middle Name of Bride</label>
                <input type="text" class="form-control" id="middlenames" name="middlenames" placeholder="Enter Middlename"
                    value="<?php echo isset($userDetails) ? htmlspecialchars($userDetails['middlename']) : ''; ?>" />
                <div id="brideMiddlenameError" class="error text-danger"></div>
            </div>

            <!-- Bride Date of Birth -->
            <div class="form-group">
                <label for="months">Bride Date of Birth</label>
                <div class="birthday-selectors">
                    <select id="months" name="months">
                        <option value="">Month</option>
                        <!-- Month options -->
                        <?php for ($i = 1; $i <= 12; $i++): ?>
                            <option value="<?php echo sprintf('%02d', $i); ?>"><?php echo date('F', mktime(0, 0, 0, $i, 10)); ?></option>
                        <?php endfor; ?>
                    </select>

                    <select id="days" name="days">
                        <option value="">Day</option>
                        <!-- Day options -->
                        <?php for ($i = 1; $i <= 31; $i++): ?>
                            <option value="<?php echo sprintf('%02d', $i); ?>"><?php echo $i; ?></option>
                        <?php endfor; ?>
                    </select>

                    <select id="years" name="years">
                        <option value="">Year</option>
                        <!-- Year options -->
                        <?php for ($i = date('Y'); $i >= 1900; $i--): ?>
                            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                        <?php endfor; ?>
                    </select>
                </div>
                <div id="dobErrors" class="error text-danger"></div>
            </div>

            <!-- Bride Place of Birth -->
            <div class="form-group">
                <label for="bride_place_of_birth">Bride Place of Birth</label>
                <textarea class="form-control" id="bride_place_of_birth" name="bride_place_of_birth" placeholder="Enter Address"><?php
                    echo isset($userDetails) ? htmlspecialchars($userDetails['address']) : '';
                ?></textarea>
                <div id="bridePlaceOfBirthError" class="error text-danger"></div>
            </div>

            <!-- Bride Citizenship -->
            <div class="form-group">
                <label for="bride_citizenship">Bride Citizenship</label>
                <input type="text" class="form-control" id="bride_citizenship" name="bride_citizenship" placeholder="Enter Bride Citizenship" />
                <div id="brideCitizenshipError" class="error text-danger"></div>
            </div>
            <!-- Bride Address -->
            <div class="form-group">
                <label for="bride_address">Bride Address</label>
                <textarea class="form-control" id="bride_address" name="bride_address" placeholder="Enter Address"></textarea>
                <div id="brideAddressError" class="error text-danger"></div>
            </div>

            <!-- Bride Religion -->
            <div class="form-group">
                <label for="bride_religion">Bride Religion</label>
                <input type="text" class="form-control" id="bride_religion" name="bride_religion" placeholder="Enter Bride Religion" />
                <div id="brideReligionError" class="error text-danger"></div>
            </div>

            <!-- Bride Previously Married -->
            <div class="form-group">
                <label for="bride_previously_married">Bride Previously Married</label>
                <select class="form-control" id="bride_previously_married" name="bride_previously_married">
                    <option value="">-- Select --</option>
                    <option value="Yes">Yes</option>
                    <option value="No">No</option>
                </select>
                <div id="bridePreviouslyMarriedError" class="error text-danger"></div>
            </div>
        </div>
                                
                            </div>
                            <div class="card-action">
                                <button type="submit" class="btn btn-success">Submit</button>
                                <button type="button" class="btn btn-danger" onclick="window.location.href='your_cancel_url.php'">Cancel</button>
                                <button type="button" class="btn btn-info" onclick="clearForm()">Clear</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require_once 'footer.php'?>
<script>
    function validateForm() {
    var isValid = true;
    document.querySelectorAll('.error').forEach(function (el) {
        el.innerText = '';
    });

    function isEmptyOrWhitespace(value) {
        return value.trim() === '';
    }
    var fields = [
        { id: 'date', errorId: 'dateError', name: 'Date' },
        { id: 'firstname', errorId: 'firstnameError', name: 'Firstname of Groom' },
        { id: 'lastname', errorId: 'lastnameError', name: 'Lastname of Groom' },
        { id: 'address', errorId: 'addressError', name: 'Groom Place of Birth' },
        { id: 'groom_citizenship', errorId: 'groomCitizenshipError', name: 'Groom Citizenship' },
        { id: 'parents_residence', errorId: 'groomAddressError', name: 'Groom Address' },
        { id: 'groom_religion', errorId: 'groomReligionError', name: 'Groom Religion' },
        { id: 'groom_previously_married', errorId: 'groomPreviouslyMarriedError', name: 'Groom Previously Married' },
        { id: 'firstnames', errorId: 'brideFirstnameError', name: 'Firstname of Bride' },
        { id: 'lastnames', errorId: 'brideLastnameError', name: 'Lastname of Bride' },
       
        { id: 'bride_citizenship', errorId: 'brideCitizenshipError', name: 'Bride Citizenship' },
        { id: 'bride_religion', errorId: 'brideReligionError', name: 'Bride Religion' },
        { id: 'bride_previously_married', errorId: 'bridePreviouslyMarriedError', name: 'Bride Previously Married' },
        { id: 'bride_address', errorId: 'brideAddressError', name: 'Bride Address' },
        { id: 'bride_place_of_birth', errorId: 'bridePlaceOfBirthError', name: 'Bride Place of Birth' }
    ];

    fields.forEach(function(field) {
        var value = document.getElementById(field.id).value;
        if (isEmptyOrWhitespace(value)) {
            document.getElementById(field.errorId).innerText = field.name + ' is required and cannot be just spaces.';
            isValid = false;
        }
    });
    var groomDob = {
        month: document.getElementById('month').value,
        day: document.getElementById('day').value,
        year: document.getElementById('year').value,
        errorId: 'dobError'
    };
    if (isEmptyOrWhitespace(groomDob.month) || isEmptyOrWhitespace(groomDob.day) || isEmptyOrWhitespace(groomDob.year)) {
        document.getElementById(groomDob.errorId).innerText = 'Complete Groom Date of Birth is required.';
        isValid = false;
    }

    var brideDob = {
        month: document.getElementById('months').value,
        day: document.getElementById('days').value,
        year: document.getElementById('years').value,
        errorId: 'dobErrors'
    };
    if (isEmptyOrWhitespace(brideDob.month) || isEmptyOrWhitespace(brideDob.day) || isEmptyOrWhitespace(brideDob.year)) {
        document.getElementById(brideDob.errorId).innerText = 'Complete Bride Date of Birth is required.';
        isValid = false;
    }

    return isValid; 
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
