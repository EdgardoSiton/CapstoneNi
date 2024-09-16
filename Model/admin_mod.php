<?php
class Admin {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    
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
    public function getBaptismRecords() {
        // Combined SQL query using UNION
        $sql = "SELECT 
                    b.baptism_id AS id,
                    b.event_name AS Event_Name,
                    b.fullname AS citizen_name,
                    b.gender AS gender,
                    b.address AS address,
                    b.c_date_birth AS birth_date,
                    b.age AS age,
                    b.father_fullname AS father_name,
                    b.pbirth AS place_of_birth,
                    b.mother_fullname AS mother_name,
                    b.religion AS religion,
                    b.parent_resident AS parent_residence,
                    b.godparent AS godparent,
                    b.status AS citizen_status
                FROM 
                    citizen c
                JOIN 
                    schedule s ON c.citizend_id = s.citizen_id
                JOIN 
                    baptismfill b ON s.schedule_id = b.schedule_id
                JOIN 
                    appointment_schedule a ON b.baptism_id = a.baptismfill_id
                WHERE 
                    a.p_status = 'Paid' AND a.status = 'Completed'
                UNION
                SELECT 
                    b.baptism_id AS id,
                    b.event_name AS Event_Name,
                    b.fullname AS citizen_name,
                    b.gender AS gender,
                    b.address AS address,
                    b.c_date_birth AS birth_date,
                    b.age AS age,
                    b.father_fullname AS father_name,
                    b.pbirth AS place_of_birth,
                    b.mother_fullname AS mother_name,
                    b.religion AS religion,
                    b.parent_resident AS parent_residence,
                    b.godparent AS godparent,
                    b.status AS citizen_status
                FROM 
                    baptismfill b
                JOIN 
                    schedule s ON b.schedule_id = s.schedule_id
                JOIN 
                    appointment_schedule a ON b.baptism_id = a.baptismfill_id
                WHERE 
                    a.p_status = 'Paid' AND a.status = 'Completed'";

        // Prepare and execute the SQL statement
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        // Fetch the results
        $result = $stmt->get_result();
        $records = $result->fetch_all(MYSQLI_ASSOC);

        // Return the records as an associative array
        return $records;
    }
    public function getConfirmationRecords() {
        // SQL query without year filtering
        $sql = "SELECT 
        cf.fullname AS fullname,
        cf.c_date_birth AS dob,
        cf.event_name AS Event_Name,
        cf.c_address AS address,
        cf.c_gender AS gender,
        cf.c_age AS age,
        cf.date_of_baptism AS date_of_baptism,
        cf.name_of_church AS name_of_church,
        cf.father_fullname AS father_fullname,
        cf.mother_fullname AS mother_fullname,
        cf.permission_to_confirm AS permission_to_confirm,
        cf.church_address AS church_address,
        s.date AS confirmation_date
    FROM 
                citizen c
    JOIN 
                schedule s ON c.citizend_id = s.citizen_id
    JOIN 
        confirmationfill cf ON s.schedule_id = cf.schedule_id
    JOIN 
        appointment_schedule a ON cf.confirmationfill_id = a.confirmation_id
    WHERE 
        a.p_status = 'Paid' AND a.status = 'Completed'
                    
                    UNION

                    SELECT 
                    cf.fullname AS fullname,
        cf.c_date_birth AS dob,
        cf.event_name AS Event_Name,
        cf.c_address AS address,
        cf.c_gender AS gender,
        cf.c_age AS age,
        cf.date_of_baptism AS date_of_baptism,
        cf.name_of_church AS name_of_church,
        cf.father_fullname AS father_fullname,
        cf.mother_fullname AS mother_fullname,
        cf.permission_to_confirm AS permission_to_confirm,
        cf.church_address AS church_address,
        s.date AS confirmation_date
            FROM 
                schedule s
            JOIN 
                confirmationfill cf ON s.schedule_id = cf.schedule_id
            JOIN 
                appointment_schedule a ON cf.confirmationfill_id = a.confirmation_id
            WHERE 
                a.p_status = 'Paid' AND a.status = 'Completed'

                    
                    ";

        // Prepare and execute the SQL statement
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        // Fetch the results
        $result = $stmt->get_result();
        $records = $result->fetch_all(MYSQLI_ASSOC);

        // Return the records as an associative array
        return $records;
    }

