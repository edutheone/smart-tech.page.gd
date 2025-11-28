<?php
session_start();
include 'config.php';

// Protect page if not logged in
if (!isset($_SESSION['email'])) {
    header("Location: login.htm");
    exit;
}

$email = $_SESSION['email'];

// Fetch user info
$userQuery = $conn->prepare("SELECT * FROM users WHERE email = ?");
$userQuery->bind_param("s", $email);
$userQuery->execute();
$userResult = $userQuery->get_result();
$user = $userResult->fetch_assoc();

// Fetch payment info
$payQuery = $conn->prepare("SELECT * FROM payments WHERE email = ? ORDER BY id DESC LIMIT 1");
$payQuery->bind_param("s", $email);
$payQuery->execute();
$payResult = $payQuery->get_result();
$payment = $payResult->fetch_assoc();

$paymentStatus = $payment['status'] ?? 'Not Paid';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard | Smart Technology</title>
    <link rel="stylesheet" href="dashboard.css">
</head>
<body>
<header class="header">
    <h1>Welcome, <?php echo htmlspecialchars($user['fullname']); ?> 👋</h1>
    <nav>
        <a href="session.php" class="btn">🎓 Session</a>
        <a href="logout.php" class="btn logout">Logout</a>
    </nav>
</header>

<main class="dashboard-container">
    <section class="user-info">
        <h2>👤 My Profile</h2>
        <p><strong>Name:</strong> <?php echo htmlspecialchars($user['fullname']); ?></p>
        <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
        <p><strong>Interest:</strong> <?php echo htmlspecialchars($user['interest'] ?? 'Not set'); ?></p>
    </section>

    <section class="payment">
        <h2>💳 Enrollment Fee</h2>
        <p>Pay <strong>Ksh 120</strong> to <b>Paybill: 522522</b><br>
           Account: <b>130041870</b></p>

        <?php
        if ($paymentStatus == 'Confirmed') {
            echo '<p class="status confirmed">✅ Payment Confirmed</p>';
        } elseif ($paymentStatus == 'Pending') {
            echo '<p class="status pending">⏳ Payment Pending Verification</p>';
        } elseif ($paymentStatus == 'Rejected') {
            echo '<p class="status rejected">❌ Payment Rejected — Please try again.</p>';
        } else {
            echo '<p class="status not-paid">💡 Not Paid Yet</p>';
        }
        ?>

        <?php if ($paymentStatus != 'Confirmed'): ?>
        <form action="pay.php" method="POST" class="payment-form">
            <input type="hidden" name="email" value="<?php echo htmlspecialchars($user['email']); ?>">
            <input type="hidden" name="fullname" value="<?php echo htmlspecialchars($user['fullname']); ?>">

            <label>Amount (Ksh):</label><br>
            <input type="number" name="amount" value="120" readonly><br>

            <label>M-Pesa Transaction Code:</label><br>
            <input type="text" name="mpesa_code" placeholder="e.g. QJ73ASL9IX" required><br>

            <button type="submit" class="btn-pay">Submit Payment</button>
        </form>
        <?php endif; ?>

        <br>
        <a href="session.php" class="btn-session">🎓 Continue to Your Session</a>
    </section>
</main>

<footer class="footer">
    <p>&copy; 2025 Smart Technology. All Rights Reserved.</p>
</footer>
</body>
</html>
