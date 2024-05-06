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

    $sql_check_emailAndUsername = "SELECT COUNT(*) AS count FROM user WHERE email = '$email' OR username = '$username'";
    $result_emailAndUsername = $connection->query($sql_check_emailAndUsername);
    $result_emailAndUsername_count = $result_emailAndUsername->fetch_assoc();

    if ($result_emailAndUsername_count['count'] > 0) {
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

    $sql_add_user =  "INSERT INTO user (username, email, password, status, registration_date, date_of_birth, profile_picture) VALUES ('$username', '$email', '$hash', true, NOW(), '$dateOfBirth', '')";
    
    if(mysqli_query($connection, $sql_add_user)) {
        $_SESSION['username'] = $username;
        $_SESSION['email'] = $email;

        echo json_encode(['success' => true, 'message' => 'User added successfully']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error occurred while adding user']);
    }
    exit();
}

?>