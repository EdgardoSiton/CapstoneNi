<?php
class Staff {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    
    }

    public function getAnnouncements() {
        $sql = "SELECT 
                    `announcement`.`announcenment_id`,
                    `announcement`.`event_type`,
                    `announcement`.`title`,
                    `announcement`.`description`,
                    `announcement`.`date_created`,
                    `announcement`.`capacity`,
                    `schedule`.`date`,
                    `schedule`.`start_time`
               
                FROM 
                    `announcement`
                JOIN 
                    `schedule` ON `announcement`.`schedule_id` = `schedule`.`schedule_id`
                ORDER BY date_created DESC";

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
    public function getPendingCitizen() {
        $sql = "SELECT 
                    b.fullname AS citizen_name,
                    s.date AS schedule_date,
                    s.start_time AS schedule_start_time,
                    b.event_name AS event_name,
                    b.status AS approval_status,
                    b.role AS roles,
                    b.baptism_id AS id,
                    'Baptism' AS type
                FROM 
                    citizen c
                JOIN 
                    schedule s ON c.citizend_id = s.citizen_id
                JOIN 
                    baptismfill b ON s.schedule_id = b.schedule_id
                WHERE 
                    b.status = 'Pending'
                UNION ALL
                SELECT 
               c.fullname AS citizen_name,
                    s.date AS schedule_date,
                    s.start_time AS schedule_start_time,
                    cf.event_name AS event_name,
                    cf.status AS approval_status,
                    cf.role AS roles,
                    cf.confirmationfill_id AS id,
                    'Confirmation' AS type
                FROM 
                    citizen c
                JOIN 
                    schedule s ON c.citizend_id = s.citizen_id
                JOIN 
                    confirmationfill cf ON s.schedule_id = cf.schedule_id
                WHERE 
                    cf.status = 'Pending'
                UNION ALL
                SELECT 
                c.fullname AS citizen_name,
                    s.date AS schedule_date,
                    s.start_time AS schedule_start_time,
                    mf.event_name AS event_name,
                    mf.status AS approval_status,
                    mf.role AS roles,
                    mf.marriagefill_id AS id,
                    'Marriage' AS type
                FROM 
                    citizen c
                JOIN 
                    schedule s ON c.citizend_id = s.citizen_id
                JOIN 
                    marriagefill mf ON s.schedule_id = mf.schedule_id
                WHERE 
                    mf.status = 'Pending'
                UNION ALL
                SELECT 
                c.fullname AS citizen_name,
                    s.date AS schedule_date,
                    s.start_time AS schedule_start_time,
                    df.event_name AS event_name,
                    df.status AS approval_status,
                    df.role AS roles,
                    df.defuctomfill_id AS id,
                    'Defuctom' AS type
                FROM 
                    citizen c
                JOIN 
                    schedule s ON c.citizend_id = s.citizen_id
                JOIN 
                    defuctomfill df ON s.schedule_id = df.schedule_id
                WHERE 
                    df.status = 'Pending'";
    
        $result = $this->conn->query($sql);
    
        if ($result === FALSE) {
            die("Error: " . $this->conn->error);
        }
    
        $pendingItems = [];
        while ($row = $result->fetch_assoc()) {
            $pendingItems[] = $row;
        }
        return $pendingItems;
    }
    public function getPendingAppointments() {
        $sql = "SELECT 
                    b.baptism_id AS id,
                    b.role AS roles,
                    b.event_name AS Event_Name,
                    c.fullname AS citizen_name,
                    s.date AS schedule_date,
                    s.start_time AS schedule_time,
                  
                    a.app_date AS appointment_date,
                    a.app_time AS appointment_time,
                    a.payable_amount AS payable_amount,
                    a.status AS c_status,
                    a.p_status AS p_status
                FROM 
                    citizen c
                    JOIN 
                    schedule s ON c.citizend_id = s.citizen_id
                JOIN 
                    baptismfill b ON s.schedule_id = b.schedule_id
                JOIN 
                    appointment_schedule a ON b.baptism_id = a.baptismfill_id
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
                    a.app_date AS appointment_date,
                    a.app_time AS appointment_time,
                    a.payable_amount AS payable_amount,
                    a.status AS c_status,
                    a.p_status AS p_status
                    FROM 
                    citizen c
                    JOIN 
                    schedule s ON c.citizend_id = s.citizen_id
                JOIN 
                    confirmationfill cf ON s.schedule_id = cf.schedule_id
                JOIN 
                    appointment_schedule a ON cf.confirmationfill_id = a.confirmation_id
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
                    
                    a.app_date AS appointment_date,
                    a.app_time AS appointment_time,
                    a.payable_amount AS payable_amount,
                    a.status AS c_status,
                    a.p_status AS p_status
                    FROM 
                    citizen c
                    JOIN 
                    schedule s ON c.citizend_id = s.citizen_id
                JOIN 
                    marriagefill mf ON s.schedule_id = mf.schedule_id
                JOIN 
                    appointment_schedule a ON mf.marriagefill_id = a.marriage_id
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
                    
                    a.app_date AS appointment_date,
                    a.app_time AS appointment_time,
                    a.payable_amount AS payable_amount,
                    a.status AS c_status,
                    a.p_status AS p_status
                    FROM 
                    citizen c
                    JOIN 
                    schedule s ON c.citizend_id = s.citizen_id
                JOIN 
                    defuctomfill df ON s.schedule_id = df.schedule_id
                JOIN 
                    appointment_schedule a ON df.defuctomfill_id = a.defuctom_id
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
        a.app_date AS appointment_date,
        a.app_time AS appointment_time,
        a.payable_amount AS payable_amount,
        a.status AS c_status,
        a.p_status AS p_status
    FROM 
        baptismfill b
    JOIN 
        citizen c ON b.citizen_id = c.citizend_id
    JOIN 
        announcement an ON b.announcement_id = an.announcenment_id
    JOIN 
        appointment_schedule a ON b.baptism_id = a.baptismfill_id
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
  
        a.app_date AS appointment_date,
        a.app_time AS appointment_time,
        a.payable_amount AS payable_amount,
        a.status AS c_status,
        a.p_status AS p_status
    FROM 
        confirmationfill cf
    JOIN 
        citizen c ON cf.citizen_id = c.citizend_id
    JOIN 
        announcement an ON cf.announcement_id = an.announcenment_id
    JOIN 
        appointment_schedule a ON cf.confirmationfill_id = a.confirmation_id
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
        a.app_date AS appointment_date,
        a.app_time AS appointment_time,
        a.payable_amount AS payable_amount,
        a.status AS c_status,
        a.p_status AS p_status
    FROM 
        marriagefill mf
    JOIN 
        citizen c ON mf.citizen_id = c.citizend_id
    JOIN 
        announcement an ON mf.announcement_id = an.announcenment_id
    JOIN 
        appointment_schedule a ON mf.marriagefill_id = a.marriage_id
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
    public function getMassPendingCitizen() {
        $sql = "SELECT 
                    c.fullname AS citizen_name,
                    b.role AS roles,
                    s.date AS schedule_date,
                    s.start_time AS schedule_start_time,
                    a.title AS Event_Name,
                    b.status AS approval_status,
                    b.baptism_id AS id
                FROM 
                    baptismfill b
                JOIN 
                    citizen c ON b.citizen_id = c.citizend_id
                JOIN 
                    announcement a ON b.announcement_id = a.announcenment_id
                JOIN 
                    schedule s ON a.schedule_id = s.schedule_id
                WHERE 
                    b.status = 'Pending'
                UNION ALL
                SELECT 
                    c.fullname AS citizen_name,
                    cf.role AS roles,
                    s.date AS schedule_date,
                    s.start_time AS schedule_start_time,
                    a.title AS Event_Name,
                    cf.status AS approval_status,
                    cf.confirmationfill_id AS id
                FROM 
                    confirmationfill cf
                JOIN 
                    citizen c ON cf.citizen_id = c.citizend_id
                JOIN 
                    announcement a ON cf.announcement_id = a.announcenment_id
                JOIN 
                    schedule s ON a.schedule_id = s.schedule_id
                WHERE 
                    cf.status = 'Pending'
                UNION ALL
                SELECT 
                   c.fullname AS citizen_name,
                    mf.role AS roles,
                    s.date AS schedule_date,
                    s.start_time AS schedule_start_time,
                    a.title AS Event_Name,
                    mf.status AS approval_status,
                    mf.marriagefill_id AS id
                FROM 
                    marriagefill mf
                JOIN 
                    citizen c ON mf.citizen_id = c.citizend_id
                JOIN 
                    announcement a ON mf.announcement_id = a.announcenment_id
                JOIN 
                    schedule s ON a.schedule_id = s.schedule_id
                WHERE 
                    mf.status = 'Pending'";
    
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

    public function getDonations() {
        $sql = "SELECT `donation_id`, `d_name`, `amount`, `donated_on`, `description` FROM `donation`";
        $result = $this->conn->query($sql);

        if ($result === FALSE) {
            die("Error: " . $this->conn->error);
        }

        $donations = [];
        while ($row = $result->fetch_assoc()) {
            $donations[] = $row;
        }
        return $donations;
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
    public function getCalendar() {
        $sql = "
        SELECT 
            mf.bride_name AS event_name,
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
            mf.status = 'Approved'
        
        UNION
        
        SELECT 
            b.fullname AS event_name,  -- Changed to match column alias
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
            b.status = 'Approved'
        
        UNION
        
        SELECT 
            cf.fullname AS event_name,  -- Changed to match column alias
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
            cf.status = 'Approved'
        
        UNION
        
        SELECT 
            df.d_fullname AS event_name,  -- Changed to match column alias
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
            df.status = 'Approved'
        
        UNION
        
        SELECT 
            a.title AS event_name,  -- Changed to match column alias
            s.date AS schedule_date,
            s.start_time AS schedule_starttime,
            s.end_time AS schedule_endtime,
            a.event_type AS Event_Name,
            'Approved' AS approval_status,
            a.announcenment_id AS event_id
        FROM 
            announcement a
        JOIN 
            schedule s ON a.schedule_id = s.schedule_id
        
        ORDER BY schedule_date DESC";
        
        $result = mysqli_query($this->conn, $sql);
    
        $events = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $events[] = $row;
        }
    
        return $events;
    }
    
}
?>
