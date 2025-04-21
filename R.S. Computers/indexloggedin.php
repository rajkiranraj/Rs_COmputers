<?php
session_start();

// Check if user is logged in, if not redirect to login page
if (!isset($_SESSION["user_id"])) {
    header("Location: portal.html");
    exit;
}

// Get user's name
$user_name = $_SESSION["user_name"];

// Check for success messages
$login_success = isset($_SESSION["login_success"]) ? true : false;
$registration_success = isset($_SESSION["registration_success"]) ? true : false;

// Clear the messages so they only show once
if ($login_success) {
    unset($_SESSION["login_success"]);
}
if ($registration_success) {
    unset($_SESSION["registration_success"]);
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>R.S. Computers - Welcome <?php echo htmlspecialchars($user_name); ?></title>
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=home"
    />
    <link
      href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@700&display=swap"
      rel="stylesheet"
    />
    <link
      href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500;700&family=Poppins:wght@300;400;500;600&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="style.css" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
    />
    <style>
      /* Alert styles */
      .alert {
        background-color: rgba(40, 167, 69, 0.9);
        color: white;
        padding: 15px 25px;
        border-radius: 5px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        margin: 20px auto;
        max-width: 500px;
        text-align: center;
        position: relative;
        transform: translateY(-20px);
        opacity: 0;
        animation: slideDown 0.5s forwards;
        z-index: 100;
      }
      
      @keyframes slideDown {
        to {
          transform: translateY(0);
          opacity: 1;
        }
      }
      
      /* User welcome styles */
      .user-welcome {
        display: flex;
        align-items: center;
        background-color: rgba(255, 255, 255, 0.1);
        padding: 5px 12px;
        border-radius: 20px;
        margin-left: 10px;
        cursor: pointer;
        transition: background-color 0.3s ease;
      }
      
      .user-welcome:hover {
        background-color: rgba(255, 255, 255, 0.2);
      }
      
      .user-welcome i {
        margin-right: 5px;
        color: #ffca28;
      }
      
      .user-profile-container {
        position: relative;
      }
      
      .profile-dropdown {
        position: absolute;
        top: 120%;
        right: 0;
        background-color: rgba(40, 44, 52, 0.85); /* Dark transparent background */
        backdrop-filter: blur(8px); /* Apply blur effect for better readability */
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 10px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
        display: none;
        z-index: 1000;
        transition: all 0.3s ease;
      }
      
      .profile-card {
        padding: 15px;
        width: 220px;
        color: #fff;
      }
      
      .profile-header {
        display: flex;
        align-items: center;
        margin-bottom: 15px;
        padding-bottom: 10px;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
      }
      
      .profile-header i {
        margin-right: 10px;
        color: #ffca28;
      }
      
      .profile-name {
        font-weight: bold;
        font-size: 1.1em;
      }
      
      .profile-menu {
        display: flex;
        flex-direction: column;
      }
      
      .profile-option {
        display: flex;
        align-items: center;
        padding: 8px 10px;
        text-decoration: none;
        color: #fff;
        border-radius: 5px;
        margin-bottom: 5px;
        transition: background-color 0.2s ease;
      }
      
      .profile-option i {
        margin-right: 10px;
        width: 20px;
        text-align: center;
      }
      
      .profile-option:hover {
        background-color: rgba(255, 255, 255, 0.1);
      }
      
      @media (max-width: 768px) {
        .user-welcome {
          margin: 10px 0;
        }
        
        .profile-dropdown {
          position: static;
          width: 100%;
          margin-top: 10px;
        }
        
        .profile-card {
          width: 100%;
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
            <svg
              xmlns="http://www.w3.org/2000/svg"
              height="24px"
              viewBox="0 -960 960 960"
              width="24px"
              fill="#e3e3e3"
            >
              <path
                d="M240-200h120v-240h240v240h120v-360L480-740 240-560v360Zm-80 80v-480l320-240 320 240v480H520v-240h-80v240H160Zm320-350Z"
              />
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
              <svg
                width="50px"
                height="20px"
                viewBox="0 0 66 43"
                version="1.1"
                xmlns="http://www.w3.org/2000/svg"
                xmlns:xlink="http://www.w3.org/1999/xlink"
              >
                <g
                  id="arrow"
                  stroke="none"
                  stroke-width="1"
                  fill="none"
                  fill-rule="evenodd"
                >
                  <path
                    class="one"
                    d="M40.1543933,3.89485454 L43.9763149,0.139296592 C44.1708311,-0.0518420739 44.4826329,-0.0518571125 44.6771675,0.139262789 L65.6916134,20.7848311 C66.0855801,21.1718824 66.0911863,21.8050225 65.704135,22.1989893 C65.7000188,22.2031791 65.6958657,22.2073326 65.6916762,22.2114492 L44.677098,42.8607841 C44.4825957,43.0519059 44.1708242,43.0519358 43.9762853,42.8608513 L40.1545186,39.1069479 C39.9575152,38.9134427 39.9546793,38.5968729 40.1481845,38.3998695 C40.1502893,38.3977268 40.1524132,38.395603 40.1545562,38.3934985 L56.9937789,21.8567812 C57.1908028,21.6632968 57.193672,21.3467273 57.0001876,21.1497035 C56.9980647,21.1475418 56.9959223,21.1453995 56.9937605,21.1432767 L40.1545208,4.60825197 C39.9574869,4.41477773 39.9546013,4.09820839 40.1480756,3.90117456 C40.1501626,3.89904911 40.1522686,3.89694235 40.1543933,3.89485454 Z"
                    fill="#FFFFFF"
                  ></path>
                  <path
                    class="two"
                    d="M20.1543933,3.89485454 L23.9763149,0.139296592 C24.1708311,-0.0518420739 24.4826329,-0.0518571125 24.6771675,0.139262789 L45.6916134,20.7848311 C46.0855801,21.1718824 46.0911863,21.8050225 45.704135,22.1989893 C45.7000188,22.2031791 45.6958657,22.2073326 45.6916762,22.2114492 L24.677098,42.8607841 C24.4825957,43.0519059 24.1708242,43.0519358 23.9762853,42.8608513 L20.1545186,39.1069479 C19.9575152,38.9134427 19.9546793,38.5968729 20.1481845,38.3998695 C20.1502893,38.3977268 20.1524132,38.395603 20.1545562,38.3934985 L36.9937789,21.8567812 C37.1908028,21.6632968 37.193672,21.3467273 37.0001876,21.1497035 C36.9980647,21.1475418 36.9959223,21.1453995 36.9937605,21.1432767 L20.1545208,4.60825197 C19.9574869,4.41477773 19.9546013,4.09820839 20.1480756,3.90117456 C20.1501626,3.89904911 20.1522686,3.89694235 20.1543933,3.89485454 Z"
                    fill="#FFFFFF"
                  ></path>
                  <path
                    class="three"
                    d="M0.154393339,3.89485454 L3.97631488,0.139296592 C4.17083111,-0.0518420739 4.48263286,-0.0518571125 4.67716753,0.139262789 L25.6916134,20.7848311 C26.0855801,21.1718824 26.0911863,21.8050225 25.704135,22.1989893 C25.7000188,22.2031791 25.6958657,22.2073326 25.6916762,22.2114492 L4.67709797,42.8607841 C4.48259567,43.0519059 4.17082418,43.0519358 3.97628526,42.8608513 L0.154518591,39.1069479 C-0.0424848215,38.9134427 -0.0453206733,38.5968729 0.148184538,38.3998695 C0.150289256,38.3977268 0.152413239,38.395603 0.154556228,38.3934985 L16.9937789,21.8567812 C17.1908028,21.6632968 17.193672,21.3467273 17.0001876,21.1497035 C16.9980647,21.1475418 16.9959223,21.1453995 16.9937605,21.1432767 L0.15452076,4.60825197 C-0.0425130651,4.41477773 -0.0453986756,4.09820839 0.148075568,3.90117456 C0.150162624,3.89904911 0.152268631,3.89694235 0.154393339,3.89485454 Z"
                    fill="#FFFFFF"
                  ></path>
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

    <!-- Success alerts appear after the header -->
    <?php if ($login_success): ?>
    <div id="successAlert" class="alert">
      <i class="fas fa-check-circle"></i> Welcome back, <?php echo htmlspecialchars($user_name); ?>!
    </div>
    <?php endif; ?>
    
    <?php if ($registration_success): ?>
    <div id="registrationAlert" class="alert">
      <i class="fas fa-check-circle"></i> Registration successful! Welcome, <?php echo htmlspecialchars($user_name); ?>!
    </div>
    <?php endif; ?>

    <main>
      <section class="hero">
        <div class="hero-content">
          <h1>Fast. Reliable. Connected.</h1>
          <h2>Your Internet and Networking Experts</h2>
          <p>
            Providing cutting-edge ISP, WiFi, Fiber Optics, and Networking
            solutions for homes and businesses.
          </p>
          
        </div>
      </section>

      <section class="services-grid">
        <div class="service-card">
          <img
            src="https://placehold.co/600x400/4158d0/white?text=ISP+Services"
            class="service-icon"
            alt="Internet Services"
          />
          <h3>Internet Services</h3>
          <p>High-speed connectivity solutions tailored to your needs</p>
          <a href="service.html#isp" class="learn-more">Learn More →</a>
        </div>
        <div class="service-card">
          <img
            src="images/wifi.webp"
            class="service-icon"
            alt="WiFi Solutions"
          />
          <h3>WiFi Solutions</h3>
          <p>Professional WiFi setup and optimization services</p>
          <a href="service.html#wifi" class="learn-more">Learn More →</a>
        </div>
        <div class="service-card">
          <img
            src="images/fiber.webp"
            class="service-icon"
            alt="Fiber Optics"
          />
          <h3>Fiber Optics</h3>
          <p>Ultra-fast fiber optic installations and maintenance</p>
          <a href="service.html#fiber" class="learn-more">Learn More →</a>
        </div>
        <div class="service-card">
          <img
            src="images/network.webp"
            class="service-icon"
            alt="Networking"
          />
          <h3>Networking</h3>
          <p>Complete network management and security solutions</p>
          <a href="service.html#network" class="learn-more">Learn More →</a>
        </div>
      </section>

      <section class="promotions">
        <div class="promo-card">
          <h3>Limited Time Offer!</h3>
          <p>Get 3 months free with our Fiber Optics plan</p>
          <button class="cta-secondary">Learn More</button>
        </div>
        <div class="promo-card">
          <h3>New Customer Special</h3>
          <p>Free WiFi setup for new customers</p>
          <button class="cta-secondary">Get Started</button>
        </div>
      </section>

      <section class="testimonials">
        <h2>What Our Customers Say</h2>
        <div class="testimonial-grid">
          <div class="testimonial-card">
            <p>
              "Exceptional service and lightning-fast speeds. Highly
              recommended!"
            </p>
            <cite>- Rakesh Kumar., Business Owner</cite>
          </div>
          <div class="testimonial-card">
            <p>"The most reliable internet service I've ever had."</p>
            <cite>- Laxmi Das., Remote Worker</cite>
          </div>
        </div>
      </section>
    </main>

    <footer class="footer">
      <div class="footer-content">
        <!-- Company Information -->
        <div class="footer-section about">
          <div class="company-header">
            <img
              src="images/logo.jpeg"
              alt="R.S Computer Logo"
              class="footer-logo"
            />
            <h4>About R.S Computer</h4>
          </div>
          <p class="tagline">
            Your Trusted Provider of ISP, WiFi, Fiber Optics, and Networking
            Solutions.
          </p>
          <div class="contact-details">
            <div>
              <i class="fas fa-map-marker-alt"></i>123 Tech Lane, City, State,
              ZIP
            </div>
            <div><i class="fas fa-envelope"></i>contact@rscomputer.com</div>
            <div>
              <i class="fas fa-phone-alt"></i>1-800-123-4567 (24/7 Support)
            </div>
          </div>
        </div>

        <!-- Quick Links -->
        <div class="footer-section links">
          <h4>Quick Links</h4>
          <ul>
            <li>
              <i class="fas fa-chevron-right"></i><a href="indexloggedin.php">Home</a>
            </li>
            <li>
              <i class="fas fa-chevron-right"></i
              ><a href="about.html">About Us</a>
            </li>
            <li>
              <i class="fas fa-chevron-right"></i
              ><a href="services.html">Services</a>
            </li>
            <li>
              <i class="fas fa-chevron-right"></i
              ><a href="support.html">Support</a>
            </li>
            <li>
              <i class="fas fa-chevron-right"></i
              ><a href="contact.html">Contact Us</a>
            </li>
            <li>
              <i class="fas fa-chevron-right"></i
              ><a href="portal.html">Customer Login</a>
            </li>
          </ul>
        </div>

        <!-- Services -->
        <div class="footer-section services">
          <h4>Our Services</h4>
          <ul>
            <li>
              <i class="fas fa-network-wired"></i
              ><a href="service.html#isp">Internet Service Provider (ISP)</a>
            </li>
            <li>
              <i class="fas fa-wifi"></i
              ><a href="service.html#wifi">WiFi Solutions</a>
            </li>
            <li>
              <i class="fas fa-project-diagram"></i
              ><a href="service.html#fiber">Fiber Optics</a>
            </li>
            <li>
              <i class="fas fa-server"></i
              ><a href="service.html#networking">Networking</a>
            </li>
          </ul>
        </div>

        <!-- Connect -->
        <div class="footer-section connect">
          <h4>Stay Connected</h4>
          <div class="social-links">
            <a href="#" title="Follow us on Facebook" aria-label="Facebook"
              ><i class="fab fa-facebook-f"></i
            ></a>
            <a href="#" title="Follow us on Twitter" aria-label="Twitter"
              ><i class="fab fa-twitter"></i
            ></a>
            <a href="#" title="Connect on LinkedIn" aria-label="LinkedIn"
              ><i class="fab fa-linkedin-in"></i
            ></a>
            <a href="#" title="Follow us on Instagram" aria-label="Instagram"
              ><i class="fab fa-instagram"></i
            ></a>
          </div>
          
          <!-- Search Form -->
          <div class="search-form">
            <h5>Search Our Website</h5>
            <form action="search.php" method="get">
              <input type="text" name="query" placeholder="What are you looking for?" required>
              <button type="submit" class="btn-search">Search</button>
            </form>
          </div>
          
          <!-- Newsletter Subscription Form -->
          <div class="newsletter-form">
            <h5>Subscribe to our Newsletter</h5>
            <form action="subscribe.php" method="post">
              <input type="email" name="email" placeholder="Your Email" required>
              <button type="submit" class="btn-subscribe">Subscribe</button>
            </form>
            <style>
              .newsletter-form {
                margin-top: 20px;
                padding: 15px;
                background-color: rgba(255, 255, 255, 0.05);
                border-radius: 8px;
              }
              
              .newsletter-form h5 {
                margin-top: 0;
                margin-bottom: 10px;
                color: #ffca28;
                font-size: 16px;
              }
              
              .newsletter-form form {
                display: flex;
                flex-direction: column;
              }
              
              .newsletter-form input[type="email"] {
                padding: 10px;
                border: none;
                border-radius: 4px;
                background-color: rgba(255, 255, 255, 0.9);
                margin-bottom: 10px;
                font-size: 14px;
              }
              
              .btn-subscribe {
                padding: 8px 15px;
                background-color: #4158d0;
                color: white;
                border: none;
                border-radius: 4px;
                cursor: pointer;
                transition: background-color 0.3s;
                font-weight: 500;
              }
              
              .btn-subscribe:hover {
                background-color: #3247b3;
              }
              
              /* Search form styling */
              .search-form {
                margin-top: 20px;
                margin-bottom: 20px;
                padding: 15px;
                background-color: rgba(255, 255, 255, 0.05);
                border-radius: 8px;
              }
              
              .search-form h5 {
                margin-top: 0;
                margin-bottom: 10px;
                color: #ffca28;
                font-size: 16px;
              }
              
              .search-form form {
                display: flex;
                flex-direction: column;
              }
              
              .search-form input[type="text"] {
                padding: 10px;
                border: none;
                border-radius: 4px;
                background-color: rgba(255, 255, 255, 0.9);
                margin-bottom: 10px;
                font-size: 14px;
              }
              
              .btn-search {
                padding: 8px 15px;
                background-color: #4158d0;
                color: white;
                border: none;
                border-radius: 4px;
                cursor: pointer;
                transition: background-color 0.3s;
                font-weight: 500;
              }
              
              .btn-search:hover {
                background-color: #3247b3;
              }
              
              @media (max-width: 768px) {
                .newsletter-form, .search-form {
                  margin-top: 30px;
                }
              }
            </style>
          </div>
        </div>
      </div>

      <!-- Legal Section -->
      <div class="footer-bottom">
        <div class="legal-links">
          <a href="terms.html">Terms of Service</a>
          <a href="privacy.html">Privacy Policy</a>
          <a href="cookies.html">Cookie Policy</a>
        </div>
        <div class="copyright">
          <p>&copy; 2024 R.S Computer. All Rights Reserved.</p>
        </div>
      </div>
    </footer>

    <script src="script.js"></script>
    <script>
      // Show login alert with animation
      document.addEventListener('DOMContentLoaded', function() {
        const successAlert = document.getElementById('successAlert');
        const registrationAlert = document.getElementById('registrationAlert');
        
        if (successAlert) {
          setTimeout(function() {
            successAlert.classList.add('show');
          }, 300);
          
          setTimeout(function() {
            successAlert.classList.remove('show');
            setTimeout(function() {
              successAlert.remove();
            }, 500);
          }, 5000);
        }

        if (registrationAlert) {
          setTimeout(function() {
            registrationAlert.classList.add('show');
          }, 300);
          
          setTimeout(function() {
            registrationAlert.classList.remove('show');
            setTimeout(function() {
              registrationAlert.remove();
            }, 500);
          }, 5000);
        }

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