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
            <h2 class="text-center display-7">Return Book</h2>
          </div>
          <div class="card-body">
            <div style="max-height: 400px; overflow: auto;">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <td>
                      <div style="display: flex; align-items: center; gap: 10px;">
                        <form method="POST" style="display: flex; align-items: center; gap: 5px; flex-wrap: nowrap;">
                          <select name="sid" class="form-control" style="width: auto;">
                            <?php
                            $res = mysqli_query($connections, "SELECT student_id FROM issue_book WHERE return_date = '' GROUP BY student_id");
                            while ($row = mysqli_fetch_array($res)) {
                              echo "<option value='" . $row["student_id"] . "'>" . $row["student_id"] . "</option>";
                            }
                            ?>
                          </select>
                          <input type="submit" value="Search" name="submit1" class="form-control btn btn-outline-success" style="width: auto;">
                        </form>
                      </div>
                    </td>
                  </tr>
                </thead>
              </table>
              <table class="table table-bordered text-center">
                <thead>
                  <tr>
                    <th class="text-white col-sm-1" style="background-color: #1f2a41;">Student ID</th>
                    <th class="text-white col-sm-1" style="background-color: #1f2a41;">Name</th>
                    <th class="text-white col-sm-1" style="background-color: #1f2a41;">Birth Date</th>
                    <th class="text-white col-sm-1" style="background-color: #1f2a41;">Phone Number</th>
                    <th class="text-white col-sm-1" style="background-color: #1f2a41;">Email</th>
                    <th class="text-white col-sm-1" style="background-color: #1f2a41;">Book Name</th>
                    <th class="text-white col-sm-1" style="background-color: #1f2a41;">Issue Date</th>
                    <th class="text-white col-sm-1" style="background-color: #1f2a41;">Return Book</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  if (isset($_POST["submit1"])) {
                    $sid = mysqli_real_escape_string($connections, $_POST["sid"]);

                    // this will display the data of issuee book.
                    $res = mysqli_query($connections, "SELECT * FROM issue_book WHERE student_id = '$sid' AND return_date = ''");

                    if (mysqli_num_rows($res) > 0) {
                      while ($row5 = mysqli_fetch_array($res)) {
                        echo "<tr>";
                        echo "<td>" . $row5["student_id"] . "</td>";
                        echo "<td>" . $row5["studentname"] . "</td>";
                        echo "<td>" . $row5["birthdate"] . "</td>";
                        echo "<td>" . $row5["phonenumber"] . "</td>";
                        echo "<td>" . $row5["email"] . "</td>";
                        echo "<td>" . $row5["book_name"] . "</td>";
                        echo "<td>" . $row5["issue_date"] . "</td>";
                        echo "<td><a href='return.php?id=" . $row5["id"] . "' style='text-decoration: none;'>Return</a></td>";
                        echo "</tr>";
                      }
                    }
                  }
                  ?>
                </tbody>
              </table>
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
