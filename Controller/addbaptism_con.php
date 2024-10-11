<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';
require 'phpmailer/src/Exception.php';
require __DIR__ . "/../vendor/autoload.php";
require_once __DIR__ . '/../Model/staff_mod.php';
require_once __DIR__ . '/../Model/db_connection.php';
require_once __DIR__ . '/../Model/citizen_mod.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $staff = new Staff($conn);
    $Citizen = new Citizen($conn);
    $requestform_id = isset($_POST['requestform_id']) ? $_POST['requestform_id'] : null;
    $baptismfill_id = isset($_POST['baptismfill_id']) ? $_POST['baptismfill_id'] : null;
     $confirmationfill_id = isset($_POST['confirmationfill_id']) ? $_POST['confirmationfill_id'] : null;
    $massbaptismfillId = isset($_POST['massbaptismfill_id']) ? $_POST['massbaptismfill_id'] : null;
    $weddingffill_id = isset($_POST['marriage_id']) ? $_POST['marriage_id'] : null;
    $massweddingffill_id = isset($_POST['massmarriage_id']) ? $_POST['massmarriage_id'] : null;
    $defuctomfill_id = isset($_POST['defuctom_id']) ? $_POST['defuctom_id'] : null;
   // Handle Baptism
   



    if ($baptismfill_id) {
    $sunday = $start_time = $end_time = $priestId = $payableAmount = null;
        if (isset($_POST['sundays'])) {
            $selected_sunday = explode('|', $_POST['sundays']);
            if (count($selected_sunday) === 4) {
                list($schedule_id, $sunday, $start_time, $end_time) = $selected_sunday;
            } else {
                die('Error: Expected 4 values, but received fewer.');
            }
        }

 
        $payableAmount = $_POST['eventTitle'] ?? null;
        $citizen_id = isset($_SESSION['citizen_id']) ? $_SESSION['citizen_id'] : null;

        // Check that all required fields are present
        if (!$sunday || !$start_time || !$end_time || !$payableAmount) {
            die('Error: Missing required form data.');
        }

        $appointment = new Staff($conn);
        $scheduleId = $appointment->insertSchedule($sunday, $start_time, $end_time, 'Seminar');

        if ($scheduleId) {
            $result = $Citizen->insertAppointment($baptismfill_id, $payableAmount, $scheduleId);
            $result = $appointment->approveBaptism($baptismfill_id);
            if ($result) {
                $contactInfo = $appointment->getContactInfoAndTitle($baptismfill_id);

                if ($contactInfo) {
                    $email = $contactInfo['email'];
                    $citizen_name = $contactInfo['fullname'];
                    $title = $contactInfo['event_name'];
                    try {
                        $mail = new PHPMailer(true);
                        $mail->isSMTP();
                        $mail->Host = "smtp.gmail.com";
                        $mail->SMTPAuth = true;
                        $mail->Username = "argaoparishchurch@gmail.com";
                        $mail->Password = "xomoabhlnrlzenur";
                        $mail->SMTPSecure = 'tls';
                        $mail->Port = 587;

                        $mail->setFrom('argaoparishchurch@gmail.com');
                        $mail->addAddress($email);
                        $mail->addEmbeddedImage('signature.png', 'signature_img');
                        $mail->addEmbeddedImage('logo.jpg', 'background_img');
                        $mail->isHTML(true);
                        $mail->Subject = "Appointment Schedule Confirmation";
                        $mail->Body = "
                        <div style='width: 100%; max-width: 400px; margin: auto; background: url(cid:background_img) no-repeat center center; background-size: cover; padding: 20px;'>
                            <div style='background: rgba(255, 255, 255, 0.8); padding: 20px;width:100%;height:auto;'>
                                Dear {$citizen_name},<br><br>Your appointment schedule for '{$title}' has been confirmed. ₱{$payableAmount}.00<br>Please make sure to pay the said amount in the church office on the day of your appointment.<br><br>Thank you.<br>
                                <img src='cid:signature_img' style='width: 200px; height: auto;'>
                            </div>
                        </div>";

                        if ($mail->send()) {
                            echo "Email notification sent successfully.";
                        } else {
                            echo "Error sending email notification: " . $mail->ErrorInfo;
                        }
                    } catch (Exception $e) {
                        echo "Error sending email notification: " . $e->getMessage();
                    }

                    // Redirect to a success page
                    header('Location: ../View/PageStaff/StaffSoloSched.php');
                    exit();
                } else {
                    echo "No contact information found for the given baptism fill ID.";
                }
            } else {
                echo "Error updating status. Please try again.";
            }
        } else {
            echo "Error inserting schedule record. Please try again.";
        }
    } elseif ($massbaptismfillId) {
        // Handle mass baptism
        $payableAmount = $_POST['eventTitle'] ?? null;
        $citizen_id = isset($_SESSION['citizen_id']) ? $_SESSION['citizen_id'] : null;
    
        // Check that all required fields are present
        if (!$payableAmount) {
            die('Error: Missing required form data for mass baptism.');
        }
    
        $appointment = new Staff($conn);
      
        // Attempt to insert the mass appointment
        $insertResult = $appointment->insertMassAppointment($massbaptismfillId,NULL, $payableAmount);
        
        // If insert is successful, then attempt to approve the baptism
        if ($insertResult) {
            $approvalResult = $appointment->approveBaptism($massbaptismfillId); // Ensure you have this method in your Staff class
    
            if ($approvalResult) {
                $contactInfo = $appointment->getContactInfoAndTitle(null,$massbaptismfillId);
    
                if ($contactInfo) {
                    $email = $contactInfo['email'];
                    $citizen_name = $contactInfo['fullname'];
                    $title = $contactInfo['event_name'];
                    try {
                        $mail = new PHPMailer(true);
                        $mail->isSMTP();
                        $mail->Host = "smtp.gmail.com";
                        $mail->SMTPAuth = true;
                        $mail->Username = "argaoparishchurch@gmail.com";
                        $mail->Password = "xomoabhlnrlzenur";
                        $mail->SMTPSecure = 'tls';
                        $mail->Port = 587;
    
                        $mail->setFrom('argaoparishchurch@gmail.com');
                        $mail->addAddress($email);
                        $mail->addEmbeddedImage('signature.png', 'signature_img');
                        $mail->addEmbeddedImage('logo.jpg', 'background_img');
                        $mail->isHTML(true);
                        $mail->Subject = "Mass Baptism Schedule Confirmation";
                        $mail->Body = "
                        <div style='width: 100%; max-width: 400px; margin: auto; background: url(cid:background_img) no-repeat center center; background-size: cover; padding: 20px;'>
                            <div style='background: rgba(255, 255, 255, 0.8); padding: 20px;width:100%;height:auto;'>
                                Dear {$citizen_name},<br><br>Your mass baptism schedule for '{$title}' has been confirmed. ₱{$payableAmount}.00<br>Please make sure to pay the said amount in the church office on the day of your appointment.<br><br>Thank you.<br>
                                <img src='cid:signature_img' style='width: 200px; height: auto;'>
                            </div>
                        </div>";
    
                        if ($mail->send()) {
                            echo "Email notification sent successfully.";
                        } else {
                            echo "Error sending email notification: " . $mail->ErrorInfo;
                        }
                    } catch (Exception $e) {
                        echo "Error sending email notification: " . $e->getMessage();
                    }
    
                    // Redirect to a success page
                    header('Location: ../View/PageStaff/StaffSoloSched.php');
                    exit();
                } else {
                    echo "No contact information found for the given mass baptism fill ID.";
                }
            } else {
                echo "Error updating status for mass baptism. Please try again.";
            }
        } else {
            echo "Error inserting mass appointment. Please try again.";
        }
    }else if($weddingffill_id){
        if (isset($_POST['sundays'])) {
            $selected_sunday = explode('|', $_POST['sundays']);
            if (count($selected_sunday) === 4) {
                $schedule_id = $selected_sunday[0];
                $sunday = $selected_sunday[1];
                $start_time = $selected_sunday[2];
                $end_time = $selected_sunday[3];
            } else {
                die("Error: Expected 4 values for sundays.");
            }
        } else {
            die("Error: No sundays data provided.");
        }

       
        $payableAmount = $_POST['eventTitle']; 
        $citizen_id = isset($_SESSION['citizen_id']) ? $_SESSION['citizen_id'] : null;

        if (!$sunday || !$start_time || !$end_time || !$payableAmount || !$weddingffill_id) {
            die('Error: Missing required form data.');
        }

        $appointment = new Staff($conn);
        $scheduleId = $appointment->insertSchedule($sunday, $start_time, $end_time, 'Seminar');

        if ($scheduleId) {
            $result = $appointment->insertwAppointment($weddingffill_id, $payableAmount, $scheduleId);
            $result = $appointment->approveWedding($weddingffill_id);
            
            if ($result) {
                $contactInfo = $appointment->getWeddingContactInfoAndTitles($weddingffill_id);

                if ($contactInfo) {
                    $email = $contactInfo['email'];
                    $citizen_name = $contactInfo['fullname'];
                    $title = $contactInfo['event_name'];

                    try {
                        $mail = new PHPMailer(true);
                        $mail->isSMTP();
                        $mail->Host = "smtp.gmail.com";
                        $mail->SMTPAuth = true;
                        $mail->Username = "argaoparishchurch@gmail.com";
                        $mail->Password = "xomoabhlnrlzenur";
                        $mail->SMTPSecure = 'tls';
                        $mail->Port = 587;

                        $mail->setFrom('argaoparishchurch@gmail.com');
                        $mail->addAddress($email);
                        $mail->addEmbeddedImage('signature.png', 'signature_img');
                        $mail->addEmbeddedImage('logo.jpg', 'background_img');
                        $mail->isHTML(true);
                        $mail->Subject = "Appointment Schedule Confirmation";
                        $mail->Body = "
                        <div style='width: 100%; max-width: 400px; margin: auto; background: url(cid:background_img) no-repeat center center; background-size: cover; padding: 20px;'>
                            <div style='background: rgba(255, 255, 255, 0.8); padding: 20px;width:100%;height:auto;'>
                                Dear {$citizen_name},<br><br>Your appointment schedule for '{$title}' has been confirmed. ₱{$payableAmount}.00<br>Please make sure to pay the said amount in the church office on the day of your appointment.<br><br>Thank you.<br>
                                <img src='cid:signature_img' style='width: 200px; height: auto;'>
                            </div>
                        </div>";

                        if ($mail->send()) {
                            echo "Email notification sent successfully.";
                        } else {
                            echo "Error sending email notification: " . $mail->ErrorInfo;
                        }
                    } catch (Exception $e) {
                        echo "Error sending email notification: " . $e->getMessage();
                    }

                    // Redirect to a success page
                    header('Location: ../View/PageStaff/StaffSoloSched.php');
                    exit();
                } else {
                    echo "No contact information found for the given wedding ID.";
                }
            } else {
                echo "Error updating status. Please try again.";
            }
        } else {
            echo "Error inserting schedule record. Please try again.";
        }
    }else if($massweddingffill_id){
 // Handle mass wedding
 $payableAmount = $_POST['eventTitle'] ?? null;
 $citizen_id = isset($_SESSION['citizen_id']) ? $_SESSION['citizen_id'] : null;

 if (!$payableAmount) {
     die('Error: Missing required form data for mass wedding.');
 }

 $appointment = new Staff($conn);
 $insertResult = $appointment->insertMassAppointment(null,$massweddingffill_id, $payableAmount);

 if ($insertResult) {
     $approvalResult = $appointment->approveWedding($massweddingffill_id);

     if ($approvalResult) {
         $contactInfo = $appointment->getWeddingContactInfoAndTitles(NULL,$massweddingffill_id);

         if ($contactInfo) {
             $email = $contactInfo['email'];
             $citizen_name = $contactInfo['fullname'];
             $title = $contactInfo['event_name'];

             try {
                 $mail = new PHPMailer(true);
                 $mail->isSMTP();
                 $mail->Host = "smtp.gmail.com";
                 $mail->SMTPAuth = true;
                 $mail->Username = "argaoparishchurch@gmail.com";
                 $mail->Password = "xomoabhlnrlzenur";
                 $mail->SMTPSecure = 'tls';
                 $mail->Port = 587;

                 $mail->setFrom('argaoparishchurch@gmail.com');
                 $mail->addAddress($email);
                 $mail->addEmbeddedImage('signature.png', 'signature_img');
                 $mail->addEmbeddedImage('logo.jpg', 'background_img');
                 $mail->isHTML(true);
                 $mail->Subject = "Mass Wedding Schedule Confirmation";
                 $mail->Body = "
                 <div style='width: 100%; max-width: 400px; margin: auto; background: url(cid:background_img) no-repeat center center; background-size: cover; padding: 20px;'>
                     <div style='background: rgba(255, 255, 255, 0.8); padding: 20px;width:100%;height:auto;'>
                         Dear {$citizen_name},<br><br>Your mass wedding schedule for '{$title}' has been confirmed. ₱{$payableAmount}.00<br>Please make sure to pay the said amount in the church office on the day of your appointment.<br><br>Thank you.<br>
                         <img src='cid:signature_img' style='width: 200px; height: auto;'>
                     </div>
                 </div>";

                 if ($mail->send()) {
                     echo "Email notification sent successfully.";
                 } else {
                     echo "Error sending email notification: " . $mail->ErrorInfo;
                 }
             } catch (Exception $e) {
                 echo "Error sending email notification: " . $e->getMessage();
             }

             // Redirect to a success page
             header('Location: ../View/PageStaff/StaffSoloSched.php');
             exit();
         } else {
             echo "No contact information found for the given mass wedding ID.";
         }
     } else {
         echo "Error updating status for mass wedding. Please try again.";
     }
 } else {
     echo "Error inserting mass appointment. Please try again.";
 }
    }else if($defuctomfill_id){
 // Capture form data
 $priestId = isset($_POST['eventType']) ? $_POST['eventType'] : null;
 $payableAmount = isset($_POST['eventTitle']) ? $_POST['eventTitle'] : null;
 
 $citizen_id = isset($_SESSION['citizen_id']) ? $_SESSION['citizen_id'] : null;
 
 // Check for missing required form data
 if (!$payableAmount || !$defuctomfill_id || !$priestId) {
     die('Error: Missing required form data.');
 }

 // Initialize Staff object with connection
 $appointment = new Staff($conn);
 
 // Insert appointment without $newScheduleId
 $result = $appointment->insertfAppointment($defuctomfill_id, $payableAmount, $priestId);

 if ($result) {
     // Approve the funeral appointment
     $result = $appointment->approveFuneral($defuctomfill_id);
     
     // Get contact information for the funeral
     $contactInfo = $appointment->getFuneralContactInfoAndTitles($defuctomfill_id);

     if ($contactInfo) {
         // Email details
         $email = $contactInfo['email'];
         $citizen_name = $contactInfo['fullname']; 
         $title = $contactInfo['event_name']; 

         try {
             // Set up PHPMailer
             $mail = new PHPMailer(true);
             $mail->isSMTP();
             $mail->Host = "smtp.gmail.com";
             $mail->SMTPAuth = true;
             $mail->Username = "argaoparishchurch@gmail.com";
             $mail->Password = "xomoabhlnrlzenur";
             $mail->SMTPSecure = 'tls';
             $mail->Port = 587;
 
             // Email settings
             $mail->setFrom('argaoparishchurch@gmail.com');
             $mail->addAddress($email);
             $mail->addEmbeddedImage('signature.png', 'signature_img');
             $mail->addEmbeddedImage('logo.jpg', 'background_img');
             $mail->isHTML(true);
             $mail->Subject = "Appointment Schedule Confirmation";
             $mail->Body = "
             <div style='width: 100%; max-width: 400px; margin: auto; background: url(cid:background_img) no-repeat center center; background-size: cover; padding: 20px;'>
                 <div style='background: rgba(255, 255, 255, 0.8); padding: 20px;width:100%;height:auto;'>
                     Dear {$citizen_name},<br><br>Your appointment schedule for '{$title}' has been confirmed. ₱{$payableAmount}.00<br>Please make sure to pay the said amount in the church office on the day of your appointment.<br><br>Thank you.<br>
                     <img src='cid:signature_img' style='width: 200px; height: auto;'>
                 </div>
             </div>";
         
             if ($mail->send()) {
                 echo "Email notification sent successfully.";
             } else {
                 echo "Error sending email notification: " . $mail->ErrorInfo;
             }
         } catch (Exception $e) {
             echo "Error sending email notification: " . $e->getMessage();
         }

         // Redirect to a success page
         header('Location: ../View/PageStaff/StaffSoloSched.php');
         exit();
     } else {
         echo "No contact information found for the given defuctom fill ID.";
     }
 } else {
     echo "Error updating status. Please try again.";
 }
}else if($confirmationfill_id ){
    

    $sunday = $start_time = $end_time = $baptismfill_id = $priestId = $payableAmount = null;

    // Process POST data
    if (isset($_POST['sundays'])) {
        $selected_sunday = explode('|', $_POST['sundays']);
        if (count($selected_sunday) === 4) {
            list($schedule_id, $sunday, $start_time, $end_time) = $selected_sunday;
        } else {
            die('Error: Expected 4 values, but received fewer.');
        }
    }
    $priestId = $_POST['eventType'] ?? null;
    $payableAmount = $_POST['eventTitle']; 

    $appointment = new Staff($conn);
    $result = $appointment->insertcAppointment($confirmationfill_id, $payableAmount);
    $result = $appointment->approveConfirmation($confirmationfill_id);
    if ($result) {
        $contactInfo = $appointment->getContactInfoAndTitles($confirmationfill_id);

        if ($contactInfo) {
            $email = $contactInfo['email'];
            $citizen_name = $contactInfo['fullname']; 
            $title = $contactInfo['event_name']; 
            try {
                $mail = new PHPMailer(true);
                $mail->isSMTP();
                $mail->Host = "smtp.gmail.com";
                $mail->SMTPAuth = true;
                $mail->Username = "argaoparishchurch@gmail.com";
                $mail->Password = "xomoabhlnrlzenur";
                $mail->SMTPSecure = 'tls';
                $mail->Port = 587;
    
                $mail->setFrom('argaoparishchurch@gmail.com');
                $mail->addAddress($email);
                $mail->addEmbeddedImage('signature.png', 'signature_img');
                $mail->addEmbeddedImage('logo.jpg', 'background_img');
                $mail->isHTML(true);
                $mail->Subject = "Appointment Schedule Confirmation";
                $mail->Body = "z
                <div style='width: 100%; max-width: 400px; margin: auto; background: url(cid:background_img) no-repeat center center; background-size: cover; padding: 20px;'>
                    <div style='background: rgba(255, 255, 255, 0.8); padding: 20px;width:100%;height:auto;'>
                        Dear {$citizen_name},<br><br>Your appointment schedule for '{$title}' has been confirmed. ₱{$payableAmount}.00<br>Please make sure to pay the said amount in the church office on the day of your appointment.<br><br>Thank you.<br>
                        <img src='cid:signature_img' style='width: 200px; height: auto;'>
                    </div>
                </div>";
            
                if ($mail->send()) {
                    echo "Email notification sent successfully.";
                } else {
                    echo "Error sending email notification: " . $mail->ErrorInfo;
                }
            } catch (Exception $e) {
                echo "Error sending email notification: " . $e->getMessage();
            }

            // Redirect to a success page
            header('Location: ../View/PageStaff/StaffSoloSched.php');
            exit();
        } else {
            echo "No contact information found for the given baptism fill ID.";
        }
    } else {
        echo "Error updating status. Please try again.";
    }

}else if ($requestform_id) {
 
    $date = $_POST['date'] ?? '';
    $startTime = $_POST['start_time'] ?? '';
    $endTime = $_POST['end_time'] ?? '';
    $datetofollowup = $_POST['datetofollowup'] ?? '';
    $priestId = $_POST['eventType'] ?? null;
    // Collecting the names and address
    $fullname = trim(implode(' ', [$_POST['firstname'] ?? '', $_POST['middlename'] ?? '', $_POST['lastname'] ?? '']));
    $fullnames = trim(implode(' ', [$_POST['firstnames'] ?? '', $_POST['middlenames'] ?? '', $_POST['lastnames'] ?? '']));
    $chapel = $_POST['chapel'] ?? '';
    $address = $_POST['address'] ?? ''; 
    $cpnumber = $_POST['cpnumber'] ?? '';
    $selectrequest = $_POST['selectrequest'] ?? '';
    
    // Insert schedule and request form
    $scheduleId = $Citizen->insertSchedule(null, $date, $startTime, $endTime);
    $requestinside = $Citizen->insertRequestFormFill($scheduleId,$priestId, $selectrequest, $fullname, $datetofollowup, $address, $cpnumber, $fullnames, $chapel);
    
    // Insert appointment
   
    $payableAmount = $_POST['pay_amount'] ?? null;
    $appointmentResult = $Citizen->insertrequestAppointment($requestinside, $payableAmount);

    // Check if the insertions were successful
    if ($scheduleId && $appointmentResult) {
        $_SESSION['status'] = "success";
        header('Location: ../View/PageStaff/StaffDashboard.php');
        exit();
    } else {
        $_SESSION['status'] = "failure"; // Handle the failure case
    }
}
 
     
    else  {
        echo "Error: No valid form data provided.";
    }
    
}
ob_end_flush();

// Close the database connection
$conn->close();
?>
