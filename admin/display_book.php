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
                        <h2 class="text-center display-7">Display Book</h2>
                        <div class="search-button">
                            <form class="d-flex search-form" role="search">
                                <input class="form-control me-2" type="search" placeholder="Search..." aria-label="Search">
                                <button class="btn btn-outline-success" type="submit"><i class="fas fa-search"></i></button>
                            </form>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="display_book.php" method="POST" enctype="multipart/form-data">
                            <div style="max-height: 500px; overflow: auto;">
                                <table class='table table-bordered text-center'>
                                    <thead>
                                        <tr>
                                            <th class="text-white col-sm-1" style="background-color: #1f2a41;">Book's Image</th>
                                            <th class="text-white col-sm-1" style="background-color: #1f2a41;">Book's Name</th>
                                            <th class="text-white col-sm-1" style="background-color: #1f2a41;">Author's Name</th>
                                            <th class="text-white col-sm-1" style="background-color: #1f2a41;">Publication</th>
                                            <th class="text-white col-sm-1" style="background-color: #1f2a41;">Price <br> (PHP)</th>
                                            <th class="text-white col-sm-1" style="background-color: #1f2a41;">Quality</th>
                                            <th class="text-white col-sm-1" style="background-color: #1f2a41;">Total Books</th>
                                            <th class="text-white col-sm-1" style="background-color: #1f2a41;">Available Books</th>
                                            <th class="text-white col-sm-1" style="background-color: #1f2a41;">Student with this Book</th>
                                        </tr>
                                    </thead>
                                    <tr id="noSearchFoundRow" style="display: none;">
                                        <td colspan="10">
                                            <div class='text-center text-danger'>No record found.</div>
                                        </td>
                                    </tr>
                                    </tr>
                                    <tbody>
                                        <?php
                                        $res = mysqli_query($connections, "SELECT * FROM add_book");
                                        if (mysqli_num_rows($res) > 0) {
                                            while ($row = mysqli_fetch_array($res)) {
                                                echo "<tr>";
                                                echo "<td><img src='" . $row["book_image"] . "' height='100' width='100'></td>";
                                                echo "<td>" . $row["book_name"] . "</td>";
                                                echo "<td>" . $row["author_name"] . "</td>";
                                                echo "<td>" . $row["publication"] . "</td>";
                                                echo "<td>" . $row["price"] . "</td>";
                                                echo "<td>" . $row["quality"] . "</td>";
                                                echo "<td>" . $row["book_total"] . "</td>";
                                                echo "<td>" . $row["available_quantity"] . "</td>";
                                                echo "<td>" ?>
                                                <a href="student_with_book.php?book_name=<?php echo $row['book_name'];?>" style='text-decoration: none;'>View</a>
                                                <?php "</td>";
                                                echo "</tr>";
                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table>
                        </form>
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