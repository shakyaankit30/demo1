<?php
include 'db_connect.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {
        $allowedMimeTypes = ['image/jpeg', 'image/png'];
        $fileType = mime_content_type($_FILES['image']['tmp_name']);
        $fileSize = $_FILES['image']['size'];

        if (!in_array($fileType, $allowedMimeTypes)) {
            echo json_encode(['success' => false, 'message' => 'Only JPEG and PNG images are allowed']);
            exit;
        }

        if ($fileSize > 2 * 1024 * 1024) { 
            echo json_encode(['success' => false, 'message' => 'File size must be less than 2MB']);
            exit;
        }

        // Move uploaded file to the upload directory
        $uploadDir = 'uploads/';
        $uploadFile = $uploadDir . time().'-'.basename($_FILES['image']['name']);
        if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadFile)) {
            // Insert file name into the database
            $sql = "INSERT INTO files (filename) VALUES ('$uploadFile')";

            if ($conn->query($sql) === TRUE) {
                echo json_encode(['success' => true, 'url' => $uploadFile]);
            } else {
                echo json_encode(['success' => false, 'message' => 'Failed to insert file name into database']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to move uploaded file']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'No file uploaded or upload error']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
}

// Close database connection
$conn->close();
?>
