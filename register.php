<?php
session_start();
// Koneksi ke database
$servername = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "test";

$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Jika form disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form
    $fullname = $conn->real_escape_string($_POST['fullname']);
    $email = $conn->real_escape_string($_POST['email']);
    $username = $conn->real_escape_string($_POST['username']);
    $password = $conn->real_escape_string($_POST['password']);
    $phone = $conn->real_escape_string($_POST['phone']);
    $country = $conn->real_escape_string($_POST['country']);
    $state = $conn->real_escape_string($_POST['state']);
    $education = $conn->real_escape_string($_POST['education']);
    $job = $conn->real_escape_string($_POST['job']);

    // Check if username already exists in database
    $check_username_sql = "SELECT * FROM register WHERE Username = '$username'";
    $check_username_result = $conn->query($check_username_sql);

    if ($check_username_result->num_rows > 0) {
        echo "<script>alert('Username sudah terdaftar. Silakan gunakan username lain.')</script>";
    } else {
        // Hash password sebelum disimpan ke database
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Query untuk menyimpan data ke database
        $sql = "INSERT INTO register (Fullname, Email, Username, Password, Phone, Country, State, Education, Job, role)
                VALUES ('$fullname', '$email', '$username', '$hashed_password', '$phone', '$country', '$state', '$education', '$job', 'member')";

        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('Registrasi berhasil'); window.location.href = 'index.php';</script>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            height: 100vh;
            margin: 0;
            padding-top: 50px;
        }
        .container {
            background-color: #fff;
            padding: 20px 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
            font-size: 24px;
            color: #007bff;
        }
        label {
            display: block;
            margin: 10px 0 5px;
            font-weight: bold;
            color: #333;
        }
        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            margin-bottom: 20px;
            font-size: 14px;
        }
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Register</h2>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
            <label for="fullname">Full Name:</label>
            <input type="text" id="fullname" name="fullname" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <label for="phone">Phone Number:</label>
            <input type="text" id="phone" name="phone" required>

            <label for="country">Country:</label>
            <input type="text" id="country" name="country" required>

            <label for="state">State/Region:</label>
            <input type="text" id="state" name="state">

            <label for="education">Education:</label>
            <input type="text" id="education" name="education">

            <label for="job">Job/Profession:</label>
            <input type="text" id="job" name="job">

            <input type="submit" value="Register">
        </form>
    </div>
</body>
</html>
