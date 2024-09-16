<?php
require_once __DIR__ . '/../Model/priest_mod.php';
require_once __DIR__ . '/../Model/db_connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['appointmentId'])) {
    $appointmentId = intval($_POST['appointmentId']);
    
    $priest = new Priest($conn); // Assuming the connection is already established
    if ($priest->approveAppointment($appointmentId)) {
        echo 'success'; // Send success response to AJAX
    } else {
        echo 'Error approving the appointment.';
    }
} else {
    echo 'Invalid request.';
}
?>
