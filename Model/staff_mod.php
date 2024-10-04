<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require_once __DIR__ . '/../Controller/phpmailer/src/PHPMailer.php'; // Ensure this uses require_once
require_once __DIR__ . '/../Controller/phpmailer/src/SMTP.php';
require_once __DIR__ . '/../Controller/phpmailer/src/Exception.php';
require_once  __DIR__ . '/../vendor/autoload.php';
class Staff {
    private $conn;
    private $regId;

    public function __construct($conn, $regId = null) {
        $this->conn = $conn;
        $this->regId = $regId;
    }
    public function deleteMassWedding($massweddingffill_id) {
        // Combine logic to retrieve contact info and title
        $sql = "
        SELECT 
        c.citizend_id, 
        c.fullname,
        c.email, 
        c.phone, 
        mf.event_name 
    FROM 
        citizen c 

    JOIN 
        marriagefill mf ON c.citizend_id = mf.citizen_id 
    WHERE 
        mf.marriagefill_id = ?"; // Ensure this column name matches your schema
    
        $stmt = $this->conn->prepare($sql);
        if (!$stmt) {
            return json_encode(['success' => false, 'message' => 'SQL prepare error.']);
        }
    
        $stmt->bind_param("i", $massweddingffill_id);
        $stmt->execute();
        $result = $stmt->get_result();
    
        if ($result->num_rows > 0) {
            // Retrieve contact info
            $contactInfo = $result->fetch_assoc();
            $email = $contactInfo['email'];
            $citizen_name = $contactInfo['fullname'];
            $title = $contactInfo['event_name'];
        } else {
            return json_encode(['success' => false, 'message' => 'No contact info found.']);
        }
    
        // Prepare SQL to delete baptism and associated schedule
        $deleteSql = "DELETE mf
                      FROM marriagefill mf
                      WHERE mf.marriagefill_id = ?"; // Ensure this field matches your schema
    
        $deleteStmt = $this->conn->prepare($deleteSql);
        if (!$deleteStmt) {
            return json_encode(['success' => false, 'message' => 'SQL prepare error during delete.']);
        }
    
        $deleteStmt->bind_param("i", $massweddingffill_id);
    
        if ($deleteStmt->execute()) {
            // Send decline email after deletion
            $emailSent = $this->sendDeclineEmail($email, $citizen_name, "Your Appointment has been deleted.",
            "Dear {$citizen_name},<br><br>Your $title Appointment has been deleted due to unavailable capacity.<br>If you have any questions, please contact us.<br>");
    
            return $emailSent ? true : json_encode(['success' => false, 'message' => 'Email notification failed.']);
        } else {
            return json_encode(['success' => false, 'message' => 'Failed to delete the baptism.']);
        }
    }
    public function deleteMassBaptism($massbaptismfillId) {
        // Combine logic to retrieve contact info and title
        $sql = "
        SELECT 
        c.citizend_id, 
        c.fullname,
        c.email, 
        c.phone, 
        b.event_name 
    FROM 
        citizen c 

    JOIN 
        baptismfill b ON c.citizend_id = b.citizen_id 
    WHERE 
        b.baptism_id = ?"; // Ensure this column name matches your schema
    
        $stmt = $this->conn->prepare($sql);
        if (!$stmt) {
            return json_encode(['success' => false, 'message' => 'SQL prepare error.']);
        }
    
        $stmt->bind_param("i", $massbaptismfillId);
        $stmt->execute();
        $result = $stmt->get_result();
    
        if ($result->num_rows > 0) {
            // Retrieve contact info
            $contactInfo = $result->fetch_assoc();
            $email = $contactInfo['email'];
            $citizen_name = $contactInfo['fullname'];
            $title = $contactInfo['event_name'];
        } else {
            return json_encode(['success' => false, 'message' => 'No contact info found.']);
        }
    
        // Prepare SQL to delete baptism and associated schedule
        $deleteSql = "DELETE b
                      FROM baptismfill b 
                      WHERE b.baptism_id = ?"; // Ensure this field matches your schema
    
        $deleteStmt = $this->conn->prepare($deleteSql);
        if (!$deleteStmt) {
            return json_encode(['success' => false, 'message' => 'SQL prepare error during delete.']);
        }
    
        $deleteStmt->bind_param("i", $massbaptismfillId);
    
        if ($deleteStmt->execute()) {
            // Send decline email after deletion
            $emailSent = $this->sendDeclineEmail($email, $citizen_name, "Your Appointment has been deleted.",
            "Dear {$citizen_name},<br><br>Your $title Appointment has been deleted due to unavailable capacity.<br>If you have any questions, please contact us.<br>");
    
            return $emailSent ? true : json_encode(['success' => false, 'message' => 'Email notification failed.']);
        } else {
            return json_encode(['success' => false, 'message' => 'Failed to delete the baptism.']);
        }
    }
    public function deleteDefuctom($defuctom_id) {
        // Combine logic to retrieve contact info and title
        $sql = "
        SELECT 
        c.citizend_id, 
        c.fullname,
        c.email, 
        c.phone, 
        df.event_name 
    FROM 
        citizen c 
        JOIN 
        schedule s ON c.citizend_id = s.citizen_id 
        JOIN 
        defuctomfill df ON s.schedule_id = df.schedule_id 
    WHERE 
        df.defuctomfill_id = ?"; // Ensure this column name matches your schema
    
        $stmt = $this->conn->prepare($sql);
        if (!$stmt) {
            return json_encode(['success' => false, 'message' => 'SQL prepare error.']);
        }
    
        $stmt->bind_param("i", $defuctom_id);
        $stmt->execute();
        $result = $stmt->get_result();
    
        if ($result->num_rows > 0) {
            // Retrieve contact info
            $contactInfo = $result->fetch_assoc();
            $email = $contactInfo['email'];
            $citizen_name = $contactInfo['fullname'];
            $title = $contactInfo['event_name'];
        } else {
            return json_encode(['success' => false, 'message' => 'No contact info found.']);
        }
    
        // Prepare SQL to delete baptism and associated schedule
        $deleteSql = "DELETE df, s 
        FROM defuctomfill df 
        INNER JOIN schedule s ON df.schedule_id = s.schedule_id 
        WHERE df.defuctomfill_id = ?"; // Ensure this field matches your schema
    
        $deleteStmt = $this->conn->prepare($deleteSql);
        if (!$deleteStmt) {
            return json_encode(['success' => false, 'message' => 'SQL prepare error during delete.']);
        }
    
        $deleteStmt->bind_param("i", $defuctom_id);
    
        if ($deleteStmt->execute()) {
            // Send decline email after deletion
            $emailSent = $this->sendDeclineEmail($email, $citizen_name, "Your Appointment has been deleted.",
            "Dear {$citizen_name},<br><br>Your $title Appointment has been deleted due to the lack of a Priest or seminar availability.<br>If you have any questions, please contact us.<br>");
    
            return $emailSent ? true : json_encode(['success' => false, 'message' => 'Email notification failed.']);
        } else {
            return json_encode(['success' => false, 'message' => 'Failed to delete the baptism.']);
        }
    }
    public function deleteWedding($weddingffill_id) {
        // Combine logic to retrieve contact info and title
        $sql = "
        SELECT 
        c.citizend_id, 
        c.fullname,
        c.email, 
        c.phone, 
        mf.event_name 
    FROM 
        citizen c 
        JOIN 
        schedule s ON c.citizend_id = s.citizen_id 
        JOIN 
        marriagefill mf ON s.schedule_id = mf.schedule_id 
    WHERE 
        mf.marriagefill_id = ?"; // Ensure this column name matches your schema
    
        $stmt = $this->conn->prepare($sql);
        if (!$stmt) {
            return json_encode(['success' => false, 'message' => 'SQL prepare error.']);
        }
    
        $stmt->bind_param("i", $weddingffill_id);
        $stmt->execute();
        $result = $stmt->get_result();
    
        if ($result->num_rows > 0) {
            // Retrieve contact info
            $contactInfo = $result->fetch_assoc();
            $email = $contactInfo['email'];
            $citizen_name = $contactInfo['fullname'];
            $title = $contactInfo['event_name'];
        } else {
            return json_encode(['success' => false, 'message' => 'No contact info found.']);
        }
    
        // Prepare SQL to delete baptism and associated schedule
        $deleteSql = "DELETE mf, s 
        FROM marriagefill mf 
        INNER JOIN schedule s ON mf.schedule_id = s.schedule_id 
        WHERE mf.marriagefill_id = ?"; // Ensure this field matches your schema
    
        $deleteStmt = $this->conn->prepare($deleteSql);
        if (!$deleteStmt) {
            return json_encode(['success' => false, 'message' => 'SQL prepare error during delete.']);
        }
    
        $deleteStmt->bind_param("i", $weddingffill_id);
    
        if ($deleteStmt->execute()) {
            // Send decline email after deletion
            $emailSent = $this->sendDeclineEmail($email, $citizen_name, "Your Appointment has been deleted.",
            "Dear {$citizen_name},<br><br>Your $title Appointment has been deleted due to the lack of a Priest or seminar availability.<br>If you have any questions, please contact us.<br>");
    
            return $emailSent ? true : json_encode(['success' => false, 'message' => 'Email notification failed.']);
        } else {
            return json_encode(['success' => false, 'message' => 'Failed to delete the baptism.']);
        }
    }
    public function deleteConfirmation($confirmationfill_id) {
        // Combine logic to retrieve contact info and title
        $sql = "
        SELECT 
        c.citizend_id, 
        c.fullname,
        c.email, 
        c.phone, 
        cf.event_name 
    FROM 
        citizen c 

    JOIN 
        confirmationfill cf ON c.citizend_id = cf.citizen_id 
    WHERE 
        cf.confirmationfill_id = ?"; // Ensure this column name matches your schema
    
        $stmt = $this->conn->prepare($sql);
        if (!$stmt) {
            return json_encode(['success' => false, 'message' => 'SQL prepare error.']);
        }
    
        $stmt->bind_param("i", $confirmationfill_id);
        $stmt->execute();
        $result = $stmt->get_result();
    
        if ($result->num_rows > 0) {
            // Retrieve contact info
            $contactInfo = $result->fetch_assoc();
            $email = $contactInfo['email'];
            $citizen_name = $contactInfo['fullname'];
            $title = $contactInfo['event_name'];
        } else {
            return json_encode(['success' => false, 'message' => 'No contact info found.']);
        }
    
        // Prepare SQL to delete baptism and associated schedule
        $deleteSql = "DELETE cf
                      FROM confirmationfill cf 
                      WHERE cf.confirmationfill_id = ?"; // Ensure this field matches your schema
    
        $deleteStmt = $this->conn->prepare($deleteSql);
        if (!$deleteStmt) {
            return json_encode(['success' => false, 'message' => 'SQL prepare error during delete.']);
        }
    
        $deleteStmt->bind_param("i", $confirmationfill_id);
    
        if ($deleteStmt->execute()) {
            // Send decline email after deletion
            $emailSent = $this->sendDeclineEmail($email, $citizen_name, "Your Appointment has been deleted.",
            "Dear {$citizen_name},<br><br>Your $title Appointment has been deleted due to unavailable capacity.<br>If you have any questions, please contact us.<br>");
    
            return $emailSent ? true : json_encode(['success' => false, 'message' => 'Email notification failed.']);
        } else {
            return json_encode(['success' => false, 'message' => 'Failed to delete the baptism.']);
        }
    }
    
