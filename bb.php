<?php
session_start();

if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] !== true) {
    header("location: login.php");
    exit;
}

$server = "localhost";
$username = "root";
$password = "aayush098";
$database = "users";

$con = mysqli_connect($server, $username, $password, $database);

if (!$con) {
    die("Connection to this database failed due to " . mysqli_connect_error());
}

// Handle comment submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['comment'])) {
    $comment = $_POST['comment'];
    $username = $_SESSION['username'];

    $sql = "INSERT INTO Comments (username, comment) VALUES ('$username', '$comment')";
    mysqli_query($con, $sql);
}

// Fetch all comments
$sql = "SELECT * FROM Comments ORDER BY timestamp DESC";
$result = mysqli_query($con, $sql);
$comments = mysqli_fetch_all($result, MYSQLI_ASSOC);

mysqli_close($con);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #121212;
            color: #ffffff;
        }
        .navbar, .card, .btn-primary {
            background-color: #1f1f1f;
        }
        .navbar-brand, .navbar-text, .nav-link, .card-title, .card-text, .btn-primary {
            color: #ffffff;
        }
        .form-control {
            background-color: #333333;
            color: #ffffff;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">MyApp</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Logout</a>
                </li>
            </ul>
            <span class="navbar-text">
                Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!
            </span>
        </div>
    </nav>

    <div class="container mt-4">
        <div class="text-center">
            <img src="download (1).jpg" class="img-fluid" alt="Topic Image">
        </div>

        <div class="comment-section">
            <h3 class="mt-4">Comments</h3>
            <form action="bb.php" method="post" class="comment-form">
                <div class="form-group">
                    <textarea name="comment" class="form-control" rows="3" placeholder="Write your comment here..." required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Post Comment</button>
            </form>

            <div>
                <?php foreach ($comments as $comment): ?>
                    <div class="card comment-card">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($comment['username']); ?></h5>
                            <p class="card-text"><?php echo nl2br(htmlspecialchars($comment['comment'])); ?></p>
                            <p class="card-text"><small class="text-muted"><?php echo $comment['timestamp']; ?></small></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.min.js"></script>
</body>
</html>
