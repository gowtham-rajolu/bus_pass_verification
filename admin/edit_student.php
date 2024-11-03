<?php
session_start();
include('../includes/db_connect.php');

// Check if the user is an admin
if (!isset($_SESSION['admin_username'])) {
    header("Location: login.php"); // Redirect to login if not logged in
    exit();
}

// Check if an ID is provided
if (isset($_GET['id'])) {
    $student_id = $_GET['id'];

    // Fetch the student data from the database
    $query = "SELECT * FROM students WHERE student_id='$student_id'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $student = $result->fetch_assoc();
    } else {
        echo "Student not found.";
        exit();
    }
} else {
    echo "Invalid request.";
    exit();
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $student_name = $_POST['student_name'];
    $validity_date = $_POST['validity_date'];
    $year_of_study = $_POST['year_of_study'];
    $branch = $_POST['branch'];
    $father_name = $_POST['father_name'];
    $address = $_POST['address'];
    $emergency_contact = $_POST['emergency_contact'];

    // Update student record in the database
    $update_query = "UPDATE students SET 
        student_name='$student_name', 
        validity_date='$validity_date', 
        year_of_study='$year_of_study', 
        branch='$branch', 
        father_name='$father_name', 
        address='$address', 
        emergency_contact='$emergency_contact' 
        WHERE student_id='$student_id'";

    if ($conn->query($update_query) === TRUE) {
        header("Location: manage_students.php?message=Student+updated+successfully."); // Redirect back to manage students
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Student</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <h2>Edit Student Details</h2>
    <form method="post" action="">
        <label for="student_name">Name:</label>
        <input type="text" name="student_name" value="<?php echo $student['student_name']; ?>" required>
        <br>

        <label for="validity_date">Validity Date:</label>
        <input type="date" name="validity_date" value="<?php echo $student['validity_date']; ?>" required>
        <br>

        <label for="year_of_study">Year of Study:</label>
        <input type="number" name="year_of_study" value="<?php echo $student['year_of_study']; ?>" required>
        <br>

        <label for="branch">Branch:</label>
        <input type="text" name="branch" value="<?php echo $student['branch']; ?>" required>
        <br>

        <label for="father_name">Father's Name:</label>
        <input type="text" name="father_name" value="<?php echo $student['father_name']; ?>" required>
        <br>

        <label for="address">Address:</label>
        <textarea name="address" required><?php echo $student['address']; ?></textarea>
        <br>

        <label for="emergency_contact">Emergency Contact:</label>
        <input type="text" name="emergency_contact" value="<?php echo $student['emergency_contact']; ?>" required>
        <br>

        <button type="submit">Update Student</button>
    </form>
    <a href="manage_students.php">Back to Manage Students</a>
</body>
</html>
