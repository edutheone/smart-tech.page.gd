<?php 
//fist including the database connection page
include 'config.php';

//check if the form was submitted
if ($_SERVER['REQUEST_METHOD']=="POST") {
    //am collecting dat from the form
    $fullname = $_POST["fullname"];
    $email = $_POST["email"];
    $phone = $_POST["phone"]; // phone field
    $password = $_POST["password"];
    $confirm = $_POST["confirm-password"];
    $interest = $_POST["interest"];

    // validation
    if (empty($fullname) || empty($email) || empty($phone) || empty($password) || empty($confirm)
        || empty($interest)) {
        echo"<script>alert('FILL ALL AREAS.'); window.history.back();</script>";
        exit;
    }

    //check if passwords match
    if ($password !== $confirm) {
        echo"<script>alert('Passwords do not match. Please re-enter.'); window.history.back();</script>";
        exit;
    }

    //hash the password for security
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // ✅ check if email already exists
    $check_email = "SELECT * FROM users WHERE email = '$email'";
    $email_result = mysqli_query($conn, $check_email);

    if (mysqli_num_rows($email_result) > 0) {
        echo "<script>
              alert('Email already registered. Please visit the login page and log in.');
              window.location.href = 'login.php';
              </script>";
        exit;
    }

    // ✅ check if phone already exists
    $check_phone = "SELECT * FROM users WHERE phone = '$phone'";
    $phone_result = mysqli_query($conn, $check_phone);

    if (mysqli_num_rows($phone_result) > 0) {
        echo "<script>
              alert('Phone number already registered. Please visit the login page and log in.');
              window.location.href = 'login.php';
              </script>";
        exit;
    }

    //save the user details to the database
    $sql = "INSERT INTO users(fullname, email, phone, password, interest)
            VALUES ('$fullname', '$email', '$phone', '$hashed_password', '$interest')";

    if (mysqli_query($conn, $sql)) {
        echo "<script>
              alert('Account created successfully! Please login.');
              window.location.href = 'login.php';
              </script>";
    } else {
        // Log the actual DB error to server logs (not shown to user)
        error_log('User registration error: ' . mysqli_error($conn));

        // Friendly message to user
        echo "<script>
              alert('Error: Could not create account. Please try again later.');
              window.history.back();
              </script>";
        exit;
    }
} // end if POST
?>
