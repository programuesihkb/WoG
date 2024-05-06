<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
        background-image: url("imagesForWebsite/b3.jpg");
        background-size: contain;
        background-position: top;
        background-attachment: fixed;
        filter: blur(0.5);
      }
      .container{
        padding-top: 56px;
      }
      img {
        width: 250px; 
        height: auto; 
        border: 2px solid blue;
      }
      h5 {
        color: white /*!important*/;
        font-size: 18px;
        font-weight: bold;
        font-family: Arial, sans-serif;
        text-align: left;
        opacity: 0.8;
      }
    
    </style>
</head>
<body>
<div class="container">
        <div class="row">
            <?php
        
            $sqlPosts = "SELECT p.*, 
            m.media_data, 
            GROUP_CONCAT(g.genre_name) AS genre_names, 
            u.username AS published_by 
     FROM Post p 
     LEFT JOIN Multimedia m ON p.post_id = m.post_id
     LEFT JOIN Post_Genre pg ON p.post_id = pg.post_id
     LEFT JOIN Genre g ON pg.genre_id = g.genre_id
     LEFT JOIN User u ON p.user_id = u.user_id
     GROUP BY p.post_id, m.media_data, p.post_name, p.description, p.post_date, u.username";
        $resultPosts = mysqli_query($connection, $sqlPosts);

 
if (!$resultPosts) {
    die("Error in SQL query: " . mysqli_error($connection));
}

        while ($row = mysqli_fetch_assoc($resultPosts)) {
            echo "<div class='col-md-4'>";
            echo "<a href='post_detail.php?post_id=" . $row['post_id'] . "'>";
            echo "<div class='thumbnail'>";

            if (!empty($row['media_data'])) {
                echo "<img src='" . $row['media_data'] . "' alt='Post Image'>";
            } else {
                echo "<p>No image available</p>";
            }
            echo "<div class='caption'>";
            echo "<h5>" . $row['post_name'] . "</h5>";
            echo "</div></div></a></div>";
        }
            ?>
        </div>
    </div>

</body>
</html>