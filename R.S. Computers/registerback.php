<?php
session_start();  // Start the session at the beginning
require_once 'connect.php';
require_once 'email_helper.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $full_name = trim($_POST["full_name"]);
    $email = trim($_POST["email"]);
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];

    // Basic validation
    if ($password !== $confirm_password) {
        echo "Passwords do not match.";
        exit;
    }

    // Check if email already exists
    $check = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $check->bind_param("s", $email);
    $check->execute();
    $check->store_result();
    if ($check->num_rows > 0) {
        echo "Email already registered.";
        exit;
    }

    // Insert new user
    $hashed = password_hash($password, PASSWORD_DEFAULT);
    $insert = $conn->prepare("INSERT INTO users (full_name, email, password) VALUES (?, ?, ?)");
    $insert->bind_param("sss", $full_name, $email, $hashed);

    if ($insert->execute()) {
        // Get the new user's ID
        $user_id = $conn->insert_id;
        
        // Set session variables
        $_SESSION["user_id"] = $user_id;
        $_SESSION["user_name"] = $full_name;
        
        // Set registration success message flag
        $_SESSION["registration_success"] = true;
        
        // Send registration confirmation email
        send_registration_email($email, $full_name);
        
        // Redirect to logged-in version after successful registration
        header("Location: indexloggedin.php");
        exit;
    } else {
        echo "Registration failed.";
    }
}
?>
