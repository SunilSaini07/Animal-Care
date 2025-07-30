<?php
session_start();
require '../config/db.php';

if (!isset($_SESSION['user_id'])) {
    echo "Please log in to view your donation history.";
    exit;
}

$user_id = $_SESSION['user_id'];
$query = "SELECT animal_name, donation_date, amount
          FROM donations
          WHERE user_id = ?
          ORDER BY donation_date DESC";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Donation History</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body { font-family: 'Segoe UI', sans-serif; padding: 40px 15px; background-color: #fff; }
    h2 { font-weight: bold; margin-bottom: 30px; }
    .donation-table { border-radius: 12px; overflow: hidden; border: 1px solid #e2e8f0; }
    .table th { background-color: #f8f9fa; font-weight: 600; }
    .table td, .table th { vertical-align: middle; }
    @media (max-width: 767px) {
      .table-responsive { font-size: 14px; }
      h2 { font-size: 22px; }
    }
  </style>
</head>
<body>
<div class="container">
  <h2>Donation History</h2>

  <div class="table-responsive donation-table">
    <table class="table table-bordered align-middle text-center">
      <thead>
        <tr>
          <th>Animal</th>
          <th>Date</th>
          <th>Amount</th>
        </tr>
      </thead>
      <tbody>
        <?php if ($result->num_rows > 0): ?>
          <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
              <td><?= htmlspecialchars($row['animal_name']) ?></td>
              <td><?= date("F j, Y, g:i a", strtotime($row['donation_date'])) ?></td>
              <td class="text-success fw-semibold">$<?= number_format($row['amount'], 2) ?></td>
            </tr>
          <?php endwhile; ?>
        <?php else: ?>
          <tr><td colspan="3">No donations found.</td></tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>
</body>
</html>
</html>
