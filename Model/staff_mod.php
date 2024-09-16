<?php
class Staff {
    private $conn;
    private $regId;

    public function __construct($conn, $regId = null) {
        $this->conn = $conn;
        $this->regId = $regId;
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


    public function getScheduleseminar($date) {
        $sql = "
            SELECT s.`start_time`, s.`end_time`
            FROM `schedule` s
            INNER JOIN `baptismfill` b ON s.`schedule_id` = b.`schedule_id`
            WHERE s.`date` = ?
            
           
        ";
    
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s",  $date); // Bind the date parameter five times for each SELECT
        $stmt->execute();
        $result = $stmt->get_result();
        $schedules = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
    
        return $schedules;
    }

    public function updateCapacity($announcementId, $newCapacity) {
        $stmt = $this->conn->prepare("UPDATE announcement SET capacity = ? WHERE announcement_id = ?");
        $stmt->bind_param("ii", $newCapacity, $announcementId);
        return $stmt->execute();
    }
    
    public function reserveCapacity($announcementId) {
        $sql = "UPDATE announcement SET capacity = capacity - 1 WHERE announcement_id = ? AND capacity > 0";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $announcementId);
        if ($stmt->execute()) {
            $_SESSION['reservation_time'] = time();
            $_SESSION['announcement_id'] = $announcementId;
            register_shutdown_function([$this, 'releaseCapacity']); // Register shutdown function to release capacity
            return true;
        } else {
            return false;
        }
    }

    
    public function releaseCapacity() {
        if (isset($_SESSION['announcement_id']) && isset($_SESSION['reservation_time'])) {
            $announcementId = $_SESSION['announcement_id'];
            $reservationTime = $_SESSION['reservation_time'];
            $currentTime = time();
    
            // Define a timeout period in seconds (e.g., 10 minutes)
            $timeout = 10 * 60; // 10 minutes
    
            if ($currentTime - $reservationTime > $timeout) {
                // Release capacity if timeout has passed
                $sql = "UPDATE announcement SET capacity = capacity + 1 WHERE announcement_id = ?";
                $stmt = $this->conn->prepare($sql);
                $stmt->bind_param("i", $announcementId);
                $stmt->execute();
            }
    
            // Clean up session variables
            unset($_SESSION['reservation_time']);
            unset($_SESSION['announcement_id']);
        }
    }
    
    
    // Complete reservation
    public function completeReservation($announcementId) {
        unset($_SESSION['reservation_time']);
        unset($_SESSION['announcement_id']);
        return true;
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
        public function insertEventCalendar($cal_fullname, $cal_Category, $cal_date, $cal_description, $cal_email) {
        $sql = "INSERT INTO event_calendar (cal_fullname, cal_Category, cal_date, cal_description, email) 
                VALUES (?, ?, ?, ?, ?)";
        
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sssss", $cal_fullname, $cal_Category, $cal_date, $cal_description, $cal_email);
        if ($stmt->execute()) {
            return "Event successfully added to the calendar.";
        } else {
            return "Error: " . $stmt->error;
        }
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
                `schedule`.`end_time`
            FROM 
                `announcement`
            JOIN 
                `schedule` ON `announcement`.`schedule_id` = `schedule`.`schedule_id`
            ORDER BY `announcement`.`date_created` DESC";

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

public function insertAppointment($baptismfillId, $priestId, $scheduleId) {
    $sql = "INSERT INTO appointment_schedule (baptismfill_id, priest_id, schedule_id, status, pr_status)
            VALUES (?, ?, ?, 'Process', 'Pending')";
    $stmt = $this->conn->prepare($sql);
    $stmt->bind_param("iii", $baptismfillId, $priestId, $scheduleId);

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


public function getContactInfoAndTitle($baptismfillId) {
    $sql = "SELECT 
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

    $stmt = $this->conn->prepare($sql);
    $stmt->bind_param("i", $baptismfillId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        return $result->fetch_assoc(); // Returns an associative array with email, phone, and event_name
    } else {
        return false; // Returns false if no contact info is found
    }
}

public function approveBaptism($baptismfillId) {
    try {
        $sql = "UPDATE baptismfill SET status = 'Approved' WHERE baptism_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $baptismfillId);
        
        if ($stmt->execute()) {
            return true;  // Status updated successfully
        } else {
            return false;  // Failed to update status
        }
    } catch (Exception $e) {
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
    $sql = "INSERT INTO appointment_schedule (confirmation_id, payable_amount, status, p_status,pr_status)
            VALUES (?, ?,  'Process', 'Unpaid',,'Pending')";
    $stmt = $this->conn->prepare($sql);

    // Bind parameters: 'i' for integer (baptismfill_id, priest_id), 'd' for decimal/float (payable_amount)
    $stmt->bind_param("id",$confirmationfill_id ,$payableAmount);

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
                schedule s ON c.citizend_id = s.citizen_id 
            JOIN 
                confirmationfill cf ON s.schedule_id = cf.schedule_id 
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
    $sql = "INSERT INTO appointment_schedule (marriage_id, payable_amount,priest_id,schedule_id, status, p_status,pr_status)
            VALUES (?, ?,?, ?, 'Process', 'Unpaid','Pending')";
    $stmt = $this->conn->prepare($sql);

    // Bind parameters: 'i' for integer (baptismfill_id, priest_id), 'd' for decimal/float (payable_amount)
    $stmt->bind_param("idii",$weddingffill_id ,$payableAmount,$priestId,$scheduleId);

    // Execute the statement and check for errors
    if ($stmt->execute()) {
        return true; // Successful insertion
    } else {
        error_log("Insertion failed: " . $stmt->error);
        return false; // Insertion failed
    }

    $stmt->close();
}
public function getWeddingContactInfoAndTitles($weddingffill_id) {
    $sql = "SELECT 
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

    $stmt = $this->conn->prepare($sql);
    $stmt->bind_param("i", $weddingffill_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        return $result->fetch_assoc(); // Returns an associative array with email, phone, and event_name
    } else {
        return false; // Returns false if no contact info is found
    }
}

public function approveWedding($weddingffill_id) {
    try {
        $sql = "UPDATE marriagefill SET status = 'Approved' WHERE marriagefill_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $weddingffill_id);
        
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
public function insertfAppointment( $defuctomfill_id, $payableAmount,$priestId,$scheduleId) {
    $sql = "INSERT INTO appointment_schedule (defuctom_id, payable_amount, priest_id,schedule_id, status, p_status,pr_status)
            VALUES (?, ?,?,?, 'Process', 'Unpaid','Pending')";
    $stmt = $this->conn->prepare($sql);

    // Bind parameters: 'i' for integer (baptismfill_id, priest_id), 'd' for decimal/float (payable_amount)
    $stmt->bind_param("idii", $defuctomfill_id ,$payableAmount,$priestId,$scheduleId);

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
        $sql = "UPDATE marriagefill SET status = 'Approved' WHERE marriagefill_id = ?";
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
                b.address
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
                cf.permission_to_confirm ,
                cf.church_address ,
                cf.name_of_church ,
                cf.c_gender ,
                cf.c_date_birth,
             
                cf.c_address
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
                mf.bride_previously_married
              
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
                df.place_of_birth ,
                df.mother_fullname,
                df.cause_of_death,
                df.marital_status,
                df.place_of_death,
                df.d_gender,
                df.date_of_birth ,
                df.date_of_death ,
                df.parents_residence
                
              
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
        switch ($eventType) {
            case 'Baptism':
                return $this->fetchBaptismFill($status);
            case 'Confirmation':
                return $this->fetchConfirmationFill($status);
            case 'Marriage':
                return $this->fetchMarriageFill($status);
            case 'Defuctom':
                return $this->fetchDefuctomFill($status);
            default:
                return array_merge(
                    $this->fetchBaptismFill($status),
                    $this->fetchConfirmationFill($status),
                    $this->fetchMarriageFill($status),
                    $this->fetchDefuctomFill($status)
                );
        }
    }
    
    
    public function getPendingAppointments() {
        $sql = "SELECT 
      
        b.baptism_id AS id,
        b.role AS roles,
        b.event_name AS Event_Name,
        c.fullname AS citizen_name, 
        s.date AS schedule_date,
        s.start_time AS schedule_time,
        a.appsched_id AS appointment_schedule_id,  
        a.baptismfill_id,
        a.priest_id,
        priest.fullname AS priest_name,
        a.schedule_id AS appointment_schedule_id,
        a.payable_amount AS payable_amount,
        a.status AS c_status,
        a.p_status AS p_status,
        sch.date AS appointment_schedule_date,  
        sch.start_time AS appointment_schedule_start_time,
        sch.end_time AS appointment_schedule_end_time
    FROM 
        citizen c
        JOIN schedule s ON c.citizend_id = s.citizen_id
        JOIN baptismfill b ON s.schedule_id = b.schedule_id
        JOIN appointment_schedule a ON b.baptism_id = a.baptismfill_id
        JOIN schedule sch ON a.schedule_id = sch.schedule_id  
        LEFT JOIN citizen priest ON a.priest_id = priest.citizend_id AND priest.user_type = 'Priest' 
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
                    a.appsched_id AS appointment_schedule_id,
                    a.confirmation_id,
                    priest.fullname AS priest_name,
                    a.priest_id,
                    a.schedule_id AS appointment_schedule_id,
                    a.payable_amount AS payable_amount,
                    a.status AS c_status,
                    a.p_status AS p_status,
                    sch.date AS appointment_schedule_date,  -- Additional schedule details from the new join
        sch.start_time AS appointment_schedule_start_time,
         sch.end_time AS appointment_schedule_end_time
              FROM citizen c
                JOIN schedule s ON c.citizend_id = s.citizen_id
                JOIN confirmationfill cf ON s.schedule_id = cf.schedule_id
                JOIN appointment_schedule a ON cf.confirmationfill_id = a.confirmation_id
                JOIN schedule sch ON a.schedule_id = sch.schedule_id
                LEFT JOIN citizen priest ON a.priest_id = priest.citizend_id AND priest.user_type = 'Priest' 
                WHERE a.status = 'Process' OR a.p_status = 'Unpaid'
                

                 UNION ALL
                SELECT 
                
                    mf.marriagefill_id AS id,
                    mf.role AS roles,
                    mf.event_name AS Event_Name,
                    c.fullname AS citizen_name,
                    s.date AS schedule_date,
                    s.start_time AS schedule_time,
                    a.appsched_id AS appointment_schedule_id,
                    a.marriage_id,
                    priest.fullname AS priest_name,
                    a.priest_id,
                    a.schedule_id AS appointment_schedule_id,
                    a.payable_amount AS payable_amount,
                    a.status AS c_status,
                    a.p_status AS p_status,
                    sch.date AS appointment_schedule_date,  -- Additional schedule details from the new join
        sch.start_time AS appointment_schedule_start_time,
         sch.end_time AS appointment_schedule_end_time
                    FROM 
                    citizen c
                    JOIN 
                    schedule s ON c.citizend_id = s.citizen_id
                JOIN 
                    marriagefill mf ON s.schedule_id = mf.schedule_id
                JOIN 
                    appointment_schedule a ON mf.marriagefill_id = a.marriage_id
                    JOIN schedule sch ON a.schedule_id = sch.schedule_id
                    LEFT JOIN citizen priest ON a.priest_id = priest.citizend_id AND priest.user_type = 'Priest' 
                WHERE 
                    a.status = 'Process' OR a.p_status = 'Unpaid'
                UNION ALL
           SELECT 
            df.defuctomfill_id AS id,
            df.role AS roles,
            df.event_name AS Event_Name,
            c.fullname AS citizen_name,
            s.date AS schedule_date,
            s.start_time AS schedule_time,
            a.appsched_id AS appointment_schedule_id,
                    a.defuctom_id,
                    priest.fullname AS priest_name,
                    a.priest_id,
                    a.schedule_id AS appointment_schedule_id,
            a.payable_amount AS payable_amount,
            a.status AS c_status,
            a.p_status AS p_status,
            sch.date AS appointment_schedule_date,  -- Additional schedule details from the new join
        sch.start_time AS appointment_schedule_start_time,
         sch.end_time AS appointment_schedule_end_time
        FROM 
            citizen c
        JOIN 
            schedule s ON c.citizend_id = s.citizen_id
        JOIN 
            defuctomfill df ON s.schedule_id = df.schedule_id
        JOIN 
            appointment_schedule a ON df.defuctomfill_id = a.defuctom_id
            JOIN schedule sch ON a.schedule_id = sch.schedule_id
            LEFT JOIN citizen priest ON a.priest_id = priest.citizend_id AND priest.user_type = 'Priest' 
            WHERE 
                    a.status = 'Process' OR a.p_status = 'Unpaid'";
    
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
        sch.date AS appointment_schedule_date,  -- Additional schedule details from the new join
        sch.start_time AS appointment_schedule_start_time,
         sch.end_time AS appointment_schedule_time
    FROM 
        baptismfill b
    JOIN 
        citizen c ON b.citizen_id = c.citizend_id
    JOIN 
        announcement an ON b.announcement_id = an.announcement_id
    JOIN 
        appointment_schedule a ON b.baptism_id = a.baptismfill_id
    JOIN 
        schedule sch ON a.schedule_id = sch.schedule_id 

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
        sch.date AS appointment_schedule_date,  -- Additional schedule details from the new join
        sch.start_time AS appointment_schedule_start_time,
         sch.end_time AS appointment_schedule_time
    FROM 
        confirmationfill cf
    JOIN 
        citizen c ON cf.citizen_id = c.citizend_id
    JOIN 
        announcement an ON cf.announcement_id = an.announcement_id
    JOIN 
        appointment_schedule a ON cf.confirmationfill_id = a.confirmation_id
    JOIN 
        schedule sch ON a.schedule_id = sch.schedule_id
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
        sch.date AS appointment_schedule_date, 
        sch.start_time AS appointment_schedule_start_time,
         sch.end_time AS appointment_schedule_time
    FROM 
        marriagefill mf
    JOIN 
        citizen c ON mf.citizen_id = c.citizend_id
    JOIN 
        announcement an ON mf.announcement_id = an.announcement_id
    JOIN 
        appointment_schedule a ON mf.marriagefill_id = a.marriage_id
    JOIN 
        schedule sch ON a.schedule_id = sch.schedule_id
    JOIN 
        schedule s ON an.schedule_id = s.schedule_id
    WHERE 
        a.status = 'Process' OR a.p_status = 'Unpaid'";
    
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
                b.address
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
                cf.c_address
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
                mf.bride_previously_married
            FROM 
                marriagefill mf
            JOIN 
                citizen c ON mf.citizen_id = c.citizend_id
            JOIN 
                announcement a ON mf.announcement_id = a.announcement_id
            JOIN 
                schedule s ON a.schedule_id = s.schedule_id
            WHERE 
                mf.status = ? ";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("s", $status);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }
    public function getMassPendingCitizen($eventType = null, $status = 'Pending') {
        switch ($eventType) {
            case 'MassBaptism':
                return $this->getBaptismPendingCitizen($status);
            case 'MassConfirmation':
                return $this->fetchConfirmationFill($status);
            case 'MassMarriage':
                return $this->getMarriagePendingCitizenl($status);
            
            default:
                // Combine all event types if no specific eventType is provided
                return array_merge(
                    $this->getBaptismPendingCitizen($status),
                    $this->getConfirmationPendingCitizen($status),
                    $this->getMarriagePendingCitizen($status)
               
                );
        }
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
        $announcementSql = "INSERT INTO announcement(event_type, title, description, schedule_id, date_created, capacity) VALUES (?, ?, ?, ?, ?, ?)";
        
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
            $announcementStmt->bind_param("sssssi", 
                $announcementData['event_type'], 
                $announcementData['title'], 
                $announcementData['description'], 
                $scheduleId,  // Use the generated schedule_id
                $announcementData['date_created'], 
                $announcementData['capacity']
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
