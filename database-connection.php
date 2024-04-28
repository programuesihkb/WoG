<?php
  include "database-include.php";

$connection = mysqli_connect(DBHOST,DBUSER,DBPASS,DBNAME);
$error = mysqli_connect_error();
if($error != null){
  header('Content-Type: application/json');
  $output = ["success" => false, "message" => "Unable to connect to database"];
  echo json_encode($output);
  exit();    
} 
    
?>