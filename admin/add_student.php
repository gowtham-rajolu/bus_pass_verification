<?php
include('../includes/db_connect.php'); // Include your database connection file

// Initialize variables for form data
$student_id = $name = $from_location = $to_location = $pass_validity_date = $year_of_study = $branch = $father_name = $address = $emergency_phone_number = $image_path = "";
$error_message = "";

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $student_id = mysqli_real_escape_string($conn, $_POST['student_id']);
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $from_location = mysqli_real_escape_string($conn, $_POST['from_location']);
    $to_location = mysqli_real_escape_string($conn, $_POST['to_location']);
    $pass_validity_date = mysqli_real_escape_string($conn, $_POST['pass_validity_date']);
    $year_of_study = mysqli_real_escape_string($conn, $_POST['year_of_study']);
    $branch = mysqli_real_escape_string($conn, $_POST['branch']);
    $father_name = mysqli_real_escape_string($conn, $_POST['father_name']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $emergency_phone_number = mysqli_real_escape_string($conn, $_POST['emergency_phone_number']);
    
    // Handle image upload
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $target_dir = "../assets/images/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        $image_path = htmlspecialchars(basename($_FILES["image"]["name"]));
        
        // Check if image file is a valid image
        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if ($check === false) {
            $error_message = "File is not an image.";
        }

        // Move uploaded file to target directory
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            // Image uploaded successfully
        } else {
            $error_message = "Sorry, there was an error uploading your file.";
        }
    } else {
        $error_message = "Image file is required.";
    }

    // Set the password provided by the admin
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $hashed_password = password_hash($password, PASSWORD_DEFAULT); // Hash the password

    // SQL to insert student data
    if (empty($error_message)) {
        $sql = "INSERT INTO students (student_id, name, from_location, to_location, pass_validity_date, year_of_study, branch, father_name, address, emergency_phone_number, image_path, password) 
                VALUES ('$student_id', '$name', '$from_location', '$to_location', '$pass_validity_date', '$year_of_study', '$branch', '$father_name', '$address', '$emergency_phone_number', '$image_path', '$hashed_password')";

        if ($conn->query($sql) === TRUE) {
            echo "New student record created successfully";
            // Optionally redirect or reset form fields
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error; // Show error message
        }
    } else {
        echo $error_message; // Show error message if any
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/styles.css"> <!-- Include your CSS file -->
    <title>Add Student</title>
</head>
<body>
    <h1>Add Student</h1>
    <form action="add_student.php" method="post" enctype="multipart/form-data">
        <label for="student_id">Student ID:</label>
        <input type="text" name="student_id" required><br>

        <label for="name">Name:</label>
        <input type="text" name="name" required><br>

        <label for="from_location">From Location:</label>
        <input type="text" name="from_location" required><br>

        <label for="to_location">To Location:</label>
        <input type="text" name="to_location" required><br>

        <label for="pass_validity_date">Pass Validity Date:</label>
        <input type="date" name="pass_validity_date" required><br>

        <label for="year_of_study">Year of Study:</label>
        <input type="text" name="year_of_study" required><br>

        <label for="branch">Branch:</label>
        <input type="text" name="branch" required><br>

        <label for="father_name">Father's Name:</label>
        <input type="text" name="father_name" required><br>

        <label for="address">Address:</label>
        <textarea name="address" required></textarea><br>

        <label for="emergency_phone_number">Emergency Phone Number:</label>
        <input type="text" name="emergency_phone_number" required><br>

        <label for="image">Upload Student Image:</label>
        <input type="file" name="image" accept="image/*" required><br>

        <label for="password">Password:</label>
        <input type="password" name="password" required><br>

        <input type="submit" value="Add Student">
    </form>

    <a href="manage_students.php">Manage Students</a> <!-- Link back to manage students -->
</body>
</html>
