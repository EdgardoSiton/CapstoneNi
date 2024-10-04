<?php
session_start();
$email = $_SESSION['email'];
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
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

 
  </head>
  <body>
  <?php  require_once 'sidebar.php'?>
      <div class="main-panel">
      <?php  require_once 'header.php'?>
        
        <div class="container">
            <div class="page-inner">
           
              <div class="row">
                <div class="col-md-12">
                  <div class="card">
                    <div class="card-header">
                      <div class="card-title">Citizen Schedule All Details</div>
                    </div>
                    <div class="card-body">
                      <div class="row">
                        <div class="col-md-6 col-lg-4">
                          <div class="form-group">
                            <label for="email2">Date</label>
                            <input
                              type="email"
                              class="form-control"
                              id="email2"
                              placeholder="2024-7-30"
                              disabled
                            />
                           
                          </div>
                          <div class="form-group">
                            <label for="password">Fullname of person to be baptize</label>
                            <input
                              type="password"
                              class="form-control"
                              id="password"
                              placeholder="Enter Fullname"
                            />
                          </div>
                          <div class="form-group">
                            <label for="password">Address</label>
                            <input
                              type="password"
                              class="form-control"
                              id="password"
                              placeholder="Enter Address"
                            />
                          </div>
                          <div class="form-group">
                            <label for="password">Phone number</label>
                            <input
                              type="password"
                              class="form-control"
                              id="password"
                              placeholder="Enter Phone number"
                            />
                          </div>
                        
                          <div class="form-group">
                            <label>Gender</label><br />
                            <div class="d-flex">
                              <div class="form-check">
                                <input
                                  class="form-check-input"
                                  type="radio"
                                  name="flexRadioDefault"
                                  id="flexRadioDefault1"
                                />
                                <label
                                  class="form-check-label"
                                  for="flexRadioDefault1"
                                >
                                  Male
                                </label>
                              </div>
                              <div class="form-check">
                                <input
                                  class="form-check-input"
                                  type="radio"
                                  name="flexRadioDefault"
                                  id="flexRadioDefault2"
                                  checked
                                />
                                <label
                                  class="form-check-label"
                                  for="flexRadioDefault2"
                                >
                                  Female
                                </label>
                              </div>
                            </div>
                          </div>
                         
        
                        </div>
                        <div class="col-md-6 col-lg-4">
                            <div class="form-group">
                                <label for="email2">Start Time</label>
                            <input
                              type="email"
                              class="form-control"
                              id="email2"
                              placeholder="10:00AM - 11:00AM"
                              disabled
                            />
                           
                              </div>
                             
                              <div class="form-group">
                                <label for="password">Place of Birth</label>
                                <input
                                  type="password"
                                  class="form-control"
                                  id="password"
                                  placeholder="Enter Place of Birth"
                                />
                              </div>
                            <div class="form-group">
                                <label for="password">Date of Birth</label>
                                <input
                                  type="date"
                                  class="form-control"
                                  id="password"
                                  placeholder="Enter Date of Birth"
                                />
                              </div>
                              
                              <div class="form-group">
                                <label for="password">Father's Fullname</label>
                                <input
                                  type="password"
                                  class="form-control"
                                  id="password"
                                  placeholder="Enter Father's Fullname"
                                />
                              </div>
                              <div class="form-group">
                                <label for="password">Mother's Fullname</label>
                                <input
                                  type="password"
                                  class="form-control"
                                  id="password"
                                  placeholder="Enter Mother's Fullname"
                                />
                              </div>
                             
                            
                            </div>
                            <div class="col-md-6 col-lg-4">
                                <div class="form-group">
                                    <label for="email2">Start Time</label>
                                    <input
                                      type="email"
                                      class="form-control"
                                      id="email2"
                                      placeholder="10:00AM - 11:00AM"
                                      disabled
                                    />
                                   
                                  </div>
                                  <div class="form-group">
                                    <label for="comment">Parent's Residence  </label>
                                    <textarea class="form-control" id="comment" rows="5">
                                    </textarea>
                                  </div>
                                  <div class="form-group">
                                    <label for="comment">List of Godparents</label>
                                    <textarea class="form-control" id="comment" rows="5">
                                    </textarea>
                                  </div>
                                
                                
                                </div>
                          </div>    
                     
                    <div class="card-action">
                      <button class="btn btn-success">Submit</button>
                      <button class="btn btn-danger">Cancel</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
  
            

        
      </div>

   
    </div>
    <!--   Core JS Files   -->
    <script src="../assets/js/core/jquery-3.7.1.min.js"></script>
    <script src="../assets/js/core/popper.min.js"></script>
    <script src="../assets/js/core/bootstrap.min.js"></script>

    <!-- jQuery Scrollbar -->
    <script src="../assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>
    <!-- Datatables -->
    <script src="../assets/js/plugin/datatables/datatables.min.js"></script>
    <!-- Kaiadmin JS -->
    <script src="../assets/js/kaiadmin.min.js"></script>
    <!-- Kaiadmin DEMO methods, don't include it in your project! -->
    <script src="../assets/js/setting-demo2.js"></script>
    <script>
      $(document).ready(function () {
        $("#basic-datatables").DataTable({});

        $("#multi-filter-select").DataTable({
          pageLength: 5,
          initComplete: function () {
            this.api()
              .columns()
              .every(function () {
                var column = this;
                var select = $(
                  '<select class="form-select"><option value=""></option></select>'
                )
                  .appendTo($(column.footer()).empty())
                  .on("change", function () {
                    var val = $.fn.dataTable.util.escapeRegex($(this).val());

                    column
                      .search(val ? "^" + val + "$" : "", true, false)
                      .draw();
                  });

                column
                  .data()
                  .unique()
                  .sort()
                  .each(function (d, j) {
                    select.append(
                      '<option value="' + d + '">' + d + "</option>"
                    );
                  });
              });
          },
        });

        // Add Row
        $("#add-row").DataTable({
          pageLength: 5,    
        });

        var action =
          '<td> <div class="form-button-action"> <button type="button" data-bs-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Edit Task"> <i class="fa fa-edit"></i> </button> <button type="button" data-bs-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Remove"> <i class="fa fa-times"></i> </button> </div> </td>';

        $("#addRowButton").click(function () {
          $("#add-row")
            .dataTable()
            .fnAddData([
              $("#addName").val(),
              $("#addPosition").val(),
              $("#addOffice").val(),
              action,
            ]);
          $("#addRowModal").modal("hide");
        });
      });
    </script>
  </body>
</html>
