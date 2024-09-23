<?php
require_once '../../Controller/registration_con.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Argaochurch</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Roboto:wght@500;700&display=swap" rel="stylesheet"> 
    
    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/signin.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/sigin.css" rel="stylesheet">
</head>
<style>
    .error-message {
        color: red;
        font-size: 14px;
        margin-top: 5px;
    }
    .input-error {
        border: 1px solid red;
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
</style>

<body>
    <div class="container-fluid position-relative d-flex p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-dark position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <!-- Sign Up Start -->
        <div class="container-fluid">
            <div class="row h-100 align-items-center justify-content-center" style="min-height: 100vh;">
                <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-4">
                    <div class="bg-secondary rounded p-4 p-sm-5 my-4 mx-3">
                    <div style="display: flex; flex-direction: column;" class="d-flex align-items-center justify-content-between mb-3">
                        <div class="logo">
                            <a href="index.html" class="">
                           <img style="width:100%;" src="assets/img/argaochurch.png" alt="" />
                            </a>
</div>
<div class="text"> 

<form method="POST" action="" onsubmit="return validateForm()">
    <h5>Register</h5>

    <div class="form-floating mb-3">
        <input type="text" class="form-control" name="first_name" id="first_name" placeholder="First Name">
        <label for="floatingText">First Name</label>
        <div class="error" id="first_name_error"></div>
    </div>

    <div class="form-floating mb-3">
        <input type="text" class="form-control" name="last_name" id="last_name" placeholder="Last Name">
        <label for="floatingText">Last Name</label>
        <div class="error" id="last_name_error"></div>
    </div>

    <div class="form-floating mb-3">
        <input type="text" class="form-control" name="middle_name" id="middle_name" placeholder="Middle Name">
        <label for="floatingText">Middle Name</label>
        <div class="error" id="middle_name_error"></div>
    </div>

    <div class="form-floating mb-3">
        <input type="text" class="form-control" name="email" id="email" placeholder="name@example.com">
        <label for="floatingInput">Email address</label>
        <div class="error" id="email_error"></div>
    </div>

    <div class="form-floating mb-3">
        <select class="form-control" name="gender" id="gender" placeholder="name@example.com">
            <option value="" disabled selected>Select gender</option>
            <option>Male</option>
            <option>Female</option>
        </select>
        <label for="floatingInput">Gender</label>
        <div class="error" id="gender_error"></div>
    </div>

    <div class="form-floating mb-3">
        <input type="tel" class="form-control" name="phone" id="phone" placeholder=" ">
        <label for="floatingText">Phone number</label>
        <div class="error" id="phone_error"></div>
    </div>
    <div class="form-floating mb-3">
    <div class="birthday-input">
        <label for="month">Date of Birth</label>
        <div class="birthday-selectors">
            <select id="month" name="month">
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

            <select id="day" name="day">
                <option value="">Day</option>
                <!-- Generate options 1 to 31 -->
                <?php for ($i = 1; $i <= 31; $i++): ?>
                    <option value="<?php echo sprintf('%02d', $i); ?>"><?php echo $i; ?></option>
                <?php endfor; ?>
            </select>

            <select id="year" name="year">
                <option value="">Year</option>
                <!-- Generate options from 1900 to current year -->
                <?php for ($i = date('Y'); $i >= 1900; $i--): ?>
                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                <?php endfor; ?>
            </select>
        </div>
    </div>
    <div class="error" id="c_date_birth_error"></div>
</div>


    <div class="form-floating mb-4">
        <input type="text" class="form-control" id="address" name="address" placeholder="Address">
        <label for="floatingPassword">Address</label>
        <div class="error" id="address_error"></div>
    </div>

    <div class="form-floating mb-3">
        <input type="file" class="form-control" id="valid_id" name="valid_id" placeholder="Valid ID">
        <label for="floatingText">Valid ID</label>
        <div class="error" id="valid_id_error"></div>
    </div>

    <div class="form-floating mb-4">
        <input type="password" class="form-control" id="password" name="password" placeholder="Password">
        <label for="floatingPassword">Password</label>
        <div class="error" id="password_error"></div>
    </div>

    <div class="form-floating mb-4">
        <input type="password" class="form-control" id="confirmpassword" name="confirmpassword" placeholder="Confirm Password">
        <label for="floatingPassword">Confirm Password</label>
        <div class="error" id="confirmpassword_error"></div>
    </div>

    <button type="submit" class="btn btn-primary py-3 w-100 mb-4">Sign Up</button>
    <p class="text-center mb-0">Already have an Account? <a style="color:white;" href="signin.php">Sign In</a></p>
</form>

        <!-- Sign Up End -->
    </div>
    <script>
function validateForm() {
    // Clear previous errors
    clearErrors();

    let isValid = true;

    // Validate first name
    const firstName = document.getElementById("first_name").value.trim();
    if (firstName === "") {
        showError("first_name", "First Name is required");
        isValid = false;
    }

    // Validate last name
    const lastName = document.getElementById("last_name").value.trim();
    if (lastName === "") {
        showError("last_name", "Last Name is required");
        isValid = false;
    }

    // Validate middle name
    const middleName = document.getElementById("middle_name").value.trim();
    if (middleName === "") {
        showError("middle_name", "Middle Name is required");
        isValid = false;
    }

    // Validate email
    const email = document.getElementById("email").value.trim();
    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (email === "") {
        showError("email", "Email is required");
        isValid = false;
    } else if (!emailPattern.test(email)) {
        showError("email", "Invalid email format");
        isValid = false;
    } else if (!email.endsWith("@gmail.com")) {
        showError("email", "Email must end with @gmail.com");
        isValid = false;
    }

    // Validate gender
    const gender = document.getElementById("gender").value;
    if (gender === "") {
        showError("gender", "Gender is required");
        isValid = false;
    }

    // Validate phone
    const phone = document.getElementById("phone").value.trim();
    if (phone === "") {
        showError("phone", "Phone number is required");
        isValid = false;
    }

    // Validate date of birth
    const month = document.getElementById("month").value;
    const day = document.getElementById("day").value;
    const year = document.getElementById("year").value;
    if (month === "" || day === "" || year === "") {
        showError("c_date_birth", "Date of Birth is required");
        isValid = false;
    } else if (!isValidDate(month, day, year)) {
        showError("c_date_birth", "Invalid Date of Birth");
        isValid = false;
    } else if (!isAtLeast15YearsOld(year, month, day)) {
        showError("c_date_birth", "You must be at least 15 years old");
        isValid = false;
    }

    // Validate address
    const address = document.getElementById("address").value.trim();
    if (address === "") {
        showError("address", "Address is required");
        isValid = false;
    }

    // Validate valid ID
    const validId = document.getElementById("valid_id").value.trim();
    if (validId === "") {
        showError("valid_id", "Valid ID is required");
        isValid = false;
    }

    // Validate password
    const password = document.getElementById("password").value.trim();
    if (password === "") {
        showError("password", "Password is required");
        isValid = false;
    }

    // Validate confirm password
    const confirmPassword = document.getElementById("confirmpassword").value.trim();
    if (confirmPassword !== password) {
        showError("confirmpassword", "Passwords do not match");
        isValid = false;
    }

    return isValid;
}

function showError(inputId, errorMessage) {
    const inputElement = document.getElementById(inputId);
    const errorElement = document.getElementById(inputId + "_error");

    if (inputElement) {
        inputElement.classList.add("input-error");
    }

    if (errorElement) {
        errorElement.textContent = errorMessage;
    }
}

function clearErrors() {
    const errorElements = document.querySelectorAll(".error");
    errorElements.forEach((element) => {
        element.textContent = "";
    });

    const inputElements = document.querySelectorAll(".form-control");
    inputElements.forEach((element) => {
        element.classList.remove("input-error");
    });
}

function isValidDate(month, day, year) {
    // Convert values to integers
    const monthInt = parseInt(month, 10);
    const dayInt = parseInt(day, 10);
    const yearInt = parseInt(year, 10);

    // Check if the date is valid
    if (monthInt < 1 || monthInt > 12) {
        return false;
    }

    const daysInMonth = new Date(yearInt, monthInt, 0).getDate();
    return dayInt > 0 && dayInt <= daysInMonth;
}

function isAtLeast15YearsOld(year, month, day) {
    const today = new Date();
    const birthDate = new Date(year, month - 1, day); // JavaScript months are 0-based
    const age = today.getFullYear() - birthDate.getFullYear();

    if (today.getMonth() + 1 < month || (today.getMonth() + 1 === month && today.getDate() < day)) {
        return age - 1 >= 15;
    }

    return age >= 15;
}

</script>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/chart/chart.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/mainsignin.js"></script>
</body>

</html>