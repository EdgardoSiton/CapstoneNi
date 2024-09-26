<?php
require_once __DIR__ . '/../Model/db_connection.php'; 
require_once __DIR__ . '/../Model/citizen_mod.php';
require_once __DIR__ . '/../Model/staff_mod.php'; // Use the Staff model
session_start();

// Check if user is logged in
$loggedInUserEmail = isset($_SESSION['email']) ? $_SESSION['email'] : null;

if (!$loggedInUserEmail) {
    header("Location: login.php");
    exit();
}

// Create instances of the models
$citizenModel = new Citizen($conn);
$staffModel = new Staff($conn); // Instantiate Staff model

$userDetails = $citizenModel->getFetchDetails($loggedInUserEmail);

// Get citizen ID
$citizenId = $userDetails['citizend_id'];

function convertTo24HourFormat($time) {
    return date("H:i", strtotime($time));
}

// Retrieve form data
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data with default values
    $month = $_POST['month'] ?? '';
    $day = $_POST['day'] ?? '';
    $year = $_POST['year'] ?? '';
    $dateOfBirth = ($month && $day && $year) ? "$year-$month-$day" : '';
 
    $firstname = $_POST['firstname'] ?? '';  
    $lastname = $_POST['lastname'] ?? ''; 
    $middlename = $_POST['middlename'] ?? ''; 
    $fullname = trim($firstname . ' ' . $middlename . ' ' . $lastname);
    
    $gender = $_POST['gender'] ?? '';
    $address = $_POST['address'] ?? ''; 
    $fatherFullname = $_POST['father_fullname'] ?? '';
    $motherFullname = $_POST['mother_fullname'] ?? '';
    $religion = $_POST['religion'] ?? '';
    $placeOfBirth = $_POST['pbirth'] ?? '';
    $parentResident = $_POST['parent_resident'] ?? '';
    $godparent = $_POST['godparent'] ?? '';
    
    // Retrieve announcement_id from form data
    $announcementId = $_POST['announcement_id'] ?? '';
    
    // Define default values for status, event_name, and role
    $status = 'Pending';
    $eventName = 'MassBaptism';
    $role = 'Online';

    // Check if the announcement_id exists using the Staff model
    $announcement = $staffModel->getAnnouncementById($announcementId);

    if ($announcement) {
        // Insert data into baptismfill
    
        $citizenModel->insertMassBaptismFill(
            $citizenId,
            $announcementId,
            $fullname,
            $gender,
            $address,
            $dateOfBirth, 
            $fatherFullname,
            $placeOfBirth,
            $motherFullname,
            $religion,
            $parentResident,
            $godparent,
            $status,
            $eventName,
            $role
        );
    
        $_SESSION['status'] = "success";
        
        header('Location: ../View/PageCitizen/CitizenPage.php');
        exit();
    
} else {
        // Handle the case where the announcement_id does not exist
        echo "Announcement ID $announcementId does not exist.";
    }
}
?>
