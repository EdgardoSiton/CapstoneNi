<?php
session_start();
require_once __DIR__ . '/../Model/priest_mod.php';
require_once __DIR__ . '/../Model/db_connection.php';
if (isset($_POST['date']) && isset($_POST['priestId'])) {
    $priestId = $_POST['priestId'] ?? null; // Fetch priestId
    $date = $_POST['date'] ?? null; // Fetch date
    
    error_log("Fetching schedule for Priest ID: $priestId on Date: $date"); // Debug log

    // Initialize Priest class
    $appointments = new Priest($conn);
    $schedule = $appointments->getPriestScheduleByDate($priestId, $date);
    echo json_encode($schedule);
}

?>
