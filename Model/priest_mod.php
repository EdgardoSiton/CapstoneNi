<?php
class Priest {
    private $conn;
    private $regId;

    public function __construct($conn, $regId = null) {
        $this->conn = $conn;
        $this->regId = $regId;
    }
    public function approveAppointment($appointmentId) {
        $query = "UPDATE appointment_schedule SET pr_status = 'Approved' WHERE appsched_id = ?";
        
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
        
            a.appsched_id,
            b.baptism_id AS id,
            b.role AS roles,
            b.event_name AS Event_Name,
            c.fullname AS citizen_name, 
            s.date AS schedule_date,
            s.start_time AS schedule_time,
            a.appsched_id AS appointment_schedule_id,  
            a.baptismfill_id AS event_id,
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
            schedule s
            LEFT JOIN citizen c ON c.citizend_id = s.citizen_id 
        JOIN baptismfill b ON s.schedule_id = b.schedule_id
        JOIN appointment_schedule a ON b.baptism_id = a.baptismfill_id
        JOIN schedule sch ON a.schedule_id = sch.schedule_id  
        LEFT JOIN citizen priest ON a.priest_id = priest.citizend_id AND priest.user_type = 'Priest'  
        WHERE a.priest_id = ? 
            AND a.pr_status = 'Pending'
        UNION ALL
        SELECT 
            a.appsched_id,
            cf.confirmationfill_id AS id,
            cf.role AS roles,
            cf.event_name AS Event_Name,
            c.fullname AS citizen_name,
            s.date AS schedule_date,
            s.start_time AS schedule_time,
            a.appsched_id AS appointment_schedule_id,
            a.confirmation_id AS event_id,
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
            schedule s
            LEFT JOIN citizen c ON c.citizend_id = s.citizen_id 
        JOIN confirmationfill cf ON s.schedule_id = cf.schedule_id
        JOIN appointment_schedule a ON cf.confirmationfill_id = a.confirmation_id
        JOIN schedule sch ON a.schedule_id = sch.schedule_id
        LEFT JOIN citizen priest ON a.priest_id = priest.citizend_id AND priest.user_type = 'Priest'
        WHERE a.priest_id = ?
            AND a.pr_status = 'Pending'
        UNION ALL
        SELECT 
            a.appsched_id,
            mf.marriagefill_id AS id,
            mf.role AS roles,
            mf.event_name AS Event_Name,
            c.fullname AS citizen_name,
            s.date AS schedule_date,
            s.start_time AS schedule_time,
            a.appsched_id AS appointment_schedule_id,
            a.marriage_id AS event_id,
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
            schedule s
            LEFT JOIN citizen c ON c.citizend_id = s.citizen_id 
        JOIN marriagefill mf ON s.schedule_id = mf.schedule_id
        JOIN appointment_schedule a ON mf.marriagefill_id = a.marriage_id
        JOIN schedule sch ON a.schedule_id = sch.schedule_id
        LEFT JOIN citizen priest ON a.priest_id = priest.citizend_id AND priest.user_type = 'Priest'
        WHERE a.priest_id = ?
            AND a.pr_status = 'Pending'
        UNION ALL
        SELECT 
            a.appsched_id,
            df.defuctomfill_id AS id,
            df.role AS roles,
            df.event_name AS Event_Name,
            c.fullname AS citizen_name,
            s.date AS schedule_date,
            s.start_time AS schedule_time,
            a.appsched_id AS appointment_schedule_id,
            a.defuctom_id AS event_id,
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
            schedule s
            LEFT JOIN citizen c ON c.citizend_id = s.citizen_id 
        JOIN defuctomfill df ON s.schedule_id = df.schedule_id
        JOIN appointment_schedule a ON df.defuctomfill_id = a.defuctom_id
        JOIN schedule sch ON a.schedule_id = sch.schedule_id
        LEFT JOIN citizen priest ON a.priest_id = priest.citizend_id AND priest.user_type = 'Priest'
        WHERE a.priest_id = ?
            AND a.pr_status = 'Pending'
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
    
    
}
