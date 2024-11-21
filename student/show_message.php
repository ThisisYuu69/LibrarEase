<?php
require_once("config/connections.php");
require_once("config/btnfunc.php");
include("header.php");
$res = mysqli_query($connections, "UPDATE message_tbl SET read_msg='y' WHERE dusername='$_SESSION[student_id]'");
?>
<!DOCTYPE html>
<html lang="en">
<body>
    <div class="container">
        <div class="row mt-5">
            <div class="col">
                <div class="card mt-2">
                    <div class="card-header">
                        <h2 class="text-center display-7">Messages</h2>
                    </div>
                    <div class="card-body">
                        <div style="max-height: 400px; overflow: auto;">
                            <table class="table table-bordered">
                                <tr>
                                    <th class="text-white col-sm-1" style="background-color: #1f2a41;">Name</th>
                                    <th class="text-white col-sm-1" style="background-color: #1f2a41;">Title</th>
                                    <th class="text-white col-sm-1" style="background-color: #1f2a41;">Message</th>
                                    <th class="text-white col-sm-1" style="background-color: #1f2a41;">Time</th>
                                </tr>

                                <?php
                                $res = mysqli_query($connections, "SELECT * FROM message_tbl WHERE dusername='$_SESSION[student_id]'
                                ORDER BY id DESC");
                                while ($row = mysqli_fetch_array($res)) {
                                    $res1 = mysqli_query($connections, "SELECT * FROM admin_tbl WHERE email='$row[susername]'");
                                    while ($row1 = mysqli_fetch_array($res1)) {
                                        echo "<tr>";
                                        echo "<td>" . $row1['email'] . "</td>";
                                        echo "<td>" . $row['title'] . "</td>";
                                        echo "<td>" . $row['msg'] . "</td>";
                                        echo "<td>" . $row['time'] . "</td>";
                                        echo "</tr>";
                                    }
                                }
                                ?>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

<?php
if (isset($_POST["submit1"])) {
    $res = mysqli_query($connections, "
    INSERT INTO message_tbl (susername, dusername, title, msg, read_msg)
    VALUES ('{$_SESSION['email']}', '{$_POST['dusername']}', '{$_POST['title']}', '{$_POST['msg']}', 'n')
");
?>
    <script type="text/javascript">
        alert("Message sent successfully!")
        window.location.href = window.location.href;
    </script>
<?php

}
?>

<footer>
    <p>
        <a href="#"><i class="fas fa-globe"></i>&nbsp; LibrarEase Management Group</a> &nbsp; &nbsp;
        <a href="#"><i class="fas fa-mobile-phone"></i>&nbsp; (02) 8543-1234</a> &nbsp; &nbsp;
        <a href="#"><i class="fas fa-envelope"></i>&nbsp; librarease@gmail.com</a>
    </p>
    <p>&copy; 2024 Library Management System</p>
</footer>
</html>