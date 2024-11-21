<?php
require_once("config/connections.php");
require_once("config/btnfunc.php");
include("header.php");
$current_time = date("H:i");
?>

<!DOCTYPE html>
<html lang="en">
<body>
    <div class="container">
        <div class="row mt-5">
            <div class="col">
                <div class="card mt-2">
                    <div class="card-header">
                        <h2 class="text-center display-7">Send Message</h2>
                    </div>
                    <div class="card-body">
                        <div style="max-height: 400px; overflow: auto;">
                            <form name="form1" action="" method="post" class="col-lg-10" enctype="multipart/form-data">
                                <table class="table table-bordered">
                                    <tr>
                                        <td>
                                            <select name="dusername" class="form-control selectpicker">
                                                <?php
                                                $res = mysqli_query($connections, "SELECT * FROM student_registration");
                                                while ($row = mysqli_fetch_array($res)) {
                                                    echo "<option value='" . $row['id'] . "'>"
                                                        . $row['id'] . " - " . $row['studentname'] . "</option>";
                                                }
                                                ?>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <input type="text" class="form-control" placeholder="Enter Title" name="title" required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <textarea name="msg" class="form-control" placeholder="Message..." required></textarea>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <input type="time" name="time" class="form-control" value="<?php echo $current_time; ?>" required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <input type="submit" value="Send" name="submit1" class="btn btn-default"
                                                style="background-color: #1f2a41; color: white;">
                                        </td>
                                    </tr>
                                </table>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

<?php
if (isset($_POST["submit1"])) {
    $time = $_POST['time'];
    $res = mysqli_query($connections, "
    INSERT INTO message_tbl (susername, dusername, title, msg, time, read_msg)
    VALUES ('{$_SESSION['email']}', '{$_POST['dusername']}', '{$_POST['title']}', '{$_POST['msg']}', '$time', 'n')
    ");
?>
    <script type="text/javascript">
        alert("Message sent successfully!");
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