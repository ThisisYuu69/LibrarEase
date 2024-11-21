<?php
$connections = mysqli_connect("localhost:3307", "root", "", "lms");
if (mysqli_connect_errno()) {

    echo "Failed to connect in mySQL:", mysqli_connect_error();
} else {
    echo "";
}
/* view data */
if (isset($_POST['click_view_btn'])) {
    $id = $_POST['request_id'];

    $query = "SELECT * FROM reqmain_tbl WHERE id = '$id'";
    $query_run = mysqli_query($connections, $query);

    if (mysqli_num_rows($query_run) > 0) {
        while ($row = mysqli_fetch_array($query_run)) {
            echo '
             <h6>Request Number: ' . $row['id'] . '</h6>
             <h6>Name: ' . $row['name'] . '</h6>
             <h6>Vehicle Type: ' . $row['vehicletype'] . '</h6>
             <h6>Date Requested: ' . $row['datereq'] . '</h6>
             <h6>Vehicle Status: ' . $row['description'] . '</h6>
             ';
        }
    } else {
        echo '<h4>No record found.</h4>';
    }
}
/* view data */

/* edit data */
if (isset($_POST['click_edit_btn'])) {
    $id = $_POST['request_id'];
    $arrayresult = [];

    $query = "SELECT * FROM reqmain_tbl WHERE id = '$id'";
    $query_run = mysqli_query($connections, $query);

    if (mysqli_num_rows($query_run) > 0) {
        while ($row = mysqli_fetch_array($query_run)) {
            array_push($arrayresult, $row);
            header('content-type: application/json');
            echo json_encode($arrayresult);
        }
    } else {
        echo '<h4>No record found.</h4>';
    }
}
/* edit data */


?>