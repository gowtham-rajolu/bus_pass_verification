<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header('Location: login.php'); // Redirect to login if not admin
    exit;
}
include '../includes/db_connect.php';
?>

<?php include '../includes/header.php'; ?>
<h2>Admin Dashboard</h2>
<p>Welcome, Admin!</p>
<ul>
    <li><a href="add_student.php">Add Student</a></li>
    <li><a href="manage_students.php">Manage Students</a></li>
    <li><a href="manage_drivers.php">Manage Drivers</a></li>
    <li><a href="add_driver.php">Add Driver</a></li>
    <li>
        <form method="get" action="view_students.php">
            <input type="text" name="search" placeholder="Search by Student ID">
            <button type="submit">Search</button>
        </form>
    </li>
    <li><a href="view_students.php">View All Students</a></li>
</ul>
<?php include '../includes/footer.php'; ?>
