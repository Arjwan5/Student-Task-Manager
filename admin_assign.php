<?php
include 'includes/db.php';
include 'includes/header.php';

if(!isset($_SESSION['user_role']) || $_SESSION['user_role'] != 'admin') {
    header("Location: index.php");
    exit;
}

if (isset($_POST['assign_task'])) {
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $desc = mysqli_real_escape_string($conn, $_POST['description']);
    $deadline = mysqli_real_escape_string($conn, $_POST['deadline']);
    $student_id = mysqli_real_escape_string($conn, $_POST['student_id']);
    $admin_id = $_SESSION['user_id'];
    
    $query = "INSERT INTO tasks (title, description, deadline, status, user_id, created_by) 
              VALUES ('$title', '$desc', '$deadline', 'pending', '$student_id', '$admin_id')";
    
    if (mysqli_query($conn, $query)) {
        $msg = "Admin has assigned a new task: $title";
        mysqli_query($conn, "INSERT INTO notifications (user_id, message) VALUES ('$student_id', '$msg')");
        
        $_SESSION['success_msg'] = "Task assigned to student successfully!";
        header("Location: admin.php");
        exit;
    } else {
        $error = "Failed to assign task!";
    }
}
?>

<div class="auth-wrapper" style="padding: 0; align-items: flex-start; margin-top: 2rem;">
    <div class="card" style="max-width: 600px;">
        <h2 class="card-title">Assign Task to Student</h2>
        
        <?php if(isset($error)) echo "<div class='alert alert-error'>$error</div>"; ?>
        
        <form method="POST">
            <div class="form-group">
                <label class="form-label">Select Student</label>
                <select name="student_id" class="form-control" required>
                    <option value="">-- Choose Student --</option>
                    <?php
                    $std_res = mysqli_query($conn, "SELECT id, name FROM users WHERE role = 'student'");
                    while($s = mysqli_fetch_assoc($std_res)) {
                        echo "<option value='".$s['id']."'>".$s['name']."</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label class="form-label">Task Title</label>
                <input type="text" name="title" class="form-control" required>
            </div>
            <div class="form-group">
                <label class="form-label">Description</label>
                <textarea name="description" class="form-control" rows="3" required></textarea>
            </div>
            <div class="form-group">
                <label class="form-label">Deadline</label>
                <input type="date" name="deadline" class="form-control" required>
            </div>
            <div style="display: flex; gap: 1rem; margin-top: 2rem;">
                <a href="admin.php" class="btn" style="background:#F3F4F6; color:#4B5563; flex: 1;">Cancel</a>
                <button type="submit" name="assign_task" class="btn btn-primary" style="flex: 2;">Assign Now</button>
            </div>
        </form>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
