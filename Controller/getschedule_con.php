<?php
// Include your database connection and the class containing the getSchedule method
require_once __DIR__ . '/../Model/db_connection.php';
require_once __DIR__ . '/../Model/citizen_mod.php'; 

// Check if the date is provided via POST
if (isset($_POST['date'])) {
    $date = $_POST['date'];
    
    // Create an instance of the Citizen class
    $staff = new Citizen($conn);
    
    // Fetch schedule data from the database for the given date
    $schedules = $staff->getSchedule($date);
    
    // Return the data as JSON
    echo json_encode($schedules);
}
?>
