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
        // Update password query
        $update_stmt = $con->prepare("UPDATE User SET password = ? WHERE email = ?");
        $update_stmt->bind_param("ss", $newpassword, $email);
        
        // Execute update query
        if ($update_stmt->execute()) {
            $_SESSION['msg1'] = "Password Changed Successfully !!";
            // Redirect to a confirmation page
            header("Location: login_page.html");
            exit();
        } else {
            $_SESSION['msg1'] = "Error updating password: " . $update_stmt->error;
        }

        $update_stmt->close();
    } else {
        $_SESSION['msg1'] = "Database connection error: " . $con->connect_error;
    }

    $con->close();
} else {
    $_SESSION['msg1'] = "Unauthorized access.";
    header("Location: login_page.html"); // Redirect unauthorized users
    exit();
}
?>
