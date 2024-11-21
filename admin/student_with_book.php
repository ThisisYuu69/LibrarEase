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
            <h2 class="text-center display-7">Student List with the Book</h2>
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
                    <th class="text-white col-sm-1" style="background-color: #1f2a41;">Student ID</th>
                    <th class="text-white col-sm-1" style="background-color: #1f2a41;">Student Name</th>
                    <th class="text-white col-sm-1"  style="background-color: #1f2a41;">Book Name</th>
                    <th class="text-white col-sm-1" style="background-color: #1f2a41;">Phone Number</th>
                    <th class="text-white col-sm-1" style="background-color: #1f2a41;">Email</th>
                    <th class="text-white col-sm-1" style="background-color: #1f2a41;">Issue Date</th>
                  </tr>
                </thead>
                <tr id="noSearchFoundRow" style="display: none;">
                  <td colspan="10">
                    <div class='text-center text-danger'>No record found.</div>
                  </td>
                </tr>
                <tbody>
                  <?php
                  //  display all student with the book.
                  $res = mysqli_query($connections, "SELECT * FROM issue_book WHERE book_name='$_GET[book_name]' && return_date=''");
                    while ($row = mysqli_fetch_array($res)) {
                      echo "<tr>";
                      echo "<td>" . $row["student_id"] . "</td>";
                      echo "<td>" . $row["studentname"] . "</td>";
                      echo "<td>" . $row["book_name"] . "</td>";
                      echo "<td>" . $row["phonenumber"] . "</td>";
                      echo "<td>" . $row["email"] . "</td>";
                      echo "<td>" . $row["issue_date"] . "</td>";
                      echo "</tr>";
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

</html>