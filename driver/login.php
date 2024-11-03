<?php
session_start();
include('../includes/db_connect.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT * FROM drivers WHERE username='$username'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $driver = $result->fetch_assoc();
        if (password_verify($password, $driver['password'])) {
            $_SESSION['driver_id'] = $driver['driver_id']; // Store driver ID in session
            header("Location: verify_student.php"); // Redirect to verification page
            exit();
        } else {
            echo "Invalid username or password.";
        }
    } else {
        echo "Invalid username or password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/styles.css">
    <title>Driver Login</title>
</head>
<body>
    <h1>Driver Login</h1>
    <form method="POST">
        <label for="username">Username:</label>
        <input type="text" name="username" required>
        <br>
        <label for="password">Password:</label>
        <input type="password" name="password" required>
        <br>
        <button type="submit">Login</button>
    </form>
</body>
</html>
