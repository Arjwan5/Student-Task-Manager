<?php
include 'includes/db.php';
include 'includes/header.php';

if(!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];
mysqli_query($conn, "UPDATE notifications SET is_read = 'yes' WHERE user_id = '$user_id'");
?>

<div class="dashboard-header">
    <h2>My Notifications</h2>
</div>

<div class="table-wrapper">
    <table>
        <thead>
            <tr>
                <th>Message</th>
                <th>Time</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $query = "SELECT * FROM notifications WHERE user_id = '$user_id' ORDER BY id DESC";
        $result = mysqli_query($conn, $query);
        
        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td><strong>" . $row['message'] . "</strong></td>";
                echo "<td>" . $row['created_at'] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='2' class='empty-state'>No notifications yet!</td></tr>";
        }
        ?>
        </tbody>
    </table>
</div>

<?php include 'includes/footer.php'; ?>
