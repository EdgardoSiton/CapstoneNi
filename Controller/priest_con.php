<?php
require_once __DIR__ . '/../Model/db_connection.php';
require_once __DIR__ . '/../Model/priest_mod.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['appointmentId']) && isset($_POST['appointmentType'])) {
    $appointmentId = intval($_POST['appointmentId']);
    $appointmentType = $_POST['appointmentType'];
    
    $priest = new Priest($conn); 

    // Call approveAppointment method with both parameters
    if ($priest->approveAppointment($appointmentId, $appointmentType)) {
        echo 'success'; // Send success response
    } else {
        echo 'Error approving the appointment.'; // Error message
    }
} else {
    echo 'Invalid request.'; // Handle invalid requests
}
