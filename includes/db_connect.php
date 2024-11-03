<?php
// db_connect.php
$host = 'localhost';
$db = 'bus_pass_system';
$user = 'root';
$pass = ''; // Default for XAMPP

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
