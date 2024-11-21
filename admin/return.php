<?php
require_once("config/connections.php");
require_once("config/btnfunc.php");

if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $a = date("Y-m-d");

    $stmt = $connections->prepare("UPDATE issue_book SET return_date = ? WHERE id = ?");
    $stmt->bind_param("si", $a, $id);

    // if student  return book it will increse.
    $book_name = "";
    $res = mysqli_query($connections, "SELECT * FROM issue_book WHERE id=$id");
    while ($row = mysqli_fetch_array($res)) {
        $book_name = $row['book_name'];
    }
    mysqli_query($connections, "UPDATE add_book SET available_quantity=available_quantity+1 WHERE book_name='$book_name'");

    if ($stmt->execute()) {
        header("Location: return_book.php");
        exit();
    }
}