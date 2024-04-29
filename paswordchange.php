<?php
session_start();
include("database-connection.php");

if(isset($_POST['Submit'])) {
    $oldpass = md5($_POST['opwd']);
    $useremail = $_SESSION['login'];
    $newpassword = md5($_POST['npwd']);
    
    $stmt = $con->prepare("SELECT password FROM userinfo WHERE email = ?");
    $stmt->bind_param("s", $useremail);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    if ($row) {
        if (md5($_POST['opwd']) === $row['password']) {
            $update_stmt = $con->prepare("UPDATE userinfo SET password = ? WHERE email = ?");
            $update_stmt->bind_param("ss", $newpassword, $useremail);
            if ($update_stmt->execute()) {
                $_SESSION['msg1'] = "Password Changed Successfully !!";
                header("Location: login_page.html"); // Redirect to login_page.html
                exit();
            } else {
                $_SESSION['msg1'] = "Error updating password.";
            }
        } else {
            $_SESSION['msg1'] = "Old Password does not match !!";
        }
    } else {
        $_SESSION['msg1'] = "User not found.";
    }

    $stmt->close();
    $update_stmt->close();
}

$con->close();
?>
