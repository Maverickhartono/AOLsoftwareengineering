<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conn = new mysqli("localhost", "root", "", "test");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $username = $conn->real_escape_string($_POST['username']);
    $password = $_POST['password'];

    $sql = "SELECT * FROM register WHERE Username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['Password'])) {
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $username;
            header("Location: index.php");
            exit; // Ensure that code after header is not executed
        } else {
            $password_error = "Password salah. Silakan coba lagi.";
        }
    } else {
        $username_error = "Username tidak ditemukan. Silakan coba lagi.";
    }
    $stmt->close();
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f7f7f7;
            margin: 0;
            font-family: 'Arial', sans-serif;
        }
        .login-container {
            background-color: #fff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        .login-container h2 {
            margin-bottom: 20px;
            font-size: 24px;
            color: #333;
        }
        .login-container form {
            display: flex;
            flex-direction: column;
        }
        .login-container label {
            margin-bottom: 5px;
            color: #555;
            text-align: left;
        }
        .login-container input[type="text"],
        .login-container input[type="password"] {
            padding: 10px;
            margin-bottom: 10px; /* Adjusted margin */
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }
        .login-container .error-message {
            color: red;
            font-size: 14px;
            text-align: left;
            margin-top: -10px; /* Adjusted margin */
            margin-bottom: 10px; /* Adjusted margin */
        }
        .login-container input[type="submit"] {
            padding: 10px;
            background-color: #28a745;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }
        .login-container input[type="submit"]:hover {
            background-color: #218838;
        }
        .register-link {
            margin-top: 15px;
            font-size: 14px;
            color: #007bff;
            text-decoration: none;
        }
        .register-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Login</h2>
        <form method="post" action="">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
            <?php if(isset($username_error)) { ?>
                <div class="error-message"><?php echo $username_error; ?></div>
            <?php } ?>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <?php if(isset($password_error)) { ?>
                <div class="error-message"><?php echo $password_error; ?></div>
            <?php } ?>

            <input type="submit" value="Login">
        </form>
        <a class="register-link" href="register.php">Apakah anda belum punya akun?</a>
    </div>
</body>
</html>
