<?php
require_once '../../Model/db_connection.php';
require_once '../../Controller/citizen_con.php';
require_once '../../Model/citizen_mod.php';
// Retrieve date and time from session
$scheduleDate = $_SESSION['selectedDate'] ?? null;
$startTime = $_SESSION['startTime'] ?? null;
$endTime = $_SESSION['endTime'] ?? null;

// Assuming you're storing session data for the user's name and citizen ID
$nme = $_SESSION['fullname'];
$regId = $_SESSION['citizend_id'];

// Create instances of the required classes
$citizen = new Citizen($conn);
$staff = new Staff($conn);

// Fetch available priests based on the selected schedule
$priests = $citizen->getAvailablePriests($scheduleDate, $startTime, $endTime);
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
// Retrieve data from sessionStorage
const selectedDate = sessionStorage.getItem('selectedDate');
const startTime = sessionStorage.getItem('startTime');
const endTime = sessionStorage.getItem('endTime');

// Use the retrieved data as needed
console.log('Selected Date:', selectedDate);
console.log('Start Time:', startTime);
console.log('End Time:', endTime);

document.addEventListener('DOMContentLoaded', function() {
    const selectedDate = sessionStorage.getItem('selectedDate');
    const selectedTimeRange = sessionStorage.getItem('selectedTimeRange');
    console.log('Selected Date:', selectedDate);  // Check if date is properly stored
    console.log('Selected Time Range:', selectedTimeRange);  // Check if time range is stored correctly
    if (selectedDate) {
        document.getElementById('date').value = selectedDate;
    }

    if (selectedTimeRange) {
        const [startTime, endTime] = selectedTimeRange.split(' - ');
        document.getElementById('start_time').value = startTime.trim();
        document.getElementById('end_time').value = endTime.trim();
    }
});
document.addEventListener('DOMContentLoaded', function() {
    // Retrieve the selected date from sessionStorage
    const selectedDate = sessionStorage.getItem('selectedDate');
    
    // Display the retrieved date in the readonly input field
    if (selectedDate) {
        document.getElementById('date').value = selectedDate;
    }

    // Use the current date and the selected date to limit the range of the "Select Seminar" field
    if (selectedDate) {
        const seminarInput = document.getElementById('dates');
        
        // Get today's date
        const today = new Date().toISOString().split('T')[0]; // Format as YYYY-MM-DD

        // Set the min date to today and the max date to the stored selectedDate
        seminarInput.min = today;
        seminarInput.max = selectedDate;
    }
});
document.addEventListener('DOMContentLoaded', function() {
    // Populate dropdown with time options
    function populateDropdown(dropdown, startHour, startMinute, endHour, endMinute) {
        dropdown.innerHTML = ''; // Clear current options

        let time = new Date();
        time.setHours(startHour);
        time.setMinutes(startMinute);

        const endTime = new Date();
        endTime.setHours(endHour);
        endTime.setMinutes(endMinute);

        // Create time options in 1-hour intervals
        while (time <= endTime) {
            const hours = time.getHours();
            const minutes = time.getMinutes().toString().padStart(2, '0');
            const period = hours >= 12 ? 'PM' : 'AM';
            const displayHours = hours % 12 || 12; // Convert 24-hour time to 12-hour time format

            const optionValue = `${hours.toString().padStart(2, '0')}:${minutes}`; // 24-hour format
            const optionText = `${displayHours}:${minutes} ${period}`; // 12-hour format
            
            const option = new Option(optionText, optionValue);
            dropdown.add(option);

            // Increment by 1 hour
            time.setHours(time.getHours() + 1);
        }
    }

    // Get the dropdowns
    const startTimeDropdown = document.getElementById('start_times');
    const endTimeDropdown = document.getElementById('end_times');

    // Initial population of both dropdowns
    populateDropdown(startTimeDropdown, 8, 30, 16, 30);  // Populate start time: 8:30 AM to 4:30 PM
    populateDropdown(endTimeDropdown, 9, 30, 17, 30);    // Populate end time: 9:30 AM to 5:30 PM

    // Update end time based on selected start time
    startTimeDropdown.addEventListener('change', function() {
        const selectedStartTime = startTimeDropdown.value.split(':');
        const startHour = parseInt(selectedStartTime[0], 10);
        const startMinute = parseInt(selectedStartTime[1], 10);

        // Populate end time with only times greater than selected start time
        const newEndHour = startHour + 1; // End time starts from selected start time + 1 hour
        populateDropdown(endTimeDropdown, newEndHour, startMinute, 17, 30); // Maintain the upper limit of 5:30 PM
    });
});






