<?php
session_start();
include("database-connection.php");

if(isset($_SESSION['login']) && isset($_POST['Submit'])) {
    // Check if the user is logged in
    $email = $_SESSION['login'];
    $oldpass = md5($_POST['opwd']);
    $newpassword = md5($_POST['npwd']);
    
    // Check if the database connection is established
    if ($con) {
        $stmt = $con->prepare("SELECT password FROM userinfo WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        if ($row) {
            if (md5($_POST['opwd']) === $row['password']) {
                $update_stmt = $con->prepare("UPDATE userinfo SET password = ? WHERE email = ?");
                $update_stmt->bind_param("ss", $newpassword, $email);
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
    } else {
        $_SESSION['msg1'] = "Database connection error.";
    }

    $con->close();
} else {
    $_SESSION['msg1'] = "Unauthorized access.";
    header("Location: login_page.html"); // Redirect unauthorized users
    exit();
}
?>
