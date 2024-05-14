<?php   
    include "database-connection.php";
    $post_id = $_GET['post_id'];

    // Delete associated rows in Multimedia table
    $sql = "DELETE FROM Multimedia WHERE post_id = $post_id";
    $result = mysqli_query($connection, $sql);
    if (!$result) {
        die("Error in SQL query: " . mysqli_error($connection));
    }

    // Delete row in Post table
    $sql = "DELETE FROM Post WHERE post_id = $post_id";
    $result = mysqli_query($connection, $sql);
    if (!$result) {
        die("Error in SQL query: " . mysqli_error($connection));
    }

    header("Location: profile.php");
    exit();
?>