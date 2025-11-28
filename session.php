<?php

session_start();
include 'config.php';

$email = $_SESSION['email'];


$stmt = $conn->prepare("SELECT status FROM payments WHERE email=? ORDER BY id DESC LIMIT 1");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();
$status = $result->num_rows > 0 ? $result->fetch_assoc()['status'] : 'Not Paid';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Your Session | Smart Technology</title>
    <link rel="stylesheet" href="dashboard.css">
</head>
<body>
<header class="header">
    <h1>🎓 My Session</h1>
    <a href="dashboard.php" class="logout-btn">← Back to Dashboard</a>
</header>

<main class="dashboard-container">
    <section class="session-area">
        <?php if ($status == 'Confirmed'): ?>
            <h2>✅ Welcome to Your Class!</h2>
            <p>Your payment has been confirmed. Your training in <b><?php echo htmlspecialchars($_SESSION['interest'] ?? 'your field'); ?></b> will begin soon.</p>
            <a href="dashboard1.php">.Continue</a>

        <?php elseif ($status == 'Pending'): ?>
            <h2>⏳ Payment Pending Verification</h2>
            <p>Please wait for the admin to confirm your payment. You’ll receive access to your session once approved.</p>

        <?php elseif ($status == 'Rejected'): ?>
            <h2>❌ Payment Rejected</h2>
            <p>Your payment was not verified. Please recheck your M-Pesa code or contact support.</p>

        <?php else: ?>
            <h2>💡 Enrollment Required</h2>
            <p>Please enroll first to access your class sessions.</p>
            <p>If you already made a payment, wait for admin confirmation or <a href="contact.php">contact the admin</a>.</p>
        <?php endif; ?>
    </section>
</main>

<footer class="footer">
    <p>&copy; 2025 Smart Technology. All Rights Reserved.</p>
</footer>
</body>
</html>
