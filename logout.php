<?php
session_start();
session_destroy();
// echo "U have logout (not really)"
header("Location:login_page.html");
exit;
?>