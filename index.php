<?php
session_start();
include "db.php";

$errorMessage = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if (!empty($username) && !empty($password)) {

        $stmt = $conn->prepare("SELECT password FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $row = $result->fetch_assoc();
            if (password_verify($password, $row['password'])) {
                $_SESSION['username'] = $username;
                header("Location: dashboard.php");
                exit();
            } else {
                $errorMessage = "Invalid username or password";
            }
        } else {
            $errorMessage = "Invalid username or password";
        }

        $stmt->close();
    } else {
        $errorMessage = "Please fill in all fields";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <script src="https://kit.fontawesome.com/aa6d55bc68.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="prep.css">
    <link rel="stylesheet" href="index-style.css">
    <link rel="stylesheet" href="media-query-mobile.css">
    <link rel="stylesheet" href="media-query-tablet.css">
    <link rel="stylesheet" href="media-query-desktop.css">
    <link rel="stylesheet" href="media-mobile-landscape.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com"/>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet"/>
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
    <link rel="stylesheet" href="login-form.css">
</head>
<body>
    <div class="modal-overlay" id="modal">
        <div class="wrapper">
            <div class="closeButton" id="closeModalBtn">
                <img src="images/close.png" height="20px" width="20px">
            </div>
            <div class="title-text">
                <div class="title login">Visitor Login</div>
                <div class="title signup">Admin Login</div>
            </div>
            <div class="form-container">
                <div class="slide-controls">
                <input type="radio" name="slide" id="login" checked>
                <input type="radio" name="slide" id="signup">
                <label for="login" class="slide login">Visitor</label>
                <label for="signup" class="slide signup">Admin</label>
                <div class="slider-tab"></div>
                </div>
                <div class="form-inner">
                <form action="login.php" method="POST" autocomplete="off" class="visitorLogin">
                    <div class="field">
                        <input type="text" id="loginUsername" name="username" placeholder="Username" value="<?php echo isset($username) ? htmlspecialchars($username) : ''; ?>" required>
                    </div>
                    <div class="field">
                        <input type="password" name="password" id="loginPassword" placeholder="Password" required>
                    </div>

                    <div class="error" style="min-height:20px;">
                        <?php echo !empty($errorMessage) ? $errorMessage : ''; ?>
                    </div>

                    <div class="pass-link"><a href="#">Forgot password?</a></div>
                    <div class="field btn">
                        <div class="btn-layer"></div>
                        <input type="submit" value="Login">
                    </div>
                    <div class="signup-link">Not register yet? <a href="">Signup now</a></div>
                </form>

                <form action="login.php" method="POST" autocomplete="off" class="adminLogin">
                    <div class="field">
                        <input type="text" name="username" placeholder="Username" value="<?php echo isset($username) ? htmlspecialchars($username) : ''; ?>" required>
                    </div>
                    <div class="field">
                        <input type="password" name="password" id="loginPassword" placeholder="Password" required>
                    </div>

                    <div class="error" style="min-height:20px;">
                        <?php echo !empty($errorMessage) ? $errorMessage : ''; ?>
                    </div>

                    <div class="pass-link"><a href="#">Forgot password?</a></div>
                    <div class="field btn">
                        <div class="btn-layer"></div>
                        <input type="submit" value="Log In">
                    </div>
                    <div class="signup-link">Not register yet? <a href="">Signup now</a></div>
                </form>
                </div>
            </div>
        </div>
    </div>

    <!--Header content goes here...-->
    <header class="head-container">
        <a href="#main-route" class="logo">
            <img src="images/handcuffs.png">
            <span class="logo-text">Jail Management System</span>
        </a>

        <div class="head-links">
            <ul>
                <li><a href="#main-route">Home</a></li>
                <li><a href="#event-route">Events</a></li>
                <li><a href="#about-route">About Us</a></li>
                <li><a href="#contanct-route">Contacts</a></li>
            </ul>
        </div>
    </header>

    <!--Main content goes here...-->
    <main class="main-container">
        <div class="hero-container" id="main-route">
            <div class="hero-title">
                <h1>Jail Management System</h1>
            </div>
            <div class="hero-content">
                <h3>Streamline inmate tracking, enhance security protocols, and optimize daily operations with our reliable and user-friendly jail management platform.</h3>
            </div>

            <div class="button-container">
                <div class="hero-button">
                    <button class="button" id="openModalBtn">Log In</button>
                </div>
            </div>

        </div>

        <div class="events-container" id="event-route">
            <div class="events-title">
                <h1>Events</h1>
            </div>
            <div class="events-content">
                <div class="event-selector">
                    <a href="#current">Current</a>
                    <a href="#upcoming">Upcoming</a>
                    <a href="#ended">Ended</a>
                </div>

                <div class="event-wrapper-container">
                    <div class="event-title"><a href="#">CURRENT EVENTS</a></div>
                    <div class="cards-1" id="current">
                        <div class="cards">Event Data...</div>
                        <div class="cards">Event Data...</div>
                        <div class="cards">Event Data...</div>
                        <div class="cards">Event Data...</div>
                        <div class="cards">Event Data...</div>
                        <div class="cards">Event Data...</div>
                        <div class="cards">Event Data...</div>
                        <div class="cards">Event Data...</div>
                    </div>
                    <div class="event-title"><a href="#">CURRENT EVENTS</a></div>
                    <div class="cards-1" id="upcoming">
                        <div class="cards">Event Data...</div>
                        <div class="cards">Event Data...</div>
                        <div class="cards">Event Data...</div>
                        <div class="cards">Event Data...</div>
                        <div class="cards">Event Data...</div>
                        <div class="cards">Event Data...</div>
                        <div class="cards">Event Data...</div>
                        <div class="cards">Event Data...</div>
                    </div>
                    <div class="event-title"><a href="#">CURRENT EVENTS</a></div>
                    <div class="cards-1" id="ended">
                        <div class="cards">Event Data...</div>
                        <div class="cards">Event Data...</div>
                        <div class="cards">Event Data...</div>
                        <div class="cards">Event Data...</div>
                        <div class="cards">Event Data...</div>
                        <div class="cards">Event Data...</div>
                        <div class="cards">Event Data...</div>
                        <div class="cards">Event Data...</div>
                    </div>
                </div>

            </div>
        </div>

        <!--about us-->
        <div class="about-us" id="about-route">
            <div class="about-us-bg">
                <div class="about-title">About Us</div>
                    <div class="about-us-content">
                        As a leading innovator in correctional technology, our Jail Management System is dedicated to enhancing the safety and efficiency of detention facilities. We provide a comprehensive, user-friendly platform that streamlines inmate tracking, automates administrative tasks, and improves communication between staff. Our mission is to empower correctional officers with the tools they need to maintain order and focus on their critical duties. We are committed to delivering reliable, secure, and intuitive solutions that modernize jail operations and ensure compliance with all regulatory standards.
                    </div>
            </div>
        </div>

         <!----->
         <div class="contacts" id="contanct-route">
            <div class="container2">
                <div class="contact-wrapper">
                    <div class="contact-left-right">
                        <h1>Contact Us</h1>
                        <div class="contact-num">
                            <p><i class="fa-solid fa-paper-plane"></i><span>dion.areglo1234@gmail.com</span></p>
                            <p><i class="fa-solid fa-phone"></i><span>09621107472</span></p>
                        </div>
                        <div class="social-icons">
                            <a href="https://web.facebook.com/dion.areglo.1"><i class="fa-brands fa-facebook"></i></a>
                            <a href="#"><i class="fa-brands fa-twitter-square"></i></a>
                            <a href="#"><i class="fa-brands fa-instagram"></i></a>
                            <a href="https://github.com/thehonored1ne"><i class="fa-brands fa-github"></i></a>
                        </div>
                    </div>
                    <div class="contact-left-right">
                        <form name="submit-to-google-sheet" action="https://script.google.com/macros/s/AKfycbxZ_fcLj-MEA7YKG6J9FlMbw4hiDMEa2rXDbnF5CtvYZNew8KcZijG-brMP2qETZVrp/exec" method="post">
                            <input type="text" name="Name" placeholder="Your Name" required>
                            <input type="email" name="Email" placeholder="Your Email" required>
                            <input type="text" name="Contact" placeholder="Your Contact Number" required>
                            <textarea name="Message" rows="6" placeholder="Your Message"></textarea>
                            <input type="hidden" id="timestamp" name="timestamp">
                            <button type="submit" class="contact-btn"><p>SUBMIT</p></button>
                        </form>
                        <span id="msg"></span>
                    </div>

                </div>
            </div>
         </div>
    </main>

    <script src="homepage.js"></script>
</body>
</html>