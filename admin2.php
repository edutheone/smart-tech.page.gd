<?php
include "../config.php";
session_start();

// Check if admin is logged in
if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] !== true) {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="admin.css"> 
</head>
<body>

<div class="header">
    <h2>Welcome Admin: <?php echo $_SESSION['admin_email']; ?> 👋</h2>
    <a class="logout" href="logout.php">Logout</a>
</div>

<div class="container">
    <h3>Registered Students</h3>
    <div class="list-box">
   <?php
$users = $conn->query("SELECT * FROM users ORDER BY id DESC");
?>

<table border="1" cellpadding="10" cellspacing="0" style="width:100%; border-collapse: collapse;">
    <tr style="background:#333; color:white;">
        <th>ID</th>
        <th>Full Name</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Date Joined</th>
        <th>Interest</th>
        <th>Actions</th>
    </tr>

<?php
if ($users->num_rows > 0) {
    while ($s = $users->fetch_assoc()) {
        echo "
        <tr>
            <td>{$s['id']}</td>
            <td>{$s['fullname']}</td>
            <td>{$s['email']}</td>
            <td>{$s['phone']}</td>
            <td>{$s['date_joined']}</td>
            <td>{$s['interest']}</td>
            <td>
                <a href='edit.php?id={$s['id']}'>Edit</a> | 
                <a href='delete.php?id={$s['id']}' onclick=\"return confirm('Are you sure you want to delete this user?');\">Delete</a>
            </td>
        </tr>";
    }
} else {
    echo "<tr><td colspan='7'>No students registered yet.</td></tr>";
}
?>
</table>

    </div>

    <div class="links">
        <a href="class.php">➕ Add Class</a>
        <a href="asignment.php">📝 Add Assignment</a>
        <a href="upload.php">📚 upload resource</a>
        <a href="view_upload.php">📄 View upload</a>
        <a href="meeting.php">📄 add class link</a>
    </div>
</div>

</body>
</html>
