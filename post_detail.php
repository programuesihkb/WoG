<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post Detail</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="post.css">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <?php
                include "database-connection.php";
                $post_id = $_GET['post_id'];

                $sqlPostDetail = "SELECT p.*, 
                m.media_data, 
                GROUP_CONCAT(g.genre_name) AS genre_names, 
                u.username AS published_by 
             FROM Post p 
                LEFT JOIN Multimedia m ON p.post_id = m.post_id
                LEFT JOIN Post_Genre pg ON p.post_id = pg.post_id
                LEFT JOIN Genre g ON pg.genre_id = g.genre_id
                LEFT JOIN User u ON p.user_id = u.user_id
                WHERE p.post_id = $post_id
                GROUP BY p.post_id, p.post_name, p.description, p.post_date, u.username, m.media_data";
                $resultPostDetail = mysqli_query($connection, $sqlPostDetail);

                if (!$resultPostDetail) {
                    die("Error in SQL query: " . mysqli_error($connection));
                }


                $row = mysqli_fetch_assoc($resultPostDetail);

                echo "<h2>" . $row['post_name'] . "</h2>";
                echo "<p><strong>Published by:</strong> " . $row['published_by'] . "</p>";
                echo "<p><strong>Published on:</strong> " . $row['post_date'] . "</p>";
                echo "<p><strong>Genre:</strong> " . $row['genre_names'] . "</p>";
                echo "<p><strong>Description:</strong> " . $row['description'] . "</p>";
            
                if (!empty($row['media_data'])) {
                    echo "<img src='" . $row['media_data'] . "' alt='Post Image' class='img-fluid'>";
                } else {
                    echo "<p>No image available</p>";
                }
                ?>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
