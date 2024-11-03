<?php
session_start();
?>

<?php include 'includes/header.php'; ?>
<h1>Welcome to the Bus Pass Verification System</h1>
<p>Please select your role to login:</p>
<ul>
    <li><a href="admin/login.php">Admin Login</a></li>
    <li><a href="student/login.php">Student Login</a></li>
    <li><a href="driver/login.php">Driver Login</a></li>
</ul>
<?php include 'includes/footer.php'; ?>
