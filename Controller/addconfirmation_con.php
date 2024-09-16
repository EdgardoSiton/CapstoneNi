<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';
require 'phpmailer/src/Exception.php';
require __DIR__ . "/vendor/autoload.php";
require_once __DIR__ . '/../Model/staff_mod.php';
require_once __DIR__ . '/../Model/db_connection.php'; 
require_once __DIR__ . '/../Model/citizen_mod.php';
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $payableAmount = $_POST['eventTitle']; 
    $confirmationfill_id = $_POST['confirmation_id']; 
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
} else {
    // Display an error message if insertion fails
    echo "Error inserting record. Please try again.";
}

// Close the database connection
$conn->close();
?>
