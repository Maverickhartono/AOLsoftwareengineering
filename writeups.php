<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit;
}

if (!isset($_SESSION['token'])) {
    $_SESSION['token'] = bin2hex(random_bytes(32));
}
$csrf_token = $_SESSION['token'];

$conn = new mysqli("localhost", "root", "", "test");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$username = $_SESSION['username'];
$sql = "SELECT role FROM register WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$stmt->bind_result($role);
$stmt->fetch();
$stmt->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>picoCTF-like Web</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-image: url('./assets/city-katanya.png');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            margin: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        header {
            background-color: #5A3E30;
            color: #fff;
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        header h1 {
            margin: 0;
        }

        header .add-button {
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #A0522D;
            color: white;
            border: none;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            font-size: 24px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        header .add-button:hover {
            background-color: #8B4513;
        }

        main {
            flex: 1;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .challenges-container {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            justify-content: space-between;
        }

        .challenge {
            flex: 0 1 calc(50% - 10px);
            display: flex;
            flex-direction: column;
            padding: 15px;
            background-color: rgba(255, 255, 255, 0.9);
            border: 1px solid #ddd;
            border-radius: 10px;
            box-sizing: border-box;
        }

        .challenge h3 {
            margin: 0;
            margin-bottom: 10px;
        }

        .challenge p {
            margin: 0 0 10px;
        }

        .challenge button {
            align-self: flex-start;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .challenge button:hover {
            background-color: #45a049;
        }

        .admin-buttons {
            display: flex;
            gap: 10px;
            margin-top: 10px;
        }

        .pagination {
            text-align: center;
            margin-top: 20px;
        }

        .pagination a {
            margin: 0 5px;
            padding: 10px 15px;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .pagination a:hover {
            background-color: #45a049;
        }

        .pagination a.active {
            background-color: #45a049;
            pointer-events: none;
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
            padding-top: 60px;
        }

        .modal-content {
            background-color: rgba(255, 255, 255, 0.9);
            margin: 5% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 600px;
            border-radius: 10px;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <header>
        <h1>CTF CONQUEST</h1>
        <?php if ($role === 'admin') { ?>
            <button class="add-button" onclick="location.href='addwriteup.php?token=<?php echo $csrf_token; ?>'">+</button>
        <?php } ?>
    </header>
    <main>
        <div class="challenges-container" id="challenges-container">
            <?php
            $conn = new mysqli("localhost", "root", "", "test");
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $sql = "SELECT * FROM `writeup`";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='challenge'>";
                    echo "<h3>{$row['title']}</h3>";
                    echo "<p>{$row['description']}</p>";
                    echo "<div class='admin-buttons'>";
                    echo "<button onclick=\"showDetail('{$row['title']}', '{$row['author']}', '{$row['description']}')\">Detail</button>";
                    if ($role === 'admin') {
                        echo "<button onclick=\"location.href='updatewriteup.php?id={$row['id']}&token={$csrf_token}'\">Update</button>";
                        echo "<button onclick=\"location.href='deletewriteup.php?id={$row['id']}&token={$csrf_token}'\">Delete</button>";
                    }
                    echo "</div>";
                    echo "</div>";
                }
            } else {
                echo "<p>No challenges found</p>";
            }
            $conn->close();
            ?>
        </div>
        <div class="pagination" id="pagination"></div>
    </main>

    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <h2 id="modalTitle"></h2>
            <p><strong>Author: </strong><span id="modalAuthor"></span></p>
            <p id="modalDescription"></p>
        </div>
    </div>

    <script>
        function showDetail(title, author, description) {
            document.getElementById('modalTitle').innerText = title;
            document.getElementById('modalAuthor').innerText = author;
            document.getElementById('modalDescription').innerText = description;
            document.getElementById('myModal').style.display = 'block';
        }

        function closeModal() {
            document.getElementById('myModal').style.display = 'none';
        }

        window.onclick = function(event) {
            if (event.target == document.getElementById('myModal')) {
                closeModal();
            }
        }
    </script>
</body>
</html>
