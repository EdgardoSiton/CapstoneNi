<?php
require_once __DIR__ . '/../Model/db_connection.php';
require_once __DIR__ . '/../Model/priest_mod.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['appointmentId'])) {
    $appointmentId = intval($_POST['appointmentId']);
    
    $priest = new Priest($conn); 
    if ($priest->approveAppointment($appointmentId)) {
        echo 'success'; 
    } else {
        echo 'Error approving the appointment.';
    }
} else {
    echo 'Invalid request.';
}
?>