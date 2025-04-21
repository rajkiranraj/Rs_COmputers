<?php
session_start();

// Check if user is logged in
$is_logged_in = isset($_SESSION["user_id"]);
$user_name = $is_logged_in ? $_SESSION["user_name"] : '';

// Process search query
$query = isset($_GET['query']) ? trim($_GET['query']) : '';

// Define searchable content - in a real application, this would come from a database
$searchable_content = [
    [
        'title' => 'Internet Services (ISP)',
        'description' => 'High-speed internet solutions for homes and businesses with reliable connectivity.',
        'url' => 'service.html#isp',
        'keywords' => ['internet', 'isp', 'broadband', 'speed', 'connectivity']
    ],
    [
        'title' => 'Network Management',
        'description' => 'Professional network setup, maintenance, and security solutions.',
        'url' => 'service.html#network',
        'keywords' => ['network', 'lan', 'wan', 'management', 'security', 'setup']
    ],
    [
        'title' => 'Fiber Optic Solutions',
        'description' => 'Ultra-fast fiber optic installations and maintenance for the best internet experience.',
        'url' => 'service.html#fiber',
        'keywords' => ['fiber', 'optic', 'fast', 'installation', 'cable']
    ],
    [
        'title' => 'Wi-Fi Installation',
        'description' => 'Expert WiFi setup, optimization, and troubleshooting services.',
        'url' => 'service.html#wifi',
        'keywords' => ['wifi', 'wireless', 'router', 'setup', 'range', 'signal']
    ],
    [
        'title' => 'About Us',
        'description' => 'Learn about R.S. Computers and our mission to provide excellent service.',
        'url' => 'about.html',
        'keywords' => ['about', 'company', 'mission', 'history', 'team']
    ],
    [
        'title' => 'Technical Support',
        'description' => 'Get help with technical issues and support for our services.',
        'url' => 'support.html',
        'keywords' => ['support', 'help', 'technical', 'trouble', 'issue', 'fix']
    ],
    [
        'title' => 'Contact Us',
        'description' => 'Get in touch with our team for inquiries and assistance.',
        'url' => 'letstalk.html',
        'keywords' => ['contact', 'inquiry', 'help', 'call', 'email', 'message']
    ]
];

