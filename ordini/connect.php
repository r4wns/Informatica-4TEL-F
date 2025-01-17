<?php
    $user = "root"
    $pass = "root"
    $server = "localhost" //127.0.0.1
    $dbName = "restaurant"

    $conn = new mysqli($user, $pass, $server, $dbName)

    if($conn->connect_error)
    {
        die("Error 500. Database not found.")
    }
?>