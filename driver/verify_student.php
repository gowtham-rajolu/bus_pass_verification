<?php
session_start();
include('../includes/db_connect.php');



// Check if student ID is provided
if (isset($_GET['id'])) {
    $student_id = $_GET['id'];

    // Fetch student details from the database
    $query = "SELECT * FROM students WHERE student_id = ?"; // Change 'id' to your actual student ID column name
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $student_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if the student exists
    if ($result->num_rows > 0) {
        $student = $result->fetch_assoc();
    } else {
        // Student not found
        $student = null; // Define the variable as null
        $error_message = "No student found with the given ID.";
    }
} else {
    $error_message = "Student ID is missing.";
    $student = null; // Define the variable as null
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Verify Student</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <h2>Verify Student Details</h2>

    <?php if (isset($error_message)): ?>
        <p style="color: red;"><?php echo htmlspecialchars($error_message); ?></p>
    <?php elseif ($student): ?>
        <table>
            <tr>
                <th>ID</th>
                <td><?php echo htmlspecialchars($student['student_id']); ?></td> <!-- Adjusted to match your column name -->
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
                <th>Validity Date</th>
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
                        <img src="../assets/images/<?php echo htmlspecialchars($student['image_path']); ?>" alt="Student Image" style="width:150px; height:auto;">
                    <?php else: ?>
                        No image available.
                    <?php endif; ?>
                </td>
            </tr>
        </table>
    <?php else: ?>
        <p>No student details to display.</p>
    <?php endif; ?>

    <form method="GET" action="verify_student.php">
        <label for="student_id">Enter Student ID:</label>
        <input type="text" name="id" id="student_id" required>
        <button type="submit">Verify</button>
    </form>

    <a href="dashboard.php">Back to Dashboard</a>
</body>
</html>
