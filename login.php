<?php

include "database-connection.php";

header('Content-Type: application/json');
error_reporting(0);

$username = isset($_POST['username']) ? trim($_POST['username']) : '';
$password = isset($_POST['password']) ? trim($_POST['password']) : '';

if ($username === '' || $password === '') {
    echo json_encode(['success' => false, 'message' => 'Username or password cannot be empty']);
    exit();
}

$username = htmlspecialchars($username, ENT_QUOTES, 'UTF-8');
$password = htmlspecialchars($password, ENT_QUOTES, 'UTF-8');

if ($username === 'user_test' && $password === '12345') {
    session_start();
    $_SESSION["user"] = $username;
    session_regenerate_id();

    echo json_encode(['success' => true]);
    exit();
} else {
    echo json_encode(['success' => false, 'message' => 'Wrong username or password']);
    exit();
}

?>
