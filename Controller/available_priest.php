<?php
require_once '../Model/db_connection.php';
require_once '../Controller/citizen_con.php';
require_once '../Model/citizen_mod.php';

session_start(); // Make sure to start the session if you're using it

// Get POST data
$scheduleDate = $_POST['selectedDate'] ?? null;
$startTime = $_POST['start_time'] ?? null;
$endTime = $_POST['end_time'] ?? null;

// Assuming you have a function to get available priests
$citizen = new Citizen($conn);
$priests = $citizen->getAvailablePriests($scheduleDate, $startTime, $endTime);

// Return the data
if ($priests) {
    foreach ($priests as $priest) {
        echo htmlspecialchars($priest['name']) . "<br>"; // Adjust based on your data structure
    }
} else {
    echo "No available priests.";
}
?>
