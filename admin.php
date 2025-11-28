<?php
session_start();
if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] !== true) {
    header("Location: admin_login.php");
    exit;
}
include 'config.php';

// Fetch payments from database
$result = $conn->query("SELECT * FROM payments ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin - Payment Records</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f9f9f9;
      color: #333;
      padding: 30px;
    }
    h2 {
      color: #009900;
      text-align: center;
      margin-bottom: 20px;
    }
    table {
      border-collapse: collapse;
      width: 100%;
      background: #fff;
      box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }
    th, td {
      padding: 12px;
      border: 1px solid #ddd;
      text-align: center;
    }
    th {
      background: #009900;
      color: #fff;
      font-weight: bold;
    }
    tr:nth-child(even) {
      background: #f2f2f2;
    }
    a.action-btn {
      padding: 5px 10px;
      background: #009900;
      color: #fff;
      border-radius: 5px;
      text-decoration: none;
      transition: background 0.3s;
    }
    a.action-btn:hover {
      background: #007a00;
    }
    .confirmed {
      color: green;
      font-weight: bold;
    }
    .rejected {
      color: red;
      font-weight: bold;
    }
    .footer {
      margin-top: 30px;
      text-align: center;
      color: #555;
    }
  </style>
</head>
<body>

  <h2>📋 Payment Records</h2>

  <table>
    <tr>
      <th>ID</th>
      <th>Name</th>
      <th>Email</th>
      <th>Amount (Ksh)</th>
      <th>M-Pesa Code</th>
      <th>Status</th>
      <th>Date</th>
      <th>Action</th>
    </tr>

    <?php if ($result->num_rows > 0): ?>
      <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
          <td><?= $row['id'] ?></td>
          <td><?= htmlspecialchars($row['fullname']) ?></td>
          <td><?= htmlspecialchars($row['email']) ?></td>
          <td><?= number_format($row['amount'], 2) ?></td>
          <td><?= htmlspecialchars($row['mpesa_code']) ?></td>
          <td>
            <?php if ($row['status'] == 'Pending'): ?>
              <span style="color: orange; font-weight: bold;">Pending</span>
            <?php elseif ($row['status'] == 'Confirmed'): ?>
              <span class="confirmed">Confirmed ✅</span>
            <?php else: ?>
              <span class="rejected">Rejected ❌</span>
            <?php endif; ?>
          </td>
          <td><?= $row['created_at'] ?></td>
          <td>
            <?php if ($row['status'] == 'Pending'): ?>
              <a href="confirm_payment.php?id=<?= $row['id'] ?>&status=Confirmed" class="action-btn">Confirm</a>
              <a href="confirm_payment.php?id=<?= $row['id'] ?>&status=Rejected" class="action-btn" style="background:red;">Reject</a>
            <?php else: ?>
              <span class="confirmed">Done</span>
            <?php endif; ?>
          </td>
        </tr>
      <?php endwhile; ?>
    <?php else: ?>
      <tr><td colspan="8">No payments found.</td></tr>
    <?php endif; ?>
  </table>

  <div class="footer">
    <p>&copy; 2025 Smart Technology Admin Dashboard</p>
  </div>

</body>
</html>
