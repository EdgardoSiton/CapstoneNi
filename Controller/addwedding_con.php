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
    $weddingffill_id = isset($_POST['marriage_id']) ? $_POST['marriage_id'] : null;
    $massweddingffill_id = isset($_POST['massmarriage_id']) ? $_POST['massmarriage_id'] : null;

    if ($weddingffill_id) {
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

        $priestId = isset($_POST['eventType']) ? $_POST['eventType'] : null;
        $payableAmount = $_POST['eventTitle']; 
        $citizen_id = isset($_SESSION['citizen_id']) ? $_SESSION['citizen_id'] : null;

        if (!$sunday || !$start_time || !$end_time || !$payableAmount || !$weddingffill_id || !$priestId) {
            die('Error: Missing required form data.');
        }

        $appointment = new Staff($conn);
        $scheduleId = $appointment->insertSchedule($sunday, $start_time, $end_time, 'Seminar');

        if ($scheduleId) {
            $result = $appointment->insertwAppointment($weddingffill_id, $payableAmount, $priestId, $scheduleId);
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
    } elseif ($massweddingffill_id) {
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
    } else {
        echo "Error: No valid form data provided.";
    }
}

// Close the database connection
$conn->close();
?>
