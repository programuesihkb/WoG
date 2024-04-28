<?php
  include "database-include.php";


  function connect(){
    $mysqli = new mysqli(SERVER, USERNAME, PASSWORD, DATABASE);
    if($mysqli->connect_errno != 0){
        $error = $mysqli->connect_error;
        $errorDate = date('Y-m-d H:i:s');
        $message="{$error} | ${errorDate}\r\n";
       
       return false;
    } else{
        return $mysqli;
    }
}

$connection = mysqli_connect(DBHOST,DBUSER,DBPASS,DBNAME);
$error = mysqli_connect_error();
if($error != null){
     $output = "<p>Unable to connect to database<p>".$error;
     exit($output);    
}  
    
?>