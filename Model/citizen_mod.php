<?php
class Citizen {
    private $conn;
    private $regId;

    public function __construct($conn, $regId = null) {
        $this->conn = $conn;
        $this->regId = $regId;
    }
    public function insertWalkinWeddingFill($scheduleId, $groom_name, $groom_dob, $groom_place_of_birth, $groom_citizenship, $groom_address, $groom_religion, $groom_previously_married,$groomage, $bride_name, $bride_dob, $bride_place_of_birth, $bride_citizenship, $bride_address, $bride_religion, $bride_previously_married,$brideage) {
      
    
        $sql = "INSERT INTO marriagefill (schedule_id, groom_name, groom_dob, groom_place_of_birth, groom_citizenship, groom_address, groom_religion, groom_previously_married,groom_age, bride_name, bride_dob, bride_place_of_birth, bride_citizenship, bride_address, bride_religion, bride_previously_married,bride_age, status, event_name, role) 
                VALUES (?, ?, ?, ?, ?, ?, ?,?,?, ?, ?, ?, ?, ?, ?, ?, ?, 'Pending', 'Wedding','Walkin')";
    
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("isssssssisssssssi", $scheduleId, $groom_name, $groom_dob, $groom_place_of_birth, $groom_citizenship, $groom_address, $groom_religion, $groom_previously_married,$groomage, $bride_name, $bride_dob, $bride_place_of_birth, $bride_citizenship, $bride_address, $bride_religion, $bride_previously_married,$brideage);
        if ($stmt->execute()) {
            // Return the last inserted ID
            $weddingffill_id = $this->conn->insert_id;
            $stmt->close();
            return $weddingffill_id;
        } else {
            error_log("Insert failed: " . $stmt->error);
            $stmt->close();
            return false;
        }
    }
    
