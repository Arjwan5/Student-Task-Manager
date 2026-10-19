<?php
$host = '127.0.0.1';
$dbname = 'csc1405_project';
$user = 'root';
$pass = '';

$conn = mysqli_connect($host, $user, $pass, $dbname);

if (!$conn) {
    echo "Database connection failed.";
    exit;
}
?>
