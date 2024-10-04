<?php
require_once '../../Controller/login_con.php';

?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <title>ARGAO CHURCH MANAGEMENT SYSTEM</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta content="" name="keywords" />
    <meta content="" name="description" />
    <link rel="icon" href="../assets/img/mainlogo.jpg" type="image/x-icon"
    />

        <!-- Google Web Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&family=Inter:slnt,wght@-10..0,100..900&display=swap" rel="stylesheet">

        <!-- Icon Font Stylesheet -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"/>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

        <!-- Libraries Stylesheet -->
        <link rel="stylesheet" href="lib/animate/animate.min.css"/>
        <link href="lib/lightbox/css/lightbox.min.css" rel="stylesheet">
        <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">


        <!-- Customized Bootstrap Stylesheet -->
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/sigin.css" rel="stylesheet">

        <!-- Template Stylesheet -->
        <link href="css/style.css" rel="stylesheet">
        <style>
                   .error{
        color: red;
        font-size: 14px;
        margin-top: 5px;
        color: red;            /* Text color for error messages */
    font-size: 12px;      /* Font size for error messages */
    margin-top: 5px;      /* Space above the error message */
    display: block;        /* Ensures the error message is on a new line */
    line-height: 1.2;     /* Adjusts line height for better readability */
    }
             .error-message {
        color: red;
        font-size: 14px;
        margin-top: 5px;
        color: red;            /* Text color for error messages */
    font-size: 12px;      /* Font size for error messages */
    margin-top: 5px;      /* Space above the error message */
    display: block;        /* Ensures the error message is on a new line */
    line-height: 1.2;     /* Adjusts line height for better readability */
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
    width: 20px;
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
     .float-left{
        width:900px;
     }
        .back-button {
float:right;       
margin-right:110px;  
margin-top:20px;  

            padding: 0.5rem 1rem;
            background-color: #0066a8;
            color: #fff;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            font-size: 1rem;
            transition: background-color 0.3s ease;
        }  .back-button:hover {
            background-color: #004a80;
        }
        .clearfix::after {
    content: "";
    display: table;
    clear: both;
}p{
    color:#3b3b3b; text-align: justify; text-justify: inter-word; font-size: 15px; line-height: 1.6; margin-top: 10px; margin-left: 10px;
}
.button1 {
  padding: 6px 24px;
  border: 2px solid #fff;
  background: transparent;
  border-radius: 6px;
  cursor: pointer;
}
.button1:active {
  transform: scale(0.98);
} .form_container h2 {
  font-size: 22px;
  color: #0b0217;
  text-align: center;
}
.input_box {
  position: relative;
  margin-top: 35px;
  width: 100%;
  height: 40px;
  display: flex;
position: relative;
gap:25px;
}
.input_box input,select {
  height: 100%;
  width: 100%;
  border: none;
  outline: none;
  padding: 0 30px;
  color: #333;
  transition: all 0.2s ease;
  border-bottom: 1.5px solid #aaaaaa;
}

.input_box input:focus {
  border-color: #7d2ae8;
}
.input_box i {
  position: absolute;
  top: 50%;
  transform: translateY(-50%);
  font-size: 20px;
  color: #707070;
}
.input_box i.email,
.input_box i.password {
  left: 0;
}
.input_box input:focus ~ i.email,
.input_box input:focus ~ i.password {
  color: #7d2ae8;
}
.input_box i.pw_hide {
  right: 0;
  font-size: 18px;
  cursor: pointer;
}
.option_field {
  margin-top: 14px;
  display: flex;
  align-items: center;
  justify-content: space-between;
  position: relative;
    
    width: 100%;
    height: 40px;
}
.form_container a {
  color: #7d2ae8;
  font-size: 12px;
}
.form_container a:hover {
  text-decoration: underline;
}
.checkbox {
  display: flex;
  column-gap: 8px;
  white-space: nowrap;
}
.checkbox input {
  accent-color: #7d2ae8;
}
.checkbox label {
  font-size: 12px;
  cursor: pointer;
  user-select: none;
  color: #0b0217;
}
.form_container .button {
  background: #7d2ae8;
  margin-top: 30px;
  width: 100%;
  padding: 10px 0;
  border-radius: 10px;
}
.login_signup {
  font-size: 12px;
  text-align: center;
  margin-top: 15px;
}
.option_field a{
  color: #7d2ae8;
  font-size: 12px;
}
.option_field a:hover {
  text-decoration: underline;
}
.input_group {
      /* display: flex; */
      flex-direction: column;
    /* position: relative; */
    /* margin-top: -21px; */
    width: 100%;
    height: 40px;
    /* display: flex; */
    position: relative;
}
  

  /* Label styling */
  .input_group label {
    font-size: 15px;
    font-weight: 500;
  }

  /* Input styling */
  .input_group input[type="date"],
  .input_group input[type="file"] {
    padding: 10px;
    font-size: 14px;
    height: 100%;
    width: 90%;
  border: none;
  outline: none;
  color: #333;
  transition: all 0.2s ease;
  border-bottom: 1.5px solid #aaaaaa;
  }
  @media (max-width: 950px) {
    .responsive-image {
        display: none;
    }
}

    </style>
    </head>

    <body>
 
    <div class="container-fluid nav-bar px-0 px-lg-4 py-lg-0">
      <div class="container">
      <?php require_once 'navbar.php'?>

      </div>
    </div>

      <div class="container1">
      <div class="forms-container">
        <div class="signin-signup">
          <form method="POST" action=""  class="sign-in-form">
          <input type="hidden" name="login_form" value="1">
            <h2 class="title">Sign in</h2>
            <div class="error" id="login_error">
        <?php
        if (isset($_SESSION['login_error'])) {
            echo htmlspecialchars($_SESSION['login_error']);
            unset($_SESSION['login_error']); // Clear the message after displaying
        }
        ?>
    </div>
            <div class="input_box">
              <input type="text" name="email" class="form-control" id="email" placeholder="name@example.com"/>
              <i class="uil uil-envelope-alt email"></i>
            </div>
            <div class="input_box">
              <input type="password" name="password" class="form-control" id="password" placeholder="Password"/>
              <i class="uil uil-lock password"></i>
              <i class="uil uil-eye-slash pw_hide"></i>
            </div>
            <div class="option_field">
              <span class="checkbox">
                <input type="checkbox" id="check" />
                <label for="check">Remember me</label>
              </span>
              <a href="#" class="forgot_pw">Forgot password?</a>
            </div>
            <button type="submit" class="btn btn-primary py-3 w-100 mb-4">Sign In</button>
            <div class="login_signup">Don't have an account? <a href="#"   id="sign-up-signbutton">Signup</a></div>
           
          </form>


          <form method="POST" action=""  enctype="multipart/form-data" onsubmit="return validateForm()"class="sign-up-form">
          <input type="hidden" name="signup_form" value="1">
            <h2 class="title">Sign up</h2>
            <div class="input_box">
            <div class="input_group">
            <input type="text" class="form-control" name="first_name" id="first_name" placeholder="First Name">
            <div class="error" id="first_name_error"></div>  
            </div>
            <div class="input_group">
              <input type="text" class="form-control" name="last_name" id="last_name" placeholder="Last Name">
              <div class="error" id="last_name_error"></div>
              </div>
              <div class="input_group">
              <input type="text" class="form-control" name="middle_name" id="middle_name" placeholder="Middle Name">
              <div class="error" id="middle_name_error"></div>
              
              </div>
            </div>
           
            <div class="input_box">
            <div class="input_group">

            <select class="form-control" name="gender"  class="input_box" id="gender" placeholder="name@example.com">
            <option value="" disabled selected>Select gender</option>
            <option>Male</option>
            <option>Female</option>
        </select>
        <div class="error" id="gender_error"></div>

        </div>
      
        <div class="input_group">
        <input type="text" class="form-control" id="address" name="address" placeholder="Address">
        <div class="error" id="address_error"></div>

        </div>
      </div>

            <div class="input_box">
  <div class="input_group" style=" margin-top: -8px;">
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
  <div class="input_group" style=" margin-top: -8px;"> 
    <label for="validID">Valid ID</label>
    <input type="file" class="form-control" id="valid_id" name="valid_id" accept="image/*" placeholder="Valid ID">
    <div class="error" id="valid_id_error"></div>
  </div>
</div>

            <div class="input_box">
            <div class="input_group">

            <input type="tel" class="form-control" name="phone" id="phone" placeholder="Phone number ">
              <i class="uil uil-envelope-alt email"></i>
              <div class="error" id="phone_error"></div>
              </div>
              <div class="input_group">
              <input type="text" class="form-control" name="email" id="emails" placeholder="name@example.com">
              <div class="error" id="email_error"></div>
              <i class="uil uil-envelope-alt email"></i>
              </div>
              </div>
          
            <div class="input_box">
            <div class="input_group">

            <input type="password" class="form-control" id="passwords" name="password" placeholder="Password">
            <div class="error" id="password_error"></div>
            <i class="uil uil-envelope-alt email"></i>
            </div>
            <div class="input_group">

          <input type="password" class="form-control" id="confirmpassword" name="confirmpassword" placeholder="Confirm Password">
          <div class="error" id="confirmpassword_error"></div>
          <i class="uil uil-envelope-alt email"></i>
          </div>

            </div>
            <br>
            <button type="submit" class="button" >Register</button>
            <div class="login_signup">Already have an account? <a href="#" id="sign-in-signbutton">Signin</a></div>

         
        </div>
        </form>
      </div>

      <div class="panels-container">
      <div class="panel left-panel">
    <div class="content">
        <h2 style="font-weight:bolder;">WELCOME TO ARGAO CHURCH OFFICIAL WEBSITE</h2>
        <p>
            Discover the rich history, faith, and community spirit of the Archdiocesan Shrine of San Miguel Arcangel. Our church has been a cornerstone of Argao, Cebu, for centuries, providing a place of worship, celebration, and connection for all. Log in to access church schedules, events, and services, and stay connected with our vibrant parish community. Thank you for being part of our journey of faith!
        </p>
    </div>
    <img src="img/log.svg" class="image responsive-image" alt="" />
</div>

        <div class="panel right-panel">
          <div class="content">
            <h3>JOIN OUR ARGAO CHURCH COMMUNITY</h3>
            <p>
            Become a part of the Archdiocesan Shrine of San Miguel Arcangel family by creating your account today. By signing up, you’ll gain access to our event schedules, church services, announcements, and more. Connect with our parish, stay updated on upcoming activities, and engage with a community that shares your faith. We look forward to welcoming you!
            </p>
           
          </div>
          <img src="img/register.svg" class="image" alt="" />
        </div>
      </div>
    </div>

    <script src="app.js"></script>
    <script>
      document.getElementById("sign-up-signbutton").addEventListener("click", function() {
    document.querySelector(".sign-in-form").style.display = "none";
    document.querySelector(".sign-up-form").style.display = "block";
});

document.getElementById("sign-in-signbutton").addEventListener("click", function() {
    document.querySelector(".sign-up-form").style.display = "none";
    document.querySelector(".sign-in-form").style.display = "block";
});

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


    // Validate email
    const email = document.getElementById("emails").value.trim();
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
    const password = document.getElementById("passwords").value.trim();
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

        const sign_in_signbutton = document.querySelector("#sign-in-signbutton");
const sign_up_signbutton = document.querySelector("#sign-up-signbutton");
const container = document.querySelector(".container1");

sign_up_signbutton.addEventListener("click", () => {
  container.classList.add("sign-up-mode");
});

sign_in_signbutton.addEventListener("click", () => {
  container.classList.remove("sign-up-mode");
});
    </script>
    <?php require_once 'footer.php'?>

    </div>
    </div>

        <!-- Back to Top -->
<script>
 const pwShowHide = document.querySelectorAll(".pw_hide");

pwShowHide.forEach((icon) => {
  icon.addEventListener("click", () => {
    // Select the input field that is inside the same parent as the icon
    let getPwInput = icon.parentElement.querySelector("input");
    
    if (getPwInput.type === "password") {
      getPwInput.type = "text"; // Show password
      icon.classList.replace("uil-eye-slash", "uil-eye"); // Toggle icon
    } else {
      getPwInput.type = "password"; // Hide password
      icon.classList.replace("uil-eye", "uil-eye-slash"); // Toggle icon
    }
  });
});


          
    var acc = document.getElementsByClassName("accordion");
    var i;

    for (i = 0; i < acc.length; i++) {
        acc[i].addEventListener("click", function() {
            this.classList.toggle("active");
            var panel = this.nextElementSibling;
            if (panel.style.display === "block") {
                panel.style.display = "none";
            } else {
                panel.style.display = "block";
            }
        });
    }
</script>
        <!-- JavaScript Libraries -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
        <script src="lib/wow/wow.min.js"></script>
        <script src="lib/easing/easing.min.js"></script>
        <script src="lib/waypoints/waypoints.min.js"></script>
        <script src="lib/counterup/counterup.min.js"></script>
        <script src="lib/lightbox/js/lightbox.min.js"></script>
        <script src="lib/owlcarousel/owl.carousel.min.js"></script>
        

        <!-- Template Javascript -->
        <script src="js/main.js"></script>
    </body>

</html>