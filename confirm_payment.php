<?php
include 'config.php';

if (isset($_GET['id']) && isset($_GET['status'])) {
    $id = intval($_GET['id']);
    $status = $_GET['status'];

    $stmt = $conn->prepare("UPDATE payments SET status=? WHERE id=?");
    $stmt->bind_param("si", $status, $id);

    if ($stmt->execute()) {
        echo "<script>alert('Payment status updated to $status');window.location='admin.php';</script>";
    } else {
        echo "Error updating record: " . $stmt->error;
    }
} else {
    header("Location: admin.php");
    exit;
}
?>
