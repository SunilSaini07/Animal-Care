<?php
session_start();
require_once '../config/db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$animal_id = isset($_POST['id']) ? intval($_POST['id']) : 0;
$amount = isset($_POST['amount']) ? floatval($_POST['amount']) : 0;

if ($animal_id <= 0 || $amount <= 0) {
    $_SESSION['error'] = "Invalid donation details.";
    header("Location: donate.php?id=$animal_id");
    exit;
}

// Get animal name for saving
$stmt = $conn->prepare("SELECT name FROM animals WHERE id = ?");
$stmt->bind_param("i", $animal_id);
$stmt->execute();
$result = $stmt->get_result();
$animal = $result->fetch_assoc();
$animal_name = $animal ? $animal['name'] : '';

$stmt->close();

$stmt = $conn->prepare("INSERT INTO donations (user_id, animal_name, donation_date, amount) VALUES (?, ?, NOW(), ?)");
$stmt->bind_param("isd", $user_id, $animal_name, $amount);
$stmt->execute();
$stmt->close();

header("Location: success.php?amount=$amount");
exit;

?>
