<?php
// Start the session to be able to use session variables
session_start();

// Function to sanitize input
function sanitize_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
    return $data;
}

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate email
    if (empty($_POST["email"])) {
        $error = "Email is required";
    } else {
        $email = sanitize_input($_POST["email"]);
        // Basic email validation
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = "Invalid email format";
        } else {
            // In a real application, you would:
            // 1. Check if the email already exists in your subscribers database
            // 2. Add the email to your database
            // 3. Maybe send a confirmation email
            
            // For now, we'll just log the subscription
            $log_file = 'newsletter_subscribers.txt';
            $log_entry = date('Y-m-d H:i:s') . ' | Email: ' . $email . "\n";
            file_put_contents($log_file, $log_entry, FILE_APPEND);
            
            // Set success message
            $_SESSION["subscription_success"] = true;
            
            // Redirect back to the page they came from or to home
            $redirect = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : 'index.html';
            header("Location: $redirect");
            exit;
        }
    }
    
    // If there was an error, set error message and redirect back
    if (isset($error)) {
        $_SESSION["subscription_error"] = $error;
        $redirect = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : 'index.html';
        header("Location: $redirect");
        exit;
    }
}
?>
```

// If someone directly accesses this page without submitting the form
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subscription Error - R.S. Computers</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <!-- Header content -->
    </header>
    
    <main style="text-align: center; padding: 50px 20px;">
        <h1>Oops! Something went wrong.</h1>
        <p>Please try subscribing to our newsletter from our website.</p>
        <a href="index.html" style="display: inline-block; margin-top: 20px; padding: 10px 20px; background-color: #4158d0; color: white; text-decoration: none; border-radius: 5px;">Go to Homepage</a>
    </main>
    
    <footer>
        <!-- Footer content -->
    </footer>
</body>
</html>
