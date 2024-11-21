<?php
session_start();
$tot = 0;
$res = mysqli_query($connections, "SELECT * FROM message_tbl WHERE dusername='$_SESSION[student_id]' && read_msg='n'");
$tot = mysqli_num_rows($res);

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
$result = display_data();
?>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>
  <link rel="stylesheet" href="css\all.min.css">
  <link rel="stylesheet" href="css\fontawesome.min.css">
  <script src="bootstrap\jquery\jquery.js"></script>
  <link rel="stylesheet" href="bootstrap\css\bootstrap.css">
  <script src="bootstrap\js\bootstrap.bundle.js"></script>
  <link rel="stylesheet" href="css/std.css">
  <script src="bootstrap\sweetalert\sweetalert.js"></script>

</head>

<label>
  <input type="checkbox">
  <div class="toggle">
    <span class="top_line common"></span>
    <span class="middle_line common"></span>
    <span class="bottom_line common"></span>
  </div>
  <div class="slide">
    <img src="resources/trademark.png" class="logo">
    <ul>
      <li><a href="dashboard.php"><i class="fas fa-home"></i> Home</a></li>
      <li><a href="my_issued_book.php"><i class="fas fa-bookmark"></i> My Issued Book</a></li>
      <li><a href="library_book.php"><i class="fas fa-book"></i> Browse Book</a></li>
      <li><a href="../login.php"><i class="fas fa-sign-out-alt"></i> Log Out</a></li>
    </ul>
  </div>
</label>

<div class="notification">
  <a href="show_message.php" class="dropdown-toggle info-number" aria-expanded="false">
    <i class="fas fa-envelope" style="color: #1f2a41;"></i>
    <span class="badge"><?php echo $tot; ?></span>
  </a>
</div>