<?php
$con = new mysqli("localhost", "root", "", "task_tracker");

if ($con->connect_error) {
    die('Connection Failed : ' . $con->connect_error);
}

$title = $_POST['title'];
$description = $_POST['description'];
$due_date = $_POST['due_date'];

$stmt = $con->prepare("INSERT INTO tasks (title, description, due_date) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $title, $description, $due_date);

$response = array();

if ($stmt->execute()) {
    $response['status'] = 'success';
    $response['message'] = 'Task inserted successfully';
} else {
    $response['status'] = 'error';
    $response['message'] = 'Failed to insert task';
}

$stmt->close();
$con->close();

echo json_encode($response); 
?>