    public function getDefunctorumRecords() {
        $sql = "SELECT 
        df.d_fullname AS fullname,
        df.d_gender AS gender,
        df.event_name AS Event_Name,
        df.cause_of_death AS cause_of_death,
        df.marital_status AS marital_status,
        df.place_of_birth AS place_of_birth,
        df.father_fullname AS father_fullname,
        df.date_of_birth AS date_of_birth,
        df.age AS age,
        df.mother_fullname AS mother_fullname,
        df.parents_residence AS parents_residence,

        df.d_address AS address,
        df.date_of_death AS date_of_death,
        df.place_of_death AS place_of_death
    FROM 
        citizen c
    JOIN 
        schedule s ON c.citizend_id = s.citizen_id
    JOIN 
        defuctomfill df ON s.schedule_id = df.schedule_id
    JOIN 
        appointment_schedule a ON df.defuctomfill_id = a.defuctom_id
    WHERE 
        a.p_status = 'Paid' AND a.status = 'Completed'
    UNION
    
    SELECT 
            df.d_fullname AS fullname,
            df.d_gender AS gender,
            df.event_name AS Event_Name,
            df.cause_of_death AS cause_of_death,
       
            df.marital_status AS marital_status,
            df.place_of_birth AS place_of_birth,
            df.father_fullname AS father_fullname,
            df.date_of_birth AS date_of_birth,
            df.age AS age,
            df.mother_fullname AS mother_fullname,
            df.parents_residence AS parents_residence,
            df.d_address AS address,
            df.date_of_death AS date_of_death,
            df.place_of_death AS place_of_death
        FROM 
           schedule s
        JOIN 
            defuctomfill df ON s.schedule_id = df.schedule_id
        JOIN 
            appointment_schedule a ON df.defuctomfill_id = a.defuctom_id
        WHERE 
            a.p_status = 'Paid' AND a.status = 'Completed'";





        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        $records = $result->fetch_all(MYSQLI_ASSOC);
        return $records;
    }

    public function getWeddingRecords() {
        $sql="SELECT 
       mf.event_name AS Event_Name,
       CONCAT(mf.groom_name, ' & ', mf.bride_name) AS groom_and_bride,

        mf.groom_dob AS groom_dob,
        mf.groom_place_of_birth AS groom_place_of_birth,
        mf.groom_citizenship AS groom_citizenship,
        mf.groom_address AS groom_address,
        mf.groom_religion AS groom_religion,
        mf.groom_previously_married AS groom_previously_married,
       
        mf.bride_dob AS bride_dob,
        mf.bride_place_of_birth AS bride_place_of_birth,
        mf.bride_citizenship AS bride_citizenship,
        mf.bride_address AS bride_address,
        mf.bride_religion AS bride_religion,
        mf.bride_previously_married AS bride_previously_married,
        s.date AS s_date
    FROM 
        citizen c
    JOIN 
        schedule s ON c.citizend_id = s.citizen_id
    JOIN 
        marriagefill mf ON s.schedule_id = mf.schedule_id
    JOIN 
        appointment_schedule a ON mf.marriagefill_id = a.marriage_id
    WHERE 
        a.p_status = 'Paid' AND a.status = 'Completed'
        
        UNION

        SELECT 
        mf.event_name AS Event_Name,
        CONCAT(mf.groom_name, ' & ', mf.bride_name) AS groom_and_bride,
        mf.groom_dob AS groom_dob,
        mf.groom_place_of_birth AS groom_place_of_birth,
        mf.groom_citizenship AS groom_citizenship,
        mf.groom_address AS groom_address,
        mf.groom_religion AS groom_religion,
        mf.groom_previously_married AS groom_previously_married,
 
        mf.bride_dob AS bride_dob,
        mf.bride_place_of_birth AS bride_place_of_birth,
        mf.bride_citizenship AS bride_citizenship,
        mf.bride_address AS bride_address,
        mf.bride_religion AS bride_religion,
        mf.bride_previously_married AS bride_previously_married,
        s.date AS s_date
    FROM 
        marriagefill mf
    JOIN 
        schedule s ON mf.schedule_id = s.schedule_id
    JOIN 
        appointment_schedule a ON mf.marriagefill_id = a.marriage_id
    WHERE 
        a.p_status = 'Paid' AND a.status = 'Completed'
        
        ";

    $stmt = $this->conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();
    $records = $result->fetch_all(MYSQLI_ASSOC);
    return $records;
}

}
    ?>