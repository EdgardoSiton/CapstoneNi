<?php
require_once __DIR__ . '/../Model/db_connection.php';
require_once __DIR__ . '/../Model/staff_mod.php'; 

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $errors = [];
    $announcement = isset($_POST['announcement']);
    $addcalendar = isset($_POST['addcalendar']);
    // You might want to add validation logic here to populate $errors if needed
    if ($announcement) {
        if (empty($errors)) {
            // Instantiate Staff class
            $staff = new Staff($conn);

            // Function to convert time to military format
            function formatToMilitaryTime($time) {
                $dateTime = DateTime::createFromFormat('g:i A', $time);
                return $dateTime ? $dateTime->format('H:i') : null; // Handle invalid time input
            }

            // Schedule data for announcement
            $scheduleData = [
                'date' => $_POST['date'],
                'start_time' => formatToMilitaryTime($_POST['start_time']),
                'end_time' => formatToMilitaryTime($_POST['end_time'])
            ];

            $startTime = $_POST['start_times'] ?? null; // This will contain the 24-hour format time
            $endTime = $_POST['end_times'] ?? null; // This will also be in 24-hour format
            
            // Check if the values are valid
            if ($startTime && $endTime) {
                $scheduleDatas = [
                    'date' => $_POST['date'] ?? '',
                    'start_time' => $startTime, // Use the value directly from the dropdown
                    'end_time' => $endTime // Same for end_time
                ];
            
                // Now you can proceed with your database insertions using the $scheduleData
            }
            // Prepare announcement data
            $announcementData = [
                'event_type' => $_POST['eventType'],
                'title' => $_POST['eventTitle'],
                'description' => $_POST['description'],
                'date_created' => date('Y-m-d H:i:s'),
                'capacity' => $_POST['capacity'],
                'priest_id' => $_POST['priest_id']
            ];

            // Call the addAnnouncement method
            $announcementResult = $staff->addAnnouncement($announcementData, $scheduleData, $scheduleDatas);

            // Check if the insertion was successful
            if ($announcementResult) {
                // Redirect to a success page or display success message
                header('Location: ../View/PageStaff/StaffAnnouncement.php');
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
    }else if ($addcalendar){
// Create an instance of the Staff class
$staff = new Staff($conn);


// Get POST data
$cal_fullname = $_POST['cal_fullname'];
$cal_Category = $_POST['cal_Category'];
$cal_date = $_POST['cal_date'];
$cal_description = $_POST['cal_description'];

// Insert event into the local event calendar database
if ($staff->insertEventCalendar($cal_fullname, $cal_Category, $cal_date, $cal_description)) {
    // Return a success message for the frontend
    echo 'Event successfully added to the calendar.';
} else {
    // Return an error message for the frontend
    echo 'Error: Failed to add event to the calendar.';
}



}else{
    echo'Theres an error';
}
}
?>
