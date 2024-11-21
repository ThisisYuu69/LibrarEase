<?php
require_once("connections.php");

function display_data()
{
    global $connections;
    $query = "SELECT * FROM reqmain_tbl";
    $result = mysqli_query($connections, $query);
    return $result;
}
?>