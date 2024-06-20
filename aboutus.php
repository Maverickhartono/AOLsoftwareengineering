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
            background-color: #D2B48C; /* Latar belakang cokelat */
            color: #333;
        }

        header {
            background-color: #6B4F4F;
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
            color: white;
            padding: 40px;
            margin-bottom: 50px;
            font-size: 1.2em; /* Ukuran font diperbesar */
        }

        .background-section h2 {
            margin-top: 0;
            font-weight: 700;
        }

        .agents {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 20px;
        }

        .agent-card {
            background-color: white;
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
        }

        .agent-card p {
            margin: 5px 0;
            color: #6B4F4F;
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
        <h1>CTFPoint</h1>
        <div class="navbar">
            <a href="#">Events</a>
            <a href="#">WriteUps</a>
            <a href="#">About Us</a>
            <a href="#">Contact</a>
        </div>
    </header>
    <main>
        <div class="background-section">
            <h2>Background</h2>
            <p>Formed by 5 students with a high interest in CTF. Knowing the many shortcomings & difficulties while exploring this field, we created a platform that is expected to make it easier for CTF players to forge their knowledge with minimal obstacles. The platform is called CTFPoint.</p>
        </div>
        <h2>The Agents</h2>
        <div class="agents">
            <div class="agent-card">
                <img src="./assets/pc.gif" alt="Agent 1">
                <h3>Jeffrey Jingga</h3>
                <p>Cyber Security Student in Bina Nusantara University, have high interest in CTF & Penetration Testing</p>
                <p>Cyber Security Student</p>
            </div>
            <div class="agent-card">
                <img src="./assets/tbg.gif" alt="Agent 2">
                <h3>Pitra Winarianto</h3>
                <p>Cyber Security Student in Bina Nusantara University, have high interest in CTF & Penetration Testing</p>
                <p>Cyber Security Student</p>
            </div>
            <div class="agent-card">
                <img src="./assets/jmp.gif" alt="Agent 3">
                <h3>Nicolas Saputra G</h3>
                <p>Cyber Security Student in Bina Nusantara University, have high interest in CTF & Penetration Testing</p>
                <p>Cyber Security Student</p>
            </div>
            <div class="agent-card">
                <img src="./assets/dip.gif" alt="Agent 4">
                <h3>Divodas Omar F</h3>
                <p>Cyber Security Student in Bina Nusantara University, have high interest in CTF & Penetration Testing</p>
                <p>Cyber Security Student</p>
            </div>
            <div class="agent-card">
                <img src="./assets/run.gif" alt="Agent 5">
                <h3>Bertrand Redondo M</h3>
                <p>Cyber Security Student in Bina Nusantara University, have high interest in CTF & Penetration Testing</p>
                <p>Cyber Security Student</p>
            </div>
        </div>
    </main>
</body>
</html>
