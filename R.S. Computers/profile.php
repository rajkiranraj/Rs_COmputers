<?php
session_start();
require_once 'connect.php';

// Check if user is logged in, if not redirect to login page
if (!isset($_SESSION["user_id"])) {
    header("Location: portal.html");
    exit;
}

// Get user information from database
$user_id = $_SESSION["user_id"];

// Fetch user data from database
$stmt = $conn->prepare("SELECT id, full_name, email FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($user_id, $user_name, $user_email);
$stmt->fetch();
$stmt->close();

// Update session with latest data
$_SESSION["user_name"] = $user_name;
$_SESSION["user_email"] = $user_email;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile - R.S. Computers</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=home">
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500;700&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        /* Profile page specific styles */
        .profile-container {
            max-width: 800px;
            margin: 40px auto;
            padding: 30px;
            background-color: #fff;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }
        
        .profile-header {
            display: flex;
            align-items: center;
            margin-bottom: 30px;
        }
        
        .profile-avatar {
            width: 80px;
            height: 80px;
            background-color: #4158d0;
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 32px;
            margin-right: 20px;
        }
        
        .profile-title h1 {
            margin: 0;
            color: #333;
            font-size: 24px;
        }
        
        .profile-subtitle {
            color: #777;
            margin-top: 5px;
        }
        
        .profile-section {
            margin-bottom: 30px;
        }
        
        .profile-section h2 {
            border-bottom: 1px solid #eee;
            padding-bottom: 10px;
            color: #4158d0;
        }
        
        .profile-info {
            display: flex;
            flex-wrap: wrap;
        }
        
        .info-group {
            width: 48%;
            margin-bottom: 20px;
        }
        
        .info-label {
            font-weight: 600;
            color: #555;
            margin-bottom: 5px;
        }
        
        .info-value {
            color: #333;
        }
        
        .action-buttons {
            display: flex;
            gap: 15px;
            margin-top: 30px;
        }
        
        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        
        .btn-primary {
            background-color: #4158d0;
            color: white;
        }
        
        .btn-primary:hover {
            background-color: #3448b0;
        }
        
        .btn-secondary {
            background-color: #f0f0f0;
            color: #333;
        }
        
        .btn-secondary:hover {
            background-color: #e0e0e0;
        }
        
        @media (max-width: 768px) {
            .profile-container {
                padding: 20px;
                margin: 20px;
            }
            
            .info-group {
                width: 100%;
            }
            
            .action-buttons {
                flex-direction: column;
            }
            
            .btn {
                width: 100%;
                margin-bottom: 10px;
            }
        }
    </style>
</head>
<body>
    <header>
      <div class="nav">
        <div class="logo">
          <img src="images/logo.jpeg" alt="R.S Computers Logo" />
        </div>
        <button class="hamburger">
          <span></span>
          <span></span>
          <span></span>
        </button>
        <div class="nav-items">
          <a href="indexloggedin.php" id="home">
            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e3e3e3">
              <path d="M240-200h120v-240h240v240h120v-360L480-740 240-560v360Zm-80 80v-480l320-240 320 240v480H520v-240h-80v240H160Zm320-350Z" />
            </svg>
            Home
          </a>
          <div class="highlight">
            <a href="service.html">Services</a>
            <div class="dropdown">
              <ul>
                <li><a href="service.html#isp">Internet Services (ISP)</a></li>
                <li><a href="service.html#network">Network Management</a></li>
                <li><a href="service.html#fiber">Fiber Optic Solutions</a></li>
                <li><a href="service.html#wifi">Wi-Fi Installation</a></li>
              </ul>
            </div>
          </div>
          <a href="support.html">Support</a>
          <a href="about.html">About Us</a>
          <a href="letstalk.html" class="cta">
            <span class="span">Let's Talk</span>
            <span class="second">
              <svg width="50px" height="20px" viewBox="0 0 66 43" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                <g id="arrow" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                  <path class="one" d="M40.1543933,3.89485454 L43.9763149,0.139296592 C44.1708311,-0.0518420739 44.4826329,-0.0518571125 44.6771675,0.139262789 L65.6916134,20.7848311 C66.0855801,21.1718824 66.0911863,21.8050225 65.704135,22.1989893 C65.7000188,22.2031791 65.6958657,22.2073326 65.6916762,22.2114492 L44.677098,42.8607841 C44.4825957,43.0519059 44.1708242,43.0519358 43.9762853,42.8608513 L40.1545186,39.1069479 C39.9575152,38.9134427 39.9546793,38.5968729 40.1481845,38.3998695 C40.1502893,38.3977268 40.1524132,38.395603 40.1545562,38.3934985 L56.9937789,21.8567812 C57.1908028,21.6632968 57.193672,21.3467273 57.0001876,21.1497035 C56.9980647,21.1475418 56.9959223,21.1453995 56.9937605,21.1432767 L40.1545208,4.60825197 C39.9574869,4.41477773 39.9546013,4.09820839 40.1480756,3.90117456 C40.1501626,3.89904911 40.1522686,3.89694235 40.1543933,3.89485454 Z" fill="#FFFFFF"></path>
                  <path class="two" d="M20.1543933,3.89485454 L23.9763149,0.139296592 C24.1708311,-0.0518420739 24.4826329,-0.0518571125 24.6771675,0.139262789 L45.6916134,20.7848311 C46.0855801,21.1718824 46.0911863,21.8050225 45.704135,22.1989893 C45.7000188,22.2031791 45.6958657,22.2073326 45.6916762,22.2114492 L24.677098,42.8607841 C24.4825957,43.0519059 24.1708242,43.0519358 23.9762853,42.8608513 L20.1545186,39.1069479 C19.9575152,38.9134427 19.9546793,38.5968729 20.1481845,38.3998695 C20.1502893,38.3977268 20.1524132,38.395603 20.1545562,38.3934985 L36.9937789,21.8567812 C37.1908028,21.6632968 37.193672,21.3467273 37.0001876,21.1497035 C36.9980647,21.1475418 36.9959223,21.1453995 36.9937605,21.1432767 L20.1545208,4.60825197 C19.9574869,4.41477773 19.9546013,4.09820839 20.1480756,3.90117456 C20.1501626,3.89904911 20.1522686,3.89694235 20.1543933,3.89485454 Z" fill="#FFFFFF"></path>
                  <path class="three" d="M0.154393339,3.89485454 L3.97631488,0.139296592 C4.17083111,-0.0518420739 4.48263286,-0.0518571125 4.67716753,0.139262789 L25.6916134,20.7848311 C26.0855801,21.1718824 26.0911863,21.8050225 25.704135,22.1989893 C25.7000188,22.2031791 25.6958657,22.2073326 25.6916762,22.2114492 L4.67709797,42.8607841 C4.48259567,43.0519059 4.17082418,43.0519358 3.97628526,42.8608513 L0.154518591,39.1069479 C-0.0424848215,38.9134427 -0.0453206733,38.5968729 0.148184538,38.3998695 C0.150289256,38.3977268 0.152413239,38.395603 0.154556228,38.3934985 L16.9937789,21.8567812 C17.1908028,21.6632968 17.193672,21.3467273 17.0001876,21.1497035 C16.9980647,21.1475418 16.9959223,21.1453995 16.9937605,21.1432767 L0.15452076,4.60825197 C-0.0425130651,4.41477773 -0.0453986756,4.09820839 0.148075568,3.90117456 C0.150162624,3.89904911 0.152268631,3.89694235 0.154393339,3.89485454 Z" fill="#FFFFFF"></path>
                </g>
              </svg>
            </span>
          </a>
          <div class="user-profile-container">
            <div class="user-welcome" id="userWelcome">
              <i class="fas fa-user-circle"></i> <?php echo htmlspecialchars($user_name); ?>
              <i class="fas fa-chevron-down" style="margin-left: 5px; font-size: 0.8em;"></i>
            </div>
            <div class="profile-dropdown" id="profileDropdown">
              <div class="profile-card">
                <div class="profile-header">
                  <i class="fas fa-user-circle fa-2x"></i>
                  <div class="profile-name"><?php echo htmlspecialchars($user_name); ?></div>
                </div>
                <div class="profile-menu">
                  <a href="profile.php" class="profile-option">
                    <i class="fas fa-user"></i> View Profile
                  </a>
                  <a href="update-profile.php" class="profile-option">
                    <i class="fas fa-user-edit"></i> Update Profile
                  </a>
                  <a href="logout.php" class="profile-option">
                    <i class="fas fa-sign-out-alt"></i> Logout
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </header>

    <main>
        <div class="profile-container">
            <div class="profile-header">
                <div class="profile-avatar">
                    <?php echo strtoupper(substr($user_name, 0, 1)); ?>
                </div>
                <div class="profile-title">
                    <h1><?php echo htmlspecialchars($user_name); ?></h1>
                    <div class="profile-subtitle">Customer</div>
                </div>
            </div>
            
            <div class="profile-section">
                <h2>Account Information</h2>
                <div class="profile-info">
                    <div class="info-group">
                        <div class="info-label">Username</div>
                        <div class="info-value"><?php echo htmlspecialchars($user_name); ?></div>
                    </div>
                    <div class="info-group">
                        <div class="info-label">Email</div>
                        <div class="info-value"><?php echo htmlspecialchars($user_email); ?></div>
                    </div>
                    <div class="info-group">
                        <div class="info-label">Account ID</div>
                        <div class="info-value">#<?php echo htmlspecialchars($user_id); ?></div>
                    </div>
                    <div class="info-group">
                        <div class="info-label">Member Since</div>
                        <div class="info-value">April 2025</div>
                    </div>
                </div>
            </div>
            
            <div class="profile-section">
                <h2>Services</h2>
                <div class="profile-info">
                    <div class="info-group">
                        <div class="info-label">Current Plan</div>
                        <div class="info-value">Premium Internet Package</div>
                    </div>
                    <div class="info-group">
                        <div class="info-label">Service Status</div>
                        <div class="info-value">Active</div>
                    </div>
                    <div class="info-group">
                        <div class="info-label">Billing Cycle</div>
                        <div class="info-value">Monthly</div>
                    </div>
                    <div class="info-group">
                        <div class="info-label">Next Payment</div>
                        <div class="info-value">May 1, 2025</div>
                    </div>
                </div>
            </div>
            
            <div class="action-buttons">
                <a href="update-profile.php" class="btn btn-primary">Edit Profile</a>
                <a href="indexloggedin.php" class="btn btn-secondary">Back to Home</a>
            </div>
        </div>
    </main>
    
    <footer class="footer">
        <div class="footer-content">
            <!-- Company Information -->
            <div class="footer-section about">
                <div class="company-header">
                    <img src="images/logo.jpeg" alt="R.S Computer Logo" class="footer-logo" />
                    <h4>About R.S Computer</h4>
                </div>
                <p class="tagline">
                    Your Trusted Provider of ISP, WiFi, Fiber Optics, and Networking Solutions.
                </p>
                <div class="contact-details">
                    <div><i class="fas fa-map-marker-alt"></i>123 Tech Lane, City, State, ZIP</div>
                    <div><i class="fas fa-envelope"></i>contact@rscomputer.com</div>
                    <div><i class="fas fa-phone-alt"></i>1-800-123-4567 (24/7 Support)</div>
                </div>
            </div>

            <!-- Footer sections from the main page would go here -->
        </div>

        <div class="footer-bottom">
            <div class="legal-links">
                <a href="terms.html">Terms of Service</a>
                <a href="privacy.html">Privacy Policy</a>
                <a href="cookies.html">Cookie Policy</a>
            </div>
            <div class="copyright">
                <p>&copy; 2025 R.S Computer. All Rights Reserved.</p>
            </div>
        </div>
    </footer>

    <script src="script.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Toggle profile dropdown
            const userWelcome = document.getElementById('userWelcome');
            const profileDropdown = document.getElementById('profileDropdown');
            userWelcome.addEventListener('click', function() {
                profileDropdown.style.display =
                profileDropdown.style.display === 'block' ? 'none' : 'block';
            });

            // Close dropdown when clicking outside
            document.addEventListener('click', function(event) {
                if (!userWelcome.contains(event.target) && !profileDropdown.contains(event.target)) {
                profileDropdown.style.display = 'none';
                }
            });
        });
    </script>
</body>
</html>