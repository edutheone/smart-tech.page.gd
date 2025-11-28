<?php
include "../config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $deadline = $_POST['deadline'];
    $desc = $_POST['description'];
    $target_interest = $_POST['target_interest']; // New field

    $conn->query("INSERT INTO assignments(title, deadline, description, target_interest) 
                  VALUES('$title','$deadline','$desc','$target_interest')");

    echo "<script>
           alert('Assignment added successfully!');
           window.location.href='admin.php';
           </script>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Assignments Page</title>
   <link rel="stylesheet" href="asignment.css">
</head>
<body>

<form  action="asignment.php" method="POST">
    <h3>Add Assignment</h3>
    <input type="text" name="title" placeholder="Assignment Title" required><br><br>
    <input type="date" name="deadline" required><br><br>
    <textarea name="description" placeholder="Description"></textarea><br><br>

    <!-- Target Interest Dropdown -->
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
