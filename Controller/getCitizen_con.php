<?php
require_once __DIR__ .'/../Model/db_connection.php';
require_once __DIR__ .'/../Model/login_mod.php';
session_start();
$email = $_SESSION['email'];
$nme = $_SESSION['fullname'];
// Create User object
$getaccount = new User($conn);
// Function to get the image path

if (isset($_POST['approve'])) {
    // Call the approveCitizen method
    $isApproved = $getaccount->approveCitizen($citizendId);
    if ($isApproved) {
        echo '<p>User approved successfully!</p>';
    } else {
        echo '<p>Failed to approve the user.</p>';
    }
}

// Initialize variables to store user data
$citizenId = $fullname = $gender = $phone = $email = $address = $validId = $status = '';


if (isset($_GET['id'])) {
    $citizendId = $_GET['id'];
    $userInfo = $getaccount->getCitizenDetails($citizendId);

    if ($userInfo) {
        // Assign details to variables
       
        $citizenId = htmlspecialchars($userInfo['citizend_id']);
        $fullname = htmlspecialchars($userInfo['fullname']);
        $gender = htmlspecialchars($userInfo['gender']);
        $phone = htmlspecialchars($userInfo['phone']);
        $email = htmlspecialchars($userInfo['email']);
        $address = htmlspecialchars($userInfo['address']);
        $validId = htmlspecialchars($userInfo['valid_id']);
        $c_date_birth = htmlspecialchars($userInfo['c_date_birth']);
        $status = htmlspecialchars($userInfo['r_status']);
    } else {
        echo '<p>No details found for the given ID.</p>';
    }
} else {
    echo '<p>No ID provided.</p>';
}
?>