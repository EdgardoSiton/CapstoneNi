<?php
require_once '../../Model/priest_mod.php';
require_once '../../Model/db_connection.php';
session_start();
$nme = $_SESSION['fullname'];
$regId = $_SESSION['citizend_id'];

// Initialize Priest class
$appointments = new Priest($conn);

// Fetch appointment schedule for the priest
$priestId = $regId; // Assuming the priest's ID is stored in session as 'citizend_id'

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>ARGAO CHURCH MANAGEMENT SYSTEM</title>
    <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />
    <link rel="icon" href="../assets/img/mainlogo.jpg" type="image/x-icon" />
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Heebo', sans-serif;
        }

        /* Full-page flexbox container to center content */
        /* Scrollable container for calendar and tasks */
        .container {
            max-height: 190vh; /* Set a maximum height for the scrollable area */
            overflow-y: auto; /* Enable vertical scrolling */
            margin: auto; /* Center the container horizontally */
            width: 100%; /* Use full width */
        }

        /* Calendar container styling */
        .calendar-container {
            width: 100%; /* Use full width */
            max-width: 400px; /* Set a max-width for larger screens */
            background-color: #fff;
            border-radius: 10px;
            padding: 10px; /* Reduce padding for a more compact appearance */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            align-items: center;
            margin: auto;
            margin-top:20px!important;
            margin-bottom:20px!important;

        }

        

        /* Day styling */
        .day {
            padding: 8px; /* Reduce padding to shrink each date */
            cursor: pointer;
            text-align: center;
            flex: 1;
            font-size: 0.9rem; /* Adjust font size to make the day numbers smaller */
        }

        .day.active {
            background-color: #0066cc;
            color: white;
            border-radius: 10px;
        }

        /* Task list styling */
        .tasks {
            margin-top: 20px;
            width: 100%; /* Make sure task list takes full width of the container */
        }

        .task-container {
            background-color: #f8f9fa; /* Light background for task container */
            padding: 10px; /* Padding around task container */
            border-radius: 10px; /* Rounded corners */
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin: 0 auto;
    width: 400px;
    margin-bottom:20px!important;

        }

        .task-item {
            display: flex; /* Use flexbox for layout */
            align-items: center; /* Align items at the start */
            padding: 10px; /* Padding inside the task item */
            margin: 20px 0; /* Space between task items */
            background-color: #f9f9f9; /* Background color for the item */
           
        }

        .time-container {
            margin-left: 10px; /* Space between time and task detail container */
            width: 30%;
        }

        .task-detail-container {
            background: #67C6E3;
            padding-right: 10px;
            border-radius: 2px 20px 20px 2px;
            border-left: 3px solid #1E2A5E; /* Left border for task details */
            flex-grow: 1; /* Allow task detail container to take remaining space */
        }

        .task-item.pending {
            border-left-color: #ff6666;
        }

        .task-item.completed {
            border-left-color: #66cc66;
        }

        .task-item .time {
            font-weight: bold;
            color: #333;
        }

        .task-detail {
            flex: 1;
            margin-left: 20px;
        }

        .task-detail p {
            margin-bottom: 5px;
        }

        .subtext {
            font-size: 12px;
            color: black;
        }

        .status {
            font-size: 20px;
            color: #333;
        }

        /* Calendar specific styles */
      

        .month ul {
            display: flex;
            justify-content: space-between;
            padding: 0;
            list-style-type: none;
            margin: 0;
        }

        .month ul li {
            font-size: 17px;
            cursor: pointer;
            color: #333;
            text-align:center;
        }

        .weekdays, .days {
            list-style-type: none;
            padding: 0;
            margin: 10px 0;
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 5px;
        }

        .weekdays li, .days li {
            padding: 10px;
            text-align: center;
            font-weight: bold;
            color: #555;
            border-radius: 5px;
            cursor: pointer;
        }

        .days li.active, .days li.selected {
            background-color: #3498db;
            color: #fff;
        }

        /* Media queries for responsiveness */
        @media (max-width: 768px) {
            .calendar-container {
                width: 95%; /* Wider width on smaller screens */
                padding: 5px; /* Reduce padding for compact appearance */
            }

            .day {
                font-size: 0.8rem; /* Smaller font size for smaller screens */
                padding: 6px; /* Less padding */
            }

            .task-item {
                padding: 6px; /* Less padding in task items */
            }
        }

        @media (max-width: 480px) {
            .calendar-container {
                width: 100%; /* Full width on very small screens */
            }

            .day {
                font-size: 0.7rem; /* Even smaller font size */
                padding: 4px; /* Less padding */
            }

            .task-item {
                padding: 4px; /* Less padding in task items */
            }

            .tasks {
                margin-top: 10px; /* Adjust spacing */
            }
        }
    </style>
</head>
<body>
    <?php require_once 'sidebar.php' ?>
    <div class="main-panel">
        <?php require_once 'header.php' ?>

        <div class="container">
            <div class="col-sm-12">
                <div class="calendar-container bg-light rounded p-4" >

                    <div class="h-100 rounded p-4">
                    <h3 style="font-size:20px; margin-top:-25px;margin-left:-30px;">Today's Schedule</h3>
                    <h3 id="currentDateDisplay" style="font-size:25px; padding-bottom:20px; margin-top:-15px; margin-left:-30px; color:#AC0727ff; font-weight: bold;"></h3>


                        <div class="calendar">

                            <div class="month">
                                <ul>
                                    <li class="prev" onclick="moveDate(-1)">&#10094;</li>
                                    <li id="monthYear"></li>
                                    <li class="next" onclick="moveDate(1)">&#10095;</li>
                                </ul>
                            </div>

                            <ul class="weekdays">   
                                <li>Mo</li>
                                <li>Tu</li>
                                <li>We</li>
                                <li>Th</li>
                                <li>Fr</li>
                                <li>Sa</li>
                                <li>Su</li>
                            </ul>

                            <ul class="days" id="days">
                                <!-- Days will be generated by JavaScript -->
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Task/Event List -->
                <div class="task-container">
                 
