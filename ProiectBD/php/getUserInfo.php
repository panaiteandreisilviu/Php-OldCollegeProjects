<?php

include 'databaseConnect.php';

$username = $_POST['username'];

$query = mysqli_query($database_connection, "SELECT U.username,U.first_name,U.last_name FROM usercredentials As U WHERE `username` = '$username' ");
$row = mysqli_fetch_all($query,MYSQLI_ASSOC);
echo(json_encode($row));

mysqli_close($database_connection);
