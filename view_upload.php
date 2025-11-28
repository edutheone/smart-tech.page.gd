<?php
include "../config.php";

$resources = $conn->query("SELECT * FROM resources ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Uploaded Files</title>
    <link rel="stylesheet" href="view_upload.css">
</head>
<body>

<h2>Uploaded Resources</h2>

<?php
if ($resources->num_rows > 0) {
    while ($row = $resources->fetch_assoc()) {
        echo "<p><strong>{$row['title']}</strong> ({$row['type']})<br>";

        // Real file path
        $filePath = "uploads/" . $row['filename'];

        echo "<a href='$filePath' target='_blank'>Open File</a> ";
        echo "<a href='delete_upload.php?id={$row['id']}'></a>";
        echo "</p><hr>";
    }
} else {
    echo "<p>No uploads yet.</p>";
}
?>

</body>
</html>
