<?php
// upload.php

// Set the upload directory
$uploadDir = 'uploads/';

// Ensure the uploads directory exists
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

// Check if the file is uploaded
if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
    // Get the file details
    $fileTmpPath = $_FILES['image']['tmp_name'];
    $fileName = $_FILES['image']['name'];
    $fileSize = $_FILES['image']['size'];
    $fileType = $_FILES['image']['type'];

    // Set the destination path to save the file
    $destination = $uploadDir . $fileName;

    // Move the uploaded file to the uploads folder
    if (move_uploaded_file($fileTmpPath, $destination)) {
        echo json_encode(['message' => 'Image uploaded and saved successfully!', 'file' => $fileName]);
    } else {
        echo json_encode(['error' => 'Failed to move uploaded file.']);
    }
} else {
    echo json_encode(['error' => 'No file uploaded or there was an error with the upload.']);
}
?>
