<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header('Location: login.php'); // Redirect to login if not admin
    exit;
}
include '../includes/db_connect.php';

// Handle search
$search = '';
if (isset($_GET['search'])) {
    $search = $_GET['search'];
}

$query = "SELECT * FROM students";
if ($search) {
    $query .= " WHERE student_id LIKE '%$search%'";
}
$result = $conn->query($query);
?>

<?php include '../includes/header.php'; ?>
<h2>View Students</h2>

<form method="get" action="">
    <input type="text" name="search" placeholder="Search by Student ID" value="<?php echo htmlspecialchars($search); ?>">
    <button type="submit">Search</button>
</form>

<table border="1">
    <tr>
        <th>Student ID</th>
        <th>Name</th>
        <th>From Location</th>
        <th>To Location</th>
        <th>Validity Date</th>
        <th>Year</th>
        <th>Branch</th>
        <th>Father's Name</th>
        <th>Address</th>
        <th>Emergency Phone</th>
        <th>Image</th>
    </tr>
    <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo $row['student_id']; ?></td>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['from_location']; ?></td>
            <td><?php echo $row['to_location']; ?></td>
            <td><?php echo $row['pass_validity_date']; ?></td>
            <td><?php echo $row['year_of_study']; ?></td>
            <td><?php echo $row['branch']; ?></td>
            <td><?php echo $row['father_name']; ?></td>
            <td><?php echo $row['address']; ?></td>
            <td><?php echo $row['emergency_phone_number']; ?></td>
            <td><img src="<?php echo $row['image_path']; ?>" alt="Student Image" width="50"></td>
        </tr>
    <?php endwhile; ?>
</table>

<?php include '../includes/footer.php'; ?>
