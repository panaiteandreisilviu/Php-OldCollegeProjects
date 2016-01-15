/*angajatii si functiile lor*/
SELECT A.Nume , A.Prenume  , C.Denumire as Functie FROM categorie as C
  INNER JOIN serviciu as S
    ON S.ID_CATEGORIE = C.ID_CATEGORIE
  INNER JOIN angajat as A
    on c.ID_CATEGORIE = A.ID_CATEGORIE
GROUP BY A.Nume


/*servicii si categorii*/
SELECT S.Denumire AS Serviciu , C.Denumire as Categorie FROM categorie AS C
  INNER join serviciu AS S
    ON S.ID_CATEGORIE = C.ID_CATEGORIE


/*angajatii functiile lor si numarul de servicii pe categorie*/
SELECT A.Nume , a.Prenume , C.Denumire ,COUNT(S.ID_CATEGORIE) AS NumarServicii
FROM angajat as A
  INNER JOIN categorie AS C
    on a.ID_CATEGORIE = c.ID_CATEGORIE
  INNER JOIN serviciu AS S
    ON C.ID_CATEGORIE = S.ID_CATEGORIE
GROUP BY A.ID_ANGAJAT


         //ANGAJAT
/*Toate Programarile*/
SELECT C.Nume , C.Prenume , P.DataProgramare , P.Ora FROM programare as P
  INNER  JOIN client AS C
    ON P.ID_CLIENT = C.ID_CLIENT


//ANGAJAT
/* Cel mai scump serviciu utilizat de fiecare client */
SELECT CONCAT(C.Nume , ' ' , C.Prenume) as Nume,  MAX(S.Pret) as Pret, S.Denumire
FROM client C
  INNER JOIN programare as P
    ON C.ID_CLIENT=P.ID_CLIENT
  INNER JOIN detalii_programare as DP
    ON P.ID_PROGRAMARE=DP.ID_PROGRAMARE
  INNER JOIN serviciu AS S
    ON S.ID_SERVICIU = DP.ID_SERVICIU
GROUP BY C.Nume


/*Minute lucrate de la angajare de fiecare angajat descrescator*/
SELECT CONCAT(A.Nume , ' ' , A.Prenume) as 'Nume Angajat', SUM(S.Durata) as Minute_Lucrate
FROM client C
  INNER JOIN programare as P
    ON C.ID_CLIENT=P.ID_CLIENT
  INNER JOIN detalii_programare as DP
    ON P.ID_PROGRAMARE=DP.ID_PROGRAMARE
  INNER JOIN serviciu AS S
    ON S.ID_SERVICIU = DP.ID_SERVICIU
  INNER JOIN angajat AS A
    ON A.ID_ANGAJAT = DP.ID_ANGAJAT
GROUP BY `Nume Angajat`
ORDER BY Minute_Lucrate DESC


/* Query-uri COMPLEXE */



/*Programari intre doua date*/
SELECT CONCAT(c.Nume , ' ' , c.Prenume) as Client ,P.DataProgramare , P.Ora FROM client AS C
  INNER JOIN (SELECT * FROM programare as P1
  WHERE P1.DataProgramare BETWEEN '2016-01-14' AND '2016-01-21') as P
    ON C.ID_CLIENT = P.ID_CLIENT


                     //ANGAJAT
/*Pret servicii platite de client pe luna respectiva*/
SELECT CONCAT(c.Nume , ' ' , c.Prenume) AS Client ,P.DataProgramare , P.Ora, SUM(S.Pret)
FROM client AS C
  INNER JOIN (SELECT * FROM programare as P1
  WHERE P1.DataProgramare > (NOW() - INTERVAL 1 MONTH)) as P
    ON C.ID_CLIENT = P.ID_CLIENT

  INNER JOIN detalii_programare AS DP
    ON P.ID_PROGRAMARE = DP.ID_PROGRAMARE

  INNER JOIN serviciu AS S
    ON S.ID_SERVICIU = DP.ID_SERVICIU
GROUP BY Client


         //ANGAJAT
/*Cat a cheltuit fiecare client in ultimul an*/
SELECT CONCAT(c.Nume , ' ' , c.Prenume) AS Client, SUM(S.Pret) AS 'Cheltuieli Anuale'
FROM client AS C
  INNER JOIN (SELECT * FROM programare as P1
  WHERE  P1.DataProgramare > (NOW() - INTERVAL 1 Year )) as P
    ON C.ID_CLIENT = P.ID_CLIENT
  INNER JOIN detalii_programare AS DP
    ON P.ID_PROGRAMARE = DP.ID_PROGRAMARE
  INNER JOIN serviciu AS S
    ON S.ID_SERVICIU = DP.ID_SERVICIU
GROUP BY Client


/*Incasari pe luna trecuta (cred ca le face pt ultimele 30 zile)*/
SELECT  CONCAT(SUM(S.Pret), ' ' , 'lei') AS Incasari
FROM client AS C
  INNER JOIN (SELECT * FROM programare as P1
  WHERE P1.DataProgramare > (NOW()  - INTERVAL 1 MONTH)) as P
    ON C.ID_CLIENT = P.ID_CLIENT

  INNER JOIN detalii_programare AS DP
    ON P.ID_PROGRAMARE = DP.ID_PROGRAMARE

  INNER JOIN serviciu AS S
    ON S.ID_SERVICIU = DP.ID_SERVICIU


/*Cate programari au angajatii in urmatoarele 10 zile*/
SELECT A.Nume, A.Prenume, COUNT(P.ID_PROGRAMARE) AS 'Numar Programari'
FROM angajat A
INNER JOIN detalii_programare DP
ON A.ID_ANGAJAT=DP.ID_ANGAJAT

INNER JOIN (SELECT * FROM programare AS P1
WHERE P1.DataProgramare<=(now()+ interval 10 DAY)) AS P
ON P.ID_PROGRAMARE = DP.ID_PROGRAMARE
GROUP BY A.Nume

/*Programari viitoare pentru un angajat anume */
SELECT A.Nume, A.Prenume, P.DataProgramare, P.Ora
FROM client C
  INNER JOIN (SELECT * FROM angajat AS A1
WHERE A1.ID_ANGAJAT = 1) AS A
  INNER JOIN (SELECT * FROM programare as P1
  WHERE P1.DataProgramare > now()) AS P
    ON C.ID_CLIENT = P.ID_CLIENT
  INNER JOIN detalii_programare DP
    ON P.ID_PROGRAMARE = DP.ID_PROGRAMARE
GROUP BY A.Nume, P.DataProgramare



/*ADMINISTRATOR*/

/*Afisare clienti sortati dupa nume*/
SELECT  C.ID_client, C.Nume, C.Prenume, C.Telefon, C.username
FROM client C
GROUP BY C.Nume, C.Prenume


/*Afisare angajati sortati dupa nume si categoria din care fac parte(postul ocupat)*/
SELECT A.ID_ANGAJAT, A.Nume,  A.Prenume, C.Denumire AS 'Denumire Post'
FROM angajat A
  INNER JOIN categorie C
    ON C.ID_CATEGORIE = A.ID_CATEGORIE
GROUP BY A.Nume, A.Prenume


/*Afisare toate programarile*/
SELECT C.Nume AS 'Nume Client' , C.Prenume , P.DataProgramare as 'Data Programare' , P.Ora AS 'Ora Programare'
FROM programare as P
  INNER  JOIN client AS C
    ON P.ID_CLIENT = C.ID_CLIENT
ORDER BY P.DataProgramare