<?php
    $servername = "localhost";
    $nama = "";
    $username = "root";
    $password = "";
    $dbname = "loginclinic";

    $mysqli = new mysqli($servername, $username, $password, $dbname);

    if ($mysqli->connect_error) {
        echo "Failed to connect to MySQL: " . $mysqli->connect_error;
        exit();
    }
?>