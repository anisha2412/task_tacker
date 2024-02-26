<?php
// Assuming you have established a database connection
$con = new mysqli("localhost", "root", "", "task_tracker");

if ($con->connect_error) {
    die('Connection Failed : ' . $con->connect_error);
}

// Get form data
$title = $_POST['update_title'];
$description = $_POST['update_description'];
$due_date = $_POST['update_due_date'];
$id = $_POST['id'];

// echo $id;exit;

// Perform update operation here (replace with your actual update query)
$stmt = $con->prepare("UPDATE tasks SET title=?, description=?, due_date=? WHERE id=?");
$stmt->bind_param("sssi", $title, $description, $due_date, $id);

// echo $this->db->last_query();exit;

$response = array(); // Create a response array

if ($stmt->execute()) {
    $response['status'] = 'success';
    $response['message'] = 'Task updated successfully';
} else {
    $response['status'] = 'error';
    $response['message'] = 'Failed to update task';
}

$stmt->close();
$con->close();

echo json_encode($response); // Encode the response array as JSON and echo it
?>
