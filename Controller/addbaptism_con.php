<?php
use PHPMailer\PHPMailer\PHPMailer;
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
    // Initialize variables
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
    $payableAmount = $_POST['eventTitle'] ?? null;
    $baptismfill_id = $_POST['baptismfill_id'] ?? null;
    $citizen_id = isset($_SESSION['citizen_id']) ? $_SESSION['citizen_id'] : null;

    // Check that all required fields are present
    if (!$sunday || !$start_time || !$end_time || !$baptismfill_id || !$priestId) {
        die('Error: Missing required form data.');
    }

    $appointment = new Staff($conn);
    $newScheduleId = $appointment->insertSchedule($sunday, $start_time, $end_time, 'Seminar');

    if ($newScheduleId) {
        $appointmentId = $appointment->insertAppointment($baptismfill_id, $priestId, $newScheduleId);

        if ($appointmentId) {
            echo "Appointment ID: " . $appointmentId . "<br>";

            if ($payableAmount) {
                $paymentResult = $appointment->insertBaptismPayment($appointmentId, $payableAmount);

                if ($paymentResult === "Payment record successfully inserted with status 'Unpaid'.") {
                    $approveResult = $appointment->approveBaptism($baptismfill_id);

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

                        header('Location: ../View/PageStaff/StaffSoloSched.php');
                        exit();
                    } else {
                        echo "No contact information found for the given baptism fill ID.";
                    }
                } else {
                    echo "Error inserting payment record.";
                }
            } else {
                echo "No payable amount found.";
            }
        } else {
            echo "Error inserting appointment record.";
        }
    } else {
        echo "Error inserting schedule record.";
    }
} else {
    echo "Invalid request method.";
}

$conn->close();
?>
