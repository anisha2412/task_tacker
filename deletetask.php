<?php

$con = new mysqli("localhost", "root", "", "task_tracker");

if ($con->connect_error) {
    die('Connection Failed : ' . $con->connect_error);
}

$id = $_POST['id'];
$decrypted_id = base64_decode($id);

$stmt = $con->prepare("DELETE FROM tasks WHERE id=?");
$stmt->bind_param("i", $decrypted_id);

$response = array(); 

if ($stmt->execute()) {
    $response['status'] = 'success';
    $response['message'] = 'Task deleted successfully';
} else {
    $response['status'] = 'error';
    $response['message'] = 'Failed to delete task';
}

$stmt->close();
$con->close();

echo json_encode($response); 
?>
