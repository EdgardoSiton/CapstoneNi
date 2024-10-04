<?php
require_once __DIR__ . '/../Model/staff_mod.php';
require_once __DIR__ . '/../Model/db_connection.php';
require_once __DIR__ . '/../Model/citizen_mod.php';

// Initialize the Citizen class
$citizen = new Citizen($conn);

// Get parameters from the query string
$selectedDate = isset($_GET['date']) ? $_GET['date'] : null;
$startTime = isset($_GET['start_time']) ? $_GET['start_time'] : null;
$endTime = isset($_GET['end_time']) ? $_GET['end_time'] : null;

// Fetch available priests
$priests = $citizen->getPriests($selectedDate, $startTime, $endTime);

header('Content-Type: application/json');
echo json_encode($priests);
