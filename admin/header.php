<?php
session_start();
if (isset($_SESSION['login_success']) && $_SESSION['login_success']) {
?>
  <script>
    setTimeout(function() {
      swal({
        title: "Admin!",
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
    <link rel="stylesheet" href="css/admin.css">
    <script src="bootstrap\sweetalert\sweetalert.js"></script>

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
                <li><a href="student_info.php"><i class="fas fa-user-graduate"></i> Student Information</a></li>
                <li><a href="add_book.php"><i class="fas fa-book-medical"></i> Add Books</a></li>
                <li><a href="display_book.php"><i class="fas fa-book"></i> Display Books</a></li>
                <li><a href="issue.php"><i class="fas fa-bookmark"></i> Issue Books</a></li>
                <li><a href="return_book.php"><i class="fas fa-undo-alt"></i> Return Books</a></li>
                <li><a href="notify_student.php"><i class="fas fa-bell"></i> Notify Student</a></li>
                <li><a href="../login.php"><i class="fas fa-sign-out-alt"></i> Log Out</a></li>
            </ul>
        </div>
    </label>
</head>