<?php
// Include the database connection
include 'config.php';

// Start session for tracking login
session_start();

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data safely
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Check for empty fields
    if (empty($email) || empty($password)) {
        echo "<script>
                alert('Please fill in all fields.');
                window.history.back();
              </script>";
        exit;
    }

    // Prepare SQL (prevent SQL injection)
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();

    // Fetch user data
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Verify hashed password
        if (password_verify($password, $user['password'])) {

            // Store session data
            $_SESSION['fullname'] = $user['fullname'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['interest'] = $user['interest'];

            echo "<script>
                    alert('Login successful! Welcome, {$user['fullname']}');
                    window.location.href = 'dashboard.php';
                  </script>";
            exit;

        } else {
            echo "<script>
                    alert('Invalid password. Please try again.');
                    window.history.back();
                  </script>";
        }
    } else {
        echo "<script>
                alert('No account found with that email.');
                window.history.back();
              </script>";
    }

    $stmt->close();
}
?>
