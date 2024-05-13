<?php

session_start();


include "database-connection.php";


$maxLoginAttempts = 3;


$lockoutDuration = 15 * 60;


if (isset($_SESSION['lockout_end_time']) && $_SESSION['lockout_end_time'] > time()) {
   
    $remainingLockoutTime = $_SESSION['lockout_end_time'] - time();
    echo json_encode(['success' => false, 'message' => "You have exceeded the maximum number of login attempts. Please try again after $remainingLockoutTime seconds."]);
    exit();
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {


    // // Elions test code
    // if ($_POST['request_type'] == 'google_user_auth') {
    //     $user_data = $_POST['user_data'];
    //     $username = $user_data['name'];
    //     $email = $user_data['email'];
    //     $profile_picture = $user_data['imageUrl'];

    //     // Check if user already exists
    //     $query = 'SELECT * FROM user WHERE username = ?';
    //     $stmt = mysqli_prepare($connection, $query);
    //     mysqli_stmt_bind_param($stmt, 's', $username);
    //     mysqli_stmt_execute($stmt);
    //     $result = mysqli_stmt_get_result($stmt);
    //     $user = mysqli_fetch_assoc($result);

    //     if (!$user) {
    //         // Insert new user into database
    //         $query = 'INSERT INTO user (username, email, profile_picture) VALUES (?, ?, ?)';
    //         $stmt = mysqli_prepare($connection, $query);
    //         mysqli_stmt_bind_param($stmt, 'sss', $username, $email, $profile_picture);
    //         mysqli_stmt_execute($stmt);
    //     }

    //     $_SESSION['user'] = $user_data;
    //     session_regenerate_id();
    //     echo json_encode(['success' => true]);
    //     exit();
    // }
    // //End Elion test code

    
    $username = isset($_POST['username']) ? $_POST['username'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    
    if ($username === '' || $password === '') {
        echo json_encode(['success' => false, 'message' => 'Username or password cannot be empty']);
        exit();
    }
      
    $username = mysqli_real_escape_string($connection, $username);
    $password = mysqli_real_escape_string($connection, $password);
    
    $query = 'SELECT * FROM user WHERE username = ?';
    $stmt = mysqli_prepare($connection, $query);
    if (!$stmt) {
        die('Error: ' . mysqli_error($connection)); 
    }
    mysqli_stmt_bind_param($stmt, 's', $username);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $user = mysqli_fetch_assoc($result);

   
    if ($user && password_verify($password, $user['password'])) {

        $user_query = "SELECT user_id, email FROM user WHERE username = '$username'";
        $user_response = mysqli_query($connection, $user_query);
        $user_row = mysqli_fetch_assoc($result);

        $user_role = "SELECT role_name AS roleName
                      FROM role
                      INNER JOIN user_role ON role.role_id = user_role.role_id
                      INNER JOIN user ON user_role.user_id = user.user_id
                      WHERE user.user_id = '{$user_row['user_id']}'";

        $_SESSION['login_attempts'] = 0;
        $_SESSION['user'] = true;
        $_SESSION['username'] = $username;
        $_SESSION['email'] = $user_row['email'];
        $_SESSION['user_role'] = $user_role;
        
        session_regenerate_id();
        echo json_encode(['success' => true]);
        exit();
    } else {
        
        $_SESSION['login_attempts'] = isset($_SESSION['login_attempts']) ? $_SESSION['login_attempts'] + 1 : 1;
        if ($_SESSION['login_attempts'] >= $maxLoginAttempts) {
            $_SESSION['lockout_end_time'] = time() + $lockoutDuration;
            echo json_encode(['success' => false, 'message' => 'You have exceeded the maximum number of login attempts']);
            exit();
        }
        echo json_encode(['success' => false, 'message' => 'Wrong username or password']);
        exit();
    }
}

mysqli_close($connection);
?>