<?php
include '../config/db.php';

// Get animal ID from URL
$animal_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Fetch animal details from database
$stmt = $conn->prepare("SELECT * FROM animals WHERE id = ?");
$stmt->bind_param("i", $animal_id);
$stmt->execute();
$animal = $stmt->get_result()->fetch_assoc();

if (!$animal) {
    echo "<h2 class='text-center mt-5'>Animal not found.</h2>";
    exit;
}

// Normalize image path
$imagePath = str_replace(['..', './'], '', $animal['image_url']); 
$imagePath = "../" . ltrim($imagePath, "/"); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Donate to <?php echo htmlspecialchars($animal['name']); ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
 
 <style>
    .animal-img {
      border-radius: 16px;
      width: 100%;
      object-fit: contain;
      max-height: 450px;
    }
    .donate-btn {
      background-color: #22c55e;
      color: white;
      font-weight: 600;
      padding: 12px 24px;
      border: none;
      width: 100%;
    }
    .donate-btn:hover {
      background-color: #16a34a;
    }
    .amount-btn {
      border: 1px solid #ddd;
      background-color: white;
      padding: 6px 16px;
      border-radius: 6px;
      margin-right: 8px;
      cursor: pointer;
    }
    .amount-btn.active {
      background-color: #22c55e;
      color: white;
      border-color: #22c55e;
    }
    @media (max-width: 576px) {
      .animal-img {
        max-height: 300px;
      }
    }
  </style>
</head>
<body>

<div class="container py-5">
  <h2 class="mb-4 fw-bold">Support <?php echo htmlspecialchars($animal['name']); ?>'s Recovery</h2>

  <img src="<?php echo htmlspecialchars($imagePath); ?>" alt="<?php echo htmlspecialchars($animal['name']); ?>" class="animal-img mb-4">

  <p class="text-muted">
    <?php echo nl2br(htmlspecialchars($animal['description'])); ?>
  </p>

  <hr class="my-4">

  <!-- Donation Form (UI only) -->
  <form action="donate_process.php" method="POST">
    <input type="hidden" name="id" value="<?php echo $animal['id']; ?>">

    <div class="mb-3">
      <label class="form-label fw-bold">Choose Your Donation Amount</label><br>
      <div class="d-flex flex-wrap mb-2">
        <button type="button" class="amount-btn" onclick="setAmount(25)">$25</button>
        <button type="button" class="amount-btn" onclick="setAmount(50)">$50</button>
        <button type="button" class="amount-btn" onclick="setAmount(100)">$100</button>
        <button type="button" class="amount-btn" onclick="customAmount()">Other</button>
      </div>
      <input type="number" id="amount" name="amount" class="form-control" placeholder="Enter Custom Amount" min="1" required>
    </div>

    <div class="mb-3">
      <label class="form-label fw-bold">Payment Method</label><br>
      <div class="d-flex gap-2">
        <button type="button" class="amount-btn active">Credit Card</button>
        <button type="button" class="amount-btn">PayPal</button>
      </div>
    </div>

    <!-- Card Details -->
    <div class="mb-3">
      <label class="form-label">Card Number</label>
      <input type="text" class="form-control" placeholder="Enter card number" required>
    </div>

    <div class="row mb-3">
      <div class="col-md-6">
        <label class="form-label">Expiry Date</label>
        <input type="text" class="form-control" placeholder="MM/YY" required>
      </div>
      <div class="col-md-6">
        <label class="form-label">CVV</label>
        <input type="text" class="form-control" placeholder="CVV" required>
      </div>
    </div>

    <div class="mb-4">
      <label class="form-label">Name on Card</label>
      <input type="text" class="form-control" placeholder="Enter name" required>
    </div>

    <button type="submit" class="donate-btn">Donate Now</button>
  </form>
</div>

<script>
  function setAmount(value) {
    document.getElementById("amount").value = value;
  }
  function customAmount() {
    document.getElementById("amount").focus();
  }
</script>
</body>
</html>
