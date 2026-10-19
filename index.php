<?php
include 'includes/db.php';
include 'includes/header.php';

if(!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];
?>

<div class="dashboard-header">
    <h2>My Tasks</h2>
    <a href="add_task.php" class="btn btn-primary">+ Add New Task</a>
</div>

<?php
if(isset($_SESSION['success_msg'])) {
    echo "<div class='alert alert-success'>" . $_SESSION['success_msg'] . "</div>";
    unset($_SESSION['success_msg']);
}

$warning_query = "SELECT title FROM tasks WHERE user_id = '$user_id' AND status != 'completed' AND deadline <= DATE_ADD(CURDATE(), INTERVAL 1 DAY)";
$warning_res = mysqli_query($conn, $warning_query);
if (mysqli_num_rows($warning_res) > 0) {
    echo "<div class='alert alert-error' style='background-color:#FEF2F2; color:#991B1B; border: 1px solid #F87171; border-radius: 0.5rem; padding: 1rem; margin-bottom: 2rem;'>";
    echo "<b> Urgent Warning!</b> The following tasks are due today or tomorrow:<br><ul style='margin-left: 20px; font-weight: bold;'>";
    while($w_row = mysqli_fetch_assoc($warning_res)) {
        echo "<li>" . $w_row['title'] . "</li>";
    }
    echo "</ul></div>";
}
?>

<div class="task-grid">
    <?php
    $query = "SELECT * FROM tasks WHERE user_id = '$user_id'";
    $result = mysqli_query($conn, $query);
    
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
    ?>
    <div class="task-card">
        <h3 class="task-title"><?php echo $row['title']; ?></h3>
        <div class="task-desc"><?php echo $row['description']; ?></div>
        <div class="task-meta">
            <span>Deadline: <?php echo $row['deadline']; ?></span>
            <span class="badge badge-<?php echo $row['status']; ?>">
                <?php echo ucfirst($row['status']); ?>
            </span>
        </div>
        
        <div style="margin-top: 1rem; border-top: 1px solid #E5E7EB; padding-top: 1rem; display: flex; gap: 0.5rem;">
            <?php if($row['status'] == 'pending') { ?>
                <a href="update_status.php?id=<?php echo $row['id']; ?>&status=in-progress" class="btn" style="background:#DBEAFE; color:#1E40AF; flex: 1;">Start</a>
            <?php } ?>
            <?php if($row['status'] != 'completed') { ?>
                <a href="update_status.php?id=<?php echo $row['id']; ?>&status=completed" class="btn btn-success" style="flex: 1;">Complete</a>
            <?php } else { ?>
                <span class="btn" style="background:#D1FAE5; color:#065F46; flex: 1; cursor: default;">Done</span>
            <?php } ?>
        </div>
    </div>
    <?php
        }
    } else {
        echo "<div class='empty-state'>No tasks found!</div>";
    }
    ?>
</div>

<?php include 'includes/footer.php'; ?>
