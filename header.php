<?php
session_start();
include("config/connections.php");

$Email = $Password = "";
$EmailErr = $PasswordErr = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["Email"])) {
        $EmailErr = "Required Email!";
    } else {
        $Email = $_POST["Email"];
    }
    if (empty($_POST["Password"])) {
        $PasswordErr = "Required Password!";
    } else {
        $Password = $_POST["Password"];
    }
    if ($Email && $Password) {
        // admin table
        $check_email_admin_tbl = mysqli_query($connections, "SELECT * FROM admin_tbl WHERE email = '$Email'");
        $check_email_row_admin_tbl = mysqli_num_rows($check_email_admin_tbl);
        if ($check_email_row_admin_tbl > 0) {
            $row = mysqli_fetch_assoc($check_email_admin_tbl);
            $db_password = $row["password"];
            $db_id = $row["id"];
            if ($db_password === $Password) {
                $_SESSION['login_success'] = true;
                $_SESSION['email'] = $Email;
                if ($db_id == "1") {
                    echo "<script>window.location.href = 'admin/dashboard.php'; </script>";
                } else {
                    echo "<script>window.location.href = 'student/dashboard.php'; </script>";
                }
            } else {
                $PasswordErr = "Password Incorrect!";
            }
        } else {
            // student_registration table
            $check_email_registration = mysqli_query($connections, "SELECT * FROM student_registration WHERE email = '$Email'");
            $check_email_row_registration = mysqli_num_rows($check_email_registration);
            if ($check_email_row_registration > 0) {
                $row = mysqli_fetch_assoc($check_email_registration);
                $db_password = $row["password"];
                $db_id = $row["id"];
                if ($db_password === $Password) {
                    $_SESSION['login_success'] = true;
                    $_SESSION['student_id'] = $db_id;
                    echo "<script>window.location.href = 'student/dashboard.php'; </script>";
                } else {
                    $PasswordErr = "Password Incorrect!";
                }
            } else {
                $EmailErr = "Email is not Registered!";
            }
        }
    }
}    
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Account</title>
    <link rel="stylesheet" type="text/css" href="css/log1.css">
    <script src="css/password.js"></script>
    <script src="admin/bootstrap\jquery\jquery.js"></script>
    <script src="user/bootstrap\jquery\jquery.js"></script>
</head>