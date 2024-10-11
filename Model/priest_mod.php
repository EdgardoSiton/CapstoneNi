<?php
class Priest {
    private $conn;
    private $regId;

    public function __construct($conn, $regId = null) {
        $this->conn = $conn;
        $this->regId = $regId;
    }
    public function approveAppointment($appointmentId, $appointmentType) {
        // Determine the correct table and ID field based on the appointment type
        switch ($appointmentType) {
            case 'baptism':
                $table = 'baptismfill';
                $idField = 'baptism_id';
                break;
            case 'confirmation':
                $table = 'confirmationfill';
                $idField = 'confirmationfill_id';
                break;
            case 'defuctom':
                $table = 'defuctomfill';
                $idField = 'defuctomfill_id';
                break;
            case 'marriage':
                $table = 'marriagefill';
                $idField = 'marriagefill_id';
                break;
            default:
                return false; // Invalid appointment type
        }
    
        // Prepare the SQL query
        $query = "UPDATE $table SET pr_status = 'Approved' WHERE $idField = ?";
    
        // Execute the query
        if ($stmt = $this->conn->prepare($query)) {
            $stmt->bind_param("i", $appointmentId);
            if ($stmt->execute()) {
                $stmt->close();
                return true; // Return true on success
            } else {
                $stmt->close();
                return false; // Return false on failure
            }
        } else {
            return false; // Return false if query preparation fails
        }
    }
    
    
    
