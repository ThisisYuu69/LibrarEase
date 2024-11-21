<?php
require_once("config/connections.php");
require_once("config/btnfunc.php");
include("header.php");
?>
<!DOCTYPE html>
<html lang="en">
    
<body>
    <div class="container d-flex justify-content-center">
        <div class="row mt-5">
            <div class="col">
                <div class="card mt-2">
                    <div class="card-header">
                        <h2 class="text-center display-7">Add Book</h2>
                    </div>
                    <div class="card-body">
                        <form name="form1" action="" method="post" class="col-lg-10" enctype="multipart/form-data">
                            <table class="table table-bordered">
                                <tr id="noRequestFoundRow" style="display: none;">
                                    <td colspan="10">No record found.</td>
                                </tr>
                                <tr>
                                    <td>
                                        <input type="text" class="form-control" placeholder="book name" name="book_name">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <input type="file" placeholder="f1" name="f1">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <input type="text" class="form-control" placeholder="Author Name" name="author_name" required>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <input type="text" class="form-control" placeholder="Publication" name="publication" required>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <input type="text" class="form-control" placeholder="Purchase Date" name="purchase_date" required>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <input type="text" class="form-control" placeholder="Price" name="price" required>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <input type="text" class="form-control" placeholder="Quality" name="quality" required>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <input type="text" class="form-control" placeholder="Available Quantity" name="available_quantity" required>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <input type="text" class="form-control" placeholder="Total Books" name="book_total" required>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <input type="submit" name="submit1" class="btn btn-outline-success" value="insert book details">
                                    </td>
                                </tr>
                            </table>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
    if (isset($_POST["submit1"])) {
        $tm = md5(time());
        $fnm = $_FILES["f1"]["name"];
        $dst = "./book_image/" . $tm . $fnm;
        $dst1 = "book_image/" . $tm . $fnm;

        move_uploaded_file($_FILES["f1"]["tmp_name"], $dst);

        $book_name = mysqli_real_escape_string($connections, $_POST['book_name']);
        $author_name = mysqli_real_escape_string($connections, $_POST['author_name']);
        $publication = mysqli_real_escape_string($connections, $_POST['publication']);
        $purchase_date = mysqli_real_escape_string($connections, $_POST['purchase_date']);
        $bprice = mysqli_real_escape_string($connections, $_POST['price']);
        $quality = mysqli_real_escape_string($connections, $_POST['quality']);
        $book_total = mysqli_real_escape_string($connections, $_POST['book_total']);
        $available_quantity = mysqli_real_escape_string($connections, $_POST['available_quantity']);

        $query = "INSERT INTO add_book (book_name, book_image, author_name, publication, purchase_date, price, quality, book_total, available_quantity)
                  VALUES ('$book_name', '$dst1', '$author_name', '$publication', '$purchase_date', '$bprice', '$quality', '$book_total', '$available_quantity')";

        if (mysqli_query($connections, $query)) {
            echo "<script type='text/javascript'>alert('Book inserted successfully!');</script>";
        } else {
            echo "Error: " . mysqli_error($connections);
        }
    }
    ?>
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