    public function deleteBaptism($baptismfill_id) {
        // Combine logic to retrieve contact info and title
        $sql = "
            SELECT 
                c.citizend_id, 
                c.fullname,
                c.email, 
                c.phone, 
                b.event_name 
            FROM 
                citizen c 
            JOIN 
                schedule s ON c.citizend_id = s.citizen_id 
            JOIN 
                baptismfill b ON s.schedule_id = b.schedule_id 
            WHERE 
                b.baptism_id = ?"; // Ensure this column name matches your schema
    
        $stmt = $this->conn->prepare($sql);
        if (!$stmt) {
            return json_encode(['success' => false, 'message' => 'SQL prepare error.']);
        }
    
        $stmt->bind_param("i", $baptismfill_id);
        $stmt->execute();
        $result = $stmt->get_result();
    
        if ($result->num_rows > 0) {
            // Retrieve contact info
            $contactInfo = $result->fetch_assoc();
            $email = $contactInfo['email'];
            $citizen_name = $contactInfo['fullname'];
            $title = $contactInfo['event_name'];
        } else {
            return json_encode(['success' => false, 'message' => 'No contact info found.']);
        }
    
        // Prepare SQL to delete baptism and associated schedule
        $deleteSql = "DELETE bf, s 
                      FROM baptismfill bf 
                      INNER JOIN schedule s ON bf.schedule_id = s.schedule_id 
                      WHERE bf.baptism_id = ?"; // Ensure this field matches your schema
    
        $deleteStmt = $this->conn->prepare($deleteSql);
        if (!$deleteStmt) {
            return json_encode(['success' => false, 'message' => 'SQL prepare error during delete.']);
        }
    
        $deleteStmt->bind_param("i", $baptismfill_id);
    
        if ($deleteStmt->execute()) {
            // Send decline email after deletion
            $emailSent = $this->sendDeclineEmail($email, $citizen_name, "Your Appointment has been deleted.",
            "Dear {$citizen_name},<br><br>Your $title Appointment has been deleted due to the lack of a Priest or seminar availability.<br>If you have any questions, please contact us.<br>");
    
            return $emailSent ? true : json_encode(['success' => false, 'message' => 'Email notification failed.']);
        } else {
            return json_encode(['success' => false, 'message' => 'Failed to delete the baptism.']);
        }
    }
    
    
    public function sendDeclineEmail($email, $citizen_name, $subject, $body) {
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
            $mail->addEmbeddedImage('../Controller/signature.png', 'signature_img');
            $mail->addEmbeddedImage('../Controller/logo.jpg', 'background_img');
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body = "<div style='width: 100%; max-width: 400px; margin: auto; background: url(cid:background_img) no-repeat center center; background-size: cover; padding: 20px;'>
                           <div style='background: rgba(255, 255, 255, 0.8); padding: 20px;width:100%;height:auto;'>
                               {$body}
                               <img src='cid:signature_img' style='width: 200px; height: auto;'>
                           </div>
                       </div>";
    
            if (!$mail->send()) {
                error_log("Email failed: " . $mail->ErrorInfo); // Log error
                return false; // Indicate failure
            }
            return true; // Indicate success
        } catch (Exception $e) {
            error_log("Error sending email notification: " . $e->getMessage()); // Log error
            return false; // Indicate failure
        }
    }
    
   
    
    public function getContactInfoAndTitle($baptismfillId = null, $massbaptismfillId = null) {
        // Initialize the SQL query and the parameter
        $sql = "";
        $id = null;
    
        if ($massbaptismfillId) {
            // Use the mass baptism fill ID
            $sql = "
                SELECT 
                c.citizend_id, 
                    c.fullname,
                    c.email, 
                    c.phone, 
                    b.event_name 
                FROM 
                    citizen c 
                JOIN 
                    baptismfill b ON c.citizend_id = b.citizen_id  
                WHERE 
                b.baptism_id = ?";
            $id = $massbaptismfillId;
        } elseif ($baptismfillId) {
            // Use the baptism fill ID
            $sql = "
            SELECT 
            c.citizend_id, 
            c.fullname,
            c.email, 
            c.phone, 
            b.event_name 
        FROM 
            citizen c 
        JOIN 
            schedule s ON c.citizend_id = s.citizen_id 
        JOIN 
            baptismfill b ON s.schedule_id = b.schedule_id 
        WHERE 
            b.baptism_id = ?";
            $id = $baptismfillId;
        }
    
        // If neither ID is provided, return false
        if (!$id) {
            return false;
        }
    
        // Prepare and execute the SQL query
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
    
        if ($result->num_rows > 0) {
            return $result->fetch_assoc(); // Returns an associative array with email, phone, and event_name
        } else {
            return false; // Returns false if no contact info is found
        }
    }
   

    
    public function updatePaymentStatus($appsched_id, $p_status) {
        $sql = "UPDATE appointment_schedule SET p_status = ? WHERE appsched_id = ?";
        $stmt = $this->conn->prepare($sql);
        
        if ($stmt) {
            $stmt->bind_param('si', $p_status, $appsched_id);
            return $stmt->execute();
        }
        return false;
    }

    // Method to update event status
    public function updateEventStatus($cappsched_id, $c_status) {
        $sql = "UPDATE appointment_schedule SET status = ? WHERE appsched_id = ?";
        $stmt = $this->conn->prepare($sql);

        if ($stmt) {
            $stmt->bind_param('si', $c_status, $cappsched_id);
            return $stmt->execute();
        }
        return false;
    }
    public function deleteAppointments($appsched_ids) { 
        // Generate placeholders for the prepared statement
        $placeholders = implode(',', array_fill(0, count($appsched_ids), '?'));
        $types = str_repeat('i', count($appsched_ids));
    
        // Step 1: Delete from the `schedule` table based on conditions
        $deleteScheduleSql = "
            DELETE FROM schedule 
            WHERE schedule_id IN (
                -- Based on baptismfill
                SELECT schedule_id 
                FROM baptismfill 
                WHERE baptism_id IN (
                    SELECT baptismfill_id 
                    FROM appointment_schedule 
                    WHERE appsched_id IN ($placeholders)
                )
            )
            OR schedule_id IN (
                -- Based on appointment_schedule directly
                SELECT schedule_id 
                FROM appointment_schedule 
                WHERE appsched_id IN ($placeholders)
            )
            OR schedule_id IN (
                -- Based on marriagefill
                SELECT schedule_id 
                FROM marriagefill 
                WHERE marriagefill_id IN (
                    SELECT marriage_id 
                    FROM appointment_schedule 
                    WHERE appsched_id IN ($placeholders)
                )
            )
            OR schedule_id IN (
                -- Based on defuctomfill
                SELECT schedule_id 
                FROM defuctomfill 
                WHERE defuctomfill_id IN (
                    SELECT defuctom_id 
                    FROM appointment_schedule 
                    WHERE appsched_id IN ($placeholders)
                )
            )";
        
        // Prepare the SQL statement for schedule deletion
        $stmtSchedule = $this->conn->prepare($deleteScheduleSql);
        
        if ($stmtSchedule) {
            // Bind the parameters for each of the sets of placeholders
            $stmtSchedule->bind_param($types . $types . $types . $types, 
                ...array_merge($appsched_ids, $appsched_ids, $appsched_ids, $appsched_ids)
            );
            
            // Execute the deletion for schedules and check for errors
            if (!$stmtSchedule->execute()) {
                echo "Error deleting from schedule: " . $stmtSchedule->error;
                return false; // Exit if deletion fails
            }
        } else {
            echo "Error preparing SQL for schedule deletion: " . $this->conn->error;
            return false; // Exit if SQL preparation fails
        }
    
        // Step 2: Delete from `baptismfill`
        $deleteBaptismFillSql = "
            DELETE FROM baptismfill 
            WHERE baptism_id IN (
                SELECT baptismfill_id 
                FROM appointment_schedule 
                WHERE appsched_id IN ($placeholders)
            )";
        
        $stmtBaptismFill = $this->conn->prepare($deleteBaptismFillSql);
        
        if ($stmtBaptismFill) {
            // Bind the parameters for baptismfill deletion
            $stmtBaptismFill->bind_param($types, ...$appsched_ids);
            
            // Execute the deletion for baptismfill and check for errors
            if (!$stmtBaptismFill->execute()) {
                echo "Error deleting from baptismfill: " . $stmtBaptismFill->error;
                return false; // Exit if deletion fails
            }
        } else {
            echo "Error preparing SQL for baptismfill deletion: " . $this->conn->error;
            return false; // Exit if SQL preparation fails
        }
    
        // Step 3: Delete from `marriagefill`
        $deleteMarriageFillSql = "
            DELETE FROM marriagefill 
            WHERE marriagefill_id IN (
                SELECT marriage_id 
                FROM appointment_schedule 
                WHERE appsched_id IN ($placeholders)
            )";
        
        $stmtMarriageFill = $this->conn->prepare($deleteMarriageFillSql);
        
        if ($stmtMarriageFill) {
            // Bind the parameters for marriagefill deletion
            $stmtMarriageFill->bind_param($types, ...$appsched_ids);
            
            // Execute the deletion for marriagefill and check for errors
            if (!$stmtMarriageFill->execute()) {
                echo "Error deleting from marriagefill: " . $stmtMarriageFill->error;
                return false; // Exit if deletion fails
            }
        } else {
            echo "Error preparing SQL for marriagefill deletion: " . $this->conn->error;
            return false; // Exit if SQL preparation fails
        }
    
        // Step 4: Delete from `confirmationfill`
        $deleteConfirmationFillSql = "
            DELETE FROM confirmationfill 
            WHERE confirmationfill_id IN (
                SELECT confirmation_id 
                FROM appointment_schedule 
                WHERE appsched_id IN ($placeholders)
            )";
        
        $stmtConfirmationFill = $this->conn->prepare($deleteConfirmationFillSql);
        
        if ($stmtConfirmationFill) {
            // Bind the parameters for confirmationfill deletion
            $stmtConfirmationFill->bind_param($types, ...$appsched_ids);
            
            // Execute the deletion for confirmationfill and check for errors
            if (!$stmtConfirmationFill->execute()) {
                echo "Error deleting from confirmationfill: " . $stmtConfirmationFill->error;
                return false; // Exit if deletion fails
            }
        } else {
            echo "Error preparing SQL for confirmationfill deletion: " . $this->conn->error;
            return false; // Exit if SQL preparation fails
        }
    
        // Step 5: Delete from appointment_schedule itself after all related records are deleted
        $deleteAppointmentSql = "
            DELETE FROM appointment_schedule 
            WHERE appsched_id IN ($placeholders)";
        
        // Prepare the SQL statement for appointment deletion
        $stmtAppointment = $this->conn->prepare($deleteAppointmentSql);
        
        if ($stmtAppointment) {
            // Bind the parameters for appointment_schedule
            $stmtAppointment->bind_param($types, ...$appsched_ids);
            
            // Execute the deletion for appointment_schedule and check for errors
            if (!$stmtAppointment->execute()) {
                echo "Error deleting from appointment_schedule: " . $stmtAppointment->error;
                return false; // Exit if deletion fails
            }
        } else {
            echo "Error preparing SQL for appointment_schedule deletion: " . $this->conn->error;
            return false; // Exit if SQL preparation fails
        }
    
        // If everything went well, return true to indicate success
        return true;
    }
    
    
    
    
   // Method to get the schedule_id from baptismfill

   public function getwScheduleId($weddingffill_id) {
    $sql = "SELECT `schedule_id` FROM `marriagefill` WHERE `marriagefill_id` = ?";
    $stmt = $this->conn->prepare($sql);
    $stmt->bind_param('i', $weddingffill_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['schedule_id'];
    } else {
        return null;
    }
}

   public function getdScheduleId($defuctom_id) {
    $sql = "SELECT `schedule_id` FROM `defuctomfill` WHERE `defuctomfill_id` = ?";
    $stmt = $this->conn->prepare($sql);
    $stmt->bind_param('i', $defuctom_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['schedule_id'];
    } else {
        return null;
    }
}

   public function getScheduleId($baptismfill_id) {
    $sql = "SELECT `schedule_id` FROM `baptismfill` WHERE `baptism_id` = ?";
    $stmt = $this->conn->prepare($sql);
    $stmt->bind_param('i', $baptismfill_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['schedule_id'];
    } else {
        return null;
    }
}
public function getcScheduleId($confirmationfill_id) {
 $sql = "SELECT `schedule_id` FROM `confirmationfill` WHERE `confirmationfill_id` = ?";
 $stmt = $this->conn->prepare($sql);
 $stmt->bind_param('i', $confirmationfill_id);
 $stmt->execute();
 $result = $stmt->get_result();

 if ($result->num_rows > 0) {
     $row = $result->fetch_assoc();
     return $row['schedule_id'];
 } else {
     return null;
 }
}

