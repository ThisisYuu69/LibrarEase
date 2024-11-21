<?php
session_start();
include("config/connections.php");

/*request*/
if (isset($_POST['request_maintenance'])) {
  $name = $_POST['name'];
  $vehicletype = $_POST['vehicletype'];
  $id = $_POST['id'];
  $datereq = $_POST['datereq'];
  $description = $_POST['description'];

  $sql = "INSERT INTO reqmain_tbl (name, vehicletype, id, datereq, description) VALUES (?, ?, ?, ?, ?)";
  $stmt = mysqli_prepare($connections, $sql);
  mysqli_stmt_bind_param($stmt, "sssss", $name, $vehicletype, $id, $datereq, $description);

  if (mysqli_stmt_execute($stmt)) {
    $_SESSION['status'] = array(
      'message' => "You've successfully requested.",
      'class' => 'text-success'
    );
    header('location: reqmain.php');
  } else {
    $_SESSION['status'] = array(
      'message' => "You've failed to request.",
      'class' => 'text-danger'
    );
    header('location: reqmain.php');
  }
}
/*request*/

/*update*/
if (isset($_POST['update_info'])) {
  $id = $_POST['id'];
  $name = $_POST['name'];
  $vehicletype = $_POST['vehicletype'];
  $datereq = $_POST['datereq'];
  $description = $_POST['description'];

  $existing_data_query = "SELECT * FROM reqmain_tbl WHERE id = ?";
  $stmt_existing = mysqli_prepare($connections, $existing_data_query);
  mysqli_stmt_bind_param($stmt_existing, "s", $id);
  mysqli_stmt_execute($stmt_existing);
  $existing_data_result = mysqli_stmt_get_result($stmt_existing);
  $existing_data = mysqli_fetch_assoc($existing_data_result);

  if ($existing_data['name'] == $name && $existing_data['vehicletype'] == $vehicletype && $existing_data['datereq'] == $datereq && $existing_data['description'] == $description) {
    $_SESSION['status'] = array(
      'message' => "No changes were made.",
      'class' => 'text-danger'
    );
    header('location: reqmain.php');
    exit();
  }

  $sql = "UPDATE reqmain_tbl SET name=?, vehicletype=?, datereq=?, description=? WHERE id=?";
  $stmt = mysqli_prepare($connections, $sql);
  mysqli_stmt_bind_param($stmt, "sssss", $name, $vehicletype, $datereq, $description, $id);

  if (mysqli_stmt_execute($stmt)) {
    $_SESSION['status'] = array(
      'message' => "You've successfully updated the information.",
      'class' => 'text-success'
    );
    header('location: reqmain.php');
  } else {
    $_SESSION['status'] = array(
      'message' => "You've failde to updated the information.",
      'class' => 'text-danger'
    );
    header('location: reqmain.php');
    exit();
  }
}
/*update*/

/*delete*/
if (isset($_POST['confirm_delete_btn'])) {
  $id = $_POST['request_id'];

  $delete_query = "DELETE FROM reqmain_tbl WHERE id = '$id'";
  $delete_query_run = mysqli_query($connections, $delete_query);

  if ($delete_query_run) {
    $_SESSION['status'] = array(
      'message' => "You've successfully deleted the request.",
      'class' => 'text-success'
    );
    header('location: reqmain.php');
  } else {
    $_SESSION['status'] = array(
      'message' => "You've failed to delete the request.",
      'class' => 'text-danger'
    );
    header('location: reqmain.php');
  }
}
/*delete*/
?>