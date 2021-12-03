<?php 
    $server = "localhost";
    $user = "M.Tejeda";
    $pass = "VMRb98bq";
    $db = "phpParents";
    $con = new mysqli($server, $user, $pass, $db);
    if ($con -> connect_error){
      die("connection error:" .$con->$connect_error);
    }
    
?>