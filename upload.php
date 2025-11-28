<?php
include "../config.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $title = $_POST['title'];
    $type = $_POST['type'];
    $uploaded_by = "Admin";
    $target_interest = $_POST['target_interest']; // New field

    $file = $_FILES['file']['name'];
    $temp = $_FILES['file']['tmp_name'];

    $folder = "uploads/" . basename($file);

    if (move_uploaded_file($temp, $folder)) {

        $conn->query("INSERT INTO resources (title, filename, type, uploaded_by, target_interest)
                      VALUES ('$title', '$file', '$type', '$uploaded_by', '$target_interest')");

        echo "<script> alert('Resource added successfully'); window.location.href='admin.php'</script>";
    } else {
        echo "Upload failed!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Resource</title>
    <link rel="stylesheet" href="upload.css">
</head>
<body>

<h3>Upload Video / Note</h3>
<form action="upload.php" method="POST" enctype="multipart/form-data">
    <input type="text" name="title" placeholder="Resource Title" required><br><br>

    <select name="type" required>
        <option value="">Select Type</option>
        <option value="video">Video</option>
        <option value="pdf">PDF Notes</option>
        <option value="image">Image</option>
        <option value="document">Document</option>
    </select><br><br>

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

    <input type="file" name="file" required><br><br>

    <button type="submit">Upload</button>
</form>

</body>
</html>
