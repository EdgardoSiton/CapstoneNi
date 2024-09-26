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



// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data with default values
    $month = $_POST['months'] ?? '';
    $day = $_POST['days'] ?? '';
    $year = $_POST['years'] ?? '';
    $date_of_baptism = ($month && $day && $year) ? "$year-$month-$day" : '';
 
    $months = $_POST['month'] ?? '';
    $days = $_POST['day'] ?? '';
    $years = $_POST['year'] ?? '';
    $c_date_birth = ($months && $days && $years) ? "$years-$months-$days" : '';

    $firstname = $_POST['firstname'] ?? '';  
    $lastname = $_POST['lastname'] ?? ''; 
    $middlename = $_POST['middlename'] ?? ''; 
    $fullname = trim($firstname . ' ' . $middlename . ' ' . $lastname);
    
    $gender = $_POST['c_gender'] ?? '';
    $address = $_POST['c_address'] ?? ''; 
    $father_fullname = $_POST['father_fullname'] ?? '';
    $mother_fullname = $_POST['mother_fullname'] ?? '';
    $permission_to_confirm= $_POST['permission_to_confirm'] ?? '';
    $church_address = $_POST['church_address'] ?? '';
    $name_of_church = $_POST['name_of_church'] ?? '';
    $announcementId = $_POST['announcement_id'] ?? '';
    // Define default values for status, event_name, and role
    $status = 'Pending';
    $eventName = 'MassConfirmation';
    $role = 'Online';
    $announcementId = $_POST['announcement_id'] ?? '';

    // Check if the announcement_id exists using the Staff model
    $announcement = $staffModel->getAnnouncementById($announcementId);

    if ($announcement) {
        // Complete the reservation if the form is filled out
       
            // Insert data into baptismfill
            $citizenModel->insertIntoMassConfirmFill(
                $citizenId,
                $announcementId,
                $fullname,
                $gender,
                $c_date_birth,
                $address, 
                $date_of_baptism,
                $name_of_church,
                $father_fullname,
                $mother_fullname,
                $permission_to_confirm,
                $church_address,
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
