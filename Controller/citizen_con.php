<?php
require_once __DIR__ . '/../Model/db_connection.php'; 
require_once __DIR__ . '/../Model/citizen_mod.php';
session_start();
$loggedInUserEmail = isset($_SESSION['email']) ? $_SESSION['email'] : null;
if (!$loggedInUserEmail) {
    header("Location: login.php");
    exit();
}
$citizenModel = new Citizen($conn); 
$userDetails = $citizenModel->getFetchDetails($loggedInUserEmail);
function convertTo24HourFormat($time) {
    return date("H:i", strtotime($time));
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $month = $_POST['month'] ?? '';
    $day = $_POST['day'] ?? '';
    $year = $_POST['year'] ?? '';
    if ($month && $day && $year) {
        $c_date_birth = "$year-$month-$day"; 
    } else {
        $c_date_birth = ''; 
    }
    
    $date = $_POST['date'] ?? '';
    $startTime = $_POST['start_time'] ?? '';
    $endTime = $_POST['end_time'] ?? '';
    $fatherFullname = $_POST['father_fullname'] ?? '';
    $firstname = $_POST['firstname'] ?? '';  
    $lastname = $_POST['lastname'] ?? ''; 
    $middlename = $_POST['middlename'] ?? ''; 
    $gender = $_POST['gender'] ?? '';
    $address = $_POST['address'] ?? ''; 
    $pbirth = $_POST['pbirth'] ?? '';
    $motherFullname = $_POST['mother_fullname'] ?? '';
    $religion = $_POST['religion'] ?? '';
    $parentResident = $_POST['parent_resident'] ?? '';
    $godparent = $_POST['godparent'] ?? '';
    $fullname = trim($firstname . ' ' . $middlename . ' ' . $lastname);

    $startTime = convertTo24HourFormat($startTime);
    $endTime = convertTo24HourFormat($endTime);

    $scheduleId = $citizenModel->insertSchedule($userDetails['citizend_id'], $date, $startTime, $endTime);
    if ($scheduleId) {
        $citizenModel->insertIntoBaptismFill(
            $scheduleId,
            $fatherFullname,
            $fullname,  
            $gender,
            $c_date_birth,
            $address,         
            $pbirth,
            $motherFullname,
            $religion,
            $parentResident,
            $godparent
        );
        
        header("Location: success.php");
        exit();
    } else {
        echo "Failed to insert schedule.";
    }
}

?>