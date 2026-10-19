<?php
include 'includes/db.php';
session_start();

if (isset($_POST['register'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = md5($_POST['password']);
    $role = 'student';
    
    $check_email = mysqli_query($conn, "SELECT id FROM users WHERE email = '$email'");
    if (mysqli_num_rows($check_email) > 0) {
        $error = "Email already registered!";
    } else {
        $query = "INSERT INTO users (name, email, password, role) VALUES ('$name', '$email', '$password', '$role')";
        if (mysqli_query($conn, $query)) {
            $_SESSION['success_msg'] = "Registration successful! Please login.";
            header("Location: login.php");
            exit;
        } else {
            $error = "Something went wrong!";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - TaskMgr</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="auth-wrapper">
    <div class="card">
        <h2 class="card-title">Join TaskMgr Today</h2>
        
        <?php if(isset($error)) echo "<div class='alert alert-error'>$error</div>"; ?>
        
        <form method="POST">
            <div class="form-group">
                <label class="form-label">Full Name</label>
                <input type="text" name="name" class="form-control" required placeholder="Full Name">
            </div>
            <div class="form-group">
                <label class="form-label">Email Address</label>
                <input type="email" name="email" class="form-control" required placeholder="name@example.com">
            </div>
            <div class="form-group">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" required placeholder="••••••••">
            </div>
            <button type="submit" name="register" class="btn btn-primary" style="width: 100%; margin-top: 1rem;">Create Account</button>
        </form>
        <p style="text-align: center; margin-top: 1.5rem; font-size: 0.875rem; color: #6B7280;">
            Already have an account? <a href="login.php" style="color: #4F46E5; font-weight: 600; text-decoration: none;">Login here</a>
        </p>
    </div>
</body>
</html>
