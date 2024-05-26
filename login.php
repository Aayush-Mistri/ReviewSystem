<?php
session_start();
$loginSuccess = false;
$loginError = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $server = "localhost";
    $username = "root";
    $password = "aayush098";
    $database = "users";

    // Create a database connection
    $con = mysqli_connect($server, $username, $password, $database);

    // Check the connection
    if (!$con) {
        die("Connection to this database failed due to " . mysqli_connect_error());
    }

    $email = $_POST['email'];
    $password = $_POST['password'];

    // Query to check if the user exists
    $sql = "SELECT * FROM `Users` WHERE `email`='$email' AND `password`='$password'";
    $result = mysqli_query($con, $sql);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $loginSuccess = true;
        // Set session variables
        $_SESSION['loggedIn'] = true;
        $_SESSION['username'] = $row['username']; // Assuming 'username' is the column name in your Users table
        // Redirect to welcome.php
        header("Location: welcome.php");
        exit();
    } else {
        $loginError = "Invalid email or password.";
    }

    // Close the database connection
    mysqli_close($con);
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <style>
        body {
            background-image: url('gif.gif');
            background-size: cover;
        }
        .card {
            border-radius: 15px;
            min-height: 80vh;
        }
        .alert {
            margin-top: 1rem;
        }
    </style>
</head>

<body class="d-flex align-items-center justify-content-center">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body p-5">
                        <h2 class="text-uppercase text-center mb-5">Login</h2>
                        <form action="login.php" method="post">
                            <div class="form-group">
                                <input type="email" name="email" class="form-control form-control-lg" placeholder="Your Email" required>
                            </div>
                            <div class="form-group">
                                <input type="password" name="password" class="form-control form-control-lg" placeholder="Password" required>
                            </div>
                            <button type="submit" class="btn btn-success btn-block btn-lg">Login</button>
                            <?php
                            if ($loginSuccess) {
                                echo '<div class="alert alert-success mt-3" role="alert">
                                        <strong>Success!</strong> You have logged in successfully.
                                      </div>';
                            } elseif ($loginError) {
                                echo '<div class="alert alert-danger mt-3" role="alert">
                                        <strong>Error!</strong> ' . $loginError . '
                                      </div>';
                            }
                            ?>
                        </form>
                        <p class="text-center text-muted mt-5 mb-0">Don't have an account? <a href="index.php" class="fw-bold">Register here</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>

</html>
