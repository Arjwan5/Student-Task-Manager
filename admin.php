<?php
include 'includes/db.php';
include 'includes/header.php';

if(!isset($_SESSION['user_role']) || $_SESSION['user_role'] != 'admin') {
    header("Location: index.php");
    exit;
}
?>

<div class="dashboard-header">
    <h2>Global Task Monitoring</h2>
    <a href="admin_assign.php" class="btn btn-primary">Assign Task to Student</a>
</div>

<div class="table-wrapper">
    <table>
        <thead>
            <tr>
                <th>Student</th>
                <th>Task Title</th>
                <th>Deadline</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $query = "SELECT t.*, u.name as student_name 
                      FROM tasks t 
                      JOIN users u ON t.user_id = u.id 
                      ORDER BY t.id DESC";
            $result = mysqli_query($conn, $query);
            
            while($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row['student_name']) . "</td>";
                echo "<td>" . htmlspecialchars($row['title']) . "</td>";
                echo "<td>" . $row['deadline'] . "</td>";
                echo "<td><span class='badge badge-" . $row['status'] . "'>" . ucfirst($row['status']) . "</span></td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<?php include 'includes/footer.php'; ?>
