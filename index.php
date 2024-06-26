<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FlagConquest</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <style>
        .navbar {
            background-color: #FF5733; /* Orange color */
        }

        .dropdown-menu {
            background-color: #FF5733; /* Orange color */
        }

        .dropdown-item {
            color: #FFFFFF; /* White color */
        }

        .dropdown-item:hover {
            background-color: #FFC300; /* Yellow color */
        }

        .content-section {
            padding: 50px;
            color: #FFFFFF; /* White color */
            animation: fadeInUp 1s ease;
            border-radius: 10px;
            box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.1);
        }

        .content-title {
            font-size: 32px;
            font-weight: bold;
            margin-bottom: 20px;
            color: #FFFFFF; /* White color */
        }

        .content-text {
            font-size: 18px;
            line-height: 1.6;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(50px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .contact-card {
            background-color: #FF5733; /* Orange color */
            color: #FFFFFF; /* White color */
            border: none;
            animation: fadeInLeft 1s ease;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.1);
        }

        .contact-card-title {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
            color: #FFFFFF; /* White color */
        }

        .contact-card-text {
            font-size: 16px;
            line-height: 1.6;
            color: #FFFFFF; /* White color */
        }

        @keyframes fadeInLeft {
            from {
                opacity: 0;
                transform: translateX(-50px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        body {
            background-image: url('./assets/pixel-art-gif-Captivating-Pixel-Art-Scenes.gif');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
        }
    </style>
</head>
<body>
    <?php 
        session_start(); 
        $loggedIn = isset($_SESSION['loggedin']);
    ?>
    <nav class="navbar navbar-expand-lg navbar-dark shadow-sm fixed-top navbar-transparent">
        <div class="container">
            <a class="navbar-brand fw-bolder" href="#home">FlagConquest</a> 
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="./main.php">Events</a> 
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./writeups.php">WriteUps</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./add_article.php">Articles</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./aboutus.php">About us</a>
                    </li>
                    <?php if ($loggedIn): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="./logout.php">Log out</a>
                    </li>
                    <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link" href="./login.php">Log in</a>
                    </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <!-- konten -->
    <div class="content-section mt-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 text-center">
                    <div class="content-title mb-4">Welcome to FlagConquest</div>
                    <div class="content-text">
                        <p><strong>About FlagConquest</strong></p>
                        <p>FlagConquest is an online platform dedicated to organizing Capture The Flag (CTF) events for cybersecurity enthusiasts, students, and professionals.</p>
                        <p><strong>Our Mission</strong></p>
                        <p>Our mission is to provide an engaging and educational experience for participants to enhance their skills in cybersecurity, penetration testing, and digital forensics.</p>
                        <p><strong>Who We Serve</strong></p>
                        <p>Whether you are a beginner looking to learn new techniques or an experienced professional seeking to challenge your expertise, FlagConquest offers a variety of CTF events suited to your level of expertise.</p>
                        <p><strong>Join Us</strong></p>
                        <p>Join us in our upcoming events, connect with like-minded individuals, and embark on a journey of continuous learning and improvement in the field of cybersecurity.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- bagian kontak -->
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card contact-card">
                    <div class="card-body">
                        <h5 class="card-title contact-card-title">Contact Us</h5>
                        <p class="card-text contact-card-text">For inquiries and support, you can reach us through:</p>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                <i class="bi bi-discord"></i> Discord: FlagConquest#1234
                            </li>
                            <li class="list-group-item">
                                <i class="bi bi-whatsapp"></i> WhatsApp: +1234567890
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>
</body>
</html>
