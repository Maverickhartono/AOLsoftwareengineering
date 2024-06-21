<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Data</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-image: url('./assets/8351163.gif');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            height: 100vh;
        }
        .header {
            width: 100%;
            background-color: #00a99d;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            position: fixed;
            top: 0;
            z-index: 1000;
        }
        .header h1 {
            color: white;
            font-size: 24px;
            margin: 0;
        }
        .nav-links a {
            color: white;
            text-decoration: none;
            margin-left: 20px;
            font-size: 16px;
        }
        .nav-links a:hover {
            text-decoration: underline;
        }
        .content {
            padding: 20px;
            margin-top: 80px; /* Adjust this value based on the height of your header */
            width: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }
        table {
            border-collapse: collapse;
            width: 80%;
            background-color: rgba(173, 216, 230, 0.8);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            animation: fadeIn 1s ease-in-out;
            margin-top: 20px;
        }
        th, td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: rgba(173, 216, 230, 0.8);
            color: #333;
            text-align: left;
            padding: 15px 10px;
            border-bottom: 2px solid #dee2e6;
        }
        tr:nth-child(even) {
            background-color: rgba(173, 216, 230, 0.6);
        }
        tr:hover {
            background-color: rgba(173, 216, 230, 0.9);
        }
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        .add-data {
            position: fixed;
            right: 20px;
            bottom: 20px;
            background-color: #28a745;
            color: white;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 24px;
            cursor: pointer;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: background-color 0.3s ease;
        }
        .add-data:hover {
            background-color: #218838;
        }
        .action-links a {
            margin-right: 10px;
            text-decoration: none;
            color: #007bff;
            transition: color 0.3s ease;
        }
        .action-links a:hover {
            color: #0056b3;
        }
    </style>
</head>
<body>
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
    
    <div class="header">
        <h1>Flag Conquest</h1>
        <div class="nav-links">
            <a href="index.php">Home</a>
            <a href="writeups.php">WriteUps</a>
            <a href="add_article.php">Article</a>
        </div>
    </div>

    <div class="content">
        <table>
            <tr>
                <th>NAMA</th>
                <th>DATE</th>
                <th>FORMAT</th>
                <th>LOCATION</th>
                <th>NOTES</th>
                <?php if ($role == 'admin') { ?>
                    <th>Action</th>
                <?php } ?>
            </tr>
            <?php 
            $sql = "SELECT * FROM `woi`";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row["nama"]); ?></td>
                        <td><?php echo htmlspecialchars($row["datee"]); ?></td>
                        <td><?php echo htmlspecialchars($row["format"]); ?></td>
                        <td><?php echo htmlspecialchars($row["location"]); ?></td>
                        <td><?php echo htmlspecialchars($row["notes"]); ?></td>
                        <?php if ($role == 'admin') { ?>
                            <td class="action-links">
                                <a href="update.php?id=<?php echo htmlspecialchars($row['id']); ?>&token=<?php echo $csrf_token; ?>">Update</a>
                                <a href="delete.php?id=<?php echo htmlspecialchars($row['id']); ?>&token=<?php echo $csrf_token; ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');">Hapus</a>
                            </td>
                        <?php } ?>
                    </tr>
                <?php }
            } else {
                echo "<tr><td colspan='7'>No data found</td></tr>";
            }
            $conn->close();
            ?>
        </table>

        <?php if ($role == 'admin') { ?>
        <div class="add-data" onclick="window.location.href='./insert.php'">+</div>
        <?php } ?>
    </div>
</body>
</html>
