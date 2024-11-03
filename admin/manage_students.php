<?php
include '../includes/db_connect.php';
$result = $conn->query("SELECT * FROM students");

while ($row = $result->fetch_assoc()) {
    echo "Student ID: " . $row['student_id'] . "<br>";
    echo "Name: " . $row['name'] . "<br>";
    // Add more fields as needed.
    echo "<a href='edit_student.php?student_id=" . $row['student_id'] . "'>Edit</a> | ";
    echo "<a href='delete_student.php?student_id=" . $row['student_id'] . "'>Delete</a><br><br>";
}
?>
