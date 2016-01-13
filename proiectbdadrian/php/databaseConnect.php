<?php

$username = "root";
$password = "dbpassword";
$database = "salon";
$database_connection = mysqli_connect("localhost", $username, $password, $database);
if (mysqli_connect_errno()) {
    echo "<br> <br> <br> <br>";
    die("Connection failed: " . mysqli_connect_error());
}