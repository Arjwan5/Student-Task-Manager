<?php
include 'includes/db.php';
include 'includes/header.php';

if(!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

if (isset($_POST['add_task'])) {
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $desc = mysqli_real_escape_string($conn, $_POST['description']);
    $deadline = mysqli_real_escape_string($conn, $_POST['deadline']);
    $user_id = $_SESSION['user_id'];
    
    $query = "INSERT INTO tasks (title, description, deadline, status, user_id, created_by) 
              VALUES ('$title', '$desc', '$deadline', 'pending', '$user_id', '$user_id')";
    
    if (mysqli_query($conn, $query)) {
        $_SESSION['success_msg'] = "Task added successfully!";
        header("Location: index.php");
        exit;
    } else {
        $error = "Failed to add task!";
    }
}
?>

<div class="auth-wrapper" style="padding: 0; align-items: flex-start; margin-top: 2rem;">
    <div class="card" style="max-width: 600px;">
        <h2 class="card-title">Create New Task</h2>
        
        <?php if(isset($error)) echo "<div class='alert alert-error'>$error</div>"; ?>
        
        <form method="POST">
            <div class="form-group">
                <label class="form-label">Task Title</label>
                <input type="text" name="title" class="form-control" required placeholder="Enter task name...">
            </div>
            <div class="form-group">
                <label class="form-label">Description</label>
                <textarea name="description" class="form-control" rows="4" required placeholder="Describe the task..."></textarea>
            </div>
            <div class="form-group">
                <label class="form-label">Deadline Date</label>
                <input type="date" name="deadline" class="form-control" required>
            </div>
            <div style="display: flex; gap: 1rem; margin-top: 2rem;">
                <a href="index.php" class="btn" style="background:#F3F4F6; color:#4B5563; flex: 1;">Cancel</a>
                <button type="submit" name="add_task" class="btn btn-primary" style="flex: 2;">Save Task</button>
            </div>
        </form>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
