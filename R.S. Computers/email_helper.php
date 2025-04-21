<?php
/**
 * Helper file for sending emails to users
 */

/**
 * Send an email notification to a user
 * 
 * @param string $to The recipient's email address
 * @param string $subject The email subject
 * @param string $message The email message body (HTML format)
 * @return bool Whether the email was sent successfully
 */
function send_email_notification($to, $subject, $message) {
    // Email headers
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= "From: R.S. Computers <noreply@rscomputers.com>" . "\r\n";
    
    // Company information for the email footer
    $company_footer = "
        <div style='margin-top: 30px; padding-top: 20px; border-top: 1px solid #eee; color: #666; font-size: 12px;'>
            <p>R.S. Computers - Your Trusted Provider of ISP, WiFi, Fiber Optics, and Networking Solutions</p>
            <p>123 Tech Lane, City, State, ZIP | <a href='mailto:contact@rscomputer.com'>contact@rscomputer.com</a> | 1-800-123-4567</p>
            <p>© 2025 R.S. Computer. All Rights Reserved.</p>
        </div>
    ";
    
    // Wrap the message in HTML formatting
    $html_message = "
    <html>
    <head>
        <style>
            body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
            .container { max-width: 600px; margin: 0 auto; padding: 20px; }
            .header { background-color: #4158d0; color: white; padding: 20px; text-align: center; border-radius: 5px 5px 0 0; }
            .content { padding: 20px; background-color: #fff; border-left: 1px solid #eee; border-right: 1px solid #eee; }
            .footer { padding: 15px; background-color: #f8f8f8; border-radius: 0 0 5px 5px; font-size: 12px; color: #666; border: 1px solid #eee; }
            .button { display: inline-block; padding: 10px 20px; background-color: #4158d0; color: white !important; text-decoration: none; border-radius: 5px; margin-top: 15px; }
        </style>
    </head>
    <body>
        <div class='container'>
            <div class='header'>
                <h2>R.S. Computers</h2>
            </div>
            <div class='content'>
                $message
            </div>
            <div class='footer'>
                $company_footer
            </div>
        </div>
    </body>
    </html>
    ";
    
    // Send the email
    return mail($to, $subject, $html_message, $headers);
}

/**
 * Send a registration confirmation email
 * 
 * @param string $to The recipient's email address
 * @param string $name The recipient's name
 * @return bool Whether the email was sent successfully
 */
function send_registration_email($to, $name) {
    $subject = "Welcome to R.S. Computers - Registration Successful";
    
    $message = "
    <h3>Welcome to R.S. Computers, $name!</h3>
    <p>Thank you for registering with R.S. Computers. Your account has been successfully created.</p>
    <p>You can now log in to access our services, manage your profile, and explore everything we have to offer.</p>
    <p><a href='http://localhost/R.S.%20Computers/portal.html' class='button'>Log In Now</a></p>
    <p>If you have any questions or need assistance, please don't hesitate to contact our support team.</p>
    <p>Best regards,<br>The R.S. Computers Team</p>
    ";
    
    return send_email_notification($to, $subject, $message);
}

/**
 * Send a password change notification email
 * 
 * @param string $to The recipient's email address
 * @param string $name The recipient's name
 * @return bool Whether the email was sent successfully
 */
function send_password_change_email($to, $name) {
    $subject = "R.S. Computers - Password Changed Successfully";
    
    $message = "
    <h3>Hello, $name</h3>
    <p>We're writing to confirm that your password for your R.S. Computers account has been successfully changed.</p>
    <p>This change was made on " . date("F j, Y, g:i a") . ".</p>
    <p>If you did not make this change, please contact our support team immediately.</p>
    <p><a href='http://localhost/R.S.%20Computers/portal.html' class='button'>Log In to Your Account</a></p>
    <p>Best regards,<br>The R.S. Computers Team</p>
    ";
    
    return send_email_notification($to, $subject, $message);
}
?>