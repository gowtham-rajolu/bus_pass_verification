<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Start the session
session_start();

// Include the database connection
include('../includes/db_connect.php'); 

// Check if the student is logged in
if (!isset($_SESSION['student_id'])) {
    header("Location: login.php"); // Redirect to login if not logged in
    exit();
}

// Retrieve student details from the database
$student_id = $_SESSION['student_id'];
$query = "SELECT * FROM students WHERE student_id='$student_id'";
$result = $conn->query($query);

// Initialize variable for student data
$student = null;

if ($result->num_rows > 0) {
    // Fetch student data
    $student = $result->fetch_assoc();
} else {
    echo "No details found for this student.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/styles.css"> <!-- Include your CSS file -->
    <title>Student Details</title>
</head>
<body>
    <h1>Student Details</h1>
    
    <?php if ($student): ?>
        <table>
            <tr>
                <th>Student ID</th>
                <td><?php echo htmlspecialchars($student['student_id']); ?></td>
            </tr>
            <tr>
                <th>Name</th>
                <td><?php echo htmlspecialchars($student['name']); ?></td>
            </tr>
            <tr>
                <th>From Location</th>
                <td><?php echo htmlspecialchars($student['from_location']); ?></td>
            </tr>
            <tr>
                <th>To Location</th>
                <td><?php echo htmlspecialchars($student['to_location']); ?></td>
            </tr>
            <tr>
                <th>Pass Validity Date</th>
                <td><?php echo htmlspecialchars($student['pass_validity_date']); ?></td>
            </tr>
            <tr>
                <th>Year of Study</th>
                <td><?php echo htmlspecialchars($student['year_of_study']); ?></td>
            </tr>
            <tr>
                <th>Branch</th>
                <td><?php echo htmlspecialchars($student['branch']); ?></td>
            </tr>
            <tr>
                <th>Father's Name</th>
                <td><?php echo htmlspecialchars($student['father_name']); ?></td>
            </tr>
            <tr>
                <th>Address</th>
                <td><?php echo htmlspecialchars($student['address']); ?></td>
            </tr>
            <tr>
                <th>Emergency Phone Number</th>
                <td><?php echo htmlspecialchars($student['emergency_phone_number']); ?></td>
            </tr>
            <tr>
                <th>Image</th>
                <td>
                    <?php if (!empty($student['image_path'])): ?>
                        <img src="../assets/images/<?php echo htmlspecialchars($student['image_path']); ?>" alt="Student Image" style="width:100px;height:auto;">
                    <?php else: ?>
                        No image available.
                    <?php endif; ?>
                </td>
            </tr>
        </table>
    <?php else: ?>
        <p>No student details available.</p>
    <?php endif; ?>

    <a href="logout.php">Logout</a> <!-- Link to logout -->
</body>
</html>