document.addEventListener('DOMContentLoaded', function() {
    const dateInput = document.getElementById('date');
    
    // Validate the date input
    if (dateInput.value) {
        const selectedDate = new Date(dateInput.value);  // Get the provided date
        
        // Ensure the selected date is valid
        if (!isNaN(selectedDate.getTime())) {
            const sundays = getSundaysBeforeDate(selectedDate);  // Get all Sundays before the selected date
            populateSundaysDropdown(sundays);  // Populate dropdown with those Sundays
        } else {
            console.error("Error: Invalid date.");
            clearSundaysDropdown();  // Clear dropdown on invalid date
        }
    } else {
        console.error("Error: No date provided.");
        clearSundaysDropdown();  // Clear dropdown if no date
    }

    // Clear form fields on button click
    document.querySelector('.btn-info').addEventListener('click', function() {
        document.querySelectorAll('.form-control').forEach(function(element) {
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
  
     
  <?php require 'header.php'?>
<?php require 'sidebar.php'?>
       
  <div class="container">
    <div class="page-inner">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Announcement Form</div>
                    </div>
                    <div class="card-body">
                    <form method="post" action="../../Controller/addannounce_con.php" onsubmit="return validateForm()">
                    
    <input type="hidden" name="announcement" name="announcement" value="announcement">
    <div class="row">
        <div class="col-md-6 col-lg-4">
        <div class="form-group">
    <label for="date">Date</label>
    <input type="text" class="form-control" id="date" name="date" placeholder="Select a date" readonly />


    <span class="error" id="dateError"></span>
</div>

<div class="form-group">
            <label for="eventTitle">Event Title</label>
            <input type="text" class="form-control" id="eventTitle" name="eventTitle" placeholder="Enter title">
        </div>
           
        
        <div class="form-group">
            <label for="capacity">Capacity</label>
            <input type="number" class="form-control" id="capacity" name="capacity" placeholder="Enter capacity">
        </div>
            
        </div>
        <div class="col-md-6 col-lg-4">
            <div class="form-group">
                <label for="start_time">Start Time</label>
                <input type="text" class="form-control" id="start_time" name="start_time" placeholder="Start Time" readonly>    
                 <span class="error" id="startTimeError"></span>
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
            
         
           
        </div>
        <div class="col-md-6 col-lg-4">
            <div class="form-group">
                <label for="end_time">End Time</label>
                <input type="text" class="form-control" id="end_time" name="end_time" placeholder="End Time" readonly>        <span class="error" id="endTimeError"></span>
            </div>
            <div class="form-group">
            <label for="description">Description</label>
            <input type="text" class="form-control" id="description" name="description" placeholder="Enter description">
        </div>
           
           
        </div>
    </div>
    <div class="card-action">
    <div class="card-header">
                        <div class="card-title">Priest</div>
                    </div>
    <div class="col-md-6 col-lg-4">
    <div class="form-group">
    <label for="dates">Select Seminar</label>
    <input type="date" class="form-control" id="dates" name="dates" placeholder="Enter description">
</div>
<div class="form-group">
    <label for="start_times">Select Start Time</label>
    <select class="form-control" id="start_times" name="start_times">
        <!-- Time options will be added by JavaScript -->
    </select>
</div>

<div class="form-group">
    <label for="end_times">Select End Time</label>
    <select class="form-control" id="end_times" name="end_times">
        <!-- Time options will be added by JavaScript -->
    </select>
</div>



    <div class="form-group">
    <label for="eventType">Select Priest</label>
    <select class="form-control" id="eventType" name="priest_id">
        <option value="" disabled selected>Select Priest</option>
        <?php foreach ($priests as $priest): ?>
            <option value="<?php echo htmlspecialchars($priest['citizend_id']); ?>">
                <?php echo htmlspecialchars($priest['fullname']); ?>
            </option>
        <?php endforeach; ?>
    </select>
    <span class="error" id="priestError"></span>
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
<script>
    

function validateForm() {
    let isValid = true;

    // Helper function to validate field
    function validateField(id, errorId, message) {
        const field = document.getElementById(id);
        const value = field.value.trim();
        if (value === '') {
            document.getElementById(errorId).innerText = message;
            field.classList.add('error');
            isValid = false;
        } else {
            document.getElementById(errorId).innerText = '';
            field.classList.remove('error');
        }
    }

    // Clear previous error messages and styles
    document.querySelectorAll('.error').forEach(e => e.innerHTML = '');
    document.querySelectorAll('.form-control').forEach(e => e.classList.remove('error'));

    // Validate fields
    validateField('firstname', 'firstnameError', 'Firstname is required');
    validateField('lastname', 'lastnameError', 'Lastname is required');
    validateField('address', 'addressError', 'Address is required');
    validateField('religion', 'religionError', 'Religion is required');
    validateField('pbirth', 'pbirthError', 'Place of Birth is required');
    validateField('father_name', 'fatherNameError', 'Father\'s Fullname is required');
    validateField('mother_name', 'motherNameError', 'Mother\'s Fullname is required');
    validateField('parents_residence', 'parentsResidenceError', 'Parents Residence is required');
    validateField('godparents', 'godparentsError', 'List Of Godparents is required');
    validateField('date', 'dateError', 'Date is required');
    validateField('start_time', 'startTimeError', 'Start Time is required');
    validateField('end_time', 'endTimeError', 'End Time is required');

    // Validate gender
    const gender = document.querySelector('input[name="gender"]:checked');
    if (!gender) {
        document.getElementById('genderError').innerText = 'Gender is required';
        document.querySelector('input[name="gender"]').classList.add('error');
        isValid = false;
    } else {
        document.getElementById('genderError').innerText = '';
        document.querySelector('input[name="gender"]').classList.remove('error');
    }

    // Validate date of birth
    const month = document.getElementById('months').value;
    const day = document.getElementById('days').value;
    const year = document.getElementById('years').value;
    if (month === '' || day === '' || year === '') {
        document.getElementById('dobError').innerText = 'Date of birth is required';
        isValid = false;
    } else {
        document.getElementById('dobError').innerText = '';
    }
    const seminar = document.getElementById('sundays').value;
    if (seminar === '') {
        document.getElementById('seminarError').innerText = 'Please select a seminar';
        document.getElementById('sundays').classList.add('error');
        isValid = false;
    } else {
        document.getElementById('seminarError').innerText = '';
        document.getElementById('sundays').classList.remove('error');
    }
    const priest = document.getElementById('eventType').value;
    if (priest === '') {
        document.getElementById('priestError').innerText = 'Please select a priest';
        document.getElementById('eventType').classList.add('error');
        isValid = false;
    } else {
        document.getElementById('priestError').innerText = '';
        document.getElementById('eventType').classList.remove('error');
    }

    
 const payAmount = document.getElementById('pay_amount').value;
    if (payAmount === '' || isNaN(payAmount) || payAmount <= 0) {
        document.getElementById('payAmountError').innerText = 'Please enter a valid payable amount';
        document.getElementById('pay_amount').classList.add('error');
        isValid = false;
    } else {
        document.getElementById('payAmountError').innerText = '';
        document.getElementById('pay_amount').classList.remove('error');
    }
    // Check if the form is valid
    if (!isValid) {
        console.log('Validation failed, form not submitted.');
        return false;  // Prevent form submission
    }

    console.log('Validation passed, form will be submitted.');
    return true;  // Allow form submission
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
