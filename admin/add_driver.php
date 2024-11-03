<?php
session_start();
include('../includes/db_connect.php');

// Check if the user is an admin


// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Check if username already exists
    $checkQuery = "SELECT * FROM drivers WHERE username = '$username'";
    $checkResult = $conn->query($checkQuery);

    if ($checkResult->num_rows > 0) {
        echo "<script>alert('Username already exists. Please choose a different username.');</script>";
    } else {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT); // Hash the password for security

        // Insert driver into the database
        $query = "INSERT INTO drivers (username, password) VALUES ('$username', '$hashed_password')";

        if ($conn->query($query) === TRUE) {
            header("Location: manage_drivers.php?message=Driver+added+successfully."); // Redirect to manage drivers page
            exit();
        } else {
            echo "Error adding driver: " . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Driver</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <h2>Add Driver</h2>
    <form method="post" action="">
        <label for="username">Username:</label>
        <input type="text" name="username" required>
        <br>

        <label for="password">Password:</label>
        <input type="password" name="password" required>
        <br>

        <button type="submit">Add Driver</button>
    </form>
    <a href="dashboard.php">Back to Dashboard</a>
</body>
</html>
