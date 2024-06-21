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

if ($stmt === false) {
    die('Prepare failed: ' . htmlspecialchars($conn->error));
}

$stmt->bind_param("s", $username);
$stmt->execute();
$stmt->bind_result($role);
$stmt->fetch();
$stmt->close();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['id'])) {
        $id = $_POST['id'];
        $title = $_POST['title'];
        $description = $_POST['description'];
        $image = $_FILES['image']['name'];
        $target = "image/" . basename($image);

        if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
            $sql = "UPDATE article SET title = ?, description = ?, image = ? WHERE id = ?";
            $stmt = $conn->prepare($sql);

            if ($stmt === false) {
                die('Prepare failed: ' . htmlspecialchars($conn->error));
            }

            $stmt->bind_param("sssi", $title, $description, $image, $id);
            $stmt->execute();
            $stmt->close();
        } else {
            echo "Failed to upload image";
        }
    } else {
        $title = $_POST['title'];
        $description = $_POST['description'];
        $image = $_FILES['image']['name'];
        $target = "image/" . basename($image);

        if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
            $sql = "INSERT INTO article (title, description, image) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($sql);

            if ($stmt === false) {
                die('Prepare failed: ' . htmlspecialchars($conn->error));
            }

            $stmt->bind_param("sss", $title, $description, $image);
            $stmt->execute();
            $stmt->close();
        } else {
            echo "Failed to upload image";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Article Data</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background: url('./assets/cafe.gif') no-repeat center center fixed;
            background-size: cover;
            margin: 0;
            padding-top: 120px;
            padding-bottom: 60px;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            align-items: flex-start;
            gap: 20px;
        }
        .card {
            width: 220px;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            overflow: hidden;
            text-align: center;
            padding: 15px;
            transition: transform 0.3s ease;
        }
        .card:hover {
            transform: translateY(-5px);
        }
        .card img {
            width: 100%;
            height: 120px;
            object-fit: cover;
            border-bottom: 1px solid #ddd;
            margin-bottom: 15px;
        }
        .card-title {
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 10px;
        }
        .show-article {
            padding: 12px 24px;
            background-color: #007BFF;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }
        .show-article:hover {
            background-color: #0056b3;
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
            background-color: rgba(0,0,0,0.4);
            justify-content: center;
            align-items: center;
        }
        .modal-content {
            background-color: #fff;
            margin: auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 600px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
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
        .add-icon {
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
        .add-icon:hover {
            background-color: #218838;
        }
        .admin-buttons {
            display: flex;
            justify-content: space-between;
            margin-top: 10px;
        }
        .admin-buttons button {
            padding: 8px 12px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .admin-buttons .update {
            background-color: #ffc107;
            color: white;
        }
        .admin-buttons .update:hover {
            background-color: #e0a800;
        }
        .admin-buttons .delete {
            background-color: #dc3545;
            color: white;
        }
        .admin-buttons .delete:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>
    <?php
    $conn = new mysqli("localhost", "root", "", "test"); 
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $sql = "SELECT * FROM `article`";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) { ?>
            <div class="card">
                <img src="image/<?php echo htmlspecialchars($row["image"]); ?>" alt="Article Image">
                <div class="card-title"><?php echo htmlspecialchars($row["title"]); ?></div>
                <button class="show-article" onclick="showModal('<?php echo addslashes(htmlspecialchars($row["title"])); ?>', '<?php echo addslashes(htmlspecialchars($row["description"])); ?>')">Show Article</button>
                <?php if ($role == 'admin') { ?>
                    <div class="admin-buttons">
                        <button class="update" onclick="updateArticle('<?php echo $row['id']; ?>', '<?php echo addslashes(htmlspecialchars($row['title'])); ?>', '<?php echo addslashes(htmlspecialchars($row['description'])); ?>')">Update</button>
                        <button class="delete" onclick="deleteArticle('<?php echo $row['id']; ?>')">Delete</button>
                    </div>
                <?php } ?>
            </div>
        <?php }
    } else {
        echo "<p>No data found</p>";
    }
    $conn->close();
    ?>

    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2 id="modal-title"></h2>
            <hr>
            <p id="modal-description"></p>
        </div>
    </div>

    <div id="updateModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="document.getElementById('updateModal').style.display='none'">&times;</span>
            <form method="post" enctype="multipart/form-data" id="updateForm">
                <label for="updateTitle">Title:</label>
                <input type="text" id="updateTitle" name="title" required><br><br>
                <label for="updateDescription">Description:</label>
                <textarea id="updateDescription" name="description" required></textarea><br><br>
                <label for="updateImage">Image:</label>
                <input type="file" id="updateImage" name="image"><br><br>
                <input type="hidden" name="csrf_token" value="<?php echo $csrf_token; ?>">
                <input type="hidden" id="updateId" name="id">
                <input type="submit" value="Update">
            </form>
        </div>
    </div>

    <?php if ($role == 'admin') { ?>
    <div class="add-icon" onclick="document.getElementById('addArticleForm').style.display='block'">+</div>
    <?php } ?>

    <div id="addArticleForm" class="modal">
        <div class="modal-content">
            <span class="close" onclick="document.getElementById('addArticleForm').style.display='none'">&times;</span>
            <form method="post" enctype="multipart/form-data">
                <label for="title">Title:</label>
                <input type="text" id="title" name="title" required><br><br>
                <label for="description">Description:</label>
                <textarea id="description" name="description" required></textarea><br><br>
                <label for="image">Image:</label>
                <input type="file" id="image" name="image" required><br><br>
                <input type="hidden" name="csrf_token" value="<?php echo $csrf_token; ?>">
                <input type="submit" value="Submit">
            </form>
        </div>
    </div>

    <form id="deleteForm" method="post" action="deletearticle.php" style="display: none;">
        <input type="hidden" name="id" id="deleteId">
        <input type="hidden" name="csrf_token" value="<?php echo $csrf_token; ?>">
    </form>

    <script>
        function showModal(title, description) {
            document.getElementById('modal-title').innerText = title;
            document.getElementById('modal-description').innerText = description;
            document.getElementById('myModal').style.display = "flex";
        }

        function updateArticle(id, title, description) {
            document.getElementById('updateTitle').value = title;
            document.getElementById('updateDescription').value = description;
            document.getElementById('updateId').value = id;
            document.getElementById('updateModal').style.display = "flex";
        }

        function deleteArticle(id) {
            if (confirm('Are you sure you want to delete this article?')) {
                document.getElementById('deleteId').value = id;
                document.getElementById('deleteForm').submit();
            }
        }

        document.querySelectorAll('.close').forEach(function(closeBtn) {
            closeBtn.onclick = function() {
                closeBtn.parentElement.parentElement.style.display = 'none';
            };
        });

        window.onclick = function(event) {
            if (event.target.classList.contains('modal')) {
                event.target.style.display = 'none';
            }
        }
    </script>
</body>
</html>
