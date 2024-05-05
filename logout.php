<?php

session_destroy();
// echo "U have logout (not really)"
header("Location:login_page.html");
exit;
?>