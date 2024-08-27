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
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="../assets/css/plugins.min.css" />
    <link rel="stylesheet" href="../assets/css/kaiadmin.min.css" />

    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link rel="stylesheet" href="../assets/css/demo.css" />
   
  </head>
  <body style="background: #eee; ">
  
     
  <?php require_once 'header.php'?>
          <!-- End Navbar -->
        </div>
        <div class="container">
            <div class="page-inner">
           
              <div class="row">
                <div class="col-md-12">
                  <div class="card">
                    <div class="card-header">
                      <div class="card-title">REQUEST FORM</div>
                    </div>
                    <div class="card-body">
                      <div class="row">
                        <div class="col-md-6 col-lg-4">
                            <div class="form-group">
                                <label for="exampleFormControlSelect1"
                                  >Select Type of Mass</label
                                >
                                <select
                                  class="form-select"
                                  id="exampleFormControlSelect1"
                                >
                                  <option>Fiesta Mass</option>
                                  <option>Novena Mass</option>
                                  <option>Wake Mass</option>
                                  <option>Monthly Mass</option>
                                  <option>1st Friday Mass</option>
                                  <option>Cemetery Chapel Mass</option>
                                  <option>Baccalaureate Mass</option>
                                  <option>Anointing of the Sick</option>
                                  <option>Blessing</option>
                                  <option>Special Mass</option>
                                </select>
                              </div>
                         
                          <div class="form-group">
                            <label for="password">Chapel</label>
                            <input
                              type="text"
                              class="form-control"
                              id="password"
                              placeholder="Enter Chapel Name"
                            />
                          </div>
                          <div class="form-group">
                            <label for="password">Person Requesting</label>
                            <input
                              type="number"
                              class="form-control"
                              id="password"
                              placeholder="Enter Fullname"
                            />
                          </div>
                        <BR><br></BR>
                        <div class="form-group">
                            <div class="input-group" style="height: 40px;">
                              <span class="input-group-text">Received by:</span>
                              <textarea
                                class="form-control"
                                aria-label="With textarea"
                                style="overflow:hidden"
                              ></textarea>
                            </div>
                          </div>
                        </div>

                        <div class="col-md-6 col-lg-4">
                            <div class="form-group">
                                <label for="password">Date</label>
                                <input
                                  type="date"
                                  class="form-control"
                                  id="password"
                                  placeholder="Enter Date"
                                />
                              </div>
                             
                          
                            <div class="form-group">
                                <label for="password">Address</label>
                                <input
                                type="text"
                                class="form-control"
                                id="password"
                                placeholder="Enter Chapel Address"
                              />
                              </div>
                              
                              <div class="form-group">
                                <label for="password">Date of Follow-up</label>
                                <input
                                  type="password"
                                  class="form-control"
                                  id="password"
                                  placeholder="Enter Contact Number"
                                />
                              </div>
                              <BR><br></BR>
                              <div style="margin-bottom: 17px;" class="form-group">
                                <div class="input-group" style="height: 40px;">
                                  <span class="input-group-text">Date Received:</span>
                                  <textarea
                                  
                                    class="form-control"
                                    aria-label="With textarea"
                                    style="overflow:hidden"
                                  ></textarea>
                                </div>
                              </div>
                             
                            
                            </div>
                            <div class="col-md-6 col-lg-4">
                                <div class="form-group">
                                    <label for="password">Time</label>
                                    <input
                                      type="text"
                                      class="form-control"
                                      id="password"
                                      placeholder="Enter Time"
                                    />
                                  </div>
                                  <div class="form-group">
                                    <label for="password">Contact Number</label>
                                    <input
                                      type="password"
                                      class="form-control"
                                      id="password"
                                      placeholder="Enter Contact Number"
                                    />
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"
        integrity="sha384-KyZXEAg3QhqLMpG8r+8auK+4szKfEFbpLHsTf7iJgD/+ub2oU" crossorigin="anonymous"></script>
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
