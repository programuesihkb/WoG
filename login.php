<?php
require "database-connection.php";
header('Content-Type: application/json');

$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

$mysqli = connect();

if (!$mysqli) {
    echo json_encode(['success' => false, 'message' => 'Database connection error']);
    exit;
}

$username = trim($username);
$password = trim($password);

if ($username == "" || $password == "") {
    echo json_encode(['success' => false, 'message' => 'Both fields are required']);
    exit;
}

$username = filter_var($username, FILTER_SANITIZE_STRING);
$password = filter_var($password, FILTER_SANITIZE_STRING);

$sql = 'SELECT username , password FROM users WHERE username = ?';
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$res = $stmt->get_result();
$data = $res->fetch_assoc();

if ($data == NULL) {
    echo json_encode(['success' => false, 'message' => 'Wrong username or password']);
    exit;
}

if (!password_verify($password, $data['password'])) {
    echo json_encode(['success' => false, 'message' => 'Wrong username or password']);
    exit;
}

session_start();
$_SESSION["user"] = $username;

echo json_encode(['success' => true]);
exit;
?>
