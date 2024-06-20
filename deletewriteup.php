<?php
session_start();

if (!isset($_GET['id']) || !isset($_GET['token']) || $_GET['token'] !== $_SESSION['token']) {
    echo "Invalid request";
    exit();
}

$conn = new mysqli("localhost", "root", "", "test");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = intval($_GET['id']);
$sql = "DELETE FROM `writeup` WHERE id = $id";

if ($conn->query($sql) === TRUE) {
    header("Location: writeups.php"); // Redirect back to the main page after deletion
    exit();
} else {
    echo "Error deleting record: " . $conn->error;
}

$conn->close();
?>
