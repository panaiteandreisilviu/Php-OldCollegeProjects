
<?php

session_start();

function start_session($row)
{
    $_SESSION['LOGGED_IN'] = true;
    $_SESSION['USERNAME'] = $row[0];
    $_SESSION['NUME'] = $row[2];
    $_SESSION['PRENUME'] = $row[3];
}

include 'databaseConnect.php';
$username = $password = "";
$userError = $passwordError = "";
$row = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = clean_input($_POST["username"]);
    $password = clean_input($_POST["password"]);
    $angajatLogin =  clean_input($_POST["isAngajat"]);
    $hashedPassword = hash('sha256',$password);

    if($angajatLogin == "false"){
        $query = mysqli_query($database_connection, "SELECT * FROM client WHERE `username` = '$username' AND `password` = '$hashedPassword' ");
        $row = mysqli_fetch_array($query);
        $response['usertype'] = "2";
    }

    else{
        $query = mysqli_query($database_connection, "SELECT * FROM angajat WHERE `username` = '$username' AND `password` = '$hashedPassword' ");
        $row = mysqli_fetch_array($query);
        $response['usertype'] = $row[6];
    }


    if ($row) {
        start_session($row);

        $response['success'] = true;
        $response['UserID'] = $row[0];
        $response['user'] = $row[4];
        $response['firstname'] = $row[1];
        $response['lastname'] = $row[2];

    } else {
        $response['success'] = false;
    }


    $response = json_encode($response);
    exit($response);


}

function clean_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    $data = mysqli_real_escape_string($GLOBALS['database_connection'],$data);
    return $data;
}

?>