<?php
session_start();
$nme = $_SESSION['fullname'];
$regId = $_SESSION['citizend_id'];
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
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
    />
    <!-- Fonts and icons -->
    <script src="../assets/js/plugin/webfont/webfont.min.js"></script>
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

    <!-- CSS Files -->
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="../assets/css/plugins.min.css" />
    <link rel="stylesheet" href="../assets/css/kaiadmin.min.css" />

    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link rel="stylesheet" href="../assets/css/demo.css" />
  </head>
  <body>
     <!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Announcement</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="modalForm">
                <div class="modal-body">
               
                    <div class="form-group">
                        <label for="input1">Donator's Name</label>
                        <input type="text" class="form-control" id="input1" placeholder="Enter name" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="input3">Amount</label>
                        <input type="tel" class="form-control" id="input3" placeholder="Enter amount" required>
                    </div>
                    <div class="form-group">
                        <label for="input3">Donated On</label>
                        <input type="date" class="form-control" id="input3" placeholder="Enter date" required>
                    </div>
                    <div class="form-group">
                        <label for="input3">Description</label>
                        <input type="text" class="form-control" id="input3" placeholder="Enter description" required>
                    </div>
                </div>
                <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button
                              type="button"
                              class="btn btn-primary"
                              id="alert_demo_6"
                            >
                              Submit
                            </button>
                             
                </div>
            </form>
        </div>
    </div>
</div>


<?php require_once 'sidebar.php'?>

      <div class="main-panel">
      <?php require_once 'header.php'?>

        <div class="container">
          <div class="page-inner">
            <div
              class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4"
            >
              <div>
                <h3 class="fw-bold mb-3">Admin Dashboard</h3>
              </div>
              <div class="ms-md-auto py-2 py-md-0">
              <a href="#"  data-toggle="modal" data-target="#myModal" class="btn btn-primary btn-round">Add Donator</a>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-6 col-md-3">
                <div class="card card-stats card-round">
                  <div class="card-body">
                    <div class="row align-items-center">
                      <div class="col-icon">
                        <div
                          class="icon-big text-center icon-primary bubble-shadow-small"
                        >
                          <i class="fas fa-calendar-check"></i>
                        </div>
                      </div>
                      <div class="col col-stats ms-3 ms-sm-0">
                        <div class="numbers">
                          <p class="card-category">Total Event Done</p>
                          <h4 class="card-title">294</h4>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-6 col-md-3">
                <div class="card card-stats card-round">
                  <div class="card-body">
                    <div class="row align-items-center">
                      <div class="col-icon">
                        <div
                          class="icon-big text-center icon-info bubble-shadow-small"
                        >
                          <i class="fas fa-coins"></i>
                        </div>
                      </div>
                      <div class="col col-stats ms-3 ms-sm-0">
                        <div class="numbers">
                          <p class="card-category">Total Donation Amount</p>
                          <h4 class="card-title"><span>&#8369;</span>13,303</h4>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-6 col-md-3">
                <div class="card card-stats card-round">
                  <div class="card-body">
                    <div class="row align-items-center">
                      <div class="col-icon">
                        <div
                          class="icon-big text-center icon-success bubble-shadow-small"
                        >
                          <i class="fas fa-coins"></i>
                        </div>
                      </div>
                      <div class="col col-stats ms-3 ms-sm-0">
                        <div class="numbers">
                          <p class="card-category">Total Financial Amount</p>
                          <h4 class="card-title"><span>&#8369;</span>16,345</h4>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-md-8" style="width: 99.666667%">
              <div class="card card-round">
                <div class="card-header">
                  <div class="card-head-row card-tools-still-right">
                    <div class="card-title">Transaction History</div>
                    <div class="card-tools">
                      <div class="dropdown">
                        <button
                          class="btn btn-icon btn-clean me-0"
                          type="button"
                          id="dropdownMenuButton"
                          data-bs-toggle="dropdown"
                          aria-haspopup="true"
                          aria-expanded="false"
                        >
                          <i class="fas fa-ellipsis-h"></i>
                        </button>
                        <div
                          class="dropdown-menu"
                          aria-labelledby="dropdownMenuButton"
                        >
                          <a class="dropdown-item" href="#">Action</a>
                          <a class="dropdown-item" href="#">Another action</a>
                          <a class="dropdown-item" href="#"
                            >Something else here</a
                          >
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="card-body p-0">
                  <div class="table-responsive">
                    <!-- Projects table -->
                    <table class="table align-items-center mb-0">
                      <thead class="thead-light">
                        <tr>
                          <th scope="col">Payment Number</th>
                          <th scope="col" class="text-end">Date & Time</th>
                          <th scope="col" class="text-end">Amount</th>
                          <th scope="col" class="text-end">Status</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <th scope="row">
                            <button
                              class="btn btn-icon btn-round btn-success btn-sm me-2"
                            >
                              <i class="fa fa-check"></i>
                            </button>
                            Payment from #10231
                          </th>
                          <td class="text-end">July 20, 2024, 2.45pm</td>
                          <td class="text-end">
                            <span>&#8369;</span> 3,500.00
                          </td>
                          <td class="text-end">
                            <span class="badge badge-success">Completed</span>
                          </td>
                        </tr>
                        <tr>
                          <th scope="row">
                            <button
                              class="btn btn-icon btn-round btn-success btn-sm me-2"
                            >
                              <i class="fa fa-check"></i>
                            </button>
                            Payment from #10231
                          </th>
                          <td class="text-end">July 20, 2024, 2.45pm</td>
                          <td class="text-end">
                            <span>&#8369;</span> 3,500.00
                          </td>
                          <td class="text-end">
                            <span class="badge badge-success">Completed</span>
                          </td>
                        </tr>
                        <tr>
                          <th scope="row">
                            <button
                              class="btn btn-icon btn-round btn-success btn-sm me-2"
                            >
                              <i class="fa fa-check"></i>
                            </button>
                            Payment from #10231
                          </th>
                          <td class="text-end">July 20, 2024, 2.45pm</td>
                          <td class="text-end">
                            <span>&#8369;</span> 3,500.00
                          </td>
                          <td class="text-end">
                            <span class="badge badge-success">Completed</span>
                          </td>
                        </tr>
                        <tr>
                          <th scope="row">
                            <button
                              class="btn btn-icon btn-round btn-success btn-sm me-2"
                            >
                              <i class="fa fa-check"></i>
                            </button>
                            Payment from #10231
                          </th>
                          <td class="text-end">July 20, 2024, 2.45pm</td>
                          <td class="text-end">
                            <span>&#8369;</span> 3,500.00
                          </td>
                          <td class="text-end">
                            <span class="badge badge-success">Completed</span>
                          </td>
                        </tr>
                        <tr>
                          <th scope="row">
                            <button
                              class="btn btn-icon btn-round btn-success btn-sm me-2"
                            >
                              <i class="fa fa-check"></i>
                            </button>
                            Payment from #10231
                          </th>
                          <td class="text-end">July 20, 2024, 2.45pm</td>
                          <td class="text-end">
                            <span>&#8369;</span> 3,500.00
                          </td>
                          <td class="text-end">
                            <span class="badge badge-success">Completed</span>
                          </td>
                        </tr>
                        <tr>
                          <th scope="row">
                            <button
                              class="btn btn-icon btn-round btn-success btn-sm me-2"
                            >
                              <i class="fa fa-check"></i>
                            </button>
                            Payment from #10231
                          </th>
                          <td class="text-end">July 20, 2024, 2.45pm</td>
                          <td class="text-end">
                            <span>&#8369;</span> 3,500.00
                          </td>
                          <td class="text-end">
                            <span class="badge badge-success">Completed</span>
                          </td>
                        </tr>
                        <tr>
                          <th scope="row">
                            <button
                              class="btn btn-icon btn-round btn-success btn-sm me-2"
                            >
                              <i class="fa fa-check"></i>
                            </button>
                            Payment from #10231
                          </th>
                          <td class="text-end">July 20, 2024, 2.45pm</td>
                          <td class="text-end">
                            <span>&#8369;</span> 3,500.00
                          </td>
                          <td class="text-end">
                            <span class="badge badge-success">Completed</span>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
        <!-- jQuery first -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<!-- Popper.js (required for Bootstrap 4) -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
