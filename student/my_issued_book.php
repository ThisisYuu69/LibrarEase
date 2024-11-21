<?php
require_once("config/connections.php");
require_once("config/btnfunc.php");
include("header.php");

$student_id = isset($_SESSION['student_id']) ? $_SESSION['student_id'] : null;
$res = null;

if ($student_id) {
  $stmt = $connections->prepare("SELECT * FROM issue_book WHERE student_id = ?");
  $stmt->bind_param("i", $student_id);
  $stmt->execute();
  $res = $stmt->get_result();
}
?>
<!DOCTYPE html>
<html lang="en">

<body>
  <div class="container">
    <div class="row mt-5">
      <div class="col">
        <div class="card mt-2">
          <div class="card-header">
            <h2 class="text-center display-7">My Issue Books</h2>
            <div class="search-button">
              <form class="d-flex search-form" role="search">
                <input class="form-control me-2" type="search" placeholder="Search..." aria-label="Search">
                <button class="btn btn-outline-success" type="submit"><i class="fas fa-search"></i></button>
              </form>
            </div>
          </div>
          <div class="card-body">
            <div style="max-height: 400px; overflow: auto;">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th class="text-white col-sm-1" style="background-color: #1f2a41;">ID</th>
                    <th class="text-white col-sm-1" style="background-color: #1f2a41;">Student Name</th>
                    <th class="text-white col-sm-1" style="background-color: #1f2a41;">Book Name</th>
                    <th class="text-white col-sm-1" style="background-color: #1f2a41;">Book Issue Date</th>
                    <th class="text-white col-sm-1" style="background-color: #1f2a41;">Returned Date</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  if ($res) {
                    while ($row = $res->fetch_assoc()) {
                      echo "<tr>";
                      echo "<td>" . $row['student_id'] . "</td>";
                      echo "<td>" . $row['studentname'] . "</td>";
                      echo "<td>" . $row['book_name'] . "</td>";
                      echo "<td>" . $row['issue_date'] . "</td>";
                      echo "<td>" . $row['return_date'] . "</td>";
                      echo "</tr>";
                    }
                  }
                  ?>
                  <tr id="noSearchFoundRow" style="display: none;">
                    <td colspan="10">
                      <div class='text-center text-danger'>No record found.</div>
                    </td>
                  </tr>
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

  <script>
    /*search */
    $(document).ready(function() {

      $('form.search-form').submit(function(e) {
        e.preventDefault();


        var searchQuery = $(this).find('input[type=search]').val().toLowerCase();


        var found = false;
        $('tbody tr').each(function() {
          var rowText = $(this).text().toLowerCase();
          if (rowText.indexOf(searchQuery) === -1) {
            $(this).hide();
          } else {
            $(this).show();
            found = true;
          }
        });

        if (!found) {
          $('#noSearchFoundRow').show();
        } else {
          $('#noSearchFoundRow').hide();
        }
      });
    });
    /* search */
  </script>