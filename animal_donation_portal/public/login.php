<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Login | Animal Care</title>
  <link rel="stylesheet" href="css/login.css" />
</head>
<body>

<div class="login-container">
  <h2>Login to Your Account</h2>

  <?php if (isset($_SESSION['error'])): ?>
    <p style="color: red; text-align:center;"><?= $_SESSION['error']; unset($_SESSION['error']); ?></p>
  <?php endif; ?>

  <form action="login_process.php" method="post">
    <label for="email">Email</label>
    <input type="email" name="email" required placeholder="Enter your email">

    <label for="password">Password</label>
    <input type="password" name="password" required placeholder="Enter your password">

    <div class="forgot-link">
      <a href="#">Forgot Password?</a>
    </div>

    <input type="submit" value="Login" class="btn">
  </form>

  <div class="signup-text">
    Don’t have an account? <a href="register.php">Sign Up</a>
  </div>
</div>

</body>
</html>
