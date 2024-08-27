<?php
require_once __DIR__ . '/../Model/db_connection.php';
require_once __DIR__ . '/../Model/staff_mod.php'; 

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $errors = [];

    // You might want to add validation logic here to populate $errors if needed

    if (empty($errors)) {
        // Instantiate Staff class
        $staff = new Staff($conn);
        
        // Prepare schedule data
        $scheduleData = [
            'date' => $_POST['eventDate'],
            'start_time' => $_POST['startTime'],
            'end_time' => $_POST['endTime']
        ];

        // Prepare announcement data
        $announcementData = [
            'event_type' => $_POST['eventType'],
            'title' => $_POST['eventTitle'],
            'description' => $_POST['description'],
            'date_created' => date('Y-m-d H:i:s'),
            'capacity' => $_POST['capacity']
        ];

        // Call the addAnnouncement method
        $announcementResult = $staff->addAnnouncement($announcementData, $scheduleData);

        // Check if the insertion was successful
        if ($announcementResult) {
            // Redirect to a success page or display success message
            header('Location: ../../View/PageStaff/StaffAnnouncement.php');
            exit();
        } else {
            // Display error message
            echo '<script>alert("Error adding announcement.");</script>';
        }
    } else {
        // Display error messages
        foreach ($errors as $error) {
            echo '<script>alert("' . $error . '");</script>';
        }
    }
}
?>
