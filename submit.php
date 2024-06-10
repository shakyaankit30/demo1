<?php
include 'db_connect.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'] ?? ''; 
    $price = $_POST['price'] ?? ''; 
    
    if ($name && $price) { 
        $stmt = $conn->prepare("INSERT INTO products (name, price) VALUES (?, ?)");

        $stmt->bind_param("ss", $name, $price);
        $stmt->execute();
        
        if ($stmt->affected_rows > 0) {

            echo json_encode(['success' => true,'message' => 'Data inserted successfully']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to insert data']);
        }

        $stmt->close();
    } else {
        echo json_encode(['success' => false, 'message' => 'Missing name or price']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
}

//$conn->close();
?>
