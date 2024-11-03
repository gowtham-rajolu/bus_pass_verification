<?php
include '../includes/db_connect.php';

if (isset($_GET['student_id'])) {
    $student_id = $_GET['student_id'];
    $sql = "DELETE FROM students WHERE student_id = '$student_id'";

    if ($conn->query($sql) === TRUE) {
        echo "Student deleted successfully.";
    } else {
        echo "Error deleting student: " . $conn->error;
    }
}
?>
