<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post Detail</title>
</head>
<body>
    <div class="container">
        <div class="row">
            <?php
    
            include "database-connection.php";

            // Get the post_id from the URL parameter
            $post_id = $_GET['post_id'];

            // Fetch the post details from the database
            $sqlPostDetail = "SELECT p.*, m.media_data, GROUP_CONCAT(g.genre_name) AS genre_names 
            FROM Post p 
            LEFT JOIN Multimedia m ON p.post_id = m.post_id
            LEFT JOIN Post_Genre pg ON p.post_id = pg.post_id
            LEFT JOIN Genre g ON pg.genre_id = g.genre_id
            WHERE p.post_id = $post_id
            GROUP BY p.post_id, m.media_data";
            $resultPostDetail = mysqli_query($connection, $sqlPostDetail);

            if (!$resultPostDetail) {
                die("Error in SQL query: " . mysqli_error($connection));
            }

            // Fetch post details from the result
            $row = mysqli_fetch_assoc($resultPostDetail);

            // Output post details
            echo "<h2>" . $row['post_name'] . "</h2>";
            echo "<p><strong>Description:</strong> " . $row['description'] . "</p>";
            echo "<p><strong>Genre:</strong> " . $row['genre_names'] . "</p>";
            // Output multimedia data if available
            if (!empty($row['media_data'])) {
                echo "<img src='" . $row['media_data'] . "' alt='Post Image'>";
            } else {
                echo "<p>No image available</p>";
            }
            ?>
        </div>
    </div>
</body>
</html>
