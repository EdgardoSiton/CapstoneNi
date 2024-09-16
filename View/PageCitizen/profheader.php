
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
    <style>
      body{
    margin-top:20px;
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
<div class="container">
      <div class="main-body">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="main-breadcrumb">
          <ol class="breadcrumb">
          <li class="breadcrumb-item">
              <a href="profile.php">My Profile</a>
            </li>
            <li class="breadcrumb-item">
              <a href="eventschedule.php">My Event Scheduling </a>
            </li>
            <li class="breadcrumb-item">
              <a href="appointmentseminar.php">My Appointment for Seminar</a>
            </li>
            <li class="breadcrumb-item">
              <a href="history.php">My Booking History</a>
            </li>
          
          </ol>
        </nav>
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