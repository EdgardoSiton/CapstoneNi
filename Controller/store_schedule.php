<?php
session_start(); // Start the session

// Get the incoming JSON data
$data = json_decode(file_get_contents('php://input'), true);

// Store the received data in the session
if (isset($data['selectedDate']) && isset($data['startTime']) && isset($data['endTime'])) {
    $_SESSION['selectedDate'] = $data['selectedDate'];
    $_SESSION['startTime'] = $data['startTime'];
    $_SESSION['endTime'] = $data['endTime'];

    // Return a success response
    echo json_encode(['success' => true]);
} else {
    // Return an error response
    echo json_encode(['success' => false]);
}
?>
