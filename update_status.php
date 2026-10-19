<?php
session_start();
include 'includes/db.php';

$id = $_GET['id'];
$status = $_GET['status'];
$task_id_safe = mysqli_real_escape_string($conn, $id);

$query = "UPDATE tasks SET status = '$status' WHERE id = '$task_id_safe'";
if (mysqli_query($conn, $query)) {
    $_SESSION['success_msg'] = "Status updated.";
    
    if ($status == 'completed' && isset($_SESSION['user_name'])) {
        $student_name = $_SESSION['user_name'];
        $t_res = mysqli_query($conn, "SELECT title FROM tasks WHERE id = '$task_id_safe'");
        $t_row = mysqli_fetch_assoc($t_res);
        $title = $t_row['title'];
        
        $msg = "Student $student_name has completed the task: $title";
        
        $admin_res = mysqli_query($conn, "SELECT id FROM users WHERE role = 'admin' LIMIT 1");
        if ($admin_row = mysqli_fetch_assoc($admin_res)) {
            $admin_id = $admin_row['id'];
            mysqli_query($conn, "INSERT INTO notifications (user_id, message) VALUES ('$admin_id', '$msg')");
        }
    }
}

header("Location: index.php");
?>
