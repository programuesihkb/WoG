<?php

session_start();

require_once "pdo_conn.php";

try {
 
    $pdo = new PDO($attr, $user, $pass, $opts);

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $maxLoginAttempts = 5;
    $lockoutDuration = 15 * 60;

    if (isset($_SESSION['lockout_end_time']) && $_SESSION['lockout_end_time'] > time()) {
        $remainingLockoutTime = $_SESSION['lockout_end_time'] - time();
        echo json_encode(['success' => false, 'message' => "You have exceeded the maximum number of login attempts. Please try again after $remainingLockoutTime seconds."]);
        exit();
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = isset($_POST['username']) ? trim($_POST['username']) : '';
        $password = isset($_POST['password']) ? trim($_POST['password']) : '';

        if ($username === '' || $password === '') {
            echo json_encode(['success' => false, 'message' => 'Username or password cannot be empty']);
            exit();
        }

        $query = 'SELECT user_id, username, password FROM users WHERE username = ?';
        $stmt = $pdo->prepare($query);
        $stmt->execute([$username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && $password === $user['password']) {
            $_SESSION['login_attempts'] = 0;
            $_SESSION['user'] = [
                'user_id' => $user['user_id'],
                'username' => $user['username']
            ];

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
} catch (PDOException $e) {
   
    echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
    exit();
} finally {
   
    $pdo = null;
}
