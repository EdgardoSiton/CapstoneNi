<?php
require_once __DIR__ . '/../Model/db_connection.php';
require_once __DIR__ . '/../Model/citizen_mod.php'; 
if (isset($_POST['date'])) {
    $date = $_POST['date'];
    $staff = new Citizen($conn);
    $schedules = $staff->getSchedule($date);
    echo json_encode($schedules);
}

?>
