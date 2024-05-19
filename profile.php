<!DOCTYPE html>
<html>
<head>
    <title>Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        .profile-icon {
            font-size: 8rem;
            margin-right: 10px;
        }
        .btn-logout {
            background-color: red;
            color: white;
        }
        .btn-logout:hover {
            background-color: red; 
            color: white; 
        }
    </style>
</head>
<body>

<?php 
include "header.php";

if (isset($_SESSION['user']) && isset($_SESSION['username'])) {
    ?>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h2><i class="bi bi-person-circle profile-icon"></i><?php echo $_SESSION['username']; ?></h2>
                <form action="logout.php" method="post" onsubmit="clearLocalStorage()">
                    <button type="submit" name="logout" class="btn btn-logout mb-3"><i class="bi bi-box-arrow-right"></i> Logout</button>
                </form>
                <a href="passwordchange.html" class="btn btn-secondary mb-3"><i class="bi bi-key"></i> Change Password</a>
            </div>
        </div>
    </div>
    <?php
} else {
    ?>
    <div class="container">
        <p>You are not signed in. <a href="login_page.html">Login</a> to view your profile.</p>
    </div>
    <?php
}

include "footer.php"; 
?>

<script>
    function clearLocalStorage() {
        localStorage.clear();
    }
</script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></>
</body>
</html>
