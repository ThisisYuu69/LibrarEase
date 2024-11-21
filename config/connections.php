<?php
    $connections = mysqli_connect("localhost:3307", "root", "", "lms");
    if(mysqli_connect_errno()){

    echo"Failed to connect in mySQL:", mysqli_connect_error();
    }
    else{
        echo"";
    }
?>