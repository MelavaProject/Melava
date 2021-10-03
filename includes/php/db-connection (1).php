<?php
    $host = "localhost";
    $user = "adidg_W92";
    $password = "987654";
    $db = "adidg_SadnaW92";
    
    $conn = new mysqli($host, $user, $password, $db);
    $conn->query("SET NAMES 'utf8'");

    if ($conn -> connection_error) {
        die("Connection failed: ".$conn -> connection_error);
    }
    
    if (!$conn->set_charset("utf8")) {
        printf("Error loading character set utf8: %s\n", $connection->error);
        exit();
    }
?>