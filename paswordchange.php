<?php
session_start();
include("database-connection.php");

if(isset($_POST['Submit'])) {
    $username = $_SESSION['user']['username'];
    $oldpass = $_POST['opwd'];
    $newpassword = $_POST['npwd'];
    $confirmpassword = $_POST['cpwd'];

    
    $query = 'SELECT * FROM user WHERE username = ?';
    $stmt = mysqli_prepare($connection, $query);
    mysqli_stmt_bind_param($stmt, 's', $username);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $user = mysqli_fetch_assoc($result);

    if ($user) {
        if ( $user['password']) {
            $update_stmt = $connection->prepare("UPDATE user SET password = ? WHERE username = ?");
            $update_stmt->bind_param("ss", $newpassword, $username);
            if ($update_stmt->execute()) {
                $_SESSION['msg1'] = "Password Changed Successfully !!";
                header("Location: login_page.html");
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
