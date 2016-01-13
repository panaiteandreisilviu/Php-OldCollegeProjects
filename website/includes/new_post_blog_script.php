<?php
	
	session_start();

	require 'db_connect.php';

	if ($_SERVER["REQUEST_METHOD"] == "POST")
	{

		$title = clean_input($_POST["post_title"]);
		$text = clean_input( $_POST["post_text"] );
		$date = date("d/m/Y");
		$author = $_SESSION["NUME"] . " " . $_SESSION["PRENUME"];

		$query = mysqli_query($database_connection,"INSERT INTO blogposts (`title`, `post_text`, `post_date`, `author`)
													VALUES ('$title', '$text', '$date', '$author')");
	

	}

	header('Location: /website/index.php');


	function clean_input($data)
			{
				$data = trim($data);
				$data = stripslashes($data);
				$data = mysql_real_escape_string($data);
								
				return $data;
			
			}




?>