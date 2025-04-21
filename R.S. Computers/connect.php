<?php
$host = "localhost"; // XAMPP runs locally
$dbUsername = "root"; // Default username in XAMPP
$dbPassword = ""; // Leave blank (no password for root by default)
$dbName = "rs_computers"; // Your database name

// Create connection
$conn = new mysqli($host, $dbUsername, $dbPassword, $dbName);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Optional: success message (you can remove this later)
// echo "Connected successfully";
?>
