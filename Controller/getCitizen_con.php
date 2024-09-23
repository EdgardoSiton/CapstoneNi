<?php
require_once __DIR__ .'/../Model/db_connection.php';
require_once __DIR__ .'/../Model/login_mod.php';
session_start();

$email = $_SESSION['email'];
$nme = $_SESSION['fullname'];

// Create User object
$user = new User($conn);

// Handle the approval process
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['citizenId'])) {
    $citizenId = $_POST['citizenId'];
    $action = $_POST['action'] ?? '';

    if ($action === 'delete') {
        $result = $user->deleteCitizen($citizenId); // Call delete method
    } else {
        $result = $user->approveCitizen($citizenId); // Default to approve
    }

    if ($result) {
        echo 'Success';
    } else {
        http_response_code(500);    
        echo 'Failed to update status';
    }
    exit; // Stop further execution after handling
}


// Initialize variables to store user data
$citizenId = $fullname = $gender = $phone = $email = $address = $validId = $status = '';

// Get citizen details if an ID is provided
if (isset($_GET['id'])) {
    $citizendId = $_GET['id'];
    $userInfo = $user->getCitizenDetails($citizendId);

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
