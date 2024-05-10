<?php
session_start();
include("database-connection.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $json = file_get_contents('php://input');
    $formData = json_decode($json, true);

    $username = mysqli_real_escape_string($connection, $_SESSION['user']['username']);
    $oldpass = mysqli_real_escape_string($connection, $formData['opwd']);
    $newpassword = mysqli_real_escape_string($connection, $formData['npwd']);
    $confirmpassword = mysqli_real_escape_string($connection, $formData['cpwd']);

    $hashed_password = password_hash($newpassword, PASSWORD_DEFAULT);

    $query = 'SELECT * FROM user WHERE username = ?';
    $stmt = mysqli_prepare($connection, $query);
    mysqli_stmt_bind_param($stmt, 's', $username);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $user = mysqli_fetch_assoc($result);

    if ($user) {
        if (password_verify($oldpass, $user['password'])) {
            $update_stmt = $connection->prepare("UPDATE user SET password = ? WHERE username = ?");
            $update_stmt->bind_param("ss", $hashed_password, $username);
            if ($update_stmt->execute()) {
                $_SESSION['msg1'] = "Password Changed Successfully !!";
                session_destroy();
                 header("Location:login_page.html");
exit();
            } else {
                $_SESSION['msg1'] = "Error updating password.";
            }
            $update_stmt->close();
        } else {
            $_SESSION['msg1'] = "Old Password does not match !!";
        }
    } else {
        $_SESSION['msg1'] = "User not found.";
    }

    mysqli_stmt_close($stmt);
}

$connection->close();
?>
