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
        $_SESSION['login_attempts'] = 0;
        $_SESSION['user'] = $user;
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