//--------------------------------------------------------------------------------------------------------
public function getScheduleDays($startDate, $endDate) {
    $scheduleDays = [];
    $currentDate = $startDate;

    while ($currentDate <= $endDate) {
        $dayOfMonth = date('j', strtotime($currentDate)); // Get the day of the month
        $dayOfWeek = date('N', strtotime($currentDate)); // Get the day of the week (1 = Monday, 7 = Sunday)

        // Check for 2nd week (8th to 14th) or 4th Saturday of the month
        if (($dayOfMonth >= 8 && $dayOfMonth <= 14 && $dayOfWeek == 6) || // 2nd week Saturday
            (date('l', strtotime($currentDate)) == 'Saturday' && ceil($dayOfMonth / 7) == 4)) { // 4th Saturday
            $scheduleDays[] = $currentDate;
        }

        // Move to the next day
        $currentDate = date('Y-m-d', strtotime($currentDate . ' +1 day'));
    }

    return $scheduleDays;
}
public function displaySundaysDropdowns($schedule_id) {
    // Fetch the schedule date based on the schedule_id
    $sql = "SELECT date FROM schedule WHERE schedule_id = ?";
    $stmt = $this->conn->prepare($sql);
    $stmt->bind_param('i', $schedule_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $schedule_date = $row['date'];
        
        // Get Sundays between today and the schedule date
        $sundays = $this->getScheduleDays(date('Y-m-d'), $schedule_date);
        
        // Define the fixed start and end times
        $start_time = "08:00 AM";
        $end_time = "5:00 PM";

        foreach ($sundays as $sunday) {
            // Combine values in the option for easier form processing later
            $option_value = "{$schedule_id}|{$sunday}|{$start_time}|{$end_time}";

            // Display the date with the fixed time range
            echo "<option value='{$option_value}'>{$sunday} - {$start_time} to {$end_time}</option>";
        }
    } else {
        echo "<option>No available schedules found.</option>";
    }
}
//-----------------------------------------------------------------------------------------------
// Method to get Sundays between start date and schedule date
public function getSundays($startDate, $endDate) {
    $sundays = [];
    $currentDate = $startDate;

    // Skip today if today is Sunday
    if (date('N', strtotime($currentDate)) == 7) {
        // If today is Sunday, start from the next day
        $currentDate = date('Y-m-d', strtotime($currentDate . ' +1 day'));
    }

    // Continue finding Sundays between start date and end date
    while ($currentDate <= $endDate) {
        if (date('N', strtotime($currentDate)) == 7) { // Check if it's Sunday
            $sundays[] = $currentDate;
        }
        $currentDate = date('Y-m-d', strtotime($currentDate . ' +1 day'));
    }

    return $sundays;
}


