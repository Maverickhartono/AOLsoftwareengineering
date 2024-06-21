<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CTFPoint</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            background: url('./assets/932df101bb5e217beb4aa0532e138c99.gif') no-repeat center center fixed;
            background-size: cover;
            color: #333;
        }

        header {
            background-color: #00CED1; /* Dark turquoise */
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: white;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        header h1 {
            margin: 0;
            font-weight: 700;
        }

        .navbar a {
            color: white;
            text-decoration: none;
            margin-left: 20px;
            transition: color 0.3s ease;
            font-weight: 500;
        }

        .navbar a:hover {
            color: #FFD700;
        }

        main {
            text-align: center;
            padding: 50px 20px;
        }

        .background-section {
            color: black; /* Ubah teks menjadi hitam */
            padding: 40px;
            margin-bottom: 50px;
            font-size: 1.5em; /* Perbesar ukuran font */
        }

        .background-section h2 {
            margin-top: 0;
            font-weight: 700;
            font-size: 2em; /* Perbesar ukuran font */
        }

        .agents {
            display: flex;
            justify-content: center;
            gap: 20px;
            flex-wrap: nowrap;
            overflow-x: auto;
        }

        .agent-card {
            background-color: rgba(0, 206, 209, 0.7); /* Dark turquoise transparan */
            border-radius: 10px;
            padding: 20px;
            width: calc(20% - 40px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            text-align: left;
        }

        .agent-card img {
            width: 100%;
            border-radius: 10px;
        }

        .agent-card h3 {
            margin: 10px 0 5px;
            font-weight: 700;
            color: black; /* Ubah teks menjadi hitam */
        }

        .agent-card p {
            margin: 5px 0;
            color: black; /* Ubah teks menjadi hitam */
        }

        .agent-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        @media (max-width: 1200px) {
            .agent-card {
                width: calc(33% - 40px);
            }
        }

        @media (max-width: 800px) {
            .agent-card {
                width: calc(50% - 40px);
            }
        }

        @media (max-width: 600px) {
            .agent-card {
                width: calc(100% - 40px);
            }
        }
    </style>
</head>
<body>
    <header>
        <h1>Flag Conquest</h1>
        <div class="navbar">
            <a href="./main.php">Events</a>
            <a href="./writeups.php">WriteUps</a>
            <a href="./add_article.php">Article</a>
            <a href="./index.php">Home</a>
        </div>
    </header>
    <main>
        <div class="background-section">
            <h2>Background</h2>
            <p>Formed by 5 students with a high interest in CTF. Knowing the many shortcomings & difficulties while exploring this field, we created a platform that is expected to make it easier for CTF players to forge their knowledge with minimal obstacles. The platform is called Flag Conquest.</p>
        </div>
        <h2>The Agents</h2>
        <div class="agents">
            <div class="agent-card">
                <img src="./assets/pc.gif" alt="Agent 1">
                <h3>I gusti agung</h3>
                <p>Cyber Security Student in Bina Nusantara University, have high interest in CTF & Penetration Testing</p>
                <p>Cyber Security Student</p>
            </div>
            <div class="agent-card">
                <img src="./assets/tbg.gif" alt="Agent 2">
                <h3>ryan rahmat</h3>
                <p>Cyber Security Student in Bina Nusantara University, have high interest in CTF & Penetration Testing</p>
                <p>Cyber Security Student</p>
            </div>
            <div class="agent-card">
                <img src="./assets/jmp.gif" alt="Agent 3">
                <h3>Thomas</h3>
                <p>Cyber Security Student in Bina Nusantara University, have high interest in CTF & Penetration Testing</p>
                <p>Cyber Security Student</p>
            </div>
            <div class="agent-card">
                <img src="./assets/dip.gif" alt="Agent 4">
                <h3>Maverick Hartono</h3>
                <p>Cyber Security Student in Bina Nusantara University, have high interest in CTF & Penetration Testing</p>
                <p>Cyber Security Student</p>
            </div>
            <div class="agent-card">
                <img src="./assets/run.gif" alt="Agent 5">
                <h3>Matthew Hartono</h3>
                <p>Cyber Security Student in Bina Nusantara University, have high interest in CTF & Penetration Testing</p>
                <p>Cyber Security Student</p>
            </div>
        </div>
    </main>
</body>
</html>
