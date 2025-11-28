<?php
include "config.php";
$id = $_GET['id'];
$conn->query("DELETE FROM resources WHERE id=$id");
header("Location: view_resources.php");
?>
