<?php
session_start(); // Start session for user tracking
include('../includes/db_connect.php'); // Include your database connection file

// Initialize variables for form data
$student_id = "";
$error_message = "";

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $student_id = mysqli_real_escape_string($conn, $_POST['student_id']);
    $input_password = mysqli_real_escape_string($conn, $_POST['password']);

    // Query to find the student by ID
    $query = "SELECT * FROM students WHERE student_id='$student_id'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Verify the password
        if (password_verify($input_password, $row['password'])) {
            // Password is correct, set session variable and redirect
            $_SESSION['student_id'] = $student_id;
            echo "Login successful!"; // Redirect to student's dashboard
            header("Location: view_details.php"); // Redirect to student details page
            exit();
        } else {
            $error_message = "Incorrect password.";
        }
    } else {
        $error_message = "Student ID not found.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/styles.css"> <!-- Include your CSS file -->
    <title>Student Login</title>
</head>
<body>
    <h1>Student Login</h1>
    <form action="login.php" method="post">
        <label for="student_id">Student ID:</label>
        <input type="text" name="student_id" required><br>

        <label for="password">Password:</label>
        <input type="password" name="password" required><br>

        <input type="submit" value="Login">
    </form>

    <?php
    // Display error message if any
    if (!empty($error_message)) {
        echo "<p style='color:red;'>$error_message</p>";
    }
    ?>

    <a href="../index.php">Back to Home</a> <!-- Link back to home -->
</body>
</html>
