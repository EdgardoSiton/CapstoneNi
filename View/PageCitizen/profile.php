<?php


// Include database connection and controller
require_once '../../Model/db_connection.php';
require_once '../../Controller/citizen_con.php';
require_once '../../Model/login_mod.php';
// Get current user details from the session
$nme = $_SESSION['fullname'];
$citizenId = $_SESSION['citizend_id'];
$citizenInfo = new User ($conn);

// Fetch additional user details using the citizen ID
$citizenDetails = $citizenInfo->getCitizenDetails($citizenId);
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css"
    />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.bundle.min.js"></script>
       <!-- Bootstrap CSS -->
       <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="icon" href="../assets/img/mainlogo.jpg" type="image/x-icon" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&family=Inter:slnt,wght@-10..0,100..900&display=swap"
      rel="stylesheet"
    />
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
   <!-- Bootstrap CSS -->
   <link href="css/bootstrap.min.css" rel="stylesheet" />
    <link href="css/style.css" rel="stylesheet" />
    <style>
      body{
    color: #1a202c;
    text-align: left;
    background-color: #e2e8f0;    
}
.main-body {
    padding: 15px;
}
.card {
    box-shadow: 0 1px 3px 0 rgba(0,0,0,.1), 0 1px 2px 0 rgba(0,0,0,.06);
}

.card {
    position: relative;
    display: flex;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
    background-color: #fff;
    background-clip: border-box;
    border: 0 solid transparent;
    border-radius: .25rem;
    margin-bottom: 1.5rem;
    box-shadow: 0 2px 6px 0 rgb(218 218 253 / 65%), 0 2px 6px 0 rgb(206 206 238 / 54%);
}
.me-2 {
    margin-right: .5rem!important;
}
.card-body {
    flex: 1 1 auto;
    min-height: 1px;
    padding: 1rem;
}

.gutters-sm {
    margin-right: -8px;
    margin-left: -8px;
}

.gutters-sm>.col, .gutters-sm>[class*=col-] {
    padding-right: 8px;
    padding-left: 8px;
}
.mb-3, .my-3 {
    margin-bottom: 1rem!important;
}

