<?php
   //database connection
    $conn = new mysqli('localhost','root','','project_portal');

    if($conn->connect_error)
    {
        die('Connection failed: '.$conn->connect_error);
    }
?>