<?php
@session_start();

$notif_count = 0;
if(isset($_SESSION['user_id']) && isset($conn)) {
    $uid_safe = $_SESSION['user_id'];
    $notif_res = mysqli_query($conn, "SELECT COUNT(id) as cnt FROM notifications WHERE user_id = '$uid_safe' AND is_read = 'no'");
    if($notif_row = mysqli_fetch_assoc($notif_res)) {
        $notif_count = $notif_row['cnt'];
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <nav class="navbar">
        <div class="container">
            <a href="index.php" class="navbar-brand">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 20h9"/><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"/></svg>
                TaskMgr
            </a>
            <div class="navbar-nav">
                <?php if(isset($_SESSION['user_id'])): ?>
                    <span class="nav-link">Welcome, <?php echo htmlspecialchars($_SESSION['user_name']); ?></span>
                    
                    <a href="notifications.php" class="nav-link">
                        <i class="fas fa-bell"></i> Notifications <?php if($notif_count > 0) echo "<span style='color:#EF4444; font-weight:bold;'>($notif_count)</span>"; ?>
                    </a>
                    
                    <?php if($_SESSION['user_role'] === 'admin'): ?>
                        <a href="admin.php" class="nav-link">Admin Dashboard</a>
                    <?php else: ?>
                        <a href="index.php" class="nav-link">My Tasks</a>
                    <?php endif; ?>
                    
                    <a href="logout.php" class="btn btn-danger">Logout</a>
                <?php else: ?>
                    <a href="login.php" class="nav-link">Login</a>
                    <a href="register.php" class="btn btn-primary">Register</a>
                <?php endif; ?>
            </div>
        </div>
    </nav>
    <main class="container" style="flex: 1; padding-top: 2rem;">
