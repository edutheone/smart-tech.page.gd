<?php
include 'config.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $amount = $_POST['amount'];
    $mpesa_code = strtoupper(trim($_POST['mpesa_code']));

    // Prevent duplicate M-Pesa codes
    $check = $conn->prepare("SELECT * FROM payments WHERE mpesa_code = ?");
    $check->bind_param("s", $mpesa_code);
    $check->execute();
    $result = $check->get_result();

    if ($result->num_rows > 0) {
        echo "<script>alert('⚠️ This M-Pesa code has already been used.');window.history.back();</script>";
        exit;
    }

    // Insert new record
    $stmt = $conn->prepare("INSERT INTO payments (fullname, email, amount, mpesa_code, status) VALUES (?, ?, ?, ?, 'Pending')");
    $stmt->bind_param("ssis", $fullname, $email, $amount, $mpesa_code);

    if ($stmt->execute()) {
        echo "<script>alert('✅ Payment submitted successfully! We’ll verify and confirm soon.');window.location.href='dashboard.php';</script>";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