// Perform search
$results = [];
if ($query) {
    foreach ($searchable_content as $content) {
        // Search in title, description and keywords
        if (stripos($content['title'], $query) !== false || 
            stripos($content['description'], $query) !== false ||
            in_array(strtolower($query), array_map('strtolower', $content['keywords']))) {
            $results[] = $content;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Search Results - R.S. Computers</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=home" />
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@700&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500;700&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <style>
        /* Search results styling */
        .search-container {
            max-width: 1200px;
            margin: 40px auto;
            padding: 0 20px;
        }
        
        .search-header {
            margin-bottom: 30px;
            text-align: center;
        }
        
        .search-header h1 {
            color: #4158d0;
            margin-bottom: 10px;
        }
        
        .search-form-top {
            max-width: 600px;
            margin: 20px auto;
            display: flex;
        }
        
        .search-form-top input[type="text"] {
            flex: 1;
            padding: 12px 15px;
            border: 2px solid #ddd;
            border-radius: 4px 0 0 4px;
            font-size: 16px;
        }
        
        .search-form-top button {
            padding: 12px 20px;
            background-color: #4158d0;
            color: white;
            border: none;
            border-radius: 0 4px 4px 0;
            cursor: pointer;
            font-weight: 500;
        }
        
        .results-info {
            margin-bottom: 20px;
            color: #666;
        }
        
        .search-results {
            display: grid;
            gap: 20px;
        }
        
        .result-card {
            background-color: #fff;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        
        .result-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
        }
        
        .result-card h3 {
            color: #4158d0;
            margin-top: 0;
            margin-bottom: 10px;
        }
        
        .result-card p {
            color: #666;
            margin-bottom: 15px;
        }
        
        .result-card a {
            display: inline-block;
            color: #4158d0;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s;
        }
        
        .result-card a:hover {
            color: #3247b3;
            text-decoration: underline;
        }
        
        .no-results {
            text-align: center;
            padding: 40px 0;
            color: #666;
        }
        
        .no-results i {
            font-size: 48px;
            color: #ddd;
            margin-bottom: 15px;
        }
        
        @media (min-width: 768px) {
            .search-results {
                grid-template-columns: repeat(2, 1fr);
            }
        }
        
        /* User profile menu styles (copy from indexloggedin.php) */
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
            background-color: rgba(40, 44, 52, 0.85);
            backdrop-filter: blur(8px);
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
                <a href="<?php echo $is_logged_in ? 'indexloggedin.php' : 'index.html'; ?>" id="home">
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
                
                <?php if ($is_logged_in): ?>
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
                <?php else: ?>
                <a href="portal.html">Login</a>
                <?php endif; ?>
            </div>
        </div>
    </header>

    <main>
        <div class="search-container">
            <div class="search-header">
                <h1>Search Results</h1>
                
                <form class="search-form-top" action="search.php" method="get">
                    <input type="text" name="query" value="<?php echo htmlspecialchars($query); ?>" placeholder="Search for services, support, etc." required>
                    <button type="submit"><i class="fas fa-search"></i> Search</button>
                </form>
            </div>
            
            <?php if ($query): ?>
                <div class="results-info">
                    <p>
                        <?php 
                        $count = count($results);
                        echo "Found " . $count . " " . ($count == 1 ? "result" : "results") . " for '" . htmlspecialchars($query) . "'";
                        ?>
                    </p>
                </div>
                
                <?php if (!empty($results)): ?>
                    <div class="search-results">
                        <?php foreach ($results as $result): ?>
                            <div class="result-card">
                                <h3><?php echo htmlspecialchars($result['title']); ?></h3>
                                <p><?php echo htmlspecialchars($result['description']); ?></p>
                                <a href="<?php echo htmlspecialchars($result['url']); ?>">View Details <i class="fas fa-arrow-right"></i></a>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <div class="no-results">
                        <i class="fas fa-search"></i>
                        <h3>No results found</h3>
                        <p>We couldn't find any content matching your search query. Please try different keywords.</p>
                    </div>
                <?php endif; ?>
            <?php else: ?>
                <div class="no-results">
                    <i class="fas fa-search"></i>
                    <h3>Enter a search term</h3>
                    <p>Please enter keywords in the search box above to find content.</p>
                </div>
            <?php endif; ?>
        </div>
    </main>

    <footer class="footer">
        <!-- Footer content - you can copy from indexloggedin.php -->
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

            <!-- Quick Links -->
            <div class="footer-section links">
                <h4>Quick Links</h4>
                <ul>
                    <li><i class="fas fa-chevron-right"></i><a href="<?php echo $is_logged_in ? 'indexloggedin.php' : 'index.html'; ?>">Home</a></li>
                    <li><i class="fas fa-chevron-right"></i><a href="about.html">About Us</a></li>
                    <li><i class="fas fa-chevron-right"></i><a href="service.html">Services</a></li>
                    <li><i class="fas fa-chevron-right"></i><a href="support.html">Support</a></li>
                    <li><i class="fas fa-chevron-right"></i><a href="letstalk.html">Contact Us</a></li>
                    <li><i class="fas fa-chevron-right"></i><a href="portal.html">Customer Login</a></li>
                </ul>
            </div>

            <!-- Footer content continues... -->
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
        // Toggle profile dropdown if user is logged in
        document.addEventListener('DOMContentLoaded', function() {
            const userWelcome = document.getElementById('userWelcome');
            const profileDropdown = document.getElementById('profileDropdown');
            
            if (userWelcome && profileDropdown) {
                userWelcome.addEventListener('click', function() {
                    profileDropdown.style.display = profileDropdown.style.display === 'block' ? 'none' : 'block';
                });

                // Close dropdown when clicking outside
                document.addEventListener('click', function(event) {
                    if (!userWelcome.contains(event.target) && !profileDropdown.contains(event.target)) {
                        profileDropdown.style.display = 'none';
                    }
                });
            }
        });
    </script>
</body>
</html>
