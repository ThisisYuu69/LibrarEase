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
                        <h2 class="text-center display-7">Library Book</h2>
                        <div class="search-button">
                            <form class="d-flex search-form" role="search">
                                <input class="form-control me-2" type="search" placeholder="Search..." aria-label="Search">
                                <button class="btn btn-outline-success" type="submit"><i class="fas fa-search"></i></button>
                            </form>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="display_book.php" method="POST" enctype="multipart/form-data">
                            <div class="row g-3 table-container" style="max-height: 500px; overflow-y: auto;">
                                <?php
                                $res = mysqli_query($connections, "SELECT * FROM add_book");
                                if (mysqli_num_rows($res) > 0) {
                                    while ($row = mysqli_fetch_array($res)) {
                                        echo "<div class='col-md-4 search-item'>";
                                        echo "<div class='card'>";
                                        echo "<img src='../admin/" . $row["book_image"] . "' class='card-img-top img-fluid' style='height: auto; max-height: 400px;'>";
                                        echo "<div class='card-body text-center'>";
                                        echo "<strong>" . $row["book_name"] . "</strong><br>";
                                        echo "Available: " . $row["available_quantity"];
                                        echo "</div></div>";
                                        echo "</div>";
                                    }
                                }
                                ?>
                            </div>
                            <div class="text-center text-danger" id="noSearchFoundRow" style="display: none;">
                                No record found.
                            </div>
                        </form>
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
    $(document).ready(function() {
        $('form.search-form').submit(function(e) {
            e.preventDefault();

            var searchQuery = $(this).find('input[type=search]').val().toLowerCase();
            var found = false;

            $('.search-item').each(function() {
                var cardText = $(this).text().toLowerCase();
                if (cardText.indexOf(searchQuery) === -1) {
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
</script>
</html>