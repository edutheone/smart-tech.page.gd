<?php
include "../config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['class_name'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $desc = $_POST['description'];
    $target_interest = $_POST['target_interest']; // New field

    // Insert into classes with target_interest
    $conn->query("INSERT INTO classes(class_name, date, time, description, target_interest) 
                  VALUES('$name','$date','$time','$desc','$target_interest')");

    echo "<script>alert('Class added successfully!');
          window.location.href='admin.php'; </script>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Class</title>
    <link rel="stylesheet" href="class.css">
</head>
<body>

<form action="class.php" method="POST">
    <h3>Add Class</h3>
    <input type="text" name="class_name" placeholder="Class Name" required><br><br>
    <input type="date" name="date" required><br><br>
    <input type="time" name="time" required><br><br>
    <textarea name="description" placeholder="Description"></textarea><br><br>

    <!-- New dropdown for target interest -->
    <label>Target Interest:</label><br>
    <select name="target_interest" required>
        <option value="ALL">All Students</option>
         <option value="graphic">Graphic Design</option>
          <option value="web">Web design and developent</option>
          <option value="uiux">UI/UX Design</option>
          <option value="animation">3D & Animation</option>
          <option value="animation">network management</option>
          <option value="animation">fundamentals of ICT</option>
          <option value="animation">object oriented programming</option>
    </select><br><br>

    <button type="submit">Save</button>
</form>

</body>
</html>
