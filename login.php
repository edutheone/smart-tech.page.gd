<?php
session_start();
include '../config.php';

// If already logged in, redirect to admin
if (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] === true) {
    header("Location: admin.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $admin_email = $_POST['email'];
    $admin_pass = $_POST['password'];

    $valid_email = "edwinnyambane404@gmail.com";
    $valid_pass = "Edwin2158";

    if ($admin_email === $valid_email && $admin_pass === $valid_pass) {
        $_SESSION['is_admin'] = true;
        $_SESSION['admin_email'] = $admin_email;
        header("Location: admin.php");
        exit;
    } else {
        $error = "❌ Invalid email or password.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login | Smart Technology</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <div class="login-container">
        <h2>🔐 Admin Login</h2>

        <?php if (!empty($error)): ?>
            <p class="error"><?= $error ?></p>
        <?php endif; ?>

        <form action="login.php" method="POST">
            <label>Email</label>
            <input type="email" name="email" placeholder="Enter admin email" required>

            <label>Password</label>
            <input type="password" name="password" placeholder="Enter password" required>

            <button type="submit">Login</button>
        </form>

        <p class="note">Return to <a href="index.php">Home</a></p>
    </div>
</body>
</html>
