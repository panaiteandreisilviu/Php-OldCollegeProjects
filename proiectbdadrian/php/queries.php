<?php

include 'databaseConnect.php';

if ($_POST['query'] == "servicii") {
    $query = mysqli_query($database_connection,
        "SELECT s.Denumire AS Serviciu ,S.Durata , S.Pret FROM serviciu AS S
  INNER JOIN categorie AS C
    ON s.ID_CATEGORIE = c.ID_CATEGORIE AND c.ID_CATEGORIE = '1");
} else if ($_POST['query'] == "getCategorii") {
    $query = mysqli_query($database_connection,
        "SELECT ID_CATEGORIE AS ID , Denumire AS Nume FROM categorie");
} else if ($_POST['query'] == "serviciiCategorii") {
    $query = mysqli_query($database_connection,
        "SELECT S.Denumire AS Serviciu , C.Denumire AS Categorie , CONCAT(S.Pret , ' lei') AS Pret ,
  CONCAT(S.Durata ,' min') AS Durata FROM categorie AS C
  INNER JOIN serviciu AS S
    ON S.ID_CATEGORIE = C.ID_CATEGORIE");
} else if ($_POST['query'] == "incasariUltimaLuna") {
    $query = mysqli_query($database_connection,
        "SELECT  CONCAT(SUM(S.Pret), ' ' , 'lei') AS Incasari
FROM client AS C
  INNER JOIN (SELECT * FROM programare AS P1
  WHERE P1.DataProgramare > (NOW()  - INTERVAL 1 MONTH)) AS P
    ON C.ID_CLIENT = P.ID_CLIENT
  INNER JOIN detalii_programare AS DP
    ON P.ID_PROGRAMARE = DP.ID_PROGRAMARE
  INNER JOIN serviciu AS S
    ON S.ID_SERVICIU = DP.ID_SERVICIU");
} else if ($_POST['query'] == "toateProgramarile") {
    $query = mysqli_query($database_connection,
        "SELECT P.ID_PROGRAMARE as ID_P , C.ID_CLIENT AS ID_C,C.Nume , C.Prenume , P.DataProgramare , P.Ora FROM programare AS P
  INNER  JOIN client AS C
    ON P.ID_CLIENT = C.ID_CLIENT
    ORDER BY P.DataProgramare");
} else if ($_POST['query'] == "programariPentruAngajat") {
    $angajat = $_POST['angajatid'];
    $query = mysqli_query($database_connection,
        "SELECT CONCAT(A.Nume, ' ' , A.Prenume) as Angajat , CONCAT(C.Nume, ' ' , C.Prenume) as Client , P.DataProgramare, P.Ora
FROM client C
  INNER JOIN (SELECT * FROM angajat AS A1
  WHERE A1.ID_ANGAJAT = $angajat) AS A
  INNER JOIN (SELECT * FROM programare as P1
  WHERE P1.DataProgramare > now()) AS P
    ON C.ID_CLIENT = P.ID_CLIENT
  INNER JOIN detalii_programare DP
    ON P.ID_PROGRAMARE = DP.ID_PROGRAMARE
GROUP BY Angajat , P.DataProgramare");
} else if ($_POST['query'] == "programariPentruClient") {
    $client = $_POST['clientid'];
    $query = mysqli_query($database_connection,
        "SELECT CONCAT(A.Nume, ' ' , A.Prenume) AS Angajat , CONCAT(C.Nume, ' ' , C.Prenume) AS Client , P.DataProgramare, P.Ora
FROM client C
  INNER JOIN (SELECT * FROM programare AS P1
  WHERE P1.DataProgramare > now()) AS P
    ON C.ID_CLIENT = P.ID_CLIENT AND C.ID_CLIENT = 2
  INNER JOIN detalii_programare DP
    ON P.ID_PROGRAMARE = DP.ID_PROGRAMARE
      INNER JOIN (SELECT * FROM angajat AS A1) AS A
      ON DP.ID_ANGAJAT = A.ID_ANGAJAT
GROUP BY Angajat , P.DataProgramare");
} else if ($_POST['query'] == "maxPretServiciuClient") {
    $query = mysqli_query($database_connection,
        "SELECT CONCAT(C.Nume , ' ' , C.Prenume) AS Nume,  MAX(S.Pret) AS Pret, S.Denumire
FROM client C
  INNER JOIN programare AS P
    ON C.ID_CLIENT=P.ID_CLIENT
  INNER JOIN detalii_programare AS DP
    ON P.ID_PROGRAMARE=DP.ID_PROGRAMARE
  INNER JOIN serviciu AS S
    ON S.ID_SERVICIU = DP.ID_SERVICIU
GROUP BY C.Nume");
} else if ($_POST['query'] == "angajatiMinuteLucrate") {
    $query = mysqli_query($database_connection,
        "SELECT CONCAT(A.Nume , ' ' , A.Prenume) AS 'Nume Angajat', SUM(S.Durata) AS `Minute Lucrate`
FROM client C
  INNER JOIN programare AS P
    ON C.ID_CLIENT=P.ID_CLIENT
  INNER JOIN detalii_programare AS DP
    ON P.ID_PROGRAMARE=DP.ID_PROGRAMARE
  INNER JOIN serviciu AS S
    ON S.ID_SERVICIU = DP.ID_SERVICIU
  INNER JOIN angajat AS A
    ON A.ID_ANGAJAT = DP.ID_ANGAJAT
GROUP BY `Nume Angajat`
ORDER BY `Minute Lucrate` DESC");
} else if ($_POST['query'] == "listaAngajatiNumarServicii") {
    $query = mysqli_query($database_connection,
        "SELECT A.Nume , a.Prenume , C.Denumire AS Specializare  ,COUNT(S.ID_CATEGORIE) AS 'Servicii disponibile'
FROM angajat AS A
  INNER JOIN categorie AS C
    ON a.ID_CATEGORIE = c.ID_CATEGORIE
  INNER JOIN serviciu AS S
    ON C.ID_CATEGORIE = S.ID_CATEGORIE
GROUP BY A.ID_ANGAJAT");
} else if ($_POST['query'] == "listaAngajati") {
    $query = mysqli_query($database_connection,
        "SELECT A.Nume , a.Prenume , C.Denumire AS Specializare
FROM angajat AS A
  INNER JOIN categorie AS C
    ON a.ID_CATEGORIE = c.ID_CATEGORIE
  INNER JOIN serviciu AS S
    ON C.ID_CATEGORIE = S.ID_CATEGORIE
GROUP BY A.ID_ANGAJAT");
} else if ($_POST['query'] == "cheltuieliAnualeClienti") {
    $query = mysqli_query($database_connection,
        "SELECT CONCAT(c.Nume , ' ' , c.Prenume) AS Client, SUM(S.Pret) AS 'Cheltuieli Anuale'
FROM client AS C
  INNER JOIN (SELECT * FROM programare AS P1
  WHERE  P1.DataProgramare > (NOW() - INTERVAL 1 YEAR )) AS P
    ON C.ID_CLIENT = P.ID_CLIENT
  INNER JOIN detalii_programare AS DP
    ON P.ID_PROGRAMARE = DP.ID_PROGRAMARE
  INNER JOIN serviciu AS S
    ON S.ID_SERVICIU = DP.ID_SERVICIU
GROUP BY Client");
} else if ($_POST['query'] == "toateProgramarileIntreDouaDate") {
    $date1 = $_POST['date1'];
    $date2 = $_POST['date2'];
    $query = mysqli_query($database_connection,
        "SELECT P.ID_PROGRAMARE as ID , CONCAT(c.Nume , ' ' , c.Prenume) AS Client ,P.DataProgramare , P.Ora FROM client AS C
  INNER JOIN (SELECT * FROM programare AS P1
  WHERE P1.DataProgramare BETWEEN CAST('" . $date1 . "' AS DATE) AND CAST('" . $date2 . "' AS DATE)) AS P
    ON C.ID_CLIENT = P.ID_CLIENT
    ORDER BY P.DataProgramare");
} else if ($_POST['query'] == "numarProgramariAngajati") {
    $query = mysqli_query($database_connection,
        "SELECT A.Nume, A.Prenume, COUNT(P.ID_PROGRAMARE) AS 'Numar Programari'
FROM angajat A
  INNER JOIN detalii_programare DP
    ON A.ID_ANGAJAT=DP.ID_ANGAJAT

  INNER JOIN (SELECT * FROM programare AS P1
  WHERE P1.DataProgramare<=(now()+ INTERVAL 10 DAY)) AS P
    ON P.ID_PROGRAMARE = DP.ID_PROGRAMARE
GROUP BY A.Nume");
} else if ($_POST['query'] == "listaClienti") {
    $query = mysqli_query($database_connection,
        "SELECT  C.ID_client AS ID, C.Nume, C.Prenume, C.Telefon, C.username , COUNT(P.ID_CLIENT) AS Programari
        FROM client C LEFT JOIN programare AS P
          ON C.ID_CLIENT = P.ID_CLIENT
        GROUP BY C.Nume, C.Prenume
        ORDER BY C.ID_CLIENT");
} else if ($_POST['query'] == "adaugareProgramare") {

    $id = $_POST['id'];
    $dataprogramare = $_POST['dataprogramare'];
    $oraprogramare = $_POST['oraprogramare'];
    $query = null;
    mysqli_query($database_connection, "INSERT INTO programare (ID_CLIENT, DataProgramare, Ora)
VALUES ('$id' ,'$dataprogramare' , '$oraprogramare')");



//    $query = mysqli_query($database_connection, "UPDATE consultation AS C SET C.DoctorID = '$doctorid',
//    C.PetID = '$petid' , C.ConsultationDate = '$date'
//    WHERE ConsultationID = '$id'");
//
} else if ($_POST['query'] == "editeazaProgramare") {
    $id = $_POST['id'];
    $dataprogramare = $_POST['dataprogramare'];
    $oraprogramare = $_POST['oraprogramare'];
    $query = null;
    mysqli_query($database_connection, "UPDATE  programare as P SET P.DataProgramare = '$dataprogramare' ,
P.Ora = '$oraprogramare' WHERE ID_PROGRAMARE = '$id'" );
}

else if ($_POST['query'] == "StergeProgramare") {
    $idcons = $_POST['idcons'];
    $query = null;
    mysqli_query($database_connection, "DELETE FROM programare WHERE ID_PROGRAMARE = '$idcons'");
}

else if ($_POST['query'] == "StergeClient") {
    $idClient = $_POST['idClient'];
    $query = null;
    mysqli_query($database_connection, "DELETE FROM client WHERE ID_CLIENT = '$idClient'");
}


if ($query) {
    $row = mysqli_fetch_all($query, MYSQLI_ASSOC);
    $keys = array_keys($row[0]);
    $data[0] = $keys;
    $data[1] = $row;
    echo json_encode($data);
}

mysqli_close($database_connection);