<?php
require_once __DIR__ . '/../Model/db_connection.php';
require_once __DIR__ . '/../Model/staff_mod.php'; 


$notificationManager = new NotificationManager($conn);
$notificationManager->markNotificationsAsRead();
?>
