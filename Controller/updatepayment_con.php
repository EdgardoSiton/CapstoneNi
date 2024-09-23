<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Include your database connection
    require_once '../Model/db_connection.php';
    require_once '../Model/staff_mod.php';

    $staff = new Staff($conn);

   // Handle deletion of multiple appointments
   if (isset($_POST['appsched_ids'])) {
    $appsched_ids = $_POST['appsched_ids']; // Array of selected IDs

    // Call delete method for multiple appointments
    if ($staff->deleteAppointments($appsched_ids)) {
        header('Location: ../View/PageStaff/StaffAppointment.php');
        exit();
    } else {
        echo "Error deleting appointments.";
    }
}

    // Handle other cases like updating payment status
    if (isset($_POST['p_status']) && isset($_POST['appsched_id'])) {
        $appsched_id = $_POST['appsched_id'];
        $p_status = $_POST['p_status'];

        if ($staff->updatePaymentStatus($appsched_id, $p_status)) {
            header('Location: ../View/PageStaff/StaffAppointment.php');
            exit();
        } else {
            echo "Error updating payment status.";
        }
    }

    // Handle event status and possible deletion
    if (isset($_POST['c_status']) && isset($_POST['cappsched_id'])) {
        $cappsched_id = $_POST['cappsched_id'];
        $c_status = $_POST['c_status'];

        if ($c_status == 'Delete') {
            if ($staff->deleteAppointment($cappsched_id)) {
                header('Location: ../View/PageStaff/StaffAppointment.php');
                exit();
            } else {
                echo "Error deleting appointment.";
            }
        } else {
            if ($staff->updateEventStatus($cappsched_id, $c_status)) {
                header('Location: ../View/PageStaff/StaffAppointment.php');
                exit();
            } else {
                echo "Error updating event status.";
            }
        }
    }
}
?>
