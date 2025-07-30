<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$dbname = 'animal_donation';

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Connection failed to MySQL on host '$host' with user '$user': " . $conn->connect_error);
}
?>