<!-- Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <!-- Sweet Alert -->
  <script src="../assets/js/plugin/sweetalert/sweetalert.min.js"></script>
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

    <!-- Chart Circle -->
    <script src="../assets/js/plugin/chart-circle/circles.min.js"></script>

    <!-- Datatables -->
    <script src="../assets/js/plugin/datatables/datatables.min.js"></script>

    <!-- jQuery Vector Maps -->
    <script src="../assets/js/plugin/jsvectormap/jsvectormap.min.js"></script>
    <script src="../assets/js/plugin/jsvectormap/world.js"></script>

    <!-- Kaiadmin JS -->
    <script src="../assets/js/kaiadmin.min.js"></script>

    <!-- Kaiadmin DEMO methods, don't include it in your project! -->
    <script src="../assets/js/setting-demo.js"></script>
    <script src="../assets/js/demo.js"></script>
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
     <script>
      //== Class definition
      var SweetAlert2Demo = (function () {
        //== Demos
        var initDemos = function () {
          //== Sweetalert Demo 1
        

        


          $("#alert_demo_6").click(function (e) {
            swal("Event added successfully!", {
              icon: "success",  
              buttons: false,
              timer: 1000,
            });
          });

       

        };

        return {
          //== Init
          init: function () {
            initDemos();
          },
        };
      })();

      //== Class Initialization
      jQuery(document).ready(function () {
        SweetAlert2Demo.init();
      });
    </script>
  </body>
</html>
