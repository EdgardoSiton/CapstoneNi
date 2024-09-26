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
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Initialize variables
    $sunday = $start_time = $end_time = $priestId = $payableAmount = null;
    $baptismfill_id = isset($_POST['baptismfill_id']) ? $_POST['baptismfill_id'] : null;
    $massbaptismfillId = isset($_POST['massbaptismfill_id']) ? $_POST['massbaptismfill_id'] : null;

    // Check if baptism is selected
    if ($baptismfill_id) {
        if (isset($_POST['sundays'])) {
            $selected_sunday = explode('|', $_POST['sundays']);
            if (count($selected_sunday) === 4) {
                list($schedule_id, $sunday, $start_time, $end_time) = $selected_sunday;
            } else {
                die('Error: Expected 4 values, but received fewer.');
            }
        }

        $priestId = $_POST['eventType'] ?? null;
        $payableAmount = $_POST['eventTitle'] ?? null;
        $citizen_id = isset($_SESSION['citizen_id']) ? $_SESSION['citizen_id'] : null;

        // Check that all required fields are present
        if (!$sunday || !$start_time || !$end_time || !$payableAmount || !$priestId) {
            die('Error: Missing required form data.');
        }

        $appointment = new Staff($conn);
        $scheduleId = $appointment->insertSchedule($sunday, $start_time, $end_time, 'Seminar');

        if ($scheduleId) {
            $result = $appointment->insertAppointment($baptismfill_id, $payableAmount, $priestId, $scheduleId);
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
    } else {
        echo "Error: No valid form data provided.";
    }
    
}

// Close the database connection
$conn->close();
?>
