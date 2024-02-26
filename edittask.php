<?php
$con = new mysqli("localhost", "root", "", "task_tracker");

if ($con->connect_error) {
    die('Connection Failed : ' . $con->connect_error);
}

$id = $_GET['id'];
$decrypted_id = base64_decode($id);

$stmt = $con->prepare("SELECT * FROM tasks WHERE id = ?");
$stmt->bind_param("s", $decrypted_id);
$stmt->execute();
$result = $stmt->get_result();


$response = array(); 

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $response['status'] = 'success';
    $response['data'] = $row; 
    $response['message'] = 'Data retrieved successfully';
} else {
    $response['status'] = 'error';
    $response['message'] = 'No data found';
}

$stmt->close();
$con->close();

echo json_encode($response); 
?>
