<?php
session_start();
include("config/connections.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Page</title>
    <link rel="stylesheet" type="text/css" href="css/registration.css">
    <script src="css/password.js"></script>
</head>

<body>
    <div class="isset">
        <?php
        if (isset($_POST['submit'])) {
            $studentname = $_POST['studentname'];
            $birthdate = $_POST['birthdate'];
            $gender = $_POST['gender'];
            $phonenumber = $_POST['phonenumber'];
            $email = $_POST['email'];
            $password = $_POST['password'];

            $sql = "INSERT INTO student_registration (studentname, birthdate, gender, phonenumber, email, password) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = mysqli_prepare($connections, $sql);
            mysqli_stmt_bind_param($stmt, "ssssss", $studentname, $birthdate, $gender, $phonenumber, $email, $password);

            if (mysqli_stmt_execute($stmt)) {
                $_SESSION['status'] = array(
                    'message' => "Registered Successfully.",
                    'class' => 'text-success'
                );
                header('Location: registration.php');
                exit();
            } else {
                $_SESSION['status'] = array(
                    'message' => "Failed to Register.",
                    'class' => 'text-danger'
                );
                header('Location: registration.php');
                exit();
            }
        }

        if (isset($_SESSION['status']) && is_array($_SESSION['status'])) {
            $status_message = $_SESSION['status']['message'];
            $status_class = $_SESSION['status']['class'];
            echo "<p class='$status_class'>$status_message</p>";
            unset($_SESSION['status']);
        }
        ?>
    </div>
    <div class="container">
        <div class="row">
            <div class="panel-primary">
                <div class="heading">
                    <h2>Create Account</h2>
                </div>
                <div class="panel-body">
                    <form action="registration.php" method="post">
                        <div class="input-field">
                            <input type="text" placeholder="Name" class="form-control" id="studentname" name="studentname" required>
                            <input type="date" placeholder="date" class="form-control" id="birthdate" name="birthdate" required>
                            <input type="text" placeholder="Gender" class="form-control" id="gender" name="gender" required>
                            <input type="tel" placeholder="Phone Number" class="form-control" id="phonenumber" name="phonenumber" required>
                            <input type="email" placeholder="Email" class="form-control" id="email" name="email" required>
                            <input type="password" class="form-control" placeholder="Password" id="password" name="password" required>
                            <img src="resources/passhide.jpg" onclick="pass()" class="pass-icon" id="pass-icon">
                        </div>
                        <div class="submit-center">
                            <input type="submit" name="submit" value="Register">
                        </div>
                    </form>
                </div>
                <div class=login>
                    <small>Have account now?&nbsp;<a href="login.php">Log in.</a></small>
                </div>
            </div>
        </div>
    </div>
</body>

</html>