<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
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

    if (isset($_POST['sundays'])) {
        // Split the selected option value into components
        $selected_sunday = explode('|', $_POST['sundays']);
        
        // Ensure 4 values are present (schedule_id, sunday, start_time, end_time)
        if (count($selected_sunday) === 4) {
            $schedule_id = $selected_sunday[0];
            $sunday = $selected_sunday[1];
            $start_time = $selected_sunday[2];
            $end_time = $selected_sunday[3];
        } else {
            echo "Error: Expected 4 values, but received fewer.";
        }
    }

    $priestId =  isset($_POST['eventType']) ? $_POST['eventType'] : null;
    $payableAmount = $_POST['eventTitle']; 
    $weddingffill_id = $_POST['marriage_id']; 
    $citizen_id = isset($_SESSION['citizen_id']) ? $_SESSION['citizen_id'] : null;
    if (!$sunday || !$start_time || !$end_time || !$payableAmount || !$weddingffill_id || !$priestId  ) {
        die('Error: Missing required form data.');
    }
    $appointment = new Staff($conn);
    $newScheduleId = $appointment->insertSchedule($sunday, $start_time, $end_time, 'Seminar');
    
    if ($newScheduleId) {
    $result = $appointment->insertwAppointment($weddingffill_id, $payableAmount,$priestId,$newScheduleId);
   
   
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
} else {
    echo "Error inserting schedule record. Please try again.";
}
} else {
    // Display an error message if insertion fails
    echo "Error inserting record. Please try again.";
}

// Close the database connection
$conn->close();
?>
