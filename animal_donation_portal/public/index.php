<?php include '../config/db.php'; 
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Animal Care</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
 <link rel="stylesheet" href="css/styles.css">
</head>
<body>

<!-- Header -->
<nav class="navbar navbar-expand-lg navbar-light bg-white px-3">
  <a class="navbar-brand fw-bold" href="#">🐾 Animal Care</a>
  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item mx-2"><a class="nav-link active" href="index.php">Home</a></li>
      <li class="nav-item mx-2"><a class="nav-link" href="donation-history.php">My Donations</a></li>
      <li class="nav-item mx-2">
        <img src="https://cdn3.iconfinder.com/data/icons/avatar-165/536/NORMAL_HAIR-512.png" class="rounded-circle" alt="User" width="32" height="32">
      </li>
      <li class="nav-item mx-2"><a class="nav-link" href="logout.php">Logout</a></li>
    </ul>
  </div>
</nav>

<!-- Hero Section -->
<div class="container my-4">
  <div class="hero-section text-white" style="background-image: url('../assets/hero.jpg');">
    <h1 class="fw-bold">Give Hope, Save Lives</h1>
    <p class="lead">Your donation can provide critical care for animals in need. Every contribution, big or small, makes a difference.</p>
    <a href="#animal-in-need" class="btn btn-donate mt-3">Donate Now</a>
  </div>
</div>

<!-- Animal Grid -->
<div class="container">
  <h3 class="mb-4" id="animal-in-need">Animals in Need</h3>
  <div class="row g-4">
    <?php
    $result = $conn->query("SELECT * FROM animals LIMIT 8");
    while ($animal = $result->fetch_assoc()):
    ?>
    <div class="col-12 col-sm-6 col-md-4 col-lg-3">
      <div class="card animal-card h-100">
        <img src="<?php echo $animal['image_url']; ?>" class="card-img-top" alt="<?php echo $animal['name']; ?>">
        <div class="card-body">
          <h5 class="card-title"><?php echo $animal['name']; ?></h5>
          <p class="card-text small text-muted"><?php echo $animal['description']; ?></p>
          <a href="donate.php?id=<?php echo $animal['id']; ?>" class="btn btn-donate mt-2 w-100">Donate</a>
        </div>
      </div>
    </div>
    <?php endwhile; ?>
  </div>

  <div class="text-center my-4">
    <a href="#" class="btn btn-outline-dark">View All Animals</a>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
