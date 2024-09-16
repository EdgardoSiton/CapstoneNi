<?php
require_once '../Model/db_connection.php';
require_once '../Model/staff_mod.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $announcementId = intval($_POST['announcement_id']);
    $staff = new Staff($conn);

    // Get current capacity
    $announcementData = $staff->getAnnouncementById($announcementId);
    $currentCapacity = $announcementData['capacity'];

    if ($currentCapacity > 0) {
        // Decrease capacity by 1
        $newCapacity = $currentCapacity - 1;
        $staff->updateCapacity($announcementId, $newCapacity);
        echo json_encode(['success' => true, 'new_capacity' => $newCapacity]);
    } else {
        echo json_encode(['success' => false, 'message' => 'No capacity left']);
    }
}
?>
