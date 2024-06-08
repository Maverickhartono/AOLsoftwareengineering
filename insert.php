<?php  
$conn = mysqli_connect("localhost", "root", "", "test");

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

if (isset($_POST["submit"])) {
    $nrp = trim($_POST["nrp"]);
    $nama = trim($_POST["nama"]);
    $email = trim($_POST["email"]);
    $jurusan = trim($_POST["jurusan"]);
    $gambar = trim($_POST["gambar"]);
    
    // Validasi input
    $errors = [];
    if (empty($nrp)) $errors[] = "NRP harus diisi";
    if (empty($nama)) $errors[] = "Nama harus diisi";
    if (empty($email)) $errors[] = "Email yang valid harus diisi";
    if (empty($jurusan)) $errors[] = "Jurusan harus diisi";
    if (empty($gambar)) $errors[] = "Gambar harus diisi";
    
    if (empty($errors)) {
        // Sanitasi input
        $nrp = mysqli_real_escape_string($conn, $nrp);
        $nama = mysqli_real_escape_string($conn, $nama);
        $email = mysqli_real_escape_string($conn, $email);
        $jurusan = mysqli_real_escape_string($conn, $jurusan);
        $gambar = mysqli_real_escape_string($conn, $gambar);

        // Masukkan ke database
        $query = "INSERT INTO woi (nama, tanggal, email, jurusan, gambar) VALUES ('$nrp', '$nama', '$email', '$jurusan', '$gambar')";
        $result = mysqli_query($conn, $query);

        if ($result) {
            echo "Data berhasil dimasukkan!";
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
</head>
<body>
    <form action="" method="post">
        <label for="nrp">nama</label>
        <input type="text" name="nrp" id="nrp">
        <br>
        <label for="nama">date</label>
        <input type="text" name="nama" id="nama">
        <br>
        <label for="email">format</label>
        <input type="text" name="email" id="email">
        <br>
        <label for="jurusan">location</label>
        <input type="text" name="jurusan" id="jurusan">
        <br>
        <label for="gambar">notes</label>
        <input type="text" name="gambar" id="gambar">
        <br>
        <button type="submit" name="submit">Kirim</button>
    </form>
</body>
</html>