<div class="tasks"></div> <!-- This is where the schedules will be displayed -->




    </div>
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

      const currentDate = new Date();
let currentMonth = currentDate.getMonth();
let currentYear = currentDate.getFullYear();
let selectedDateElement = null;

function moveDate(direction) {
    currentMonth += direction;
    if (currentMonth < 0) {
        currentMonth = 11;
        currentYear--;
    } else if (currentMonth > 11) {
        currentMonth = 0;
        currentYear++;
    }
    renderCalendar();
}

function renderCalendar() {
    const daysElement = document.getElementById('days');
    daysElement.innerHTML = '';

    const monthYearElement = document.getElementById('monthYear');
    const months = [
        'January', 'February', 'March', 'April', 'May', 'June',
        'July', 'August', 'September', 'October', 'November', 'December'
    ];

    // Update month and year display
    monthYearElement.innerHTML = `${months[currentMonth]} <span style="font-size:17px">${currentYear}</span>`;

    // Get the first day of the month and the number of days in that month
    const firstDay = new Date(currentYear, currentMonth, 1).getDay();
    const daysInMonth = new Date(currentYear, currentMonth + 1, 0).getDate();

    // Fill in empty days before the first day of the month
    for (let i = 0; i < firstDay; i++) {
        daysElement.innerHTML += '<li></li>';
    }

    const today = new Date();

    // Fill in the actual days of the month
    for (let i = 1; i <= daysInMonth; i++) {
        const dayElement = document.createElement('li');
        dayElement.textContent = i;

        const dayDate = new Date(currentYear, currentMonth, i);

        // Add click event listener for all dates
        dayElement.addEventListener('click', () => selectDate(dayElement));

        // Highlight today's date
        if (dayDate.toDateString() === today.toDateString()) {
            dayElement.classList.add('today'); // Add a class for today's date
            selectDate(dayElement); // Optionally select today by default
        }

        daysElement.appendChild(dayElement);
    }
}

// Initialize calendar on page load
window.addEventListener('DOMContentLoaded', () => {
    renderCalendar(); // Render the calendar based on the current month and year

    // Display the current date
    const currentDateElement = document.getElementById('currentDateDisplay');
    const options = { year: 'numeric', month: 'long', day: 'numeric' }; // Formatting options
    currentDateElement.textContent = currentDate.toLocaleDateString('en-US', options); // Set formatted date
});

function selectDate(dayElement) {
    if (selectedDateElement) {
        selectedDateElement.classList.remove('active'); // Deselect previously selected date
    }
    dayElement.classList.add('active'); // Mark the new date as selected
    selectedDateElement = dayElement;

    const selectedDate = new Date(currentYear, currentMonth, dayElement.textContent);
    const formattedDate = selectedDate.toLocaleDateString('en-CA'); // Format as YYYY-MM-DD

    // Fetch the priestId from PHP
    const priestId = <?php echo json_encode($regId); ?>;

    // Make an AJAX request to fetch the schedule for the selected date
    fetch('../../Controller/getPriestSched.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `date=${formattedDate}&priestId=${priestId}`,
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .then(schedules => {
        console.log('Schedules:', schedules); // Log the fetched schedules
        updateAvailableTimes(schedules); // Update the UI with the fetched schedules
    })
    .catch(error => {
        console.error('Error fetching schedules:', error);
    });
}

function updateAvailableTimes(schedules) {
    const taskContainer = document.querySelector('.tasks');
    taskContainer.innerHTML = '';  // Clear previous tasks

    if (!schedules || schedules.length === 0) {
        taskContainer.innerHTML = '<p>No schedules available for the selected date.</p>';
        return; // Exit if no schedules found
    }

    schedules.forEach(schedule => {
        const formattedStartTime = formatTime(schedule.schedule_time); // Ensure this key matches your fetched data
        const formattedEndTime = formatTime(schedule.schedule_end_time); // Ensure this key matches your fetched data

        const taskItem = document.createElement('div');
        taskItem.classList.add('task-item');
        
        taskItem.innerHTML = `
            <div class="time-container">
                <span class="time">${formattedStartTime} - ${formattedEndTime}</span>
            </div>
            <div class="task-detail-container">
                <div class="task-detail">
                    <p>Event on: ${schedule.Event_Name}</p> <!-- Displaying the schedule date -->
              
  
                </div>
            </div>
        `;

        taskContainer.appendChild(taskItem);
    });
}

function formatTime(time) {
    const [hours, minutes] = time.split(':');
    const suffix = hours >= 12 ? 'PM' : 'AM';
    const formattedHours = hours % 12 || 12; // Convert to 12-hour format
    return `${formattedHours}:${minutes} ${suffix}`; // Return formatted time
}


    </script>   
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="lib/chart/chart.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>
    <script src="js/main.js"></script>
   
</body>
</html>