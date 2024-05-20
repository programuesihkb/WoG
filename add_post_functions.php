<?php
include "database-connection.php";

header('Content-Type: application/json');
error_reporting(0);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $description = $_POST['description'];
    $title = $_POST['title'];
    $userName = $_POST['userName'];

    if ($description === '' || $userName === '' || $title === '') {
        echo json_encode(['success' => false, 'message' => 'Ndodhi nje problem!']);
        exit();
    }

    $description = mysqli_real_escape_string($connection, $description);
    $title = mysqli_real_escape_string($connection, $title);
    $userName = mysqli_real_escape_string($connection, $userName);

    $user_id_query = "SELECT user_id FROM user WHERE username = '{$userName}'";
    $user_id_response = mysqli_query($connection, $user_id_query);
    if (!$user_id_response || mysqli_num_rows($user_id_response) === 0) {
        echo json_encode(['success' => false, 'message' => 'User not found']);
        exit();
    }
    $user_id_row = mysqli_fetch_assoc($user_id_response);
    $user_id_value = $user_id_row['user_id'];

    $sql_add_post = "INSERT INTO post (post_name, post_status, description, post_date, user_id) VALUES ('$title', 'published', '$description', NOW(), '$user_id_value')";

    if (mysqli_query($connection, $sql_add_post)) {
        $post_id = mysqli_insert_id($connection);

        if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
            $file = $_FILES['image'];
            $file_name = $file['name'];
            $file_tmp = $file['tmp_name'];
            $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
            $allowed_ext = ['jpg', 'jpeg', 'png', 'gif'];

            if (in_array($file_ext, $allowed_ext)) {
                $new_file_name = uniqid() . '.' . $file_ext;
                $upload_path = "imagesForWebsite/" . $new_file_name;

                if (move_uploaded_file($file_tmp, $upload_path)) {
                    $sql_add_post_media = "INSERT INTO multimedia (media_data, post_id) VALUES ('$upload_path', '$post_id')";
                    if (mysqli_query($connection, $sql_add_post_media)) {
                        echo json_encode(['success' => true, 'message' => 'Post added successfully']);
                    } else {
                        echo json_encode(['success' => false, 'message' => 'Error occurred while adding post media']);
                    }
                } else {
                    echo json_encode(['success' => false, 'message' => 'Failed to move uploaded file']);
                }
            } else {
                echo json_encode(['success' => false, 'message' => 'Invalid file type']);
            }
        } else {
            echo json_encode(['success' => true, 'message' => 'Post added successfully without image']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Error occurred while adding post']);
    }
    exit();
}
?>
