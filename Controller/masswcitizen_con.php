<?php
require_once __DIR__ . '/../Model/db_connection.php'; 
require_once __DIR__ . '/../Model/citizen_mod.php';
require_once __DIR__ . '/../Model/staff_mod.php';
session_start();
$loggedInUserEmail = isset($_SESSION['email']) ? $_SESSION['email'] : null;
if (!$loggedInUserEmail) {
    header("Location: login.php");
    exit();
}
$citizenModel = new Citizen($conn);
$staffModel = new Staff($conn); 
$userDetails = $citizenModel->getFetchDetails($loggedInUserEmail);
$citizenId = $userDetails['citizend_id'];
function convertTo24HourFormat($time) {
    return date("H:i", strtotime($time));
}

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
    $groom_name= trim($firstname . ' ' . $middlename . ' ' . $lastname);
    $bride_name= trim($firstnames . ' ' . $middlenames . ' ' . $lastnames);
    $announcementId = $_POST['announcement_id'] ?? '';
    $status = 'Pending';
    $eventName = 'MassWedding';
    $role = 'Online';


    $announcement = $staffModel->getAnnouncementById($announcementId);
    if ($announcement) {
     
        $citizenModel->insertMassWeddingFill(
            $citizenId,
            $announcementId,
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
            $bride_previously_married,
            $status,
            $eventName,
            $role
        );
        $_SESSION['status'] = "success";
        
        header('Location: ../View/PageCitizen/CitizenPage.php');
           exit();
           
    
 }
        else {
           echo "Announcement ID $announcementId does not exist.";
       }
}
?>
