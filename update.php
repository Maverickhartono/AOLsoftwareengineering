<?php
session_start();

if (!isset($_GET['id']) || !isset($_GET['token']) || $_GET['token'] !== $_SESSION['token']) {
    echo "Invalid request";
    exit();
}

$conn = mysqli_connect("localhost", "root", "", "test");

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

$id = intval($_GET['id']);
$sql = "SELECT * FROM woi WHERE id = $id";
$result = mysqli_query($conn, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
} else {
    echo "Data not found";
    exit();
}

if (isset($_POST["submit"])) {
    $nama = trim($_POST["nama"]);
    $datee = trim($_POST["datee"]);
    $format = trim($_POST["format"]);
    $location = trim($_POST["location"]);
    $notes = trim($_POST["notes"]);
    
    $errors = [];
    if (empty($nama)) $errors[] = "Nama harus diisi";
    if (empty($datee)) $errors[] = "Date harus diisi";
    if (empty($format) || !in_array($format, ["Jeopardy", "Attack-Defence", "Hack-quest"])) $errors[] = "Format yang valid harus dipilih";
    if (empty($location)) $errors[] = "Location harus diisi";
    if (empty($notes)) $errors[] = "Notes harus diisi";
    
    if (empty($errors)) {
        $nama = mysqli_real_escape_string($conn, $nama);
        $datee = mysqli_real_escape_string($conn, $datee);
        $location = mysqli_real_escape_string($conn, $location);
        $format = mysqli_real_escape_string($conn, $format);
        $notes = mysqli_real_escape_string($conn, $notes);

        $query = "UPDATE woi SET nama='$nama', datee='$datee', location='$location', format='$format', notes='$notes' WHERE id=$id";
        $result = mysqli_query($conn, $query);

        if ($result) {
            echo "<script>
                    if (confirm('Data berhasil diupdate! Apakah Anda yakin ingin kembali ke halaman utama?')) {
                        window.location.href = 'index.php';
                    }
                  </script>";
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    } else {
        foreach ($errors as $error) {
            echo "<p style='color:red;'>$error</p>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir Input Data</title>
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
        form {
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            animation: fadeIn 1s ease-in-out;
        }
        label {
            display: block;
            margin-bottom: 8px;
            color: #333;
        }
        input[type="text"], input[type="date"], select {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button {
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        button:hover {
            background-color: #0056b3;
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
    </style>
</head>
<body>
    <form action="" method="post">
        <label for="nama">Nama</label>
        <input type="text" name="nama" id="nama" value="<?php echo htmlspecialchars($row['nama']); ?>">
        
        <label for="datee">Date</label>
        <input type="date" name="datee" id="datee" value="<?php echo htmlspecialchars($row['datee']); ?>">
        
        <label for="format">Format</label>
        <select name="format" id="format">
            <option value="">Pilih Format</option>
            <option value="Jeopardy" <?php if ($row['format'] == 'Jeopardy') echo 'selected'; ?>>Jeopardy</option>
            <option value="Attack-Defence" <?php if ($row['format'] == 'Attack-Defence') echo 'selected'; ?>>Attack-Defence</option>
            <option value="Hack-quest" <?php if ($row['format'] == 'Hack-quest') echo 'selected'; ?>>Hack-quest</option>
        </select>
        
        <label for="location">Location</label>
        <select name="location" id="location">
            <option value="online" <?php if ($row['location'] == 'online') echo 'selected'; ?>>Online</option>
            <option value="onsite" <?php if ($row['location'] == 'onsite') echo 'selected'; ?>>Onsite</option>
        </select>
        
        <label for="notes">Notes</label>
        <input type="text" name="notes" id="notes" value="<?php echo htmlspecialchars($row['notes']); ?>">
        
        <button type="submit" name="submit">Kirim</button>
    </form>
</body>
</html>
<?php
mysqli_close($conn);
?>
