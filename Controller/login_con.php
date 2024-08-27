<?php
require_once __DIR__ . '/../Model/db_connection.php';
require_once __DIR__ . '/../Model/login_mod.php'; 

session_start(); // Start the session

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    $user = new User($conn);

    // Check if the email exists
    $userInfo = $user->getUserInfo($email);
    if ($userInfo) {
        // Validate password
        $loginResult = $user->login($email, $password);
        if ($loginResult === true) {
            $accountType = $userInfo['user_type'];
            $status = $userInfo['r_status'];
            $regId = $userInfo['citizend_id']; 
            $nme = $userInfo['fullname'];

            // Store user info in session
            $_SESSION['email'] = $email;
            $_SESSION['user_type'] = $accountType;
            $_SESSION['r_status'] = $status;
            $_SESSION['citizend_id'] = $regId; 
            $_SESSION['fullname'] = $nme;

            // Redirect based on the account type and status
            if ($status === 'Approve') {
                if ($accountType === 'Citizen') {
                    header('Location: ../../View/PageCitizen/CitizenPage.php');
                }
                 else {
                    $_SESSION['login_error'] = 'Unknown account type';
                    header('Location: ../../View/PageLanding/signin.php');
                }
                exit;
            } elseif ($accountType === 'Admin') {
                    header('Location: ../../View/PageAdmin/AdminDashboard.php');
                } elseif ($accountType === 'Staff') {
                    header('Location: ../../View/PageStaff/StaffDashboard.php');
                } elseif ($accountType === 'Priest') {
                    header('Location: ../PriestDashboard.php');
                }
             else {
                $_SESSION['login_error'] = 'Waiting for approval by the management';
                header('Location: ../../View/PageLanding/signin.php');
                exit;
            }
        } else {
            // Password incorrect
            $_SESSION['login_error'] = 'Invalid credentials';
            header('Location: ../../View/PageLanding/signin.php');
            exit;
        }
    } else {
        // Email not found
        $_SESSION['login_error'] = 'Email not found';
        header('Location: ../../View/PageLanding/signin.php');
        exit;
    }
}
?>
