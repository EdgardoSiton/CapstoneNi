<?php
require_once '../Model/db_connection.php';
require_once '../Model/staff_mod.php';

$staff = new Staff($conn);

try {
    $deletedCount = $staff->cleanUpStaleReservations();
    echo "Cleaned up $deletedCount stale reservations.";
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>
