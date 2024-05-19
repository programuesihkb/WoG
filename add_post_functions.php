<?php

include "database-connection.php";

header('Content-Type: application/json');
error_reporting(0);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $imageUrl = $_REQUEST['imageUrl'];
    $description = $_REQUEST['description'];
    $title = $_REQUEST['title'];
    $userName = $_REQUEST['userName'];

    if ($imageUrl === '' || $description === '' || $userName === '' || $title === '') {
        echo json_encode(['success' => false, 'message' => 'Ndodhi nje problem!']);
        exit();
    }

    $imageUrl = mysqli_real_escape_string($connection, $imageUrl);
    $description = mysqli_real_escape_string($connection, $description);
    $title = mysqli_real_escape_string($connection, $title);
    $userName = mysqli_real_escape_string($connection, $userName);

    $user_id_query = "SELECT user_id FROM user WHERE username = {$userName}";
    $user_id_response = mysqli_query($connection, $user_id_query);
    $user_id_row = mysqli_fetch_assoc($user_id_response);
    $user_id_value = $user_id_row['user_id'];

    $sql_add_post = "INSERT INTO post (post_name, post_status, description, post_date, user_id) VALUES ('$title', 'published', '$description', NOW(), '$user_id_value')";

    if(mysqli_query($connection, $sql_add_post)) {
        $post_id = mysqli_insert_id($connection);

        $sql_add_post_media = "INSERT INTO multimedia (media_data, post_id) VALUES ('$imageUrl', '$post_id')";
        if(mysqli_query($connection, $sql_add_post_media)) {
            echo json_encode(['success' => true, 'message' => 'Post added successfully']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error occurred while adding post media']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Error occurred while adding post']);
    }
    exit();
}

?>