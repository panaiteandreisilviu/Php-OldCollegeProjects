<?php

include 'databaseConnect.php';

if($_POST['query'] == "servicii"){
    $query = mysqli_query($database_connection,
        "SELECT s.Denumire as Serviciu ,S.Durata , S.Pret from serviciu as S
  INNER JOIN categorie as C
    on s.ID_CATEGORIE = c.ID_CATEGORIE AND c.ID_CATEGORIE = '1");
}

else if($_POST['query'] == "getCategorii"){
    $query = mysqli_query($database_connection,
        "SELECT ID_CATEGORIE as ID , Denumire as Nume from categorie");
}

if($query){
    $row = mysqli_fetch_all($query, MYSQLI_ASSOC);
    $keys = array_keys($row[0]);
    $data[0] = $keys;
    $data[1] = $row;
    echo json_encode($data);
}

mysqli_close($database_connection);