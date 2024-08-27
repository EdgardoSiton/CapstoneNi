<?php
require_once __DIR__ . '/../Model/db_connection.php';
require_once __DIR__ . '/../Model/staff_mod.php'; 


$notificationManager = new Staff($conn);
$notifications = $notificationManager->getRecentNotifications();

header('Content-Type: application/json');
echo json_encode($notifications);
?>
