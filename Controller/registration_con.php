<?php
require_once dirname(__DIR__) . '/Model/db_connection.php';
require_once dirname(__DIR__) . '/Model/login_mod.php'; 

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $errors = [];
    // Assuming further validation here

    if (empty($errors)) {
        // Instantiate Registration class
        $registration = new User($conn);
        $registrationData = $_POST; // Perform further validation if necessary
        $registrationResult = $registration->registerUser($registrationData);

        // Check if registration was successful
        if ($registrationResult === "Registration successful and notification sent") {
            // Redirect to success page or login page
            header('Location: ../../View/PageLanding/index.php');
            exit();
        } else {
            // Display error message
            echo '<script>alert("' . $registrationResult . '");</script>';
        }
    } else {
        // Display error messages
        foreach ($errors as $error) {
            echo '<script>alert("' . $error . '");</script>';
        }
    }
}
?>
