<?php
require_once("config/connections.php");
require_once("config/btnfunc.php");
include("header.php");
?>
<!DOCTYPE html>
<html lang="en">

<body>
  <div class="container">
    <div class="row mt-5">
      <div class="col">
        <div class="card mt-2">
          <div class="card-header">
            <h2 class="text-center display-7">Issue Book</h2>
          </div>
          <div class="card-body">
            <form action="issue.php" method="POST" enctype="multipart/form-data">
              <div style="max-height: 550px; overflow: auto;">
                <table class='table table-bordered'>
                  <thead>
                    <tr>
                      <td>
                        <div class="id" style="display: flex; align-items: center; gap: 10px;">
                          <select name="sid" class="form-control selectpicker">
                            <?php
                            $res = mysqli_query($connections, "SELECT id FROM student_registration");
                            while ($row = mysqli_fetch_array($res)) {
                              echo "<option>" . $row["id"] . "</option>";
                            }
                            ?>
                          </select>
                          <input type="submit" value="Issue" name="submit1" class="btn btn-default">
                        </div>
                      </td>
                    </tr>
                  </thead>
                  <tbody>
                  </tbody>
                </table>

                <?php
                if (isset($_POST["submit1"])) {
                  $res = mysqli_query($connections, "SELECT * FROM student_registration WHERE id='$_POST[sid]'");
                  while ($row5 = mysqli_fetch_array($res)) {
                    $id = $row5["id"];
                    $studentname = $row5["studentname"];
                    $birthdate = $row5["birthdate"];
                    $gender = $row5["gender"];
                    $phonenumber = $row5["phonenumber"];
                    $email = $row5["email"];
                  }
                ?>
                  <table class="table table-bordered">
                    <tr>
                      <td>
                        <input type="text" class="form-control" placeholder="Student ID" name="student_id" value="<?php echo $id; ?>" required>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <input type="text" class="form-control" placeholder="Student Name" name="studentname" value="<?php echo $studentname; ?>" required>
                      </td>
                    </tr>
                    <tr>
                    <tr>
                      <td>
                        <input type="text" class="form-control" placeholder="Birthdate" name="birthdate" value="<?php echo $birthdate; ?>" required>
                      </td>
                    </tr>
                    <tr>
                    <tr>
                      <td>
                        <input type="text" class="form-control" placeholder="Phone Number" name="phonenumber" value="<?php echo $phonenumber; ?>" required>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <input type="text" class="form-control" placeholder="Email" name="email" value="<?php echo $email; ?>" required>
                      </td>
                    </tr>
                    <td>
                      <select name="book_name" class="form-control selectpicker">
                        <?php
                        $res = mysqli_query($connections, "select book_name from add_book");
                        while ($row = mysqli_fetch_array($res)) {
                          echo "<option>";
                          echo $row["book_name"];
                          echo "</option>";
                        }
                        ?>
                      </select>
                    </td>
                    <tr>
                      <td>
                        <input type="text" class="form-control" placeholder="Issue Date" name="issue_date" value="<?php echo date("Y-m-d"); ?>" required>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <input type="text" class="form-control" placeholder="ID" name="id" value="<?php echo $id; ?>" disabled>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <input type="submit" value="issue book" name="submit2" class="form-control btn btn-default"
                          style="background-color: #1f2a41; color: white;">
                      </td>
                    </tr>
                  </table>
                <?php
                }
                ?>
            </form>

            <?php
            if (isset($_POST["submit2"])) {
              $quantity = 0;
              $res = mysqli_query($connections, "SELECT * FROM add_book WHERE book_name='$_POST[book_name]'");
              while ($row = mysqli_fetch_array($res)) {
                $quantity = $row["available_quantity"];
              }
              if ($quantity == 0) {
            ?>
                <script type="text/javascript">
                  alert("This book is out of stock!")
                  window.location.href = window.location.href;
                </script>
              <?php
              } else {
                mysqli_query($connections, "insert into issue_book values('','$_POST[student_id]','$_POST[studentname]','$_POST[birthdate]','$_POST[phonenumber]',
              '$_POST[email]','$_POST[book_name]','$_POST[issue_date]','')");

                // if student issue book it will decrease.
                mysqli_query($connections, "UPDATE add_book SET available_quantity=available_quantity-1 WHERE book_name='$_POST[book_name]'");
              ?>

                <script type="text/javascript">
                  alert("Book issue successfully!")
                  window.location.href = window.location.href;
                </script>
            <?php
              }
            }
            ?>
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>
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