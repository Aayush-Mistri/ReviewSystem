<?php
session_start();
$insert = false;
$error = false;

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

    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];

    // Check if email already exists
    $check_email_query = "SELECT * FROM `Users` WHERE `email`='$email'";
    $result = mysqli_query($con, $check_email_query);

    if (mysqli_num_rows($result) > 0) {
        $error = "Email already exists. Please use a different email.";
    } else {
        // Check if passwords match
        if ($password == $cpassword) {
            $sql = "INSERT INTO `Users` (`username`, `email`, `password`, `dt`) VALUES ('$username', '$email', '$password', CURRENT_TIMESTAMP);";

            // Execute the query
            $result = mysqli_query($con, $sql);

            // Check if the query was successful
            if ($result) {
                $insert = true;
                // Set session variables
                $_SESSION['loggedIn'] = true;
                $_SESSION['username'] = $username;
                // Redirect to the welcome page
                header("Location: welcome.php");
                exit();
            } else {
                $error = "Error: " . mysqli_error($con);
            }
        } else {
            $error = "Passwords do not match.";
        }
    }

    // Close the database connection
    mysqli_close($con);
}
?>

<!-- Your HTML code for signup form -->

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <title>Sign up</title>
    <style>
        * {
            background-size: cover;
            background-position: center center;
            background-repeat: no-repeat;
        }
    </style>
</head>

<body>

    <section class="vh-100 bg-image" style="background-image: url('gif.gif');">
        <div class="mask d-flex align-items-center h-100 gradient-custom-3">
            <div class="container h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-12 col-md-9 col-lg-7 col-xl-6">
                        <div class="card" style="border-radius: 15px;">
                            <div class="card-body p-5">
                                <h2 class="text-uppercase text-center mb-5">Create an account</h2>

                                <form action="index.php" method="post">

                                    <div data-mdb-input-init class="form-outline mb-4">
                                        <input type="text" name="username" id="form3Example1cg"
                                            class="form-control form-control-lg" required />
                                        <label class="form-label" for="form3Example1cg">Your Name</label>
                                    </div>

                                    <div data-mdb-input-init class="form-outline mb-4">
                                        <input type="email" name="email" id="form3Example3cg"
                                            class="form-control form-control-lg" required />
                                        <label class="form-label" for="form3Example3cg">Your Email</label>
                                    </div>

                                    <div data-mdb-input-init class="form-outline mb-4">
                                        <input type="password" name="password" id="form3Example4cg"
                                            class="form-control form-control-lg" required />
                                        <label class="form-label" for="form3Example4cg">Password</label>
                                    </div>

                                    <div data-mdb-input-init class="form-outline mb-4">
                                        <input type="password" name="cpassword" id="form3Example4cdg"
                                            class="form-control form-control-lg" required />
                                        <label class="form-label" for="form3Example4cdg">Confirm your password</label>
                                    </div>

                                    <div class="d-flex justify-content-center">
                                        <button type="submit"
                                            class="btn btn-success btn-block btn-lg gradient-custom-4 text-body"
                                            id="btn">Register</button>
                                    </div>

                                    <?php
                                    if ($insert) {
                                        echo '<div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                                                <strong>Success!</strong> Your account has been created successfully.
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                              </div>';
                                    } elseif ($error) {
                                        echo '<div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                                                <strong>Error!</strong> ' . $error . '
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                              </div>';
                                    }
                                    ?>

                                    <p class="text-center text-muted mt-5 mb-0">Have already an account? <a
                                            href="login.php" class="fw-bold text-body"><u>Login here</u></a></p>

                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
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
