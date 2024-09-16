<?php
require_once __DIR__ . '/../Model/db_connection.php'; 
require_once __DIR__ . '/../Model/citizen_mod.php';
session_start();

$loggedInUserEmail = isset($_SESSION['email']) ? $_SESSION['email'] : null;

if (!$loggedInUserEmail) {
    header("Location: login.php");
    exit();
}

$citizenModel = new Citizen($conn);  // Initialize Citizen model with the database connection
$userDetails = $citizenModel->getFetchDetails($loggedInUserEmail);

// Function to convert 12-hour format to 24-hour format
function convertTo24HourFormat($time) {
    return date("H:i", strtotime($time));
}

// Check if form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $month = $_POST['month'] ?? '';
    $day = $_POST['day'] ?? '';
    $year = $_POST['year'] ?? '';
    if ($month && $day && $year) {
        $c_date_birth = "$year-$month-$day"; 
    } else {
        $c_date_birth = ''; 
    }

    $month = $_POST['months'] ?? '';
    $day = $_POST['days'] ?? '';
    $year = $_POST['years'] ?? '';
    if ($month && $day && $year) {
        $date_of_baptism = "$year-$month-$day"; 
    } else {
        $date_of_baptism = ''; 
    }
    // Retrieve form data with default values
    $date = $_POST['date'] ?? '';
    $startTime = $_POST['start_time'] ?? '';
    $endTime = $_POST['end_time'] ?? '';
 
    $firstname = $_POST['firstname'] ?? '';  
    $lastname = $_POST['lastname'] ?? ''; 
    $middlename = $_POST['middlename'] ?? ''; 
   
    $gender = $_POST['c_gender'] ?? '';
    $address = $_POST['c_address'] ?? ''; 
    $name_of_church = $_POST['name_of_church'] ?? '';
    $father_fullname = $_POST['father_fullname'] ?? '';
    $mother_fullname = $_POST['mother_fullname'] ?? '';
    $permission_to_confirm = $_POST['permission_to_confirm'] ?? '';
    $church_address = $_POST['church_address'] ?? '';
    $fullname = trim($firstname . ' ' . $middlename . ' ' . $lastname);
    $startTime = convertTo24HourFormat($startTime);
    $endTime = convertTo24HourFormat($endTime);

    // Insert into schedule and get schedule_id
    $scheduleId = $citizenModel->insertSchedule($userDetails['citizend_id'], $date, $startTime, $endTime);

    if ($scheduleId) {
        // Insert into baptismfill
        $citizenModel->insertIntoConfirmFill(
            $scheduleId,
            $fullname ,
            $gender,        
            $c_date_birth,
            $address,       
             $date_of_baptism,
             $name_of_church,
             $father_fullname,
            $mother_fullname,
            $permission_to_confirm,
            $church_address,
           
        );
        $_SESSION['status'] = "success";
        
        header('Location: ../View/PageCitizen/CitizenPage.php');
        exit();
    } else {
        // Handle error in schedule insertion
        echo "Failed to insert schedule.";
    }
}
?>
