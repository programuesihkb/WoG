<?php

include "database-connection.php";

header('Content-Type: application/json');
error_reporting(0);

// $username = isset($_POST['username']) ? trim($_POST['username']) : '';
// $dateOfBirth = isset($_POST['dateOfBirth']) ? trim($_POST['dateOfBirth']) : '';
// $email = isset($_POST['email']) ? trim($_POST['email']) : '';
// $password = isset($_POST['password']) ? trim($_POST['password']) : '';
// $confirmPassword = isset($_POST['confirmPassword']) ? trim($_POST['confirmPassword']) : '';

// echo "Username: $username<br>";
// echo "Email: $email<br>";
// echo "Password: $password<br>";
// echo "Confirm Password: $confirmPassword<br>";
// echo "Date of Birth: $dateOfBirth<br>";

$username = $_REQUEST['username'];
$dateOfBirth = $_REQUEST['dateOfBirth'];
$email = $_REQUEST['email'];
$password = $_REQUEST['password'];
$confirmPassword = $_REQUEST['confirmPassword'];

if ($username === '' || $password === '' || $email === '') {
    echo json_encode(['success' => false, 'message' => 'Username or password cannot be empty']);
    exit();
}

$username = htmlspecialchars($username, ENT_QUOTES, 'UTF-8');
$dateOfBirth = htmlspecialchars($dateOfBirth, ENT_QUOTES, 'UTF-8');
$email = htmlspecialchars($email, ENT_QUOTES, 'UTF-8');
$password = htmlspecialchars($password, ENT_QUOTES, 'UTF-8');
$confirmPassword = htmlspecialchars($confirmPassword, ENT_QUOTES, 'UTF-8');

// $stmt = $pdo->prepare("SELECT COUNT(*) AS count FROM user WHERE email = ?");
// $stmt->execute([$email]);
// $count = $stmt->fetchColumn();

$sql_check_email = "SELECT COUNT(*) AS count FROM user WHERE email = $email";
$result_email_count = $connection->query($sql_check_email);

if ($count > 0) {
    echo json_encode(['success' => false, 'message' => 'Email already exists']);
    exit();
}

if ($password !== $confirmPassword) {
    echo json_encode(['success' => false, 'message' => 'Passwords do not match'.$confirmPassword.' '.$password]);
    exit();
}

// $stmt = $pdo->prepare("INSERT INTO user (username, email, password, status, registration_date, date_of_birth, profile_picture) VALUES (?, ?, ?, 'active', NOW(), ?, '')");
// $result = $stmt->execute([$username, $email, $password, $dateOfBirth]);
// echo `$result`;
// if (!$result) {
//     echo json_encode(['success' => false, 'message' => 'Failed to create user']);
//     exit();
// }

$sql_add_user =  "INSERT INTO user (username, email, password, status, registration_date, date_of_birth, profile_picture) VALUES ('$username', '$email', '$password', true, NOW(), '$dateOfBirth', '')";
if(mysqli_query($connection, $sql_add_user)) {
    echo "<h3>User added successfully!</h3>";
} else {
    echo "Error: ".mysqli_error($connection);
}
echo json_encode(['success' => true]);
exit();

?>
