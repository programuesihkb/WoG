<?php

include "database-connection.php";

header('Content-Type: application/json');
error_reporting(0);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_REQUEST['username'];
    $dateOfBirth = $_REQUEST['dateOfBirth'];
    $email = $_REQUEST['email'];
    $password = $_REQUEST['password'];
    $confirmPassword = $_REQUEST['confirmPassword'];

    if ($username === '' || $password === '' || $email === '') {
        echo json_encode(['success' => false, 'message' => 'Username, email, or password cannot be empty']);
        exit();
    }

    $username = mysqli_real_escape_string($connection, $username);
    $dateOfBirth = mysqli_real_escape_string($connection, $dateOfBirth);
    $email = mysqli_real_escape_string($connection, $email);
    $password = mysqli_real_escape_string($connection, $password);
    $confirmPassword = mysqli_real_escape_string($connection, $confirmPassword);

    $sql_check_email = "SELECT COUNT(*) AS count FROM user WHERE email = '$email'";
    $result_email = $connection->query($sql_check_email);
    $result_email_count = $result_email->fetch_assoc();

    if ($result_email_count['count'] > 0) {
        echo json_encode(['success' => false, 'message' => 'Email already exists']);
        exit();
    }

    $sql_check_username = "SELECT COUNT(*) AS count FROM user WHERE username = '$username'";
    $result_username = $connection->query($sql_check_username);
    $result_username_count = $result_username->fetch_assoc();
    
    if ($result_username_count['count'] > 0) {
        echo json_encode(['success' => false, 'message' => 'Email or username already exists']);
        exit();
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(['success' => false, 'message' => 'Invalid email format']);
        exit();
    }

    if ($password !== $confirmPassword) {
        echo json_encode(['success' => false, 'message' => 'Passwords do not match']);
        exit();
    }

    session_start();

    $hash = password_hash($password, PASSWORD_DEFAULT); 
    $sql_add_user = "INSERT INTO user (username, email, password, status, registration_date, date_of_birth, profile_picture) VALUES ('$username', '$email', '$hash', true, NOW(), '$dateOfBirth', '')";
    
    if(mysqli_query($connection, $sql_add_user)) {
        $user_id = mysqli_insert_id($connection); // Get the ID of the newly inserted user
        
        // Now insert into user_role table
        $sql_add_role = "INSERT INTO user_role (user_id, role_id) VALUES ('$user_id', '1')";
        if(mysqli_query($connection, $sql_add_role)) {
            $_SESSION['user'] = true;
            $_SESSION['username'] = $username;
            $_SESSION['email'] = $email;
            $_SESSION['role'] = 'user';
    
            echo json_encode(['success' => true, 'message' => 'User added successfully']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error occurred while adding user role']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Error occurred while adding user']);
    }
    exit();
}

?>