public function displaySundaysDropdown($schedule_id) {
    // Fetch the schedule date based on the schedule_id
    $sql = "SELECT date FROM schedule WHERE schedule_id = ?";
    $stmt = $this->conn->prepare($sql);
    $stmt->bind_param('i', $schedule_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $schedule_date = $row['date'];
        
        // Get Sundays between today and the schedule date
        $sundays = $this->getSundays(date('Y-m-d'), $schedule_date);
        
        // Define the fixed start and end times
        $start_time = "09:00 AM";
        $end_time = "11:00 AM";

        foreach ($sundays as $sunday) {
            // Combine values in the option for easier form processing later
            $option_value = "{$schedule_id}|{$sunday}|{$start_time}|{$end_time}";

            // Display the date with the fixed time range
            echo "<option value='{$option_value}'>{$sunday} - {$start_time} to {$end_time}</option>";
        }
    } else {
        echo "<option>No available schedules found.</option>";
    }
}



  
    
    
    public function getAnnouncementById($announcementId) {
        $sql = "SELECT 
                    `announcement`.`announcement_id`,
                    `announcement`.`event_type`,
                    `announcement`.`title`,
                    `announcement`.`description`,
                    `announcement`.`date_created`,
                    `announcement`.`capacity`,
                    `schedule`.`date`,
                    `schedule`.`start_time`,
                    `schedule`.`end_time`
                FROM 
                    `announcement`
                JOIN 
                    `schedule` ON `announcement`.`schedule_id` = `schedule`.`schedule_id`
                WHERE
                    `announcement`.`announcement_id` = ?
                LIMIT 1";
    
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $announcementId);
        $stmt->execute();
        $result = $stmt->get_result();
    
        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        } else {
            return null;
        }
    }
    public function insertEventCalendar($cal_fullname, $cal_Category, $cal_date, $cal_description) {
        $sql = "INSERT INTO event_calendar (cal_fullname, cal_Category, cal_date, cal_description) 
                VALUES (?, ?, ?, ?)";
        
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssss", $cal_fullname, $cal_Category, $cal_date, $cal_description);
        
        // Return true if execution is successful, otherwise false
        return $stmt->execute();
    }
    
    public function getAnnouncements() {
        $sql = "SELECT 
                    `announcement`.`announcement_id`,
                    `announcement`.`event_type`,
                    `announcement`.`title`,
                    `announcement`.`description`,
                    `announcement`.`date_created`,
                    `announcement`.`capacity`,
                    `schedule`.`date`,
                    `schedule`.`start_time`,
                    `schedule`.`end_time`,
                    `citizen`.`fullname` -- Assuming you want to include citizen's full name
                FROM 
                    `announcement`
                JOIN 
                    `schedule` ON `announcement`.`schedule_id` = `schedule`.`schedule_id`
                JOIN 
                    `citizen` ON `announcement`.`priest_id` = `citizen`.`citizend_id` -- Join based on the citizen_id
                ORDER BY 
                    `announcement`.`date_created` DESC";
    
        $result = $this->conn->query($sql);
    
        if ($result === FALSE) {
            die("Error: " . $this->conn->error);
        }
    
        $announcements = [];
        while ($row = $result->fetch_assoc()) {
            $announcements[] = $row;
        }
        return $announcements;
    }
    

//------------------------------------------------------------------------------------//
// In Staff class

public function insertSchedule($date, $startTime, $endTime, $eventType) {
    $sql = "INSERT INTO schedule (date, start_time, end_time, event_type) VALUES (?, ?, ?, 'Seminar')";
    $stmt = $this->conn->prepare($sql);
    $stmt->bind_param("sss", $date, $startTime, $endTime, );

    if ($stmt->execute()) {
        $insertedScheduleId = $stmt->insert_id;
        $stmt->close();
        return $insertedScheduleId;
    } else {
        error_log("Schedule insertion failed: " . $stmt->error);
        $stmt->close();
        return false; // Insertion failed
    }
}
public function insertIntoWalkinBaptismFill($scheduleId, $fatherFullname, $fullname, $gender, $c_date_birth, $address, $pbirth, $mother_fullname, $religion, $parentResident, $godparent, $age) {
    $sql = "INSERT INTO baptismfill (schedule_id, father_fullname, fullname, gender, c_date_birth, address, pbirth, mother_fullname, religion, parent_resident, godparent, age, status, event_name, role, created_at) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'Pending', 'Baptism', 'Walk', CURRENT_TIMESTAMP)";
    
    $stmt = $this->conn->prepare($sql);
    
    // Bind parameters
    $stmt->bind_param("issssssssssi", $scheduleId, $fatherFullname, $fullname, $gender, $c_date_birth, $address, $pbirth, $mother_fullname, $religion, $parentResident, $godparent, $age);

    if ($stmt->execute()) {
        // Return the last inserted ID
        $baptismfillId = $this->conn->insert_id;
        $stmt->close();
        return $baptismfillId;
    } else {
        error_log("Insert failed: " . $stmt->error);
        $stmt->close();
        return false;
    }
}

public function insertMassAppointment($massbaptismfillId = null ,$massweddingffill_id = null , $payableAmount ) {
    // Generate a random 12-letter reference number
    $referenceNumber = $this->generateReferenceNumber();

    // Update the SQL to match the parameters correctly
    $sql = "INSERT INTO appointment_schedule (baptismfill_id,marriage_id, payable_amount,  status, p_status,reference_number)
            VALUES (?, ?,?,'Process','Unpaid',?)";
    $stmt = $this->conn->prepare($sql);
    
    // Adjust the bind_param to include the reference number
    $stmt->bind_param("iids", $massbaptismfillId, $massweddingffill_id,$payableAmount, $referenceNumber);

    if ($stmt->execute()) {
        // Get the last inserted ID
        $appointmentId = $this->conn->insert_id;
        $stmt->close();
        return $appointmentId;  // Return the ID of the newly inserted record
    } else {
        error_log("Insertion failed: " . $stmt->error);
        $stmt->close();
        return false;  // Insertion failed
    }
}


private static $generatedReferences = [];

private function generateReferenceNumber() {
    do {
        // Generate a random string of 12 uppercase letters and numbers
        $referenceNumber = substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890'), 0, 12);
    } while (in_array($referenceNumber, self::$generatedReferences));

    // Store the generated reference number to avoid future duplicates
    self::$generatedReferences[] = $referenceNumber;

    return $referenceNumber;
}



public function approveBaptism($baptismfillId = null, $massbaptismfillId = null) {
    try {
        if ($baptismfillId !== null) {
            $sql = "UPDATE baptismfill SET status = 'Approved' WHERE baptism_id = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("i", $baptismfillId);
        } elseif ($massbaptismfillId !== null) {
            $sql = "UPDATE baptismfill SET status = 'Approved' WHERE baptism_id = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("i", $massbaptismfillId);
        } else {
            return false;  // Neither ID was provided
        }
        
        if ($stmt->execute()) {
            return true;  // Status updated successfully
        } else {
            return false;  // Failed to update status
        }
    } catch (Exception $e) {
        error_log("Error approving baptism or mass baptism: " . $e->getMessage());
        return false;  // Error occurred
    }
}

public function insertBaptismPayment($appointmentId, $payableAmount) {
    try {
        $sql = "INSERT INTO payments (appointment_id, amount)
                VALUES (?, ?)";

        $stmt = $this->conn->prepare($sql);
        if ($stmt === false) {
            throw new Exception("Prepare failed: " . $this->conn->error);
        }

        $stmt->bind_param("id", $appointmentId, $payableAmount);
        if ($stmt->error) {
            throw new Exception("Bind failed: " . $stmt->error);
        }

        if (!$stmt->execute()) {
            throw new Exception("Execute failed: " . $stmt->error);
        }

        $stmt->close();
        return "Payment record successfully inserted with status 'Unpaid'.";
    } catch (Exception $e) {
        return "Error: " . $e->getMessage();
    }
}

//--------------------------------------------------------------------------//

public function insertcAppointment($confirmationfill_id, $payableAmount) {
    $referenceNumber = $this->generateReferenceNumber();
    $sql = "INSERT INTO appointment_schedule (confirmation_id, payable_amount, status, p_status, reference_number)
            VALUES (?, ?,  'Process', 'Unpaid',?)";
    $stmt = $this->conn->prepare($sql);

    // Bind parameters: 'i' for integer (baptismfill_id, priest_id), 'd' for decimal/float (payable_amount)
    $stmt->bind_param("ids",$confirmationfill_id ,$payableAmount, $referenceNumber );

    // Execute the statement and check for errors
    if ($stmt->execute()) {
        return true; // Successful insertion
    } else {
        error_log("Insertion failed: " . $stmt->error);
        return false; // Insertion failed
    }

    $stmt->close();
}
public function getContactInfoAndTitles($confirmationfill_id) {
    $sql = "SELECT 
                c.fullname,
                c.email, 
                c.phone, 
                cf.event_name 
            FROM 
                citizen c 

            JOIN 
                confirmationfill cf ON c.citizend_id = cf.citizen_id 
            WHERE 
                cf.confirmationfill_id = ?";

    $stmt = $this->conn->prepare($sql);
    $stmt->bind_param("i", $confirmationfill_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        return $result->fetch_assoc(); // Returns an associative array with email, phone, and event_name
    } else {
        return false; // Returns false if no contact info is found
    }
}

