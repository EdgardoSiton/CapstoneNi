<?php
class Citizen {
    private $conn;
    private $regId;

    public function __construct($conn, $regId = null) {
        $this->conn = $conn;
        $this->regId = $regId;
    }
    
    public function insertMassBaptismFill($citizenId, $announcementId, $fullname, $gender, $address, $dateOfBirth,$fatherFullname, $placeOfBirth, $motherFullname, $religion, $parentResident, $godparent, $status, $eventName, $role) {
        $stmt = $this->conn->prepare("
            INSERT INTO baptismfill (
                citizen_id, announcement_id, fullname, gender, address, c_date_birth, father_fullname, pbirth, mother_fullname, religion, parent_resident, godparent, status, event_name, role
            ) VALUES (?, ?, ?, ?, ?, ?, ?,  ?, ?, ?, ?, ?, ?, ?, ?)
        ");
        
        if ($stmt === FALSE) {
            die("Error: " . $this->conn->error);
        }
    
        $stmt->bind_param(
            "iisssssssssssss",
            $citizenId, $announcementId, $fullname, $gender, $address, $dateOfBirth,  $fatherFullname, $placeOfBirth, $motherFullname, $religion, $parentResident, $godparent, $status, $eventName, $role
        );
    
        if ($stmt->execute() === FALSE) {
            die("Error: " . $stmt->error);
        }
    
        $stmt->close();
    }
    
    
    
    public function getFetchDetails($email) {
        $sql = "SELECT `citizend_id`, `fullname`, `gender`, `c_date_birth`,  `address` FROM `citizen` WHERE `email` = ?";
        $stmt = $this->conn->prepare($sql);
        
        if (!$stmt) {
            error_log("Prepare failed: " . $this->conn->error);
            return null;
        }
    
        $stmt->bind_param("s", $email);
        $stmt->execute();
        
        if ($stmt->errno) {
            error_log("Execute failed: " . $stmt->error);
        }
        
        $result = $stmt->get_result();
        $details = $result->fetch_assoc();
        $stmt->close();
    
        if (!$details) {
            error_log("No details found for email: " . $email);
            return null;
        }
    
        // Split fullname into components
        $names = explode(' ', $details['fullname']);
        $details['firstname'] = $names[0];
        $details['lastname'] = end($names);
        
        // Handle the case where there's a middle name
        if (count($names) > 2) {
            $details['middlename'] = implode(' ', array_slice($names, 1, -1));
        } else {
            $details['middlename'] = '';
        }
    
        return $details;
    }
    

    public function insertIntoBaptismFill($scheduleId, $fatherFullname, $fullname, $gender, $c_date_birth, $address, $pbirth, $mother_fullname, $religion, $parentResident, $godparent) {
        $sql = "INSERT INTO baptismfill (schedule_id, father_fullname, fullname, gender, c_date_birth, address, pbirth, mother_fullname, religion, parent_resident, godparent, status, event_name, role) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'Pending', 'Baptism', 'Online')";
        $stmt = $this->conn->prepare($sql);
    
        // Use 'issssssssss' for the type definition string, corresponding to the parameters
        $stmt->bind_param("issssssssss", $scheduleId, $fatherFullname, $fullname, $gender, $c_date_birth, $address, $pbirth, $mother_fullname, $religion, $parentResident, $godparent);

        if (!$stmt->execute()) {
            error_log("Insert failed: " . $stmt->error);
        }
        $stmt->close();
    }
    public function insertIntoConfirmFill($scheduleId, $fullname, $gender, $c_date_birth, $address,  $date_of_baptism, $name_of_church, $father_fullname, $mother_fullname, $permission_to_confirm, $church_address) {
        $sql = "INSERT INTO confirmationfill (schedule_id, fullname, c_gender, c_date_birth, c_address,  date_of_baptism, name_of_church, father_fullname, mother_fullname, permission_to_confirm, church_address, status, event_name, role) 
                VALUES (?, ?, ?,  ?, ?, ?,  ?, ?, ?, ?, ?, 'Pending', 'Confirmation', 'Online')";
        $stmt = $this->conn->prepare($sql);
        
        // Use 'isssssssssssss' for the type definition string, corresponding to the parameters
        $stmt->bind_param("issssssssss", $scheduleId, $fullname, $gender, $c_date_birth, $address,  $date_of_baptism, $name_of_church, $father_fullname, $mother_fullname, $permission_to_confirm, $church_address);
    
        if (!$stmt->execute()) {
            error_log("Insert failed: " . $stmt->error);
        }
        $stmt->close();
    }
    
    public function insertSchedule($citizenId, $date, $startTime, $endTime) {
        $sql = "INSERT INTO `schedule` (`citizen_id`, `date`, `start_time`, `end_time`) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("isss", $citizenId, $date, $startTime, $endTime);
        if (!$stmt->execute()) {
            error_log("Insert failed: " . $stmt->error);
            return false;
        }
        // Return the ID of the inserted schedule
        return $this->conn->insert_id;
    }
    public function insertFuneralFill($scheduleId, $d_fullname, $d_address, $d_gender, $cause_of_death, $marital_status, $place_of_birth, $father_fullname, $date_of_birth, $mother_fullname, $parents_residence, $date_of_death, $place_of_death) {
        $status = 'Pending';
        $event_name = 'Funeral';
        $role = 'Online';
    
        $sql = "INSERT INTO defuctomfill (schedule_id, d_fullname, d_address, d_gender, cause_of_death, marital_status, place_of_birth, father_fullname, date_of_birth,  mother_fullname, parents_residence, date_of_death, place_of_death, status, event_name, role) 
                VALUES (?, ?,?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("isssssssssssssss", $scheduleId, $d_fullname, $d_address, $d_gender, $cause_of_death, $marital_status, $place_of_birth, $father_fullname, $date_of_birth,  $mother_fullname, $parents_residence, $date_of_death, $place_of_death, $status, $event_name, $role);
    
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function insertWeddingFill($scheduleId, $groom_name, $groom_dob, $groom_place_of_birth, $groom_citizenship, $groom_address, $groom_religion, $groom_previously_married, $bride_name, $bride_dob, $bride_place_of_birth, $bride_citizenship, $bride_address, $bride_religion, $bride_previously_married) {
        $status = 'Pending';
        $event_name = 'Wedding';
        $role = 'Online';
    
        $sql = "INSERT INTO marriagefill (schedule_id, groom_name, groom_dob, groom_place_of_birth, groom_citizenship, groom_address, groom_religion, groom_previously_married, bride_name, bride_dob, bride_place_of_birth, bride_citizenship, bride_address, bride_religion, bride_previously_married, status, event_name, role) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("isssssssssssssssss", $scheduleId, $groom_name, $groom_dob, $groom_place_of_birth, $groom_citizenship, $groom_address, $groom_religion, $groom_previously_married, $bride_name, $bride_dob, $bride_place_of_birth, $bride_citizenship, $bride_address, $bride_religion, $bride_previously_married, $status, $event_name, $role);
    
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
    
    public function getSchedule($date) {
        $sql = "SELECT `start_time`, `end_time` FROM `schedule` WHERE `date` = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $date);
        $stmt->execute();
        $result = $stmt->get_result();
        $schedules = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        return $schedules;
    }

    public function updateCitizen($fullname, $gender, $address) {
        $sql = "UPDATE `citizen` SET `fullname` = ?, `gender` = ?, `address` = ? WHERE `citizend_id` = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sssi", $fullname, $gender, $address, $this->regId);
        if (!$stmt->execute()) {
            error_log("Update failed: " . $stmt->error);
        }
        $stmt->close();
    }
}
?>
