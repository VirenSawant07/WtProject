<?php
// db.php - Database connection
$host = "localhost";
$user = "root";
$pass = "";
$db = "blog_cms";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
