<?php
// Get donation amount and optional animal info
$amount = isset($_GET['amount']) ? htmlspecialchars($_GET['amount']) : 'a generous';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Thank You for Your Donation</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/success.css">
  <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</head>
<body>
<div class="thank-you-container">
  <h2 class="fw-bold mb-3">Thank you for your generous donation!</h2>
  <p class="text-muted mb-4">
    Your support helps us provide care and find loving homes for animals in need.
    Every contribution makes a difference in their lives.
  </p>

  <img src="../assets/animal_images/dog-cat.jpg" alt="Thank You Animals" class="thank-you-image mb-4">

  <p class="mb-4">
    Your donation of <strong>$<?php echo $amount; ?></strong> will go directly towards providing food, shelter,
    and medical care for animals like Max and Bella.
  </p>

  <a href="index.php" class="btn btn-green mb-3">View Animals in Need</a>

  <div class="social-icons">
    <p class="text-muted">Share your support on social media</p>
    <a href="#" title="Twitter"><i class="fab fa-twitter"></i></a>
    <a href="#" title="Facebook"><i class="fab fa-facebook"></i></a>
    <a href="#" title="Instagram"><i class="fab fa-instagram"></i></a>
  </div>
</div>

</body>
</html>
