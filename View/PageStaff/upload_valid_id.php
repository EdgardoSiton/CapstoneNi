<?php
require_once '../../Model/db_connection.php'; // Adjust path as necessary

if (isset($_POST) && isset($_FILES['validId'])) {
    $citizenId = $_GET['id']; // Assume you're passing the citizen ID
    $file = $_FILES['validId'];
    
    // Directory to save the uploaded files
    $targetDir = "images/valid_ids/";
    $targetFile = $targetDir . basename($file["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Check if image file is an actual image or fake image
    $check = getimagesize($file["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }

    // Check if file already exists
    if (file_exists($targetFile)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }

    // Check file size (5MB limit)
    if ($file["size"] > 5000000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow only certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
        echo "Sorry, only JPG, JPEG, & PNG files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    } else {
        // If everything is okay, try to upload the file
        if (move_uploaded_file($file["tmp_name"], $targetFile)) {
            echo "The file " . basename($file["name"]) . " has been uploaded.";
            
            // Update the database with the file path
            $sql = "UPDATE citizens SET valid_id = ? WHERE citizend_id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("si", $targetFile, $citizenId);

            if ($stmt->execute()) {
                echo "Valid ID path updated successfully.";
                // Redirect or display success message
            } else {
                echo "Error updating record: " . $conn->error;
            }
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}
?>