    public function insertwAppointment($weddingffill_id, $payableAmount, $priestId,$scheduleId) {
        $referenceNumber = $this->generateReferenceNumber();
       $sql = "INSERT INTO appointment_schedule (marriage_id, payable_amount,priest_id,schedule_id, status, p_status,pr_status,reference_number)
                VALUES (?, ?,?, ?, 'Process', 'Unpaid','Pending',?)";
        $stmt = $this->conn->prepare($sql);
    
        // Bind parameters: 'i' for integer (baptismfill_id, priest_id), 'd' for decimal/float (payable_amount)
        $stmt->bind_param("idiis",$weddingffill_id ,$payableAmount,$priestId,$scheduleId,$referenceNumber);
        if ($stmt->execute()) {
            // Get the last inserted ID
            $weddingffill_id = $this->conn->insert_id;
            $stmt->close();
            return $weddingffill_id;  // Return the ID of the newly inserted record
        } else {
            error_log("Insertion failed: " . $stmt->error);
            $stmt->close();
            return false;  // Insertion failed
        } 
    }
    public function insertAppointment($baptismfillId = null, $payableAmount = null, $priestId  = null, $scheduleId = null) {
        // Generate a random 12-letter reference number
        $referenceNumber = $this->generateReferenceNumber();
    
        $sql = "INSERT INTO appointment_schedule (baptismfill_id, payable_amount, priest_id, schedule_id, status, pr_status,p_status, reference_number) 
                VALUES (?, ?, ?, ?, 'Process', 'Pending','Unpaid', ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("idiis", $baptismfillId, $payableAmount, $priestId, $scheduleId, $referenceNumber);
    
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
    public function insertWalkinFuneralFill($scheduleId, $d_fullname, $d_address, $d_gender, $cause_of_death, $marital_status, $place_of_birth, $father_fullname, $date_of_birth,$birthage, $mother_fullname, $parents_residence, $date_of_death, $place_of_death) {
        $status = 'Pending';
        $event_name = 'Funeral';
        $role = 'Walkin';
    
        $sql = "INSERT INTO defuctomfill (schedule_id, d_fullname, d_address, d_gender, cause_of_death, marital_status, place_of_birth, father_fullname, date_of_birth,age,  mother_fullname, parents_residence, date_of_death, place_of_death, status, event_name, role) 
                VALUES (?, ?,?, ?, ?,?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("issssssssisssssss", $scheduleId, $d_fullname, $d_address, $d_gender, $cause_of_death, $marital_status, $place_of_birth, $father_fullname, $date_of_birth,$birthage,  $mother_fullname, $parents_residence, $date_of_death, $place_of_death, $status, $event_name, $role);
        if ($stmt->execute()) {
            // Return the last inserted ID
            $defuctomfill_id = $this->conn->insert_id;
            $stmt->close();
            return $defuctomfill_id;
        } else {
            error_log("Insert failed: " . $stmt->error);
            $stmt->close();
            return false;
        }
    }
    public function insertfAppointment( $defuctomfill_id, $payableAmount,$priestId) {
        $referenceNumber = $this->generateReferenceNumber();
       $sql = "INSERT INTO appointment_schedule (defuctom_id, payable_amount, priest_id, status, p_status,pr_status,reference_number)
                VALUES (?, ?,?, 'Process', 'Unpaid','Pending',?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("idis", $defuctomfill_id ,$payableAmount,$priestId, $referenceNumber);
    
        if ($stmt->execute()) {
            // Get the last inserted ID
            $defuctomfill_id = $this->conn->insert_id;
            $stmt->close();
            return $defuctomfill_id;  // Return the ID of the newly inserted record
        } else {
            error_log("Insertion failed: " . $stmt->error);
            $stmt->close();
            return false;  // Insertion failed
        }
    }
    public function insertIntoWalkinBaptismFill($scheduleId, $fatherFullname, $fullname, $gender, $c_date_birth, $address, $pbirth, $mother_fullname, $religion, $parentResident, $godparent, $age) {
        $sql = "INSERT INTO baptismfill (schedule_id, father_fullname, fullname, gender, c_date_birth, address, pbirth, mother_fullname, religion, parent_resident, godparent, age, status, event_name, role, created_at) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'Pending', 'Baptism', 'Walk In', CURRENT_TIMESTAMP)";
        
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
    public function fetchBaptismFillss($regId) {
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
                b.status IN ( 'Pending') AND c.citizend_id = ? ";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $regId);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }
    
    public function fetchConfirmationFillss($regId) {
        $query = "
            SELECT 
   
                cf.fullname AS citizen_name,
                s.date AS schedule_date,
                s.start_time AS schedule_start_time,
                s.end_time AS schedule_end_time,
                cf.event_name AS event_name,
                cf.status AS approval_status,
                cf.role AS roles,
                cf.confirmationfill_id AS id,
                'Confirmation' AS type,
             
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
                citizen c
            JOIN 
                schedule s ON c.citizend_id = s.citizen_id
            JOIN 
                confirmationfill cf ON s.schedule_id = cf.schedule_id
             
              
            WHERE 
                cf.status IN ('Pending') AND c.citizend_id = ? ";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $regId);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }
    
    
    public function fetchMarriageFillss($regId) {
        $query = "
            SELECT 
   
                mf.groom_name AS citizen_name,
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
                mf.status IN ( 'Pending') AND c.citizend_id = ? ";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $regId);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }
    
    
    public function fetchDefuctomFillss($regId) {
        $query = "
            SELECT 

                df.d_fullname AS citizen_name,
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
                df.parents_residence
            FROM 
                citizen c
            JOIN 
                schedule s ON c.citizend_id = s.citizen_id
            JOIN 
                defuctomfill df ON s.schedule_id = df.schedule_id
              
              
            WHERE 
                df.status IN ( 'Pending') AND c.citizend_id = ? ";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $regId);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }
    
    public function getPendingCitizenss($eventType = null, $regId) {
        switch ($eventType) {
            case 'Baptism':
                return $this->fetchBaptismFillss($regId);
            case 'Confirmation':
                return $this->fetchConfirmationFillss($regId);
            case 'Marriage':
                return $this->fetchMarriageFillss($regId);
            case 'Defuctom':
                return $this->fetchDefuctomFillss($regId);
            default:
                return array_merge(
                    $this->fetchBaptismFillss($regId),
                    $this->fetchConfirmationFillss($regId),
                    $this->fetchMarriageFillss($regId),
                    $this->fetchDefuctomFillss($regId)
                );
        }
    }
    public function fetchBaptismFills($regId) {
        $query = "
            SELECT 
           
            a.payable_amount,
            a.status,
           a.appsched_id AS appointment_id,
           a.reference_number,
            sch.date AS seminar_date,
            sch.start_time AS seminar_starttime,
            sch.end_time AS seminar_endtime,
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
                JOIN appointment_schedule a ON b.baptism_id = a.baptismfill_id
            
                JOIN schedule sch ON a.schedule_id = sch.schedule_id 
             
            WHERE 
                b.status IN ( 'Approved') AND c.citizend_id = ?";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $regId);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }
    
    public function fetchConfirmationFills($regId) {
        $query = "
            SELECT 
            a.payable_amount,
            a.status,
            a.appsched_id AS appointment_id,
            a.reference_number,
            sch.date AS seminar_date,
            sch.start_time AS seminar_starttime,
            sch.end_time AS seminar_endtime,
                cf.fullname AS citizen_name,
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
                citizen c
            JOIN 
                schedule s ON c.citizend_id = s.citizen_id
            JOIN 
                confirmationfill cf ON s.schedule_id = cf.schedule_id
                JOIN appointment_schedule a ON cf.confirmationfill_id = a.confirmation_id
                JOIN schedule sch ON a.schedule_id = sch.schedule_id
              
            WHERE 
                cf.status IN ('Approved') AND c.citizend_id = ?";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $regId);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }
    
    
    public function fetchMarriageFills($regId) {
        $query = "
            SELECT 
            a.payable_amount,
            a.status,
            a.appsched_id AS appointment_id,
            a.reference_number,
            sch.date AS seminar_date,
            sch.start_time AS seminar_starttime,
            sch.end_time AS seminar_endtime,
                mf.groom_name AS citizen_name,
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
                JOIN 
                appointment_schedule a ON mf.marriagefill_id = a.marriage_id
                JOIN schedule sch ON a.schedule_id = sch.schedule_id
               
            WHERE 
                mf.status IN ( 'Approved') AND c.citizend_id = ?";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $regId);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }
    
    
    public function fetchDefuctomFills($regId) {
        $query = "
            SELECT 
          a.payable_amount,
          a.status,
          a.reference_number,
            a.appsched_id AS appointment_id,
            sch.date AS seminar_date,
            sch.start_time AS seminar_starttime,
            sch.end_time AS seminar_endtime,
                df.d_fullname AS citizen_name,
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
                df.parents_residence
            FROM 
                citizen c
            JOIN 
                schedule s ON c.citizend_id = s.citizen_id
            JOIN 
                defuctomfill df ON s.schedule_id = df.schedule_id
                JOIN 
                appointment_schedule a ON df.defuctomfill_id = a.defuctom_id
                JOIN schedule sch ON a.schedule_id = sch.schedule_id
               
            WHERE 
                df.status IN ( 'Approved') AND c.citizend_id = ?";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $regId);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }
    
    public function getPendingCitizens($eventType = null, $regId) {
        switch ($eventType) {
            case 'Baptism':
                return $this->fetchBaptismFills($regId);
            case 'Confirmation':
                return $this->fetchConfirmationFills($regId);
            case 'Marriage':
                return $this->fetchMarriageFills($regId);
            case 'Defuctom':
                return $this->fetchDefuctomFills($regId);
            default:
                return array_merge(
                    $this->fetchBaptismFills($regId),
                    $this->fetchConfirmationFills($regId),
                    $this->fetchMarriageFills($regId),
                    $this->fetchDefuctomFills($regId)
                );
        }
    }

    

    public function insertIntoMassConfirmFill($citizenId,$announcementId, $fullname, $gender, $c_date_birth,$cage, $address,  $date_of_baptism, $name_of_church, $father_fullname, $mother_fullname, $permission_to_confirm, $church_address) {
        $sql = "INSERT INTO confirmationfill (citizen_id,announcement_id, fullname, c_gender, c_date_birth,c_age, c_address,  date_of_baptism, name_of_church, father_fullname, mother_fullname, permission_to_confirm, church_address, status, event_name, role) 
                VALUES (?,?, ?, ?,?,  ?, ?, ?,  ?, ?, ?, ?, ?, 'Pending', 'MassConfirmation', 'Online')";
        $stmt = $this->conn->prepare($sql);
        
        // Use 'isssssssssssss' for the type definition string, corresponding to the parameters
        $stmt->bind_param("iisssisssssss", $citizenId,$announcementId, $fullname, $gender, $c_date_birth,$cage, $address,  $date_of_baptism, $name_of_church, $father_fullname, $mother_fullname, $permission_to_confirm, $church_address);
    
        if (!$stmt->execute()) {
            error_log("Insert failed: " . $stmt->error);
        }
        $stmt->close();
    }
    
    public function insertMassWeddingFill($citizenId,$announcementId, $groom_name, $groom_dob, $groom_place_of_birth, $groom_citizenship, $groom_address, $groom_religion, $groom_previously_married, $groomage, $bride_name, $bride_dob, $bride_place_of_birth, $bride_citizenship, $bride_address, $bride_religion, $bride_previously_married,$brideage, $status,$event_name,$role) {
        
    
        $sql = "INSERT INTO marriagefill (citizen_id,announcement_id, groom_name, groom_dob, groom_place_of_birth, groom_citizenship, groom_address, groom_religion, groom_previously_married,groom_age, bride_name, bride_dob, bride_place_of_birth, bride_citizenship, bride_address, bride_religion, bride_previously_married,bride_age, status, event_name, role) 
                VALUES (?,?, ?, ?, ?, ?, ?, ?, ?, ?,?,?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("iisssssssisssssssisss", $citizenId,$announcementId, $groom_name, $groom_dob, $groom_place_of_birth, $groom_citizenship, $groom_address, $groom_religion, $groom_previously_married,$groomage, $bride_name, $bride_dob, $bride_place_of_birth, $bride_citizenship, $bride_address, $bride_religion, $bride_previously_married,$brideage, $status, $event_name, $role);
    
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function insertMassBaptismFill($citizenId, $announcementId, $fullname, $gender, $address, $dateOfBirth,$fatherFullname, $placeOfBirth, $motherFullname, $religion, $parentResident, $godparent, $age, $status, $eventName, $role) {
        $stmt = $this->conn->prepare("
            INSERT INTO baptismfill (
                citizen_id, announcement_id, fullname, gender, address, c_date_birth, father_fullname, pbirth, mother_fullname, religion, parent_resident, godparent,age, status, event_name, role
            ) VALUES (?, ?, ?, ?, ?, ?, ?,  ?, ?, ?, ?, ?, ?, ?, ?,?)
        ");
        
        if ($stmt === FALSE) {
            die("Error: " . $this->conn->error);
        }
    
        $stmt->bind_param(
            "iissssssssssisss",
            $citizenId, $announcementId, $fullname, $gender, $address, $dateOfBirth,$fatherFullname, $placeOfBirth, $motherFullname, $religion, $parentResident, $godparent, $age, $status, $eventName, $role
        );
    
        if ($stmt->execute() === FALSE) {
            die("Error: " . $stmt->error);
        }
    
        $stmt->close();
    }
    
    
    
    public function getFetchDetails($email) {
        $sql = "SELECT `citizend_id`, `fullname`, `gender`, `c_date_birth`,  `address`,  `phone`FROM `citizen` WHERE `email` = ?";
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

    public function insertIntoBaptismFill($scheduleId, $fatherFullname, $fullname, $gender, $c_date_birth, $address, $pbirth, $mother_fullname, $religion, $parentResident, $godparent,$age) {
        $sql = "INSERT INTO baptismfill (schedule_id, father_fullname, fullname, gender, c_date_birth, address, pbirth, mother_fullname, religion, parent_resident, godparent,age, status, event_name, role,created_at) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?, 'Pending', 'Baptism', 'Online',CURRENT_TIMESTAMP)";
        $stmt = $this->conn->prepare($sql);
    
        // Use 'issssssssss' for the type definition string, corresponding to the parameters
        $stmt->bind_param("issssssssssi", $scheduleId, $fatherFullname, $fullname, $gender, $c_date_birth, $address, $pbirth, $mother_fullname, $religion, $parentResident, $godparent,$age);

        if (!$stmt->execute()) {
            error_log("Insert failed: " . $stmt->error);
        }
        $stmt->close();
    }
    public function insertRequestFormFill($selectrequest = null, $fullname = null, $datetofollowup = null, $address = null, $cpnumber = null, $fullnames = null, $chapel = null) {
        $sql = "INSERT INTO req_form (req_category, req_person, cal_date, req_address, req_pnumber, req_name_pamisahan, req_chapel, status, role, created_at) 
                VALUES (?, ?, ?, ?, ?, ?, ?, 'Pending', 'Online', CURRENT_TIMESTAMP)";
        
        $stmt = $this->conn->prepare($sql);
        
        // Use 'sssssss' for the type definition string, corresponding to the parameters
        $stmt->bind_param("sssssss", $selectrequest, $fullname, $datetofollowup, $address, $cpnumber, $fullnames, $chapel);
    
        if (!$stmt->execute()) {
            error_log("Insert failed: " . $stmt->error);
        }
        $stmt->close();
    }
    
    
    public function insertIntoConfirmFill($scheduleId, $fullname, $gender, $c_date_birth, $address,  $date_of_baptism, $name_of_church, $father_fullname, $mother_fullname, $permission_to_confirm, $church_address,$age) {
        $sql = "INSERT INTO confirmationfill (schedule_id, fullname, c_gender, c_date_birth, c_address,  date_of_baptism, name_of_church, father_fullname, mother_fullname, permission_to_confirm, church_address,c_age, status, event_name, role) 
                VALUES (?, ?, ?,  ?, ?, ?,  ?, ?, ?, ?, ?,?, 'Pending', 'Confirmation', 'Online')";
        $stmt = $this->conn->prepare($sql);
        
        // Use 'isssssssssssss' for the type definition string, corresponding to the parameters
        $stmt->bind_param("issssssssssi", $scheduleId, $fullname, $gender, $c_date_birth, $address,  $date_of_baptism, $name_of_church, $father_fullname, $mother_fullname, $permission_to_confirm, $church_address,$age);
    
        if (!$stmt->execute()) {
            error_log("Insert failed: " . $stmt->error);
        }
        $stmt->close();
    }
    
    public function insertSchedule($citizenId, $date, $startTime, $endTime) {
        $sql = "INSERT INTO `schedule` (`citizen_id`, `date`, `start_time`, `end_time`, `event_type`) VALUES (?, ?, ?, ?,'Appointment')";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("isss", $citizenId, $date, $startTime, $endTime);
        if (!$stmt->execute()) {
            error_log("Insert failed: " . $stmt->error);
            return false;
        }
        // Return the ID of the inserted schedule
        return $this->conn->insert_id;
    }
    public function insertFuneralFill($scheduleId, $d_fullname, $d_address, $d_gender, $cause_of_death, $marital_status, $place_of_birth, $father_fullname, $date_of_birth,$birthage, $mother_fullname, $parents_residence, $date_of_death, $place_of_death) {
        $status = 'Pending';
        $event_name = 'Funeral';
        $role = 'Online';
    
        $sql = "INSERT INTO defuctomfill (schedule_id, d_fullname, d_address, d_gender, cause_of_death, marital_status, place_of_birth, father_fullname, date_of_birth,age,  mother_fullname, parents_residence, date_of_death, place_of_death, status, event_name, role) 
                VALUES (?, ?,?, ?, ?,?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("issssssssisssssss", $scheduleId, $d_fullname, $d_address, $d_gender, $cause_of_death, $marital_status, $place_of_birth, $father_fullname, $date_of_birth,$birthage,  $mother_fullname, $parents_residence, $date_of_death, $place_of_death, $status, $event_name, $role);
    
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function insertWeddingFill($scheduleId, $groom_name, $groom_dob, $groom_place_of_birth, $groom_citizenship, $groom_address, $groom_religion, $groom_previously_married,$groomage, $bride_name, $bride_dob, $bride_place_of_birth, $bride_citizenship, $bride_address, $bride_religion, $bride_previously_married,$brideage) {
      
    
        $sql = "INSERT INTO marriagefill (schedule_id, groom_name, groom_dob, groom_place_of_birth, groom_citizenship, groom_address, groom_religion, groom_previously_married,groom_age, bride_name, bride_dob, bride_place_of_birth, bride_citizenship, bride_address, bride_religion, bride_previously_married,bride_age, status, event_name, role) 
                VALUES (?, ?, ?, ?, ?, ?, ?,?,?, ?, ?, ?, ?, ?, ?, ?, ?, 'Pending', 'Wedding','Online')";
    
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("isssssssisssssssi", $scheduleId, $groom_name, $groom_dob, $groom_place_of_birth, $groom_citizenship, $groom_address, $groom_religion, $groom_previously_married,$groomage, $bride_name, $bride_dob, $bride_place_of_birth, $bride_citizenship, $bride_address, $bride_religion, $bride_previously_married,$brideage);
    
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
    
    public function getSchedule($date) {
        $sql = "
            SELECT s.`start_time`, s.`end_time`
            FROM `schedule` s
            INNER JOIN `baptismfill` b ON s.`schedule_id` = b.`schedule_id`
            WHERE s.`date` = ?
            
            UNION
            
            SELECT s.`start_time`, s.`end_time`
            FROM `schedule` s
            INNER JOIN `confirmationfill` c ON s.`schedule_id` = c.`schedule_id`
            WHERE s.`date` = ?
    
            UNION
    
            SELECT s.`start_time`, s.`end_time`
            FROM `schedule` s
            INNER JOIN `defuctomfill` d ON s.`schedule_id` = d.`schedule_id`
            WHERE s.`date` = ?
    
            UNION
    
            SELECT s.`start_time`, s.`end_time`
            FROM `schedule` s
            INNER JOIN `marriagefill` m ON s.`schedule_id` = m.`schedule_id`
            WHERE s.`date` = ?
    
            UNION
    
            SELECT s.`start_time`, s.`end_time`
            FROM `schedule` s
            INNER JOIN `announcement` a ON s.`schedule_id` = a.`schedule_id`
            WHERE s.`date` = ?
        ";
    
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sssss", $date, $date, $date, $date, $date); // Bind the date parameter five times for each SELECT
        $stmt->execute();
        $result = $stmt->get_result();
        $schedules = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
    
        return $schedules;
    }
    public function requestgetSchedule($date) {
        $sql = "
          
    
            SELECT s.`start_time`, s.`end_time`
            FROM `schedule` s
            INNER JOIN `req_form` r ON s.`schedule_id` = r.`schedule_id`
            WHERE s.`date` = ?
    
        ";
    
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $date); // Bind the date parameter five times for each SELECT
        $stmt->execute();
        $result = $stmt->get_result();
        $schedules = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
    
        return $schedules;
    }

    public function getAvailablePriests($selectedDate, $startTime, $endTime) {
        // Query to fetch available priests excluding those already booked on the selected date and time
        $sql = "
           SELECT 
                c.citizend_id,
                c.fullname
            FROM 
                citizen c
            WHERE 
                c.user_type = 'Priest' 
                AND NOT EXISTS (
                    SELECT 1
                    FROM appointment_schedule a
                    JOIN baptismfill b ON a.baptismfill_id = b.baptism_id
                    JOIN schedule s ON b.schedule_id = s.schedule_id
                    WHERE 
                        a.priest_id = c.citizend_id
                        AND s.date = ?  -- The date for the appointment
                        AND (
                            (s.start_time <= ? AND s.end_time >= ?)  -- Check if the priest is busy during the specified time
                        )
                )";
        
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sss", $selectedDate, $startTime, $endTime);
        $stmt->execute();
        $result = $stmt->get_result();
    
        $priests = [];
        while ($row = $result->fetch_assoc()) {
            $priests[] = $row;
        }
    
        $stmt->close();
        return $priests;
    }
    
    public function getPriests() {
        $sql = "SELECT citizend_id, fullname FROM citizen WHERE user_type = 'Priest'";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();

        $priests = [];
        while ($row = $result->fetch_assoc()) {
            $priests[] = $row;
        }

        $stmt->close();
        return $priests;
    }
}
?>
