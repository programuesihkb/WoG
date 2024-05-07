<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <style>
      body{
        background-color: rgba(0, 0, 0, 0.95) !important;
      } 
      #section1 {
        background-image: url("imagesForWebsite/background2.jpg");
        background-position: top;
        background-size: 100vw; /* Add this line */
        background-repeat: no-repeat; /* Add this line */
        filter: blur(0.5);
        backface-visibility: 0.5;
        background-color: rgba(0, 0, 0, 0.85) !important;
      }
      .container{
        padding-top: 56px;
      }
      /* img {
        width: 250px; 
        height: auto; 
        border: 2px solid blue;
      } */
      h5 {
        color: white /*!important*/;
        font-size: 18px;
        font-weight: bold;
        font-family: Arial, sans-serif;
        text-align: left;
        opacity: 0.8;
      }
      .card-box{
        border-radius: 100px;
        /* background-clip: padding-box; /* for IE9+, Firefox 4+, Opera, Chrome */
      }
    
    </style>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css"
      rel="stylesheet"/>
</head>
<body>

<!-- //component -->
<section id="section1"> 
  <div class="container">
    <div class="row row-cols-3 justify-content-between"> 
        <?php
          function getPosts($connection) {
              $sqlPosts = "
                  SELECT p.*, 
                      m.media_data, 
                      GROUP_CONCAT(g.genre_name) AS genre_names, 
                      u.username AS published_by 
                  FROM Post p 
                  LEFT JOIN Multimedia m ON p.post_id = m.post_id
                  LEFT JOIN Post_Genre pg ON p.post_id = pg.post_id
                  LEFT JOIN Genre g ON pg.genre_id = g.genre_id
                  LEFT JOIN User u ON p.user_id = u.user_id
                  GROUP BY p.post_id, m.media_data, p.post_name, p.description, p.post_date, u.username
              ";
              $resultPosts = mysqli_query($connection, $sqlPosts);

              if (!$resultPosts) {
                  die("Error in SQL query: " . mysqli_error($connection));
              }

              $posts = [];
              while ($row = mysqli_fetch_assoc($resultPosts)) {
                  $posts[] = $row;
              }

              return $posts;
          }
 
          function renderPost($post) {
              $html = "<div class='card card-box column m-4' style='width: 18rem; background-color:
              #173518;'>";
              $html .= "<a href='post_detail.php?post_id=" . $post['post_id'] . "'>";
              
              if (!empty($post['media_data'])) {
                  $html .= "<img class='card-img-top mt-3' style='border-radius:15px;' src='" . $post['media_data'] . "' alt='Post Image'>";
              } else {
                  $html .= "<p>No image available</p>";
              }

              $html .= "<div class='card-body'>";
              
              $html .= "<p class='card-text text-white opacity-95'>" . $post['post_name'] . "</p>";
              $html .= "</div> </a>  </div>";

              return $html;
          }

          $posts = getPosts($connection);
          foreach ($posts as $post) {
              echo renderPost($post);
          }
          ?>
        </div>
  </div>
</section>       

  <!-- Bootstrap -->
  <script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"
  ></script>
</body>
</html>