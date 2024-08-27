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
        $groom_dob = "$year-$month-$day"; 
    } else {
        $groom_dob = ''; 
    }

    $month = $_POST['months'] ?? '';
    $day = $_POST['days'] ?? '';
    $year = $_POST['years'] ?? '';
    if ($month && $day && $year) {
        $bride_dob = "$year-$month-$day"; 
    } else {
        $bride_dob = ''; 
    }

    // Retrieve form data with default values
    $date = $_POST['date'] ?? '';
    $startTime = $_POST['start_time'] ?? '';
    $endTime = $_POST['end_time'] ?? '';
    $firstname = $_POST['firstname'] ?? '';  
    $lastname = $_POST['lastname'] ?? ''; 
    $middlename = $_POST['middlename'] ?? ''; 
 
    $firstnames = $_POST['firstnames'] ?? '';  
    $lastnames = $_POST['lastnames'] ?? ''; 
    $middlenames = $_POST['middlenames'] ?? ''; 

    $groom_place_of_birth = $_POST['groom_place_of_birth'] ?? '';
    $groom_citizenship = $_POST['groom_citizenship'] ?? ''; 
    $groom_address = $_POST['groom_address'] ?? ''; 
    $groom_religion = $_POST['groom_religion'] ?? '';
    $groom_previously_married = $_POST['groom_previously_married'] ?? '';

    $bride_place_of_birth = $_POST['bride_place_of_birth'] ?? '';
    $bride_citizenship = $_POST['bride_citizenship'] ?? ''; 
    $bride_address = $_POST['bride_address'] ?? '';
    $bride_religion = $_POST['bride_religion'] ?? '';
    $bride_previously_married = $_POST['bride_previously_married'] ?? '';
 
    $startTime = convertTo24HourFormat($startTime);
    $endTime = convertTo24HourFormat($endTime);
    $groom_name= trim($firstname . ' ' . $middlename . ' ' . $lastname);
    $bride_name= trim($firstnames . ' ' . $middlenames . ' ' . $lastnames);

    // Insert into schedule and get schedule_id
    $scheduleId = $citizenModel->insertSchedule($userDetails['citizend_id'], $date, $startTime, $endTime);

    if ($scheduleId) {
        // Insert into marriagefill
        $result = $citizenModel->insertWeddingFill(
            $scheduleId,
            $groom_name,
            $groom_dob,
            $groom_place_of_birth,
            $groom_citizenship,
            $groom_address,
            $groom_religion,
            $groom_previously_married,
            $bride_name,
            $bride_dob,
            $bride_place_of_birth,
            $bride_citizenship,
            $bride_address,
            $bride_religion,
            $bride_previously_married
        );
    
        if ($result) {
            header("Location: success.php");
            exit();
        } else {
            echo "Failed to insert wedding details.";
        }
    } else {
        echo "Failed to insert schedule.";
    }
}
?>
