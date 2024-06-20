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
            padding: 20px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .header {
            width: 100%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        table {
            border-collapse: collapse;
            width: 80%;
            background-color: rgba(173, 216, 230, 0.8); /* Light blue with transparency */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            animation: fadeIn 1s ease-in-out;
        }
        th, td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: rgba(173, 216, 230, 0.8); /* Light blue with transparency */
            color: #333;
            text-align: left;
            padding: 15px 10px;
            border-bottom: 2px solid #dee2e6;
        }
        tr:nth-child(even) {
            background-color: rgba(173, 216, 230, 0.6); /* Light blue with more transparency */
        }
        tr:hover {
            background-color: rgba(173, 216, 230, 0.9); /* Light blue with less transparency */
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
        .add-data, .logout {
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
            margin-bottom: 20px;
        }
        .add-data:hover, .logout:hover {
            background-color: #0056b3;
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
    <?php if ($role == 'admin') { ?>
    <a class="add-data" href="./insert.php">Tambah Data</a>
    <?php } ?>
    <a class="logout" href="logout.php">Log Out</a>
</div>
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
</body>
</html>
