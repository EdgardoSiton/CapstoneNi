<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>ARGAO CHURCH MANAGEMENT SYSTEM</title>
    <meta
      content="width=device-width, initial-scale=1.0, shrink-to-fit=no"
      name="viewport"
    />
    <link rel="icon" href="assets/img/mainlogo.jpg" type="image/x-icon"
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
    </script>
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
 integrity="sha384-KyZXEAg3QhqLMpG8r+Knujsl7/1L_dstPt3HV5HzF6Gvk/e3s4Wz6iJgD/+ub2oU" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <!-- CSS Files -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="assets/css/plugins.min.css" />
    <link rel="stylesheet" href="assets/css/kaiadmin.min.css" />

    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link rel="stylesheet" href="assets/css/demo.css" />
   
  </head>
  <body>
  
     
        <div class="main-header" style="background: #0066a8 !important;width: 100%!important;     position: static!important;
        ">
          <div class="main-header-logo">
            <!-- Logo Header -->
            <div class="logo-header" data-background-color="dark">
              <a href="" class="logo">
                <img
                  src="assets/img/kaiadmin/logo_light.svg"
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
              src="assets/img/argaochurch.png"
              alt="navbar brand"
                class="navbar-brand"
                height="46"
              />
            </a>
            <div class="nav-toggle">
              
             
            </div>
           
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
                      <span class="op-7" style="color: white!important;">Welcome,</span>
                      <span class="fw-bold" style="color: white!important;">Church Priest</span>
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
        <div class="container py-9 py-lg-11 position-relative z-index-1">
            <div class="row" style="    margin-top: 80px!important; border:1px solid red;">
                <div class="col-lg-5 mb-5 mb-lg-0" >
                    <h5 style="color:#AC0727ff!important;margin-top:20px!important;" class="mb-4 text-info aos-init aos-animate" data-aos="fade-up">Parish Priest Schedule</h5>
                    <div class="nav nav-pills flex-column aos-init aos-animate" id="myTab" role="tablist"
                        data-aos="fade-up">
                        <button class="nav-link px-4 text-start mb-3 active" id="d1-tab" data-bs-toggle="tab"
                            data-bs-target="#day1" type="button" role="tab" aria-controls="day1" aria-selected="true">
                            <span class="d-block fs-5 fw-bold">Rev. Fr. Virgilio Del Mundo</span>
                            <span class="small">Sun, July 2, 2024</span>
                        </button>
    
                        <button class="nav-link px-4 text-start" id="d2-tab" data-bs-toggle="tab" data-bs-target="#day2"
                            type="button" role="tab" aria-controls="day2" aria-selected="false" tabindex="-1">
                            <span class="d-block fs-5 fw-bold">Rev. Fr. Jeremiah Adviento</span>
                            <span class="small">Tue, July 3, 2024</span>
                        </button>
                    </div>
                </div>
    
                <div class="col-lg-7 col-xl-6"  >
                    <div data-aos="fade-up" class="tab-content aos-init aos-animate" id="myTabContent">
                        <div class="tab-pane fade active show" id="day1" role="tabpanel" aria-labelledby="d1-tab">
                            <ul class="pt-4 list-unstyled mb-0">
                                <li class="d-flex flex-column flex-md-row py-4">
                                    <span class="flex-shrink-0 width-13x me-md-4 d-block mb-3 mb-md-0 small text-muted">9:00
                                        AM - 10:00 AM</span>
                                    <div class="flex-grow-1 ps-4 border-start border-3">
                                        <h4>Sunday Mass</h4>
                                        <p class="mb-0">
                                            English
                                        </p>
                                    </div>
                                </li>
                                <li class="d-flex flex-column flex-md-row py-4">
                                    <span class="flex-shrink-0 width-13x me-md-4 d-block mb-3 mb-md-0 small text-muted">10:00
                                        AM - 11:00 AM</span>
                                    <div class="flex-grow-1 ps-4 border-start border-3">
                                        <h4>Feast of St. Mary Magdalene Mass</h4>
                                        <p class="mb-0">
                                            Argao Cebu
                                        </p>
                                    </div>
                                </li>
                                <li class="d-flex flex-column flex-md-row py-4">
                                    <span class="flex-shrink-0 width-13x me-md-4 d-block mb-3 mb-md-0 small text-muted">11:00
                                        AM - 12:30 PM</span>
                                    <div class="flex-grow-1 ps-4 border-start border-3">
                                        <h4>Feast of St. Mary Magdalene Mass</h4>
                                        <p class="mb-0">
                                            Argao Cebu
                                        </p>
                                    </div>
                                </li>
                                <li class="d-flex flex-column flex-md-row py-4">
                                    <span class="flex-shrink-0 width-13x me-md-4 d-block mb-3 mb-md-0 small text-muted">12:30
                                        PM - 1:30 PM</span>
                                    <div class="flex-grow-1 ps-4 border-start border-3">
                                        <h4>Feast of St. Mary Magdalene Mass</h4>
                                        <p class="mb-0">
                                            Argao Cebu
                                        </p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="tab-pane fade" id="day2" role="tabpanel" aria-labelledby="d2-tab">
                            <ul class="pt-4 list-unstyled mb-0">
                                <li class="d-flex flex-column flex-md-row py-4">
                                    <span class="flex-shrink-0 width-13x me-md-4 d-block mb-3 mb-md-0 small text-muted">9:00
                                        AM - 10:00 AM</span>
                                    <div class="flex-grow-1 ps-4 border-start border-3">
                                        <h4>Feast of St. Mary Magdalene Mass</h4>
                                        <p class="mb-0">
                                            Argao Cebu
                                        </p>
                                    </div>
                                </li>
                               
                                <li class="d-flex flex-column flex-md-row py-4">
                                    <span class="flex-shrink-0 width-13x me-md-4 d-block mb-3 mb-md-0 small text-muted">11:00
                                        AM - 12:30 PM</span>
                                    <div class="flex-grow-1 ps-4 border-start border-3">
                                        <h4>Feast of St. Mary Magdalene Mass</h4>
                                        <p class="mb-0">
                                            Argao Cebu
                                        </p>
                                    </div>
                                </li>
    
                            </ul>
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
    <script src="assets/js/core/jquery-3.7.1.min.js"></script>
    <script src="assets/js/core/popper.min.js"></script>
    <script src="assets/js/core/bootstrap.min.js"></script>

    <!-- jQuery Scrollbar -->
    <script src="assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>

    <!-- Chart JS -->
    <script src="assets/js/plugin/chart.js/chart.min.js"></script>

    <!-- jQuery Sparkline -->
    <script src="assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js"></script>

    <!-- Chart Circle -->
    <script src="assets/js/plugin/chart-circle/circles.min.js"></script>

    <!-- Datatables -->
    <script src="assets/js/plugin/datatables/datatables.min.js"></script>


    <!-- jQuery Vector Maps -->
    <script src="assets/js/plugin/jsvectormap/jsvectormap.min.js"></script>
    <script src="assets/js/plugin/jsvectormap/world.js"></script>

    <!-- Sweet Alert -->
    <script src="assets/js/plugin/sweetalert/sweetalert.min.js"></script>

    <!-- Kaiadmin JS -->
    <script src="assets/js/kaiadmin.min.js"></script>

    <!-- Kaiadmin DEMO methods, don't include it in your project! -->
    <script src="assets/js/setting-demo.js"></script>
    <script src="assets/js/demo.js"></script>
    <script>
      $("#lineChart").sparkline([102, 109, 120, 99, 110, 105, 115], {
        type: "line",
        height: "70",
        width: "100%",
        lineWidth: "    2",
        lineColor: "#177dff",
        fillColor: "rgba(23, 125, 255, 0.14)",
      });

      $("#lineChart2").sparkline([99, 125, 122, 105, 110, 124, 115], {
        type: "line",
        height: "70",
        width: "100%",
        lineWidth: "2",
        lineColor: "#f3545d",
        fillColor: "rgba(243, 84, 93, .14)",
      });

      $("#lineChart3").sparkline([105, 103, 123, 100, 95, 105, 115], {
        type: "line",
        height: "70",
        width: "100%",
        lineWidth: "2",
        lineColor: "#ffa534",
        fillColor: "rgba(255, 165, 52, .14)",
      });
    </script>
  </body>
</html>
