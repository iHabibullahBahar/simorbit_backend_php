<?php
    $servername = "localhost";
    // $username = "chat_shower";
    // $password = "7Vdz7^42a";
    // $dbname = "notundeal_db";
    $username = "root";
    $password = "";
    $dbname = "simorbit_db";
    // Create connection
    $conn =  mysqli_connect($servername, $username, $password,$dbname);
    if(!$conn){
        die("Connection failed: " . mysqli_connect_error());
    }
?>