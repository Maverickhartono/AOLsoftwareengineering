<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Data</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 20px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        table {
            border-collapse: collapse;
            width: 80%;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            overflow: hidden;
            animation: fadeIn 1s ease-in-out;
        }
        th, td {
            padding: 12px 15px;
            text-align: left;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #ddd;
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
            margin-bottom: 20px;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }
        .add-data:hover {
            background-color: #45a049;
        }
        .action-links a {
            margin-right: 10px;
            text-decoration: none;
            color: #007BFF;
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
    if (!isset($_SESSION['token'])) {
        $_SESSION['token'] = bin2hex(random_bytes(32));
    }
    $csrf_token = $_SESSION['token'];
    ?>
    <a class="add-data" href="./insert.php">Tambah Data</a>
    <table>
        <tr>
            <th>ID</th>
            <th>NAMA</th>
            <th>DATE</th>
            <th>FORMAT</th>
            <th>LOCATION</th>
            <th>NOTES</th>
            <th>Action</th>
        </tr>
        <?php 
        $conn = new mysqli("localhost", "root", "", "test"); 
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT * FROM `woi`";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo htmlspecialchars($row["id"]); ?></td>
                    <td><?php echo htmlspecialchars($row["nama"]); ?></td>
                    <td><?php echo htmlspecialchars($row["tanggal"]); ?></td>
                    <td><?php echo htmlspecialchars($row["email"]); ?></td>
                    <td><?php echo htmlspecialchars($row["jurusan"]); ?></td>
                    <td><?php echo htmlspecialchars($row["gambar"]); ?></td>
                    <td class="action-links">
                        <a href="insert.php">Tambah</a>
                        <a href="delete.php?id=<?php echo htmlspecialchars($row['id']); ?>&token=<?php echo $csrf_token; ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');">Hapus</a>
                    </td>
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
