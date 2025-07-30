<?php
session_start();
require_once '../config/db.php'; 

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get POST data and sanitize
$name = trim($_POST['name']);
$email = trim($_POST['email']);
$password = $_POST['password'];

if (empty($name) || empty($email) || empty($password)) {
    echo "All fields are required.";
    exit;
}

// Check if email already exists
$stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    echo "Email is already registered.";
    $stmt->close();
    exit;
}
$stmt->close();

$hashed_password = password_hash($password, PASSWORD_BCRYPT);


$stmt = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $name, $email, $hashed_password);

if ($stmt->execute()) {
    $_SESSION['success'] = "Registration successful. Please log in.";
	$_SESSION['donor_name'] = $name; 
    header("Location: login.php");
    exit;
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
