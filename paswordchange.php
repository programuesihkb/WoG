<?php
session_start();
include("database-connection.php");

if(isset($_POST['Submit'])) {
    // Get the username from the session array
    $username = $_SESSION['user']['username'];
    
    // Debug information
    echo "Accessing user: " . $username . "<br>";

    $oldpass = md5($_POST['opwd']);
    $newpassword = md5($_POST['npwd']);

    // Prepare the SELECT statement
    $query = 'SELECT * FROM user WHERE username = ?';
    $stmt = mysqli_prepare($connection, $query);
    if (!$stmt) {
        die('Error preparing SELECT statement: ' . mysqli_error($connection)); // Handle the error appropriately
    }

    // Bind parameters and execute the statement
    mysqli_stmt_bind_param($stmt, 's', $username);
    
    // Execute the statement
    $result = mysqli_stmt_execute($stmt);
    if (!$result) {
        die('Error executing SELECT statement: ' . mysqli_error($connection)); // Handle the error appropriately
    }

    // Get the result set
    $result_set = mysqli_stmt_get_result($stmt);
    $user = mysqli_fetch_assoc($result_set);

    // Debug: Check if user exists and display user data
    if ($user) {
        echo "User found:<br>";
        var_dump($user);
    } else {
        echo "User not found.<br>";
    }

    // Check if the password field is set and is a string
    if (isset($user['password']) && is_string($user['password'])) {
        // Check if the old password matches
        if (md5($_POST['opwd']) === $user['password']) {
            // Debug: Print username and new password
            echo "Username: " . $username . "<br>";
            echo "New Password: " . $newpassword . "<br>";

            // Prepare the UPDATE statement
            $update_stmt = $connection->prepare("UPDATE user SET password = ? WHERE username = ?");
            $update_stmt->bind_param("ss", $newpassword, $username);

            // Execute the UPDATE statement
            if ($update_stmt->execute()) {
                echo "Password update successful!<br>";
                $_SESSION['msg1'] = "Password Changed Successfully !!";
                header("Location: login_page.html"); // Redirect to login_page.html
                exit();
            } else {
                echo "Error updating password: " . mysqli_error($connection) . "<br>";
                $_SESSION['msg1'] = "Error updating password.";
            }
            $update_stmt->close(); // Close the update statement
        } else {
            $_SESSION['msg1'] = "Old Password does not match !!";
        }
    } else {
        $_SESSION['msg1'] = "Password not set for the user.";
    }

    // Close the prepared statement
    mysqli_stmt_close($stmt);
}

// Close the database connection
$connection->close();
?>
