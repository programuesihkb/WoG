<?php   
    include "database-connection.php";
    $post_id = $_GET['post_id'];

     // Delete associated rows in post_genre table
     $sql = "DELETE FROM post_genre WHERE post_id = $post_id";
     $result = mysqli_query($connection, $sql);
     if (!$result) {
         die("Error in SQL query: " . mysqli_error($connection));
     }

    // Delete associated MultiMedia In Image Folder
    $sql = "SELECT media_data as media FROM Multimedia WHERE post_id = $post_id";
    $result = mysqli_query($connection, $sql);
    if (!$result) {
        die("Error in SQL query: " . mysqli_error($connection));
    } else {
        $row = mysqli_fetch_assoc($result);
        if ($row) {
            $file_path = $row['media'];

            if (file_exists($file_path)) {
                if (unlink($file_path)) {
                    echo "File deleted successfully.";
                } else {
                    echo "Error deleting the file.";
                }
            } else {
                echo "File does not exist.";
            }
        } else {
            echo "No media found for the specified post ID.";
        }
    }

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