
<?php

$database_connection = mysqli_connect("localhost", "root", "panaite" , "database1");
if (mysqli_connect_errno()) 
{   
	echo "<br> <br> <br> <br>" ;
	die("Connection failed: " . mysqli_connect_error());
}
?>