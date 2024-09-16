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
        $date_birth = "$year-$month-$day"; 
    } else {
        $date_birth = ''; 
    }

    $month = $_POST['months'] ?? '';
    $day = $_POST['days'] ?? '';
    $year = $_POST['years'] ?? '';
    if ($month && $day && $year) {
        $date_of_death = "$year-$month-$day"; 
    } else {
        $date_of_death = ''; 
    }
    // Retrieve form data with default values
    $date = $_POST['date'] ?? '';
    $startTime = $_POST['start_time'] ?? '';
    $endTime = $_POST['end_time'] ?? '';
 
    $firstname = $_POST['firstname'] ?? '';  
    $lastname = $_POST['lastname'] ?? ''; 
    $middlename = $_POST['middlename'] ?? ''; 
   
    $gender = $_POST['d_gender'] ?? '';
    $d_address = $_POST['d_address'] ?? '';
    $cause_of_death = $_POST['cause_of_death'] ?? ''; 
    $marital_status = $_POST['marital_status'] ?? '';
    $place_of_birth = $_POST['place_of_birth'] ?? '';
   
    $father_fullname = $_POST['father_fullname'] ?? '';
    $mother_fullname = $_POST['mother_fullname'] ?? ''; 
    $parents_residence = $_POST['parents_residence'] ?? '';
    $place_of_death = $_POST['place_of_death'] ?? '';
 
 
    
    $d_fullname = trim($firstname . ' ' . $middlename . ' ' . $lastname);
    $startTime = convertTo24HourFormat($startTime);
    $endTime = convertTo24HourFormat($endTime);

    // Insert into schedule and get schedule_id
    $scheduleId = $citizenModel->insertSchedule($userDetails['citizend_id'], $date, $startTime, $endTime);

    if ($scheduleId) {
        // Insert into defuctomfill
        $result = $citizenModel->insertFuneralFill(
            $scheduleId,
            $d_fullname,
            $d_address,
            $gender,
            $cause_of_death,
            $marital_status,
            $place_of_birth,
            $father_fullname,
            $date_birth,
            $mother_fullname,
            $parents_residence,
            $date_of_death,
            $place_of_death
        );
    

        if ($result) {
            $_SESSION['status'] = "success";
            header('Location: ../View/PageCitizen/CitizenPage.php');
            exit();
        } else {
            echo "Failed to insert funeral details.";
        }
    } else {
        echo "Failed to insert schedule.";
    }
    
}
?>
