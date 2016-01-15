<?php 

	

	session_start();
	
	require 'databaseConnect.php';

	if ($_SERVER["REQUEST_METHOD"] == "POST")
	{
		if(empty($_POST["change_firstname"]) || empty($_POST["change_lastname"]))
		{
			$_SESSION['changeNamesError'] = "Please input both fields";
			//variabila session pt ca globals nu functioneaza
			header('Location: /website/user_panel.php');
	
		}

		else{

			$firstname = clean_input($_POST["change_firstname"]);
			$lastname = clean_input($_POST["change_lastname"]);
			$username = $_SESSION['USERNAME'];
			$query = mysqli_query($database_connection, "UPDATE userstable SET `first_name` = '$firstname' ,`last_name` = '$lastname'  WHERE `username` = '$username' ");
			$_SESSION['changeNamesError'] = "Information updated succesfully";
			$_SESSION['NUME'] = $lastname;
			$_SESSION['PRENUME'] = $firstname;
			header('Location: /website/user_panel.php');

		}

	}




	function clean_input($data)
	{
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		$data = mysql_real_escape_string($data);
		
		return $data;
	}




?>