.bg-gray-300 {
    background-color: #e2e8f0;
}
.h-100 {
    height: 100%!important;
}
.shadow-none {
    box-shadow: none!important;
}
.list-group-item {
      transition: background-color 0.3s, color 0.3s; /* Smooth transition */
    }

    .list-group-item:not(.no-hover):hover {
      background-color: #f0f0f0; /* Change background color on hover */
      color: #007bff; /* Change text color on hover */
    }
    .edit-mode {
      border: 1px solid #007bff; /* Optional: Highlight editable area */
      padding: 5px;
      border-radius: 3px;
    }
    </style>
  </head>
  <body style="margin-top: 0!important;">
    <!-- Navbar & Hero Start -->
    <div class="container-fluid nav-bar px-0 px-lg-4 py-lg-0">
      <div class="container">
       
      <?php require_once 'header.php'?>

      </div>
    </div>
    <!-- Navbar & Hero End -->
    

    <?php require_once 'profheader.php'?>
        <!-- /Breadcrumb -->

        <div class="row gutters-sm">
          <div class="col-md-4">
            <div class="card">
              <div class="card-body">
                <div class="d-flex flex-column align-items-center text-center">
                  <img
                    src="assets/img/profile.png"
                    alt="Citizen"
                    class="rounded-circle"
                    width="180"
                  />
                  <div class="mb-0">
                    <h4> <?php echo htmlspecialchars($nme); ?></h4>
                    <p  class="text-muted font-size-sm">
                    <?php echo htmlspecialchars($citizenDetails['address']); ?>
                    </p>
                   <br>
                  </div>
                </div>
                <hr class="my-4">
     
              </div>
            </div>
          </div>
          <div class="col-md-8">
    <div class="card mb-3">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-3">
                    <h6 class="mb-0">Full Name</h6>
                </div>
                <div class="col-sm-6 text-secondary editable">
                    <?php echo htmlspecialchars($nme); ?>
                </div>
                <div class="col-sm-3 text-right">
                    <i class="fas fa-edit text-secondary edit-btn" style="cursor: pointer;"></i>
                </div>
            </div>
            <hr />
            <div class="row">
                <div class="col-sm-3">
                    <h6 class="mb-0">Email</h6>
                </div>
                <div class="col-sm-6 text-secondary editable">
                    <?php echo htmlspecialchars($citizenDetails['email']); ?>
                </div>
                <div class="col-sm-3 text-right">
                    <i class="fas fa-edit text-secondary edit-btn" style="cursor: pointer;"></i>
                </div>
            </div>
            <hr />
            <div class="row">
                <div class="col-sm-3">
                    <h6 class="mb-0">Gender</h6>
                </div>
                <div class="col-sm-6 text-secondary editable">
                    <?php echo htmlspecialchars($citizenDetails['gender']); ?>
                </div>
                <div class="col-sm-3 text-right">
                    <i class="fas fa-edit text-secondary edit-btn" style="cursor: pointer;"></i>
                </div>
            </div>
            <hr />
            <div class="row">
                <div class="col-sm-3">
                    <h6 class="mb-0">Phone number</h6>
                </div>
                <div class="col-sm-6 text-secondary editable">
                    <?php echo htmlspecialchars($citizenDetails['phone']); ?>
                </div>
                <div class="col-sm-3 text-right">
                    <i class="fas fa-edit text-secondary edit-btn" style="cursor: pointer;"></i>
                </div>
            </div>
            <hr />
            <div class="row">
                <div class="col-sm-3">
                    <h6 class="mb-0">Date of birth</h6>
                </div>
                <div class="col-sm-6 text-secondary editable">
                    <?php echo htmlspecialchars($citizenDetails['c_date_birth']); ?>
                </div>
                <div class="col-sm-3 text-right">
                    <i class="fas fa-edit text-secondary edit-btn" style="cursor: pointer;"></i>
                </div>
            </div>
            <hr />
            <div class="row">
                <div class="col-sm-3">
                    <h6 class="mb-0">Address</h6>
                </div>
                <div class="col-sm-6 text-secondary editable">
                    <?php echo htmlspecialchars($citizenDetails['address']); ?>
                </div>
                <div class="col-sm-3 text-right">
                    <i class="fas fa-edit text-secondary edit-btn" style="cursor: pointer;"></i>
                </div>
            </div>
            <hr />
            <div class="row">
                <div class="col-sm-12">
                    <a class="btn btn-info" target="__blank" href="#">Save</a>
                </div>
            </div>
        </div>
    </div>
</div>
            <div class="card mt-3">
              <ul class="list-group list-group-flush">
                <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap no-hover">
                  <h4>Account Transaction History</h4>
                </li>
             
                <button
  class="list-group-item d-flex justify-content-between align-items-center flex-wrap"
  onclick="window.location.href='history.php';">
  Booking History <span class="text-secondary">10</span>
</button>

                  <button  class="list-group-item d-flex justify-content-between align-items-center flex-wrap">Seminar Appointment <span class="text-secondary">12</span></button>
               

              </ul>
            </div>
           
                </div>
              </div>
            </div>
          </div>
          <script>
    // Function to toggle contentEditable on the target element
    document.querySelectorAll('.edit-btn').forEach((button) => {
      button.addEventListener('click', function () {
        const editableContent = this.closest('.row').querySelector('.editable');
        
        // Toggle contentEditable attribute
        const isEditable = editableContent.getAttribute('contentEditable') === 'true';
        editableContent.setAttribute('contentEditable', !isEditable);
        
        // Add/remove visual indicator of edit mode
        editableContent.classList.toggle('edit-mode', !isEditable);
        
        // Optionally, change the button icon to indicate the current mode
        if (!isEditable) {
          this.classList.add('text-primary'); // Optional: Change icon color to show edit mode
        } else {
          this.classList.remove('text-primary');
        }
      });
    });
  </script>
  </body>
</html>