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
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
    />
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

        monthYearElement.innerHTML = ${months[currentMonth]}<br><span style="font-size:18px">${currentYear}</span>;

        const firstDay = new Date(currentYear, currentMonth, 1).getDay();
        const daysInMonth = new Date(currentYear, currentMonth + 1, 0).getDate();

        const today = new Date();
        const isCurrentMonth = today.getFullYear() === currentYear && today.getMonth() === currentMonth;

        for (let i = 1; i < firstDay; i++) {
            daysElement.innerHTML += '<li></li>';
        }

        for (let i = 1; i <= daysInMonth; i++) {
            const dayElement = document.createElement('li');
            dayElement.textContent = i;

            const dayDate = new Date(currentYear, currentMonth, i);

            if (isCurrentMonth && i === today.getDate() && !selectedDateElement) {
                dayElement.classList.add('active');
                selectedDateElement = dayElement;
            }

            if (dayDate < today) {
                dayElement.classList.add('past');
            } else {
                dayElement.addEventListener('click', () => selectDate(dayElement));
            }

            daysElement.appendChild(dayElement);
        }
    }

    function selectDate(dayElement) {
        if (selectedDateElement) {
            selectedDateElement.classList.remove('active');
        }
        dayElement.classList.add('active');
        selectedDateElement = dayElement;
    }

    document.addEventListener('DOMContentLoaded', renderCalendar);
    </script>
        <style>
 .container-cal {
            margin: 0 auto;
        }
        .calendar {
            width: 80%;
        }
        .month ul {
            list-style-type: none;
            padding: 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .weekdays, .days {
            list-style-type: none;
            padding: 0;
            display: flex;
            flex-wrap: wrap;
        }
        .weekdays li, .days li {
            width: 14.28%;
            text-align: center;
            margin-bottom: 10px;
        }
        .days li {
            cursor: pointer;
        }
        .days li.active {
            background-color: #1abc9c;
            color: white;
            border-radius: 50%;
        }
        .days li.past {
            color: #ccc;
            cursor: not-allowed;
        }
    </style>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-KyZXEAg3QhqLMpG8r+Knujsl7/1L_dstPt3HV5HzF6Gvk/e3s4Wz6iJgD/+ub2oU"
      crossorigin="anonymous"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
    />
    <!-- CSS Files -->
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="../assets/css/plugins.min.css" />
    <link rel="stylesheet" href="../assets/css/kaiadmin.min.css" />

    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link rel="stylesheet" href="../assets/css/demo.css" />
    <link rel="stylesheet" href="../assets/css/schedule.css" />
  </head>
  <body style="background: #9e9e9e47">
    <div
      class="main-header"
      style="
        background: #0066a8 !important;
        width: 100% !important;
        position: static !important;
      "
    >
      <div class="main-header-logo">
        <!-- Logo Header -->
        <div class="logo-header" data-background-color="dark">
          <a href="" class="logo">
            <img
              src="../assets/img/kaiadmin/logo_light.svg"
              alt="navbar brand"
              class="navbar-brand"
              height="20"
            />
          </a>
          <div class="nav-toggle">
            <button class="btn btn-toggle toggle-sidebar">
              <i class="gg-menu-right"></i>
            </button>
            <button class="btn btn-toggle sidenav-toggler">
              <i class="gg-menu-left"></i>
            </button>
          </div>
          <button class="topbar-toggler more">
            <i class="gg-more-vertical-alt"></i>
          </button>
        </div>
        <!-- End Logo Header -->
      </div>
      <!-- Navbar Header -->
      <nav
        class="navbar navbar-header navbar-header-transparent navbar-expand-lg border-bottom"
      >
        <div class="container-fluid">
          <div class="logo-header" data-background-color="dark">
            <a href="index.html" class="logo">
              <img
                src="../assets/img/argaochurch.png"
                alt="navbar brand"
                class="navbar-brand"
                height="46"
              />
            </a>
            <div class="nav-toggle"></div>
          </div>

          <ul class="navbar-nav topbar-nav ms-md-auto align-items-center">
            <li class="nav-item topbar-user dropdown hidden-caret">
              <a
                class="dropdown-toggle profile-pic"
                data-bs-toggle="dropdown"
                href="#"
                aria-expanded="false"
              >
                <div class="avatar">
                  <span
                    class="avatar-title rounded-circle border border-white bg-secondary"
                    >P</span
                  >
                </div>
                <span class="profile-username">
                  <span class="op-7" style="color: white !important"
                    >Welcome,</span
                  >
                  <span class="fw-bold" style="color: white !important"
                    >Church Citizen</span
                  >
                </span>
              </a>
              <ul class="dropdown-menu dropdown-user animated fadeIn">
                <div class="dropdown-user-scroll scrollbar-outer">
                  <li>
                    <div class="user-box">
                      <div class="avatar-lg">
                        <img
                          src="assets/img/profile.jpg"
                          alt="image profile"
                          class="avatar-img rounded"
                        />
                      </div>
                      <div class="u-text">
                        <h4>Church Admin</h4>
                        <p class="text-muted">argaochurch@gmail.com</p>
                        <a
                          href="profile.html"
                          class="btn btn-xs btn-secondary btn-sm"
                          >View Profile</a
                        >
                      </div>
                    </div>
                  </li>
                  <li>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">My Profile</a>
                    <a class="dropdown-item" href="#">Account Setting</a>
                    <a class="dropdown-item" href="#">Logout</a>
                  </li>
                </div>
              </ul>
            </li>
          </ul>
        </div>
      </nav>
      <!-- End Navbar -->
    </div>
  </div>
  <div class="container-cal">
    <div class="calendar">
        <h3 style="padding-top: 20px;" class="fw-bold mb-3">Select Date</h3>
        <div class="month">
            <ul>
                <li class="prev" onclick="moveDate(-1)">&#10094;</li>
                <li id="monthYear">
                    July<br>
                    <span style="font-size:18px">2024</span>
                </li>
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


<div class="schedule">

<div class="time" > 
  <h3 style="padding-top: 20px; padding-left: 10px;" class="fw-bold mb-3">Select Time</h3>
  <div style="padding-left: 70px;" class="form-group">
    <div class="d-flex">
     
      <div class="form-check">
        <input
          class="form-check-input"
          type="radio"
          name="flexRadioDefault"
          id="flexRadioDefault2"
          checked
        />
        <label
        style="padding-right: 130px;"
          class="form-check-label"
          for="flexRadioDefault2"
        >
          8:30 AM - 9:30 AM
        </label>
        <label
        class="form-check-label"
        for="flexRadioDefault2"
      >
      <h6 style="font-size: 14px; color: green; padding:0; margin: 0;">Available</h6>
    </label>
      </div>
    </div>
    <div class="d-flex">
     
      <div class="form-check">
        <input
          class="form-check-input"
          type="radio"
          name="flexRadioDefault"
          id="flexRadioDefault2"
          checked
        />
        <label
        style="padding-right: 121px;"
          class="form-check-label"
          for="flexRadioDefault2"
        >
          9:30 AM - 10:30 AM
        </label>
        <label
        style="color: red;"
        class="form-check-label"
        for="flexRadioDefault2"
      >
      <h6 style="font-size: 14px; color: red; padding:0; margin: 0;">Booked</h6>
      </label>
      </div>
    </div>
    <div class="d-flex">
     
      <div class="form-check">
        <input
          class="form-check-input"
          type="radio"
          name="flexRadioDefault"
          id="flexRadioDefault2"
          checked
        />
        <label
        style="padding-right: 115px;"
          class="form-check-label"
          for="flexRadioDefault2"
        >
        10:30 AM - 11:30 AM
      </label>
      <label
        class="form-check-label"
        for="flexRadioDefault2"
      >
      <h6 style="font-size: 14px; color: green; padding:0; margin: 0;">Available</h6>
      </label>
      </div>
    </div>
    <div class="d-flex">
      <div class="form-check">
        <input
          class="form-check-input"
          type="radio"
          name="flexRadioDefault"
          id="flexRadioDefault2"
          checked
        />
        <label
        style="padding-right: 113px;"
          class="form-check-label"
          for="flexRadioDefault2"
        >
          01:30 PM - 02:30 PM
        </label>
        <label
        class="form-check-label"
        for="flexRadioDefault2"
      >
      <h6 style="font-size: 14px; color: green; padding:0; margin: 0;">Available</h6>
      </label>
      </div>
    </div>
    <div class="d-flex">
     
      <div class="form-check">
        <input
          class="form-check-input"
          type="radio"
          name="flexRadioDefault"
          id="flexRadioDefault2"
          checked
        />
        <label
        style="padding-right: 115px;"
          class="form-check-label"
          for="flexRadioDefault2"
        >
          02:30 PM - 03:30 PM
        </label>
        <label
        class="form-check-label"
        for="flexRadioDefault2"
      >
      <h6 style="font-size: 14px; color: red; padding:0; margin: 0;">Booked</h6>
      </label>
      </div>
    </div>
    <div class="d-flex">
     
      <div class="form-check">
        <input
          class="form-check-input"
          type="radio"
          name="flexRadioDefault"
          id="flexRadioDefault2"
          checked
        />
        <label
        style="padding-right: 115px;"
          class="form-check-label"
          for="flexRadioDefault2"
        >
          03:30 PM - 04:30 PM
        </label>
        <label
        class="form-check-label"
        for="flexRadioDefault2"
      >
      <h6 style="font-size: 14px; color: red; padding:0; margin: 0;">Booked</h6>
      </label>
      </div>
    </div>
    <div class="d-flex">
     
      <div class="form-check">
        <input
          class="form-check-input"
          type="radio"
          name="flexRadioDefault"
          id="flexRadioDefault2"
          checked
        />
        <label
        style="padding-right: 117px;"
          class="form-check-label"
          for="flexRadioDefault2"
        >
          04:30 PM - 05:30 PM
        </label>
        <label
        class="form-check-label"
        for="flexRadioDefault2"
      >
      <h6 style="font-size: 14px; color: red; padding:0; margin: 0;">Booked</h6>
      </label>
      </div>
    </div>
  </div>

</div>

</div>
<button style="background: #1572e8!important; 
border: none;  
position: absolute;
top:600px;
  right: 65px;
"  class="btn btn-primary"
onclick="window.location.href='ConfirmAppointment.php';">Submit</button>
</div>
</div>


  <!-- container -->
    <script src="../assets/js/calendar.js"></script>

    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"
      integrity="sha384-KyZXEAg3QhqLMpG8r+8auK+4szKfEFbpLHsTf7iJgD/+ub2oU"
      crossorigin="anonymous"
    ></script>
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