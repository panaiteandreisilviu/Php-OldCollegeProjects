<?php
include 'databaseConnect.php';

function clean_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    $data = mysqli_real_escape_string($GLOBALS['database_connection'], $data);
    return $data;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {


    $firstname = clean_input($_POST["firstname"]);
    $lastname = clean_input($_POST["lastname"]);
    $username = clean_input($_POST["username"]);
    $password = clean_input($_POST["password"]);

    $password = hash('sha256', $password);


    $query_check = mysqli_query($GLOBALS['database_connection'], "SELECT * FROM usercredentials WHERE `username` = '$username'");
    echo mysqli_error($GLOBALS['database_connection']);

    $row = mysqli_fetch_array($query_check);
    if (isset($row)) {
        $response['success'] = false;
    } else {

        $query = mysqli_query($GLOBALS['database_connection'], "INSERT INTO usercredentials (`username`, `password`, `first_name`, `last_name`,`userType`)
													VALUES ('$username', '$password', '$firstname', '$lastname','2')");

        echo mysqli_error($GLOBALS['database_connection']);
        $response['success'] = true;
    }

    $response = json_encode($response);
    exit($response);
}

?>