<?php
include 'db_connect.php';

$limit = 10; 
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$start = ($page - 1) * $limit;

$sql = "SELECT * FROM products LIMIT $start, $limit";
$result = $conn->query($sql);

$response = array();

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $response[] = $row;
    }
} else {
    $response['message'] = "No products found";
}

$conn->close();

echo json_encode($response);

?>