    public function getPriestAppointmentSchedule($priestId) {
        // SQL query to get the schedule for a specific priest to approve or decline
        $sql = "
        SELECT 
        'baptism' AS type,
         
            b.baptism_id AS id,
            b.role AS roles,
            b.event_name AS Event_Name,
            c.fullname AS citizen_name, 
            s.date AS schedule_date,
            s.start_time AS schedule_time,
            b.priest_id,
            priest.fullname AS priest_name
          
            FROM 
            schedule s
            LEFT JOIN citizen c ON c.citizend_id = s.citizen_id 
        JOIN baptismfill b ON s.schedule_id = b.schedule_id
    
        LEFT JOIN citizen priest ON b.priest_id = priest.citizend_id AND priest.user_type = 'Priest'  
        WHERE b.priest_id = ? 
            AND b.pr_status = 'Pending'
        UNION ALL
        SELECT 
        'confirmation' AS type,
         
            cf.confirmationfill_id AS id,
            cf.role AS roles,
            cf.event_name AS Event_Name,
            c.fullname AS citizen_name,
            s.date AS schedule_date,
            s.start_time AS schedule_time,
         
      
            cf.priest_id,
            priest.fullname AS priest_name
           
          
         
        
            FROM 
            schedule s
            LEFT JOIN citizen c ON c.citizend_id = s.citizen_id 
        JOIN confirmationfill cf ON s.schedule_id = cf.schedule_id
  
    
        LEFT JOIN citizen priest ON cf.priest_id = priest.citizend_id AND priest.user_type = 'Priest'
        WHERE cf.priest_id = ?
            AND cf.pr_status = 'Pending'
        UNION ALL
        SELECT 
        'marriage' AS type,
       
            mf.marriagefill_id AS id,
            mf.role AS roles,
            mf.event_name AS Event_Name,
            c.fullname AS citizen_name,
            s.date AS schedule_date,
            s.start_time AS schedule_time,
           
          
            mf.priest_id,
            priest.fullname AS priest_name
           
         
            FROM 
            schedule s
            LEFT JOIN citizen c ON c.citizend_id = s.citizen_id 
        JOIN marriagefill mf ON s.schedule_id = mf.schedule_id
      
      
        LEFT JOIN citizen priest ON mf.priest_id = priest.citizend_id AND priest.user_type = 'Priest'
        WHERE mf.priest_id = ?
            AND mf.pr_status = 'Pending'
        UNION ALL
        SELECT 
        'defuctom' AS type,
        
            df.defuctomfill_id AS id,
            df.role AS roles,
            df.event_name AS Event_Name,
            c.fullname AS citizen_name,
            s.date AS schedule_date,
            s.start_time AS schedule_time,
              df.priest_id,
            priest.fullname AS priest_name
          
            FROM 
            schedule s
            LEFT JOIN citizen c ON c.citizend_id = s.citizen_id 
        JOIN defuctomfill df ON s.schedule_id = df.schedule_id
    

        LEFT JOIN citizen priest ON df.priest_id = priest.citizend_id AND priest.user_type = 'Priest'
        WHERE df.priest_id = ?
            AND df.pr_status = 'Pending'
        ORDER BY schedule_date ASC
        ";
        
        // Prepare and execute the statement
        $stmt = $this->conn->prepare($sql);
        // Bind priest_id four times (for each placeholder ? in the SQL)
        $stmt->bind_param("iiii", $priestId, $priestId, $priestId, $priestId);
        $stmt->execute();
        $result = $stmt->get_result();
    
        // Fetch the data into an associative array
        $appointments = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $appointments[] = $row;
            }
        }
    
        // Close the statement
        $stmt->close();
    
        // Return the result set (appointments)
        return $appointments;
    }
    
    
    public function getPriestScheduleByDate($priestId, $date) {
        // SQL query to get the schedule for a specific priest to approve or decline
        $sql = "
        SELECT 
           
            b.baptism_id AS id,
            b.role AS roles,
            b.event_name AS Event_Name,
            c.fullname AS citizen_name, 
            s.date AS schedule_date,
            s.start_time AS schedule_time,
            s.end_time AS schedule_end_time,
            b.priest_id,
            priest.fullname AS priest_name
           
        FROM 
            schedule s
            LEFT JOIN citizen c ON c.citizend_id = s.citizen_id 
            JOIN baptismfill b ON s.schedule_id = b.schedule_id
         

            LEFT JOIN citizen priest ON b.priest_id = priest.citizend_id AND priest.user_type = 'Priest'  
        WHERE 
            b.priest_id = ?
            AND b.pr_status = 'Approved'
            AND DATE(s.date) = ?
        
        UNION ALL
        
        SELECT 
        
            cf.confirmationfill_id AS id,
            cf.role AS roles,
            cf.event_name AS Event_Name,
            c.fullname AS citizen_name,
            s.date AS schedule_date,
            s.start_time AS schedule_time,
            s.end_time AS schedule_end_time,
            cf.priest_id,
            priest.fullname AS priest_name
           
         
        FROM 
            schedule s
            LEFT JOIN citizen c ON c.citizend_id = s.citizen_id 
            JOIN confirmationfill cf ON s.schedule_id = cf.schedule_id
           
            LEFT JOIN citizen priest ON cf.priest_id = priest.citizend_id AND priest.user_type = 'Priest'
        WHERE 
            cf.priest_id = ?
            AND cf.pr_status = 'Approved'
            AND DATE(s.date) = ?
        
        UNION ALL
        
        SELECT 
          
            mf.marriagefill_id AS id,
            mf.role AS roles,
            mf.event_name AS Event_Name,
            c.fullname AS citizen_name,
            s.date AS schedule_date,
            s.start_time AS schedule_time,
            s.end_time AS schedule_end_time,
            mf.priest_id,
            priest.fullname AS priest_name
           
        FROM 
            schedule s
            LEFT JOIN citizen c ON c.citizend_id = s.citizen_id 
            JOIN marriagefill mf ON s.schedule_id = mf.schedule_id
            LEFT JOIN citizen priest ON mf.priest_id = priest.citizend_id AND priest.user_type = 'Priest'
        WHERE 
            mf.priest_id = ?
            AND mf.pr_status = 'Approved'
            AND DATE(s.date) = ?
        
        UNION ALL
        
        SELECT 
         
            df.defuctomfill_id AS id,
            df.role AS roles,
            df.event_name AS Event_Name,
            c.fullname AS citizen_name,
            s.date AS schedule_date,
            s.start_time AS schedule_time,
            s.end_time AS schedule_end_time,
            df.priest_id,
            priest.fullname AS priest_name
           
           
        FROM 
            schedule s
            LEFT JOIN citizen c ON c.citizend_id = s.citizen_id 
            JOIN defuctomfill df ON s.schedule_id = df.schedule_id

            LEFT JOIN citizen priest ON df.priest_id = priest.citizend_id AND priest.user_type = 'Priest'
        WHERE 
            df.priest_id = ?
            AND df.pr_status = 'Approved'
            AND DATE(s.date) = ?
        
        ORDER BY schedule_date ASC
        ";
        
        // Prepare and execute the statement
        $stmt = $this->conn->prepare($sql);
        // Bind priest_id and date (four times each, for each UNION)
        $stmt->bind_param("isisisis", $priestId, $date, $priestId, $date, $priestId, $date, $priestId, $date);
        $stmt->execute();
        $result = $stmt->get_result();
    
        // Fetch the data into an associative array
        $appointments = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $appointments[] = $row;
            }
        }
    
        // Close the statement
        $stmt->close();
    
        // Return the result set (appointments)
        return $appointments;
    }
    
}
