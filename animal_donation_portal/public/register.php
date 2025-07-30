<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Create an Account</title>
  <link rel="stylesheet" href="css/register.css" />
</head>
<body>
  <div class="container">
    <h2>Create an account</h2>
    <form action="register_process.php" method="POST">
      <input type="text" name="name" placeholder="Enter your name" required />
      <input type="email" name="email" placeholder="Enter your email" required />
      <input type="password" name="password" placeholder="Enter your password" required />
      <button type="submit">Sign Up</button>
    </form>
    <div class="login-link">
      Already have an account? <a href="login.php">Sign in</a>
    </div>
  </div>
</body>
</html>
