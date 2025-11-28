<?php
session_start();
include 'config.php';

// Ensure the student is logged in
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit;
}

// Get logged-in student info
$email = $_SESSION['email'];
$interest = $_SESSION['interest']; // e.g., 'Computer', 'ICT', 'Video Editing'
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Student Dashboard</title>
<style>
body { font-family: Arial, sans-serif; background: #f0f4f7; margin: 0; }
.header { background: #1a73e8; padding: 15px; color: #fff; text-align: center; font-size: 22px; }
.container { max-width: 900px; margin: 30px auto; background: #fff; padding: 25px; border-radius: 10px; }
.section-box { background: #e9f2ff; padding: 15px; margin-bottom: 20px; border-radius: 8px; }
h2 { color: #1a73e8; }
h3 { margin-top: 0; color: green; }
.logout-btn { padding: 10px 15px; background: #d9534f; color: white; text-decoration: none; border-radius: 5px; }
</style>
</head>
<body>

<div class="header">Student Dashboard</div>

<div class="container">

<h2>WELCOME TO OUR PROGRAM</h2>

<!-- Upcoming Classes -->
<div class="section-box">
    <h3>Upcoming Classes 📚</h3>

    <?php
    $class_query = $conn->query("
        SELECT * FROM classes 
        WHERE target_interest='ALL' OR target_interest='$interest' 
        ORDER BY date ASC, time ASC
    ");

    if ($class_query->num_rows > 0) {
        while ($row = $class_query->fetch_assoc()) {
            echo "<p>
                <strong>{$row['class_name']}</strong><br>
                Date: {$row['date']}<br>
                Time: {$row['time']}<br>
                {$row['description']}<br>
                <strong>For:</strong> {$row['target_interest']}
            </p><hr>";
        }
    } else {
        echo "<p>No upcoming classes for your interest.</p>";
    }
    ?>
</div>

<!-- Assignments -->
<div class="section-box">
    <h3>Assignments 📝</h3>

    <?php
    $assign_query = $conn->query("SELECT * FROM assignments ORDER BY deadline ASC");

    if ($assign_query->num_rows > 0) {
        while ($a = $assign_query->fetch_assoc()) {
            echo "<p>
                <strong>{$a['title']}</strong><br>
                Deadline: {$a['deadline']}<br>
                {$a['description']}
            </p><hr>";
        }
    } else {
        echo "<p>No assignments available.</p>";
    }
    ?>
</div>

<!-- Learning Materials -->
<div class="section-box">
    <h3>Learning Materials 📂</h3>

    <?php
    $res = $conn->query("
        SELECT * FROM resources 
        WHERE target_interest='ALL' OR target_interest='$interest' 
        ORDER BY uploaded_at DESC
    ");

    if ($res->num_rows > 0) {
        while ($r = $res->fetch_assoc()) {
            echo "<p>
                <strong>{$r['title']}</strong><br>
                <a href='admin/uploads/{$r['filename']}' target='_blank'>Open File</a><br>
                <strong>For:</strong> {$r['target_interest']}
            </p><hr>";
        }
    } else {
        echo "<p>No learning materials uploaded yet.</p>";
    }
    ?>
</div>

<!-- Video Lessons -->
<div class="section-box">
    <h3>Video Lessons 🎦</h3>

    <?php
    $video = $conn->query("
        SELECT * FROM resources 
        WHERE type='video' AND (target_interest='ALL' OR target_interest='$interest') 
        ORDER BY uploaded_at DESC
    ");

    if ($video->num_rows > 0) {
        while ($v = $video->fetch_assoc()) {
            echo "<p>
                <strong>{$v['title']}</strong><br>
                <video width='100%' controls>
                    <source src='admin/uploads/{$v['filename']}' type='video/mp4'>
                </video><br>
                <strong>For:</strong> {$v['target_interest']}
            </p><hr>";
        }
    } else {
        echo "<p>No video lessons available for your interest.</p>";
    }
    ?>
</div>

<!-- Live Class Link -->
<div class="section-box">
    <h3>Join Live Class 🎧</h3>

    <?php
    $meet = $conn->query("
        SELECT * FROM meeting 
        WHERE target_interest='ALL' OR target_interest='$interest'
        ORDER BY id DESC LIMIT 1
    ");
    if ($meet->num_rows > 0) {
        $m = $meet->fetch_assoc();
        echo "<p><strong>Live Class:</strong></p>
              <a href='{$m['meeting_link']}' target='_blank'>Join Class</a><br>
              <p>Date: {$m['date']} | Time: {$m['time']}</p>
              <p>{$m['message']}</p>
              <strong>For:</strong> {$m['target_interest']}</p>";
    } else {
        echo "<p>No online class link posted yet for your interest.</p>";
    }
    ?>
</div>

<a href="contact.php">Contact Your Teacher</a><br><br>

<!-- Logout Button -->
<a href="logout.php" class="logout-btn">Logout</a>

</div>
</body>
</html>
