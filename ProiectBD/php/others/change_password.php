<?php 

	

	session_start();
	
	require 'databaseConnect.php';
	$changePasswordError = "";

	if ($_SERVER["REQUEST_METHOD"] == "POST")
	{
		if(empty($_POST["change_password1"]) || empty($_POST["change_password2"]))
		{
			$_SESSION['changePasswordError'] = "Please input both fields";
			//variabila session pt ca globals nu functioneaza
			header('Location: /website/user_panel.php');
	
		}


		else if ( $_POST["change_password1"] != $_POST["change_password2"] )
		{
			$_SESSION['changePasswordError'] = "Passwords do not match";
			header('Location: /website/user_panel.php');
		}

		else{

			$password = clean_input($_POST["change_password1"]);
			$password = md5($password);
			$username = $_SESSION['USERNAME'];
			$query = mysqli_query($database_connection, "UPDATE userstable SET `password` = '$password' WHERE `username` = '$username' ");
			$_SESSION['changePasswordError'] = "Password changed succesfully";
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