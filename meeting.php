<?php
session_start();
include "../config.php";

// Check if admin is logged in
if (!isset($_SESSION['is_admin'])) {
    header("Location: login.php"); 
    exit;
}

// When form is submitted
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $meeting_link = $_POST['meeting_link'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $message = $_POST['message'];
    $target_interest = $_POST['target_interest']; // New field

    $save = $conn->query("
        INSERT INTO meeting (meeting_link, date, time, message, target_interest)
        VALUES ('$meeting_link', '$date', '$time', '$message', '$target_interest')
    ");

    if ($save) {
        echo "<script>alert('Live Class added successfully!'); window.location='admin.php';</script>";
    } else {
        echo "<script>alert('Error saving live class!');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width , initial-scale=1.0">
    <title>Add Live Class</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #360575ff;
        }
        .container {
            width: 450px;
            margin: 80px auto;
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px #ccc;
        }
        input, textarea, select {
            width: 100%;
            padding: 12px;
            border-radius: 6px;
            border: 1px solid #aaa;
            margin-bottom: 12px;
        }
        button {
            background: #1a73e8;
            color: white;
            padding: 12px;
            width: 100%;
            border: none;
            border-radius: 6px;
            font-size: 16px;
        }
        a {
            text-decoration: none;
            color: blue;
        }
    </style>
</head>
<body>

<div class="container">
    <form method="POST">
        <h2>Add Live Class / Meeting Link</h2>

        <label>Meeting Link (Zoom / Google Meet / WhatsApp Group)</label>
        <input type="text" name="meeting_link" placeholder="https://meet.google.com/xyz-123" required>

        <label>Date</label>
        <input type="date" name="date" required>

        <label>Time</label>
        <input type="text" name="time" placeholder="8:00 PM" required>

        <label>Message / Topic Description</label>
        <textarea name="message" placeholder="Today's topic: Networking basics..." required></textarea>

        <!-- Target Interest Dropdown -->
        <label>Target Interest:</label>
        <select name="target_interest" required>
            <option value="ALL">All Students</option>
             <option value="graphic">Graphic Design</option>
          <option value="web">Web design and developent</option>
          <option value="uiux">UI/UX Design</option>
          <option value="animation">3D & Animation</option>
          <option value="animation">network management</option>
          <option value="animation">fundamentals of ICT</option>
          <option value="animation">object oriented programming</option>
        </select>

        <button type="submit">Save Live Class</button>
    </form>

    <br>
    <a href="admin.php">← Back to Dashboard</a>
</div>

</body>
</html>