public function approveConfirmation($confirmationfill_id) {
    try {
        $sql = "UPDATE confirmationfill SET status = 'Approved' WHERE confirmationfill_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $confirmationfill_id);
        
        if ($stmt->execute()) {
            return true;  // Status updated successfully
        } else {
            return false;  // Failed to update status
        }
    } catch (Exception $e) {
        return false;  // Error occurred
    }
}

//--------------------------------------------------------------------------------//
public function insertwAppointment($weddingffill_id, $payableAmount, $priestId,$scheduleId) {
    $referenceNumber = $this->generateReferenceNumber();
   $sql = "INSERT INTO appointment_schedule (marriage_id, payable_amount,priest_id,schedule_id, status, p_status,pr_status,reference_number)
            VALUES (?, ?,?, ?, 'Process', 'Unpaid','Pending',?)";
    $stmt = $this->conn->prepare($sql);

    // Bind parameters: 'i' for integer (baptismfill_id, priest_id), 'd' for decimal/float (payable_amount)
    $stmt->bind_param("idiis",$weddingffill_id ,$payableAmount,$priestId,$scheduleId,$referenceNumber);

    // Execute the statement and check for errors
    if ($stmt->execute()) {
        return true; // Successful insertion
    } else {
        error_log("Insertion failed: " . $stmt->error);
        return false; // Insertion failed
    }

    $stmt->close();
}
public function getWeddingContactInfoAndTitles($weddingffill_id = null, $massweddingffill_id = null) {
    // Initialize the SQL query and the parameter
    $sql = "";
    $id = null;

    if ($massweddingffill_id) {
        // Use the mass baptism fill ID
        $sql = "
            SELECT 
                c.fullname,
                c.email, 
                c.phone, 
                mf.event_name 
            FROM 
                citizen c 
            JOIN 
                marriagefill mf ON c.citizend_id = mf.citizen_id  
            WHERE 
            mf.marriagefill_id = ?";
        $id = $massweddingffill_id;
    } elseif ($weddingffill_id) {
        // Use the baptism fill ID
        $sql = "
       SELECT 
                c.fullname,
                c.email, 
                c.phone, 
                mf.event_name 
            FROM 
                citizen c 
            JOIN 
                schedule s ON c.citizend_id = s.citizen_id 
            JOIN 
                marriagefill mf ON s.schedule_id = mf.schedule_id 
            WHERE 
                mf.marriagefill_id = ?";
        $id = $weddingffill_id;
    }

    // If neither ID is provided, return false
    if (!$id) {
        return false;
    }

    // Prepare and execute the SQL query
    $stmt = $this->conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        return $result->fetch_assoc(); // Returns an associative array with email, phone, and event_name
    } else {
        return false; // Returns false if no contact info is found
    }
}

public function approveWedding($weddingffill_id = null, $massweddingffill_id = null) {
    try {
        if ($weddingffill_id ) {
            $sql = "UPDATE marriagefill SET status = 'Approved' WHERE marriagefill_id = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("i", $weddingffill_id);
        } elseif ($massweddingffill_id ) {
            $sql = "UPDATE marriagefill SET status = 'Approved' WHERE marriagefill_id = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("i", $massweddingffill_id);
        } else {
            return false;  // Neither ID was provided
        }
        
        if ($stmt->execute()) {
            return true;  // Status updated successfully
        } else {
            return false;  // Failed to update status
        }
    } catch (Exception $e) {
        error_log("Error approving marriage or mass marriage: " . $e->getMessage());
        return false;  // Error occurred
    }
}

//--------------------------------------------------------------------------//
public function insertfAppointment( $defuctomfill_id, $payableAmount,$priestId) {
    $referenceNumber = $this->generateReferenceNumber();
   $sql = "INSERT INTO appointment_schedule (defuctom_id, payable_amount, priest_id, status, p_status,pr_status,reference_number)
            VALUES (?, ?,?, 'Process', 'Unpaid','Pending',?)";
    $stmt = $this->conn->prepare($sql);

    // Bind parameters: 'i' for integer (baptismfill_id, priest_id), 'd' for decimal/float (payable_amount)
    $stmt->bind_param("idis", $defuctomfill_id ,$payableAmount,$priestId, $referenceNumber);

    // Execute the statement and check for errors
    if ($stmt->execute()) {
        return true; // Successful insertion
    } else {
        error_log("Insertion failed: " . $stmt->error);
        return false; // Insertion failed
    }

    $stmt->close();
}
public function getFuneralContactInfoAndTitles($defuctomfill_id) {
    $sql = "SELECT 
                c.fullname,
                c.email, 
                c.phone, 
                df.event_name 
            FROM 
                citizen c 
            JOIN 
                schedule s ON c.citizend_id = s.citizen_id 
            JOIN 
                defuctomfill df ON s.schedule_id = df.schedule_id 
            WHERE 
                df.defuctomfill_id = ?";

    $stmt = $this->conn->prepare($sql);
    $stmt->bind_param("i", $defuctomfill_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        return $result->fetch_assoc(); // Returns an associative array with email, phone, and event_name
    } else {
        return false; // Returns false if no contact info is found
    }
}

public function approveFuneral( $defuctomfill_id) {
    try {
        $sql = "UPDATE defuctomfill SET status = 'Approved' WHERE defuctomfill_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i",  $defuctomfill_id);
        
        if ($stmt->execute()) {
            return true;  // Status updated successfully
        } else {
            return false;  // Failed to update status
        }
    } catch (Exception $e) {
        return false;  // Error occurred
    }
}

//--------------------------------------------------------------------------//





public function fetchBaptismFill($status) {
    $query = "
        SELECT 
            c.citizend_id,
            b.fullname AS citizen_name,
            s.date AS schedule_date,
            s.start_time AS schedule_start_time,
            s.end_time AS schedule_end_time,
            b.event_name AS event_name,
            b.status AS approval_status,
            b.role AS roles,
            b.baptism_id AS id,
            'Baptism' AS type,
            b.father_fullname,
            b.pbirth,
            b.mother_fullname,
            b.religion,
            b.parent_resident,
            b.godparent,
            b.gender,
            b.c_date_birth,
            b.age,
            b.address,
            b.created_at 
        FROM 
            citizen c
        JOIN 
            schedule s ON c.citizend_id = s.citizen_id
        JOIN 
            baptismfill b ON s.schedule_id = b.schedule_id
        WHERE 
            b.status = ?";
    
    $stmt = $this->conn->prepare($query);
    $stmt->bind_param("s", $status);
    $stmt->execute();
    return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
}

public function fetchConfirmationFill($status) {
    $query = "
        SELECT 
            c.citizend_id,
            c.fullname AS citizen_name,
            s.date AS schedule_date,
            s.start_time AS schedule_start_time,
            s.end_time AS schedule_end_time,
            cf.event_name AS event_name,
            cf.status AS approval_status,
            cf.role AS roles,
            cf.confirmationfill_id AS id,
            'Confirmation' AS type,
            cf.fullname,
            cf.father_fullname,
            cf.date_of_baptism,
            cf.mother_fullname,
            cf.permission_to_confirm,
            cf.church_address,
            cf.name_of_church,
            cf.c_gender,
            cf.c_date_birth,
            cf.c_address,
            cf.c_created_at 
        FROM 
            citizen c
        JOIN 
            schedule s ON c.citizend_id = s.citizen_id
        JOIN 
            confirmationfill cf ON s.schedule_id = cf.schedule_id
        WHERE 
            cf.status = ?";
    
    $stmt = $this->conn->prepare($query);
    $stmt->bind_param("s", $status);
    $stmt->execute();
    return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
}

public function fetchMarriageFill($status) {
    $query = "
        SELECT 
            c.citizend_id,
            c.fullname AS citizen_name,
            s.date AS schedule_date,
            s.start_time AS schedule_start_time,
            s.end_time AS schedule_end_time,
            mf.event_name AS event_name,
            mf.status AS approval_status,
            mf.role AS roles,
            mf.marriagefill_id AS id,
            'Marriage' AS type,
            mf.groom_name,
            mf.groom_dob,
            mf.groom_age,
            mf.groom_place_of_birth,
            mf.groom_citizenship,
            mf.groom_address,
            mf.groom_religion,
            mf.groom_previously_married,
            mf.bride_name,
            mf.bride_dob,
            mf.bride_age,
            mf.bride_place_of_birth,
            mf.bride_citizenship,
            mf.bride_address,
            mf.bride_religion,
            mf.bride_previously_married,
            mf.m_created_at 
        FROM 
            citizen c
        JOIN 
            schedule s ON c.citizend_id = s.citizen_id
        JOIN 
            marriagefill mf ON s.schedule_id = mf.schedule_id
        WHERE 
            mf.status = ?";
    
    $stmt = $this->conn->prepare($query);
    $stmt->bind_param("s", $status);
    $stmt->execute();
    return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
}

