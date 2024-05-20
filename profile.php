<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        .profile-icon {
            font-size: 8rem;
            margin-right: 10px;
        }
        .btn-logout {
            background-color: red;
            color: white;
        }
        .btn-logout:hover {
            background-color: red; 
            color: white; 
        }
    </style>
</head>
<body>
<?php 
include "header.php";
if (isset($_SESSION['user']) && isset($_SESSION['username'])) {
?>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h2><i class="bi bi-person-circle profile-icon"></i><?php echo $_SESSION['username']; ?></h2>
                <form action="logout.php" method="post" onsubmit="clearLocalStorage()">
                    <button type="submit" name="logout" class="btn btn-logout mb-3"><i class="bi bi-box-arrow-right"></i> Logout</button>
                </form>
                <a href="passwordchange.html" class="btn btn-secondary mb-3"><i class="bi bi-key"></i> Change Password</a>
            </div>
        </div>
    <h3>My Posts</h3>
        <div class="row row-cols-1 row-cols-md-5">
        
            <?php
        function renderPost($post) {
            $html = "<div class='col-md-3 mb-4'>";
            $html .= "<div class='card' style='background-color: #173518;'>";
            $html .= "<a href='post_detail.php?post_id=" . $post['post_id'] . "'>";
            if (!empty($post['media_data'])) {
                $html .= "<img class='card-img-top' style='border-radius: 15px; max-height: 200px; object-fit: contain;' src='" . $post['media_data'] . "' alt='Post Image'>";
            } else {
                $html .= "<p class='card-text text-white opacity-95'>No image available</p>";
            }
            $html .= "<div class='card-body' style='height: 80px;'>";
            $html .= "<p class='card-text text-white opacity-95'>" . $post['post_name'] . "</p>";
            $html .= "</div></a>";
        
            $html .= "<div class=' mt-1 mb-1 ml-2'>"; 
        
            $html .= "<a href='edit_post.php?post_id=" . $post['post_id'] . "' class='btn btn-primary btn-sm me-2 btn-lg'>Edit</a>";
            $html .= "<a href='delete_post.php?post_id=" . $post['post_id'] . "' class='btn btn-danger btn-sm btn-lg'>Delete</a>"; 
        
            $html .= "</div>"; 
        
            $html .= "</div></div>";
        
            return $html;
        }
        
        
        
        function getPosts($connection, $username) {
                    
                        $sqlUserId = "SELECT user_id FROM User WHERE username = '$username'";
                        $resultUserId = mysqli_query($connection, $sqlUserId);

                        if (!$resultUserId) {
                            die("Error in SQL query: " . mysqli_error($connection));
                        }

                        $rowUserId = mysqli_fetch_assoc($resultUserId);
                        $userId = $rowUserId['user_id'];

                    
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
                            WHERE p.user_id = $userId
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

            $username = $_SESSION['username'];
            $posts = getPosts($connection, $username);
            foreach ($posts as $post) {
                echo renderPost($post);
            }
            ?>
        </div>
    </div>
<?php
    } else {
?>
    <div class="container">
        <p>You are not signed in. <a href="login_page.html">Login</a> to view your profile.</p>
    </div>
<?php }?>

<?php 
include "footer.php"; 
?>

<script>
    function clearLocalStorage() {
        localStorage.clear();
    }
</script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></>
</body>
</html>
