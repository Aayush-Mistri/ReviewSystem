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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <style>
        /* Transparent Navbar */
        body {
            background-color: black;
            font-family: verdana;
            color: white;
        }

        .jersey-25-charted-regular {
            font-family: "Jersey 25 Charted", sans-serif;
            font-weight: 400;
            font-style: normal;
        }

        .acme-regular {
            font-family: "Acme", sans-serif;
            font-weight: 400;
            font-style: normal;
        }


        .navbar {
            background-color: transparent;
            border-bottom: none;
            /* Remove border */
            box-shadow: none;
            /* Remove box shadow */
        }

        .navbar-nav .nav-link,
        .navbar-brand,
        .navbar-text {
            color: honeydew;
        }

        .container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .card {
            border-radius: 15px;
        }

        .card-body {
            text-align: center;
        }

        .first {
            background-color: red;
            width: 100%;
            height: 100%;
            background-image: url('wallpaperflare.com_wallpaper.jpg');
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .txt {
            font-family: "Jersey 25 Charted";
            font-size: 230px;
            display: flex;
            color: rgb(166, 35, 72, 0.9 );
            text-shadow: 0 0 5px white, 0 0 10px white , 0 0 20px white;

        }

        .txt2 {
            margin-top: 20px;
            font-family: "Acme";
            color: rgb(166, 35, 72);
            font-size: 50px;
            text-shadow: 0 0 5px #fff, 0 0 10px #fff , 0 0 20px #fff;
        }
        .sep{
            width:100%;
            background-color: black;
            height:20%;
            color:black;
        }
        .second{
            display:flex;
            align-items: center;
            justify-content: center;
            flex-wrap: wrap;
        }
        .one img{
            height:470px;
            width:379px;
            object-fit: cover;
            border:10px solid black;
        }
        .one{
            height:480;
            border:20px;
            margin-top: 50px;
        }
    </style>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Jersey+25+Charted&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Acme&family=Jersey+25+Charted&display=swap" rel="stylesheet">
</head>

<body>

    <div class="first">
        <nav class="navbar navbar-expand-lg navbar-light">
            <a class="navbar-brand" href="#">MyApp</a>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="logout.php">Logout <span class="sr-only">(current)</span></a>
                    </li>
                </ul>
                <span class="navbar-text mr-3">
                    Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>! </span>
            </div>
        </nav>

        <div class="txt">
            Post your<br> reviews,
        </div>
        <div class="txt2">
           <b> Connect with community!</b>
        </div>
    </div>
    <div class="sep"> hello<br>hello</div>
    <div class="second">
       
        <div class="one">
            <a href="bb.php">
                <img src="download (1).jpg" alt="">
            </a>   
        </div>
        <div class="one">
            <a href="got.php">
                <img src="download (2).jpg" alt="">
            </a>   
        </div>
        <div class="one">
            <a href="rnm.php">
                <img src="download.jpg" alt="">
            </a>   
        </div>
        <div class="one">
            <a href="dark.php">
                <img src="Louis Hofmann Dark.jpg" alt="">
            </a>   
        </div>
    </div>
    <div class="second">
       
        <div class="one">
            <a href="bb.php">
                <img src="download (1).jpg" alt="">
            </a>   
        </div>
        <div class="one">
            <a href="got.php">
                <img src="download (2).jpg" alt="">
            </a>   
        </div>
        <div class="one">
            <a href="rnm.php">
                <img src="download.jpg" alt="">
            </a>   
        </div>
        <div class="one">
            <a href="dark.php">
                <img src="Louis Hofmann Dark.jpg" alt="">
            </a>   
        </div>
    </div>



    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
        crossorigin="anonymous"></script>
</body>

</html>