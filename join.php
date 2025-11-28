<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Join Us - TechHive Design Academy</title>
  <link rel="stylesheet" href="join.css">
</head>

<body>

  <!-- Header -->
  <header class="site-header">
    <div class="container header-content">
      <h1 class="logo">Smart Technology</h1>
      <nav>
        <ul class="nav-links">
          <li><a href="index.php">Home</a></li>
          <li><a href="about.php">About</a></li>
          <li><a href="contact.php">Contact</a></li>
          <li><a href="join.php" class="active">Join Us</a></li>
        </ul>
      </nav>
    </div>
  </header>

  <!-- Main Section -->
  <main class="main-section">
    <section class="join-container">
      <h2>Join Our Design and development Community</h2>
      <p class="intro-text">Register to place an order or attend our online classes and begin your creative journey!</p>

      <form id="joinForm" class="join-form" method="POST" action="register.php">
        <label for="fullname">Full Name</label>
        <input type="text" id="fullname" name="fullname" placeholder="Enter your full name" required>

        <label for="email">Email Address</label>
        <input type="email" id="email" name="email" placeholder="Enter your email" required>

    
        <label for="phone">Phone Number (whatsapp and calls)</label>
        <input type="tel" id="phone" name="phone"  pattern="^\+2547\d{8}$"  placeholder="+2547XXXXXXXX" required>
       

        <label for="password">Password</label>
        <input type="password" id="password" name="password" placeholder="Create a password" required>

        <label for="confirm-password">Confirm Password</label>
        <input type="password" id="confirm-password" name="confirm-password" placeholder="Confirm your password" required>

        <label for="interest">Area of Interest</label>
        <select id="interest" name="interest" required>
          <option value="">Select your interest</option>
          <option value="graphic">Graphic Design</option>
          <option value="web">Web design and developent</option>
          <option value="uiux">UI/UX Design</option>
          <option value="animation">3D & Animation</option>
          <option value="animation">network management</option>
          <option value="animation">fundamentals of ICT</option>
          <option value="animation">object oriented programming</option>
        </select>

        <button type="submit" class="submit-btn">Create Account</button>

        <p class="login-text">
          Already have an account?
          <a href="login.PHP">Login here</a>
        </p>
      </form>
    </section>
  </main>

  <!-- Footer -->
  <footer class="site-footer">
    <p>&copy; 2025 Smart Technology. All rights reserved.</p>
  </footer>

  <!-- Simple Password Validation -->
  <script>
    const form = document.getElementById('joinForm');
    form.addEventListener('submit', function (e) {
      const password = document.getElementById('password').value;
      const confirm = document.getElementById('confirm-password').value;

      if (password !== confirm) {
        e.preventDefault();
        alert('Passwords do not match. Please re-enter.');
      }
    });
  </script>
</body>

</html>
