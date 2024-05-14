<?php
session_start(); 
include "header.php";

if(isset($_GET['post_id'])) {
    $post_id = mysqli_real_escape_string($connection, $_GET['post_id']);

    $sqlPostDetail = "SELECT p.*, m.media_data FROM Post p LEFT JOIN Multimedia m ON p.post_id = m.post_id WHERE p.post_id = '$post_id'";
    $resultPostDetail = mysqli_query($connection, $sqlPostDetail);

    if (!$resultPostDetail) {
        die("Error in SQL query: " . mysqli_error($connection));
    }

    $post = mysqli_fetch_assoc($resultPostDetail);

    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $updated_post_name = mysqli_real_escape_string($connection, $_POST['post_name']);
        $updated_description = mysqli_real_escape_string($connection, $_POST['description']);

        if(isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
            $file_name = $_FILES['image']['name'];
            $file_tmp = $_FILES['image']['tmp_name'];
        
            move_uploaded_file($file_tmp, "imagesForWebsite/" . $file_name);
        
          
            $sqlUpdateMedia = "UPDATE multimedia SET media_data = 'imagesForWebsite/$file_name' WHERE post_id = '$post_id'";
            $resultUpdateMedia = mysqli_query($connection, $sqlUpdateMedia);
        
            if(!$resultUpdateMedia) {
                die("Error in SQL query: " . mysqli_error($connection));
            }
        
            $sqlUpdatePost = "UPDATE post SET post_name = '$updated_post_name', description = '$updated_description' WHERE post_id = '$post_id'";
        } else {
            $sqlUpdatePost = "UPDATE post SET post_name = '$updated_post_name', description = '$updated_description' WHERE post_id = '$post_id'";
        }
        
        $resultUpdatePost = mysqli_query($connection, $sqlUpdatePost);
        
        if(!$resultUpdatePost) {
            die("Error in SQL query: " . mysqli_error($connection));
        }
        
        header("Location: profile.php");
        exit();
        
    }
}

?>
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <h2>Edit Post</h2>
            <form action="" method="POST" enctype="multipart/form-data"> 
                <div class="mb-3">
                    <label for="post_name" class="form-label">Post Name</label>
                    <input type="text" class="form-control" id="post_name" name="post_name" value="<?php echo $post['post_name']; ?>">
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="3"><?php echo $post['description']; ?></textarea>
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label">Current Image</label><br>
                    <?php if(!empty($post['media_data'])): ?>
                        <img src="<?php echo $post['media_data']; ?>" alt="Current Image" style="max-width: 100px;">
                    <?php else: ?>
                        <p>No image available</p>
                    <?php endif; ?>
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label">Change the image</label>
                    <input type="file" class="form-control" id="image" name="image">
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="profile.php" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>
