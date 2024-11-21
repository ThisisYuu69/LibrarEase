<?php
if (isset($_SESSION['login_success']) && $_SESSION['login_success']) {
?>
  <script>
    setTimeout(function() {
      swal({
        title: "User!",
        text: "You are now logged in as",
        icon: "success",
        heightAuto: false,
      });
    }, 1000);
  </script>
<?php
  unset($_SESSION['login_success']);
}
require_once("config/connections.php");
require_once("config/btnfunc.php");
include("header.php");

$result = display_data();
?>

<!DOCTYPE html>
<html lang="en">

<body>

</body>

<footer>
  <p>
    <a href="#"><i class="fas fa-globe"></i>&nbsp; LibrarEase Management Group</a> &nbsp; &nbsp;
    <a href="#"><i class="fas fa-mobile-phone"></i>&nbsp; (02) 8543-1234</a> &nbsp; &nbsp;
    <a href="#"><i class="fas fa-envelope"></i>&nbsp; librarease@gmail.com</a>
  </p>
  <p>&copy; 2024 Library Management System</p>
</footer>
</html>