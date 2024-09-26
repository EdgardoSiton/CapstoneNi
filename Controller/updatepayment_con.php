<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Include your database connection
    require_once '../Model/db_connection.php';
    require_once '../Model/staff_mod.php';

    $staff = new Staff($conn);
   if (isset($_POST['appsched_ids'])) {
    $appsched_ids = $_POST['appsched_ids']; 
    if ($staff->deleteAppointments($appsched_ids)) {
        header('Location: ../View/PageStaff/StaffAppointment.php');
        exit();
    } else {
        echo "Error deleting appointments.";
    }
}else if (isset($_POST['mappsched_ids'])) {
    $appsched_ids = $_POST['mappsched_ids']; 
    if ($staff->deleteAppointments($appsched_ids)) {
        header('Location: ../View/PageStaff/StaffMassSeminar.php');
        exit();
    } else {
        echo "Error deleting appointments.";
    }
}

if (isset($_POST['p_status']) && isset($_POST['appsched_id'])) {
        $appsched_id = $_POST['appsched_id'];
        $p_status = $_POST['p_status'];

        if ($staff->updatePaymentStatus($appsched_id, $p_status)) {
            header('Location: ../View/PageStaff/StaffAppointment.php');
            exit();
        } else {
            echo "Error updating payment status.";
        }
    }else if (isset($_POST['mp_status']) && isset($_POST['mappsched_id'])){
        $appsched_id = $_POST['mappsched_id'];
        $p_status = $_POST['mp_status'];

        if ($staff->updatePaymentStatus($appsched_id, $p_status)) {
            header('Location: ../View/PageStaff/StaffMassSeminar.php');
            exit();
        } else {
            echo "Error updating payment status.";
        }
    }

    if (isset($_POST['c_status']) && isset($_POST['cappsched_id'])) {
        $cappsched_id = $_POST['cappsched_id'];
        $c_status = $_POST['c_status'];
 
 
            if ($staff->updateEventStatus($cappsched_id, $c_status)) {
                header('Location: ../View/PageStaff/StaffAppointment.php');
                exit();
            } else {
                echo "Error updating event status.";
            }
        
    }else if (isset($_POST['mc_status']) && isset($_POST['mcappsched_id'])){
         $cappsched_id = $_POST['mcappsched_id'];
         $c_status = $_POST['mc_status'];
         
         if ($staff->updateEventStatus($cappsched_id, $c_status)) {
            header('Location: ../View/PageStaff/StaffMassSeminar.php');
            exit();
        } else {
            echo "Error updating event status.";
        }
    }
}
?>