public function fetchDefuctomFill($status) {
    $query = "
        SELECT 
            c.citizend_id,
            c.fullname AS citizen_name,
            s.date AS schedule_date,
            s.start_time AS schedule_start_time,
            s.end_time AS schedule_end_time,
            df.event_name AS event_name,
            df.status AS approval_status,
            df.role AS roles,
            df.defuctomfill_id AS id,
            'Defuctom' AS type,
            df.d_fullname,
            df.d_address,
            df.father_fullname,
            df.place_of_birth,
            df.mother_fullname,
            df.cause_of_death,
            df.marital_status,
            df.place_of_death,
            df.d_gender,
            df.date_of_birth,
            df.date_of_death,
            df.parents_residence,
            df.d_created_at 
        FROM 
            citizen c
        JOIN 
            schedule s ON c.citizend_id = s.citizen_id
        JOIN 
            defuctomfill df ON s.schedule_id = df.schedule_id
        WHERE 
            df.status = ?";
    
    $stmt = $this->conn->prepare($query);
    $stmt->bind_param("s", $status);
    $stmt->execute();
    return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
}

public function getPendingCitizen($eventType = null, $status = 'Pending') {
    $results = [];

    switch ($eventType) {
        case 'Baptism':
            $results = $this->fetchBaptismFill($status);
            break;
        case 'Confirmation':
            $results = $this->fetchConfirmationFill($status);
            break;
        case 'Marriage':
            $results = $this->fetchMarriageFill($status);
            break;
        case 'Defuctom':
            $results = $this->fetchDefuctomFill($status);
            break;
        default:
            $results = array_merge(
                $this->fetchBaptismFill($status),
                $this->fetchConfirmationFill($status),
                $this->fetchMarriageFill($status),
                $this->fetchDefuctomFill($status)
            );
            break;
    }

    // Sort the results based on created_at timestamp first
    usort($results, function($a, $b) {
        // Determine the correct created_at field for each event type
        $createdAtFieldA = $a['type'] === 'Baptism' ? $a['created_at'] :
                           ($a['type'] === 'Confirmation' ? $a['c_created_at'] :
                           ($a['type'] === 'Marriage' ? $a['m_created_at'] :
                           $a['d_created_at'])); // Adjust based on your actual fields

        $createdAtFieldB = $b['type'] === 'Baptism' ? $b['created_at'] :
                           ($b['type'] === 'Confirmation' ? $b['c_created_at'] :
                           ($b['type'] === 'Marriage' ? $b['m_created_at'] :
                           $b['d_created_at'])); // Adjust based on your actual fields

        // Convert created_at timestamps to UNIX timestamps for comparison
        $aCreatedAt = strtotime($createdAtFieldA ?? '0');
        $bCreatedAt = strtotime($createdAtFieldB ?? '0');

        // First, sort by created_at timestamp (ascending order)
        if ($aCreatedAt !== $bCreatedAt) {
            return $aCreatedAt - $bCreatedAt; // Ascending order
        }

        // If created_at timestamps are the same, then sort by event type
        $eventOrder = ['Baptism', 'Confirmation', 'Marriage', 'Defuctom'];
        return array_search($a['type'], $eventOrder) - array_search($b['type'], $eventOrder);
    });

    return $results;
}

    
    public function getBaptismAppointments() {
        $sql = "SELECT 
            b.fullname AS fullnames,
            a.pr_status AS approve_priest,
            b.baptism_id AS id,
            b.role AS roles,
            b.event_name AS Event_Name,
            c.fullname AS citizen_name, 
            s.date AS schedule_date,
            s.start_time AS schedule_time,
            a.appsched_id,
            a.baptismfill_id,
            a.priest_id,
            priest.fullname AS priest_name,
            a.schedule_id AS appointment_schedule_id,
            a.payable_amount AS payable_amount,
            a.status AS c_status,
            a.p_status AS p_status,
            sch.date AS appointment_schedule_date,  
            sch.start_time AS appointment_schedule_start_time,
            sch.end_time AS appointment_schedule_end_time,
            b.created_at 
        FROM 
            schedule s
        LEFT JOIN citizen c ON c.citizend_id = s.citizen_id 
        JOIN baptismfill b ON s.schedule_id = b.schedule_id
        JOIN appointment_schedule a ON b.baptism_id = a.baptismfill_id
        JOIN schedule sch ON a.schedule_id = sch.schedule_id  
        LEFT JOIN citizen priest ON a.priest_id = priest.citizend_id AND priest.user_type = 'Priest' 
        WHERE 
            a.status = 'Process' OR a.p_status = 'Unpaid'";
    
        return $this->fetchAppointments($sql);
    }public function getMarriageAppointments() {
        $sql = "SELECT 
            mf.groom_name AS fullnames,
            a.pr_status AS approve_priest,
            mf.marriagefill_id AS id,
            mf.role AS roles,
            mf.event_name AS Event_Name,
            c.fullname AS citizen_name,
            s.date AS schedule_date,
            s.start_time AS schedule_time,
            a.appsched_id,
            a.marriage_id,
            a.priest_id,
            priest.fullname AS priest_name,
            a.schedule_id AS appointment_schedule_id,
            a.payable_amount AS payable_amount,
            a.status AS c_status,
            a.p_status AS p_status,
            sch.date AS appointment_schedule_date,  
            sch.start_time AS appointment_schedule_start_time,
            sch.end_time AS appointment_schedule_end_time,
            mf.m_created_at 
        FROM 
            schedule s
        LEFT JOIN citizen c ON c.citizend_id = s.citizen_id 
        JOIN marriagefill mf ON s.schedule_id = mf.schedule_id
        JOIN appointment_schedule a ON mf.marriagefill_id = a.marriage_id
        JOIN schedule sch ON a.schedule_id = sch.schedule_id
        LEFT JOIN citizen priest ON a.priest_id = priest.citizend_id AND priest.user_type = 'Priest' 
        WHERE 
            a.status = 'Process' OR a.p_status = 'Unpaid'";
    
        return $this->fetchAppointments($sql);
    }public function getDefuctomAppointments() {
        $sql = "SELECT 
            df.d_fullname AS fullnames,
            a.pr_status AS approve_priest,
            df.defuctomfill_id AS id,
            df.role AS roles,
            df.event_name AS Event_Name,
            c.fullname AS citizen_name,
            s.date AS schedule_date,
            s.start_time AS schedule_time,
            a.appsched_id,
            a.defuctom_id,  
            a.priest_id,
            priest.fullname AS priest_name,
            a.schedule_id AS appointment_schedule_id,
            a.payable_amount AS payable_amount,
            a.status AS c_status,
            a.p_status AS p_status,
            df.d_created_at 
        FROM 
            schedule s
        LEFT JOIN citizen c ON c.citizend_id = s.citizen_id 
        JOIN defuctomfill df ON s.schedule_id = df.schedule_id
        JOIN appointment_schedule a ON df.defuctomfill_id = a.defuctom_id
        LEFT JOIN citizen priest ON a.priest_id = priest.citizend_id AND priest.user_type = 'Priest' 
        WHERE 
            a.status = 'Process' OR a.p_status = 'Unpaid'";
    
        return $this->fetchAppointments($sql);
    }private function fetchAppointments($sql) {
        $result = $this->conn->query($sql);
        
        if ($result === FALSE) {
            die("Error: " . $this->conn->error);
        }
    
        $appointments = [];
        while ($row = $result->fetch_assoc()) {
            $appointments[] = $row;
        }
        return $appointments;
    }
    
    public function getPendingAppointments() {
        $baptismAppointments = $this->getBaptismAppointments();
        $marriageAppointments = $this->getMarriageAppointments();
        $defuctomAppointments = $this->getDefuctomAppointments();
    
        // Combine all appointments into one array
        $allAppointments = array_merge($baptismAppointments, $marriageAppointments, $defuctomAppointments);
    
        // Sort all appointments based on the correct created_at timestamp for each event type
        usort($allAppointments, function($a, $b) {
            // Determine the correct created_at field for each event type
            $createdAtFieldA = $a['Event_Name'] === 'Baptism' ? $a['created_at'] :
                               ($a['Event_Name'] === 'Marriage' ? $a['marriage_created_at'] :
                               ($a['Event_Name'] === 'Defuctom' ? $a['defuctom_created_at'] : '0')); // Adjust based on your actual fields
    
            $createdAtFieldB = $b['Event_Name'] === 'Baptism' ? $b['created_at'] :
                               ($b['Event_Name'] === 'Marriage' ? $b['marriage_created_at'] :
                               ($b['Event_Name'] === 'Defuctom' ? $b['defuctom_created_at'] : '0')); // Adjust based on your actual fields
    
            // Convert created_at timestamps to UNIX timestamps for comparison
            $aCreatedAt = strtotime($createdAtFieldA ?? '0');
            $bCreatedAt = strtotime($createdAtFieldB ?? '0');
    
            // First, sort by created_at timestamp (ascending order)
            if ($aCreatedAt !== $bCreatedAt) {
                return $aCreatedAt - $bCreatedAt; // Ascending order
            }
    
            // If created_at timestamps are the same, then sort by event type
            $eventOrder = ['Baptism', 'Marriage', 'Defuctom'];
            return array_search($a['Event_Name'], $eventOrder) - array_search($b['Event_Name'], $eventOrder);
        });
    
        return $allAppointments;
    }
    
    
    
    public function getPendingMassAppointments() {
        $sql = "SELECT 
            b.baptism_id AS id,
            b.role AS roles,
            b.event_name AS Event_Name,
            c.fullname AS citizen_name,
            s.date AS schedule_date,
            s.start_time AS schedule_time,
            a.payable_amount AS payable_amount,
            a.status AS c_status,
            a.p_status AS p_status,
            a.appsched_id,
            b.created_at AS created_at
            -- Additional schedule details from the new join
            -- sch.date AS appointment_schedule_date,
            -- sch.start_time AS appointment_schedule_start_time,
            -- sch.end_time AS appointment_schedule_time
        FROM 
            baptismfill b
        JOIN 
            citizen c ON b.citizen_id = c.citizend_id
        JOIN 
            announcement an ON b.announcement_id = an.announcement_id
        JOIN 
            appointment_schedule a ON b.baptism_id = a.baptismfill_id
        -- JOIN schedule sch ON a.schedule_id = sch.schedule_id
        JOIN 
            schedule s ON an.schedule_id = s.schedule_id
        WHERE 
            a.status = 'Process' OR a.p_status = 'Unpaid'
        
        UNION ALL
    
        SELECT 
            cf.confirmationfill_id AS id,
            cf.role AS roles,
            cf.event_name AS Event_Name,
            c.fullname AS citizen_name,
            s.date AS schedule_date,
            s.start_time AS schedule_time,
            a.payable_amount AS payable_amount,
            a.status AS c_status,
            a.p_status AS p_status,
            a.appsched_id,
            cf.c_created_at AS created_at
            -- Additional schedule details from the new join
            -- sch.date AS appointment_schedule_date,
            -- sch.start_time AS appointment_schedule_start_time,
            -- sch.end_time AS appointment_schedule_time
        FROM 
            confirmationfill cf
        JOIN 
            citizen c ON cf.citizen_id = c.citizend_id
        JOIN 
            announcement an ON cf.announcement_id = an.announcement_id
        JOIN 
            appointment_schedule a ON cf.confirmationfill_id = a.confirmation_id
        -- JOIN schedule sch ON a.schedule_id = sch.schedule_id
        JOIN 
            schedule s ON an.schedule_id = s.schedule_id
        WHERE 
            a.status = 'Process' OR a.p_status = 'Unpaid'
        
        UNION ALL
    
        SELECT 
            mf.marriagefill_id AS id,
            mf.role AS roles,
            mf.event_name AS Event_Name,
            c.fullname AS citizen_name,
            s.date AS schedule_date,
            s.start_time AS schedule_time,
            a.payable_amount AS payable_amount,
            a.status AS c_status,
            a.p_status AS p_status,
            a.appsched_id,
            mf.m_created_at AS created_at
            -- Additional schedule details from the new join
            -- sch.date AS appointment_schedule_date,
            -- sch.start_time AS appointment_schedule_start_time,
            -- sch.end_time AS appointment_schedule_time
        FROM 
            marriagefill mf
        JOIN 
            citizen c ON mf.citizen_id = c.citizend_id
        JOIN 
            announcement an ON mf.announcement_id = an.announcement_id
        JOIN 
            appointment_schedule a ON mf.marriagefill_id = a.marriage_id
        -- JOIN schedule sch ON a.schedule_id = sch.schedule_id
        JOIN 
            schedule s ON an.schedule_id = s.schedule_id
        WHERE 
            a.status = 'Process' OR a.p_status = 'Unpaid'
            
            ORDER BY created_at ASC";
    
        $result = $this->conn->query($sql);
    
        if ($result === FALSE) {
            die("Error: " . $this->conn->error);
        }
    
        $pendingMassCitizen = [];
        while ($row = $result->fetch_assoc()) {
            $pendingMassCitizen[] = $row;
        }
        return $pendingMassCitizen;
    }
    
    public function getBaptismPendingCitizen($status) {
        $query = "SELECT 
                a.title AS Event_Name,
                b.fullname AS citizen_name,
                s.date AS schedule_date,
                s.start_time AS schedule_start_time,
                s.end_time AS schedule_end_time,
                b.event_name AS event_name,
                b.status AS approval_status,
                b.role AS roles,
                b.baptism_id AS id,
                'MassBaptism' AS type, -- Use 'MassBaptism' for consistent event type naming
                b.father_fullname,
                b.pbirth,
                b.mother_fullname,
                b.religion,
                b.parent_resident,
                b.godparent,
                b.gender,
                b.c_date_birth,
                b.age,
                b.address,
                b.created_at 
            FROM 
                baptismfill b
            JOIN 
                citizen c ON b.citizen_id = c.citizend_id
            JOIN 
                announcement a ON b.announcement_id = a.announcement_id
            JOIN 
                schedule s ON a.schedule_id = s.schedule_id
            WHERE 
                b.status = ?";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("s", $status);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }
    
    public function getConfirmationPendingCitizen($status) {
        $query = "SELECT 
                a.title AS Event_Name,
                c.fullname AS citizen_name,
                s.date AS schedule_date,
                s.start_time AS schedule_start_time,
                s.end_time AS schedule_end_time,
                cf.event_name AS event_name,
                cf.status AS approval_status,
                cf.role AS roles,
                cf.confirmationfill_id AS id,
                'Mass Confirmation' AS type, -- Use 'Mass Confirmation'
                cf.fullname,
                cf.father_fullname,
                cf.date_of_baptism,
                cf.mother_fullname,
                cf.permission_to_confirm,
                cf.church_address,
                cf.name_of_church,
                cf.c_gender,
                cf.c_date_birth,
                cf.c_address,
                cf.c_created_at -- Use the actual created_at field here
            FROM 
                confirmationfill cf
            JOIN 
                citizen c ON cf.citizen_id = c.citizend_id
            JOIN 
                announcement a ON cf.announcement_id = a.announcement_id
            JOIN 
                schedule s ON a.schedule_id = s.schedule_id
            WHERE 
                cf.status = ?";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("s", $status);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }
    
    public function getMarriagePendingCitizen($status) {
        $query = "SELECT 
                a.title AS Event_Name,
                c.fullname AS citizen_name,
                s.date AS schedule_date,
                s.start_time AS schedule_start_time,
                s.end_time AS schedule_end_time,
                mf.event_name AS event_name,
                mf.status AS approval_status,
                mf.role AS roles,
                mf.marriagefill_id AS id,
                'Mass Marriage' AS type, -- Use 'Mass Marriage'
                mf.groom_name,
                mf.groom_dob,
                mf.groom_age,
                mf.groom_place_of_birth,
                mf.groom_citizenship,
                mf.groom_address,
                mf.groom_religion,
                mf.groom_previously_married,
                mf.bride_name,
                mf.bride_dob,
                mf.bride_age,
                mf.bride_place_of_birth,
                mf.bride_citizenship,
                mf.bride_address,
                mf.bride_religion,
                mf.bride_previously_married,
                mf.m_created_at -- Use the actual created_at field here
            FROM 
                marriagefill mf
            JOIN 
                citizen c ON mf.citizen_id = c.citizend_id
            JOIN 
                announcement a ON mf.announcement_id = a.announcement_id
            JOIN 
                schedule s ON a.schedule_id = s.schedule_id
            WHERE 
                mf.status = ?";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("s", $status);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }
    
    public function getMassPendingCitizen($eventType = null, $status = 'Pending') {
        // Fetch pending citizens based on event type
        switch ($eventType) {
            case 'MassBaptism':
                $pendingCitizens = $this->getBaptismPendingCitizen($status);
                break;
            case 'Mass Confirmation':
                $pendingCitizens = $this->getConfirmationPendingCitizen($status);
                break;
            case 'Mass Marriage':
                $pendingCitizens = $this->getMarriagePendingCitizen($status);
                break;
            default:
                // Combine all event types if no specific eventType is provided
                $pendingCitizens = array_merge(
                    $this->getBaptismPendingCitizen($status),
                    $this->getConfirmationPendingCitizen($status),
                    $this->getMarriagePendingCitizen($status)
                );
                break;
        }
    
        // Sort the results based on created_at timestamp first
        usort($pendingCitizens, function($a, $b) {
            // Determine the correct created_at field for each event type
            $createdAtFieldA = $a['type'] === 'MassBaptism' ? $a['created_at'] :
                               ($a['type'] === 'Mass Confirmation' ? $a['c_created_at'] :  // Use the same created_at field
                               ($a['type'] === 'Mass Marriage' ? $a['m_created_at'] :
                               '0')); // Adjust if necessary
    
            $createdAtFieldB = $b['type'] === 'MassBaptism' ? $b['created_at'] :
                               ($b['type'] === 'Mass Confirmation' ? $b['c_created_at'] :  // Use the same created_at field
                               ($b['type'] === 'Mass Marriage' ? $b['m_created_at'] :
                               '0')); // Adjust if necessary
    
            // Convert created_at timestamps to UNIX timestamps for comparison
            $aCreatedAt = strtotime($createdAtFieldA ?? '0');
            $bCreatedAt = strtotime($createdAtFieldB ?? '0');
    
            // First, sort by created_at timestamp (ascending order)
            if ($aCreatedAt !== $bCreatedAt) {
                return $aCreatedAt - $bCreatedAt; // Ascending order
            }
    
            // If created_at timestamps are the same, then sort by event type
            $eventOrder = ['MassBaptism', 'Mass Confirmation', 'Mass Marriage'];
            return array_search($a['type'], $eventOrder) - array_search($b['type'], $eventOrder);
        });
    
        return $pendingCitizens;
    }
    
    
    
        
    public function getCurrentUsers() {
        $sql = "SELECT `citizend_id`, `fullname`, `email`, `gender`, `phone`, `c_date_birth`, `age`, `address`, `valid_id`, `password`, `user_type`, `r_status`, `c_current_time` 
                FROM `citizen` 
                WHERE `c_current_time` >= DATE_SUB(CURDATE(), INTERVAL 7 DAY)
                AND `r_status` = 'Pending'";
        $result = $this->conn->query($sql);

        if ($result === FALSE) {
            die("Error: " . $this->conn->error);
        }

        $CurrentUsers = [];
        while ($row = $result->fetch_assoc()) {
            $CurrentUsers[] = $row;
        }
        return $CurrentUsers;
    }
    public function getUnreadNotificationCount() {
        $query = "SELECT COUNT(*) AS count FROM notifications WHERE status = 'unread'";
        $result = $this->conn->query($query);

        if ($result === FALSE) {
            die("Error: " . $this->conn->error);
        }

        $row = $result->fetch_assoc();
        return $row['count'];
    }

    public function getRecentNotifications() {
        $query = "SELECT * FROM notifications ORDER BY time DESC LIMIT 4";
        $result = $this->conn->query($query);

        if ($result === FALSE) {
            die("Error: " . $this->conn->error);
        }

        $notifications = $result->fetch_all(MYSQLI_ASSOC);
        return $notifications;
    }

    public function markNotificationsAsRead() {
        $query = "UPDATE notifications SET status = 'read' WHERE status = 'unread'";
        return $this->conn->query($query);
    }


    public function getApprovedRegistrations() {
        $sql = "SELECT `citizend_id`, `fullname`, `email`, `gender`, `phone`, `c_date_birth`, `age`, `address`, `valid_id`, `password`, `user_type`, `r_status`, `c_current_time`
                FROM `citizen`
                WHERE `r_status` = 'Approve'";
        $result = $this->conn->query($sql);

        if ($result === FALSE) {
            die("Error: " . $this->conn->error);
        }

        $approvedRegistrations = [];
        while ($row = $result->fetch_assoc()) {
            $approvedRegistrations[] = $row;
        }
        return $approvedRegistrations;
    }

    public function addAnnouncement($announcementData, $scheduleData) {
        // SQL statements
        $scheduleSql = "INSERT INTO schedule(date, start_time, end_time) VALUES (?, ?, ?)";
        $announcementSql = "INSERT INTO announcement(event_type, title, description, schedule_id, date_created, capacity,priest_id) VALUES (?, ?, ?, ?, ?, ?,?)";
        
        $this->conn->begin_transaction();
    
        try {
            // Prepare and execute the schedule insert statement
            $scheduleStmt = $this->conn->prepare($scheduleSql);
            $scheduleStmt->bind_param("sss", $scheduleData['date'], $scheduleData['start_time'], $scheduleData['end_time']);
            $scheduleStmt->execute();
    
            // Get the last inserted schedule_id
            $scheduleId = $this->conn->insert_id;
    
            // Prepare and execute the announcement insert statement
            $announcementStmt = $this->conn->prepare($announcementSql);
            $announcementStmt->bind_param("sssssii", 
                $announcementData['event_type'], 
                $announcementData['title'], 
                $announcementData['description'], 
                $scheduleId,  // Use the generated schedule_id
                $announcementData['date_created'], 
                $announcementData['capacity'],
                $announcementData['priest_id']
            );
            $announcementStmt->execute();
    
            // Commit the transaction
            $this->conn->commit();
    
            // Close the statements
            $scheduleStmt->close();
            $announcementStmt->close();
    
            return true;
    
        } catch (Exception $e) {
            // Rollback transaction if something went wrong
            $this->conn->rollback();
    
            // Close the statements if they are open
            if ($scheduleStmt) $scheduleStmt->close();
            if ($announcementStmt) $announcementStmt->close();
    
            return false;
        }
    }
    public function fetchMarriageEvents() {
        $query = "
            SELECT 
                mf.groom_name AS groom_name,
                mf.bride_name AS bride_name,
                s.date AS schedule_date,
                s.start_time AS schedule_starttime,
                s.end_time AS schedule_endtime,
                mf.event_name AS Event_Name,
                mf.status AS approval_status,
                mf.marriagefill_id AS event_id
            FROM 
                schedule s
            JOIN 
                marriagefill mf ON s.schedule_id = mf.schedule_id
            JOIN 
                appointment_schedule a ON mf.marriagefill_id = a.marriage_id
            WHERE 
                mf.status = 'Approved';
        ";
        return $this->executeQuery($query);
    }

    // Fetch baptism events
    public function fetchBaptismEvents() {
        $query = "
            SELECT 
                b.fullname AS citizen_name,
                s.date AS schedule_date,
                s.start_time AS schedule_starttime,
                s.end_time AS schedule_endtime,
                b.event_name AS Event_Name,
                b.status AS approval_status,
                b.baptism_id AS event_id
            FROM 
                schedule s
            JOIN 
                baptismfill b ON s.schedule_id = b.schedule_id
            JOIN 
                appointment_schedule a ON b.baptism_id = a.baptismfill_id
            WHERE 
                b.status = 'Approved';
        ";
        return $this->executeQuery($query);
    }

    // Fetch confirmation events
    public function fetchConfirmationEvents() {
        $query = "
            SELECT 
                cf.fullname AS fullname,
                s.date AS schedule_date,
                s.start_time AS schedule_starttime,
                s.end_time AS schedule_endtime,
                cf.event_name AS Event_Name,
                cf.status AS approval_status,
                cf.confirmationfill_id AS event_id
            FROM 
                schedule s
            JOIN 
                confirmationfill cf ON s.schedule_id = cf.schedule_id
            JOIN 
                appointment_schedule a ON cf.confirmationfill_id = a.confirmation_id
            WHERE 
                cf.status = 'Approved';
        ";
        return $this->executeQuery($query);
    }

    // Fetch defuctom events
    public function fetchDefuctomEvents() {
        $query = "
            SELECT 
                df.d_fullname AS fullname,
                s.date AS schedule_date,
                s.start_time AS schedule_starttime,
                s.end_time AS schedule_endtime,
                df.event_name AS Event_Name,
                df.status AS approval_status,
                df.defuctomfill_id AS event_id
            FROM 
                schedule s
            JOIN 
                defuctomfill df ON s.schedule_id = df.schedule_id
            JOIN 
                appointment_schedule a ON df.defuctomfill_id = a.defuctom_id
            WHERE 
                df.status = 'Approved';
        ";
        return $this->executeQuery($query);
    }
    public function fetchAddCalendar() {
        $query = "
            SELECT cal_fullname,cal_Category,cal_description,cal_date FROM 
                event_calendar";
        return $this->executeQuery($query);
    }

    // Fetch mass events
    public function fetchMassEvents() {
        $query = "
            SELECT 
                announcement.announcement_id,
                announcement.event_type,
                announcement.title,
                announcement.description,
                announcement.date_created,
                announcement.capacity,
                schedule.date,
                schedule.start_time,
                schedule.end_time
            FROM 
                announcement
            JOIN 
                schedule ON announcement.schedule_id = schedule.schedule_id
            ORDER BY 
                date_created DESC;
        ";
        return $this->executeQuery($query);
    }

    // Execute the query and return results
    private function executeQuery($query) {
        $result = mysqli_query($this->conn, $query);
        if (!$result) {
            die("Database query failed: " . mysqli_error($this->conn));
        }
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
    
    
}
?>
