<?php

include 'databaseConnect.php';

if ($_POST['query'] == "allUsers") {
    $query = mysqli_query($database_connection,
        "SELECT U.username AS Username,U.first_name AS `First Name` , U.last_name AS `Last Name`,UT.type AS `User Type` FROM usercredentials U
  INNER JOIN usertypes UT
    ON U.userType = UT.userType");
} else if ($_POST['query'] == "allDoctors") {
    $query = mysqli_query($database_connection,
        "SELECT CONCAT(U.first_name , ' ' , U.last_name )AS `Name`,U.username AS `Username` ,COUNT(C.ConsultationID) AS Consultations
FROM usercredentials AS U INNER JOIN doctors AS D
    ON U.UserID = D.UserID
  LEFT JOIN consultation AS C
    ON D.DoctorID = C.DoctorID AND c.ConsultationDate >= DATE(NOW())
GROUP BY D.DoctorID");


} else if ($_POST['query'] == "allDoctorsForSelect") {
    $query = mysqli_query($database_connection,
        "SELECT CONCAT(U.first_name , ' ' , U.last_name )AS `Name`,U.username AS `Username`, D.DoctorID
FROM usercredentials AS U INNER JOIN doctors AS D
ON U.UserID = D.UserID");


} else if ($_POST['query'] == "allPetsForSelect") {
    $ownerID = $_POST['ownerID'];
    $query = mysqli_query($database_connection,
        "SELECT P.PetName ,  p.PetID FROM pets P
  INNER JOIN pet_owners PO
    ON P.OwnerID = PO.OwnerID AND PO.UserID = $ownerID");


} else if ($_POST['query'] == "allPets") {
    $query = mysqli_query($database_connection,
        "SELECT P.PetName AS `Pet Name`, CONCAT(U.first_name ,' ', U.last_name) AS Owner , a.AnimalName AS Animal , P.YearOfBirth AS `Birth Year` , P.Color
FROM usercredentials AS U INNER JOIN pet_owners AS PO
    ON U.UserID = PO.UserID
  INNER JOIN pets AS P
    ON P.OwnerID = PO.OwnerID
INNER JOIN animals AS A ON P.Animal_ID = A.Animal_ID");


} else if ($_POST['query'] == "allPetsForOwner") {
    $ownerID = $_POST['ownerID'];
    $query = mysqli_query($database_connection,
        "SELECT P.PetName as `Pet Name` ,A.AnimalName AS Animal ,P.YearOfBirth as `Birth Year`, P.Color FROM pets P
  INNER JOIN pet_owners PO
    ON P.OwnerID = PO.OwnerID AND PO.UserID = $ownerID
  INNER JOIN animals as A ON P.Animal_ID = A.Animal_ID");


} else if ($_POST['query'] == "allPetOwners") {
    $query = mysqli_query($database_connection,
        "SELECT CONCAT(U.first_name , ' ' , U.last_name) AS Name ,U.username AS Username ,COUNT(p.PetID) AS Pets
FROM usercredentials AS U INNER JOIN pet_owners AS PO
    ON U.UserID = PO.UserID
  INNER JOIN pets AS P
    ON P.OwnerID = PO.OwnerID
GROUP BY U.UserID");

} else if ($_POST['query'] == "allAppointments") {
    $query = mysqli_query($database_connection,
        "SELECT CONCAT(U.first_name , ' ', U.last_name) AS Doctor, P.PetName AS `Pet Name`, DATE_FORMAT(C.ConsultationDate,'%d-%m-%Y') AS `Date` FROM consultation AS C
  INNER JOIN doctors AS D
    ON c.DoctorID = d.DoctorID
  INNER JOIN usercredentials AS U
    ON D.UserID = u.UserID
  INNER JOIN pets AS P
    ON C.PetID = P.PetID
  INNER JOIN ( SELECT CONCAT(U2.first_name , U2.last_name) , PO2.OwnerID AS PetOwner FROM usercredentials U2
    INNER JOIN pet_owners PO2 ON U2.UserID = PO2.UserID) AS PO
    ON P.OwnerID = PO.PetOwner
    ORDER BY C.ConsultationDate");


} else if ($_POST['query'] == "consultationHistoryForDoctor") {
    $ownerID = $_POST['ownerID']; //id-ul doctorului din lista de useri
    $query = mysqli_query($database_connection,
        "SELECT CONCAT(UD.first_name , ' ' , UD.last_name) AS Doctor , p.PetName as `Pet Name` ,
       CONCAT(UPO.first_name, ' ', UPO.last_name) AS Owner, DATE_FORMAT(C.ConsultationDate,'%d-%m-%Y') as Date
FROM consultation AS C
  INNER JOIN doctors AS D
    ON C.DoctorID = D.DoctorID AND C.ConsultationDate <= DATE(NOW())
  INNER JOIN
  ( SELECT UD2.UserID , UD2.first_name , UD2.last_name FROM usercredentials as UD2
  WHERE UD2.UserID = $ownerID ) AS UD
  INNER JOIN pets AS P
    ON C.PetID = P.PetID
  INNER JOIN pet_owners as PO ON P.OwnerID = PO.OwnerID
  INNER JOIN usercredentials AS UPO ON PO.UserID = UPO.UserID
ORDER BY C.ConsultationDate");


} else if ($_POST['query'] == "consultationsUpcomingForDoctor") {
    $ownerID = $_POST['ownerID']; //id-ul doctorului din lista de useri
    $query = mysqli_query($database_connection,
        "SELECT CONCAT(UD.first_name , ' ' , UD.last_name) AS Doctor , UPO.PetName as `Pet Name` ,
       CONCAT(UPO.first_name, ' ', UPO.last_name) AS Owner, DATE_FORMAT(C.ConsultationDate,'%d-%m-%Y') as Date
FROM consultation AS C
  INNER JOIN doctors AS D
    ON C.DoctorID = D.DoctorID AND C.ConsultationDate >= DATE(NOW())
  INNER JOIN usercredentials as UD
    ON D.UserID = UD.UserID AND UD.UserID = $ownerID
  INNER JOIN ( SELECT P.PetName , P.PetID , UPO2.first_name , UPO2.last_name FROM pets AS P
    INNER JOIN pet_owners as PO ON P.OwnerID = PO.OwnerID
    INNER JOIN usercredentials AS UPO2 ON PO.UserID = UPO2.UserID
  ) AS UPO
  WHERE C.PetID = UPO.PetID
ORDER BY C.ConsultationDate");


} else if ($_POST['query'] == "consultationsInInterval") {
    $date1 = $_POST['date1'];
    $date2 = $_POST['date2'];
    $ownerID = $_POST['ownerID']; //id-ul doctorului din lista de useri
    $query = mysqli_query($database_connection,
        "SELECT CONCAT(UD.first_name , ' ' , UD.last_name) AS Doctor , p.PetName ,
CONCAT(UPO.first_name, ' ', UPO.last_name) AS Owner, DATE_FORMAT(C.ConsultationDate,'%d-%m-%Y') as Date
FROM consultation AS C
  INNER JOIN doctors AS D
    ON C.DoctorID = D.DoctorID AND C.ConsultationDate BETWEEN CAST('" . $date1 . "' AS DATE) AND CAST('" . $date2 . "' AS DATE)
  INNER JOIN ( SELECT UD2.UserID , UD2.first_name , UD2.last_name FROM usercredentials as UD2
  WHERE UD2.UserID = $ownerID ) AS UD
INNER JOIN pets AS P
ON C.PetID = P.PetID
INNER JOIN pet_owners as PO ON P.OwnerID = PO.OwnerID
INNER JOIN usercredentials AS UPO ON PO.UserID = UPO.UserID
ORDER BY C.ConsultationDate");


} else if ($_POST['query'] == "consultationHistoryForUser") {
    $ownerID = $_POST['ownerID'];
    $query = mysqli_query($database_connection,
        "SELECT P.PetName , CONCAT(U.first_name, ' ',U.last_name) as Doctor , DATE_FORMAT(C.ConsultationDate,'%d-%m-%Y') AS Date
FROM pets as P INNER JOIN
  ( SELECT C1.ConsultationDate , C1.PetID , C1.DoctorID from consultation as C1
  HAVING  C1.ConsultationDate <= DATE(NOW()) ) as C
    ON C.PetID = P.PetID
  INNER JOIN doctors as D
    ON C.DoctorID = D.DoctorID
  INNER JOIN usercredentials as U
    ON U.UserID = D.UserID
  INNER JOIN pet_owners as PO on P.OwnerID = PO.OwnerID
  INNER JOIN usercredentials U2 on PO.UserID = U2.UserID AND U2.UserID = $ownerID
  ORDER BY c.ConsultationDate");


} else if ($_POST['query'] == "upcomingConsultationsForUser") {
    $ownerID = $_POST['ownerID'];
    $query = mysqli_query($database_connection,
        "SELECT C.ConsultationID as ID,P.PetName , CONCAT(U.first_name,' ',U.last_name) as Doctor , DATE_FORMAT(C.ConsultationDate,'%d-%m-%Y') AS Date
FROM pets as P INNER JOIN
  ( SELECT C1.ConsultationDate , C1.PetID , C1.DoctorID, C1.ConsultationID from consultation as C1
  HAVING  C1.ConsultationDate >= DATE(NOW()) ) as C
    ON C.PetID = P.PetID
  INNER JOIN doctors as D
    ON C.DoctorID = D.DoctorID
  INNER JOIN usercredentials as U
    ON U.UserID = D.UserID
INNER JOIN pet_owners as PO on P.OwnerID = PO.OwnerID
INNER JOIN usercredentials U2 on PO.UserID = U2.UserID AND U2.UserID = $ownerID
ORDER BY C.ConsultationDate");


} else if ($_POST['query'] == "AddConsultation") {
    $petid = $_POST['PetID'];
    $doctorid = $_POST['DoctorID'];
    $date = $_POST['Date'];
    echo('Date from PHP');
    $query = null;
    mysqli_query($database_connection, "INSERT INTO consultation (DoctorID, PetID, ConsultationDate)
VALUES ($doctorid,$petid, CAST('" . $date . "' AS DATE))");

} else if ($_POST['query'] == "UpdateConsultation") {
    $petid = $_POST['PetID'];
    $doctorid = $_POST['DoctorID'];
    $date = $_POST['Date'];
    $id = $_POST['ID'];

    $query = null;
    $query = mysqli_query($database_connection, "UPDATE consultation AS C SET C.DoctorID = '$doctorid',
    C.PetID = '$petid' , C.ConsultationDate = '$date'
    WHERE ConsultationID = '$id'");
    var_dump($query);

} else if ($_POST['query'] == "UpdateUser") {

    $user = $_POST['username'];
    $newUsername = $_POST['newUsername'];
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $userType = $_POST['userType'];
    $password = $_POST['password'];
    $password = hash('sha256', $password);
    $query = null;

    $query = mysqli_query($database_connection, "UPDATE usercredentials AS U SET U.username = '$newUsername',
    U.first_name = '$firstName' , U.last_name = '$lastName' , U.userType = '$userType'
    WHERE U.username = '$username'");
    var_dump($query);

} else if ($_POST['query'] == "RemoveUser") {
    $user = $_POST['user'];
    var_dump($user);
    $query = null;
    mysqli_query($database_connection, "DELETE FROM usercredentials WHERE username = '$user'");
}
else if ($_POST['query'] == "RemoveAppointment") {
    $id = $_POST['id'];
    $query = null;
    mysqli_query($database_connection, "DELETE FROM consultation WHERE ConsultationID = '$id'");
}


if ($query) {
    $row = mysqli_fetch_all($query, MYSQLI_ASSOC);
    $data = null;
    if ($row) {
        $keys = array_keys($row[0]);
        $data[0] = $keys;
        $data[1] = $row;
    }

    echo json_encode($data);
}

mysqli_close($database_connection);

//array_keys()
//array_key_exist()