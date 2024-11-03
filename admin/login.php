<?php
session_start();
include '../includes/db_connect.php';
$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Admin credentials
    $admin_username = 'admin';
    $admin_password = '123@vignan';

    if ($username === $admin_username && $password === $admin_password) {
        $_SESSION['role'] = 'admin';
        header('Location: dashboard.php'); // Redirect to admin dashboard
        exit;
    } else {
        $error = "Invalid username or password!";
    }
}
?>

<?php include '../includes/header.php'; ?>
<h2>Admin Login</h2>
<form method="post">
    <input type="text" name="username" placeholder="Username" required><br>
    <input type="password" name="password" placeholder="Password" required><br>
    <button type="submit">Login</button>
    <p style="color:red;"><?php echo $error; ?></p>
</form>
<?php include '../includes/footer.php'; ?>
