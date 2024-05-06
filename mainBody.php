<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<div class="container">
        <div class="row">
            <?php
            // // Include database connection code
            // include "database-include.php";

            // // Connect to the database
            // $connection = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);

            // // Check for connection errors
            // $error = mysqli_connect_error();
            // if ($error != null) {
            //     $output = "<p>Unable to connect to database<p>" . $error;
            //     exit($output);
            // }

            // Fetch posts from the Post table along with multimedia data
            $sqlPosts = "SELECT p.*, m.media_data, GROUP_CONCAT(g.genre_name) AS genre_names 
            FROM Post p 
            LEFT JOIN Multimedia m ON p.post_id = m.post_id
            LEFT JOIN Post_Genre pg ON p.post_id = pg.post_id
            LEFT JOIN Genre g ON pg.genre_id = g.genre_id
            GROUP BY p.post_id, m.media_data";
        $resultPosts = mysqli_query($connection, $sqlPosts);

        // Check if query execution was successful
if (!$resultPosts) {
    die("Error in SQL query: " . mysqli_error($connection));
}
        // Loop through each fetched post and display them
        while ($row = mysqli_fetch_assoc($resultPosts)) {
            echo "<div class='col-md-4'>";
            echo "<a href='post_detail.php?post_id=" . $row['post_id'] . "'>";
            echo "<div class='thumbnail'>";
            // Display post image if available
            if (!empty($row['media_data'])) {
                echo "<img src='" . $row['media_data'] . "' alt='Post Image'>";
            } else {
                echo "<p>No image available</p>";
            }
            echo "<div class='caption'>";
            echo "<h3>" . $row['post_name'] . "</h3>";
            echo "</div></div></a></div>";
        }
            ?>
        </div>
    </div>

</body>
</html>