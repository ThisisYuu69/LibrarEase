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
require_once("config/connections.php");
require_once("config/btnfunc.php");

$result = display_data();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>
  <link rel="stylesheet" href="css\all.min.css">
  <link rel="stylesheet" href="css\fontawesome.min.css">
  <script src="bootstrap\jquery\jquery.js"></script>
  <link rel="stylesheet" href="bootstrap\css\bootstrap.css">
  <script src="bootstrap\js\bootstrap.bundle.js"></script>
  <link rel="stylesheet" href="css/request.css">
  <script src="bootstrap\sweetalert\sweetalert.js"></script>
</head>

<body>
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
        <li><a href="dashboard.php"><i class="fas fa-tools"></i>Home</a></li>
        <li><a href="student_info.php"><i class="fas fa-tools"></i>Student Information</a></li>
        <li><a href="add_book.php"><i class="fas fa-tools"></i>Add Books</a></li>
        <li><a href="reqmain.php"><i class="fas fa-tools"></i>Request Maintenance</a></li>
        <li><a href="../login.php"><i class="fas fa-tools"></i>Log Out</a></li>
      </ul>
    </div>
  </label>

  <!--request modal-->
  <div class="modal fade" id="request" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="requestLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="requestLabel">Request Maintenance</h1>
        </div>
        <form action="request.php" method="POST">
          <div class="modal-body">
            <div class="form-group mb-3">
              <input type="text" name="name" class="form-control" placeholder="Surname, First Name M.I" required>
            </div>
            <div class="form-group mb-3">
              <input type="text" name="vehicletype" class="form-control" placeholder="Vehicle Type" required>
            </div>
            <div class="form-group mb-3">
              <input type="hidden" name="id" class="form-control" placeholder="Request Number" required>
            </div>
            <div class="form-group mb-3">
              <input type="date" name="datereq" class="form-control" placeholder="Date Requested" required>
            </div>
            <div class="form-group mb-3">
              <input type="text" name="description" class="form-control" placeholder="Vehicle Status" required>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" name="request_maintenance" class="btn btn-primary">Request Maintenance</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!--request modal-->

  <!--view modal-->
  <div class="modal fade" id="viewrequestdata" tabindex="-1" aria-labelledby="viewrequestdataLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="viewrequestdataLabel">View Information</h1>
        </div>
        <div class="modal-body">
          <div class="view_request_data"></div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
  <!--view modal-->

  <!--edit modal-->
  <div class="modal fade" id="editdata" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editdataLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="editdataLabel">Edit information</h1>
        </div>
        <form action="request.php" method="POST">
          <div class="modal-body">
            <div class="form-group mb-3">
              <input type="text" name="name" id="name" class="form-control" placeholder="Surname, First Name M.I">
            </div>
            <div class="form-group mb-3">
              <input type="text" name="vehicletype" id="vehicletype" class="form-control" placeholder="Vehicle Type">
            </div>
            <div class="form-group mb-3">
              <input type="hidden" name="id" id="id" class="form-control" placeholder="Request Number">
            </div>
            <div class="form-group mb-3">
              <input type="date" name="datereq" id="datereq" class="form-control" placeholder="Date Requested">
            </div>
            <div class="form-group mb-3">
              <input type="text" name="description" id="description" class="form-control" placeholder="Vehicle Status">
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" name="update_info" class="btn btn-primary">Update</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!--edit modal-->

  <!--delete-->
  <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          Are you sure you want to delete this request?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <form id="deleteForm" method="POST">
            <input type="hidden" id="delete_request_id" name="request_id">
            <button type="submit" name="confirm_delete_btn" class="btn btn-danger">Confirm</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!--delete-->




  <?php
  if (isset($_SESSION['status']) && is_array($_SESSION['status'])) {
    $status_message = $_SESSION['status']['message'];
    $status_class = $_SESSION['status']['class'];
  ?>
    <div class="alert <?php echo $status_class; ?> alert-dismissible fade show" role="alert">
      <strong>Hey!</strong> <?php echo $status_message; ?>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  <?php
    unset($_SESSION['status']);
  }
  ?>
  <div class="container">
    <div class="row mt-5">
      <div class="col">
        <div class="card mt-2">
          <div class="card-header">
            <h2 class="text-center display-7">Request Maintenance</h2>
            <div class="request-button">
              <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#request">Request</button>
              <form class="d-flex search-form" role="search">
                <input class="form-control me-2" type="search" placeholder="Search..." aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
              </form>
            </div>
          </div>
          <div class="card-body">
            <table class="table table-bordered text-center">
              <thead>
                <tr>
                  <th class="bg-dark text-white col-sm-1">Request Number</th>
                  <th class="bg-dark text-white col-sm-1">Name</th>
                  <th class="bg-dark text-white col-sm-1">Vehicle Type</th>
                  <th class="bg-dark text-white col-sm-1">Date Requested</th>
                  <th class="bg-dark text-white col-sm-1">Operation</th>
                </tr>
              </thead>
              <tr>
              <tr id="noRequestFoundRow" style="display: none;">
                <td colspan="5">No request found.</td>
              </tr>
              <?php
              while ($row = mysqli_fetch_assoc($result)) {
              ?>

                <td class="request_id"><?php echo $row['id']; ?></td>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['vehicletype']; ?></td>
                <td><?php echo $row['datereq']; ?></td>
                <td>
                  <a href="#" class="btn btn-info text-center btn-sm view_data">View</a>
                  <a href="#" class="btn btn-success text-center btn-sm edit_data">Edit</a>
                  <a href="#" class="btn btn-danger text-center btn-sm delete_btn">Delete</a>
                </td>
                </tr>

              <?php
              }
              ?>

            </table>
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
  </script>

  <script>
    /*view data*/
    $(document).ready(function() {
      $('.view_data').click(function(e) {
        e.preventDefault();

        var request_id = $(this).closest('tr').find('.request_id').text();

        $.ajax({
          method: "POST",
          url: "config/connections.php",
          data: {
            'click_view_btn': true,
            'request_id': request_id,
          },
          success: function(response) {
            $('.view_request_data').html(response)
            $('#viewrequestdata').modal('show');
          }
        });
      });
    });
    /*view data*/

    /*edit data*/
    $(document).ready(function() {
      $('.edit_data').click(function(e) {
        e.preventDefault();

        var request_id = $(this).closest('tr').find('.request_id').text();
        console.log(request_id);

        $.ajax({
          method: "POST",
          url: "config/connections.php",
          data: {
            'click_edit_btn': true,
            'request_id': request_id,
          },
          success: function(response) {

            $.each(response, function(key, value) {

              $('#name').val(value['name']);
              $('#vehicletype').val(value['vehicletype']);
              $('#id').val(value['id']);
              $('#datereq').val(value['datereq']);
              $('#description').val(value['description']);
            });
            $('#editdata').modal('show');
          }
        });
      });
    });
    /*edit data*/

    /*delete data*/
    $(document).ready(function() {
      $('.delete_btn').click(function(e) {
        e.preventDefault();
        var request_id = $(this).closest('tr').find('.request_id').text();
        $('#delete_request_id').val(request_id);
        $('#deleteModal').modal('show');
      });

      $('#deleteForm').submit(function(e) {
        e.preventDefault();
        var request_id = $('#delete_request_id').val();
        $.ajax({
          method: "POST",
          url: "request.php",
          data: {
            'confirm_delete_btn': true,
            'request_id': request_id,
          },
          success: function(response) {
            location.reload();
          }
        });
      });
    });
    /*delete data*/

    /*search data*/
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
          $('#noRequestFoundRow').show();
        } else {
          $('#noRequestFoundRow').hide();
        }
      });
    });
  </script>

</html>