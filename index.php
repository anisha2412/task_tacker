<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="fonts/icomoon/style.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <title>Task Tracker</title>
</head>
<body>
    <div class="content">
        <div class="container">
            

            <div class="text-right mb-3">
                <button class="btn btn-dark"  data-toggle="modal" data-target="#exampleModal" id="" data-whatever="@mdo">Add Task</button>

              
            </div>

            <h2 class="mb-5">Task Tracker</h2>
            <div class="table-responsive custom-table-responsive">
                <table class="table custom-table">
                    <thead>
                        <tr>  
                            <th scope="col">Title</th>
                            <th scope="col">Description</th>
                            <th scope="col">Due Date</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $con = new mysqli("localhost", "root", "", "task_tracker");
                        if ($con->connect_error) {
                            die('Connection Failed : ' . $con->connect_error);
                        } else {
                            $stmt = $con->prepare("SELECT * FROM tasks");
                            $stmt->execute();
                            $result = $stmt->get_result(); 
                            while ($row = $result->fetch_assoc()) { 
                                $encrypted_id = base64_encode($row['id']); 
                                echo "<tr>";
                                echo "<td>{$row['title']}</td>";
                                echo "<td>{$row['description']}</td>";
                                echo "<td>{$row['due_date']}</td>";
                                echo "<td>";

                                echo "<a href='#' class='edit-task' data-toggle='modal' data-target='#editexampleModal' data-id='{$encrypted_id}'><i class='fas fa-pencil-alt'></i></a>";

                                echo "<br><a href='#' class='delete-task' data-id='{$encrypted_id}'><i class='fas fa-trash-alt'></i></a>";

                                echo "</td>";
                                echo "</tr>";
                            }
                            
                            $stmt->close();
                            $con->close();
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>



<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add new task</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <div class="modal-body">
        <form id="addtask" name="addtask"  autocomplete="off" action="" method="POST" enctype="multipart/form-data" >

            <div class="form-group">
                <label for="recipient-name" class="col-form-label">Title:</label><span class="text-danger"> *</span>
                <input type="text" id="title" name="title" class="form-control" id="recipient-name">
            </div>
            
            <div class="form-group">
                <label for="due_date">Due Date</label><span class="text-danger"> *</span>
                <input type="date" class="form-control" id="due_date" name="due_date">
            </div>

            <div class="form-group">
                <label for="message-text" class="col-form-label">Description:</label>
                <textarea class="form-control" id="description" name="description"></textarea>
            </div>

            </form>
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" id="add_task_btn" class="btn btn-secondary">Submit</button>
      </div>
    </div>
  </div>
</div>




<div class="modal fade" id="editexampleModal" tabindex="-1" role="dialog" aria-labelledby="editexampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editexampleModalLabel">Edit task</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <div class="modal-body">
       
        <form id="edittask" name="edittask"  autocomplete="off" action="" method="POST" enctype="multipart/form-data" >
        <input type="hidden" id="id" name="id" value="">

            <div class="form-group">
                <label for="recipient-name" class="col-form-label">Title:</label><span class="text-danger"> *</span>
                <input type="text" id="update_title" name="update_title" class="form-control" id="recipient-name">
            </div>
            
            <div class="form-group">
                <label for="due_date">Due Date</label><span class="text-danger"> *</span>
                <input type="date" class="form-control" id="update_due_date" name="update_due_date">
            </div>

            <div class="form-group">
                <label for="message-text" class="col-form-label">Description:</label>
                <textarea class="form-control" id="update_description" name="update_description"></textarea>
            </div>

            </form>
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" id="edit_task_btn" class="btn btn-secondary">Update</button>
      </div>
    </div>
  </div>
</div>


    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
    <script src="js/task.js"></script>
</body>
</html>
