<?php

require_once '../Model/db_connection.php';
require_once '../Model/staff_mod.php';
$staff = new Staff($conn);
if ($_SERVER['REQUEST_METHOD'] == 'POST' ) { 
    $baptismfill_id = $_POST['baptismfill_id'];
    $confirmationfill_id = $_POST['confirmationfill_id']; 
    $weddingffill_id  =$_POST['marriagefill_id'];
    $defuctom_id =$_POST['defuctomfill_id'];
    $massbaptismfillId = $_POST['baptism_id'];
    $massweddingffill_id = $_POST['massmarriage_id'];
   if($baptismfill_id){
    $decline = $staff->deleteBaptism($baptismfill_id);
    echo $decline; // Output the result for client-side handling
   }else if($confirmationfill_id){
    $decline = $staff->deleteConfirmation($confirmationfill_id);
    echo $decline;
   }else if($weddingffill_id){
    $declines = $staff->deleteWedding($weddingffill_id);
    echo $declines;
   }else if($defuctom_id){
    $decline =$staff->deleteDefuctom($defuctom_id);
   }else if ($massbaptismfillId){
    $declines = $staff->deleteMassBaptism($massbaptismfillId);
    echo $declines;
   }else if($massweddingffill_id){
    $declines = $staff->deleteMassWedding($massweddingffill_id);
    echo $declines;
   }
   
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
