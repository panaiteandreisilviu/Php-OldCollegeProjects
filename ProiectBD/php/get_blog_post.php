<?php

	
	require 'databaseConnect.php';

	if ($_SERVER["REQUEST_METHOD"] == "POST"){

			$postid = $_POST["postid"];

	
	

				$result = mysqli_query($database_connection, "SELECT title, post_text , author , post_date FROM blogposts WHERE `id` = '$postid'");
				$row = mysqli_fetch_array($result);

		    	echo "<div class = \"post_information\">";
		        echo "<br>" . "posted by <b> " . $row["author"] . " </b> " . "on<b> " . $row["post_date"] . "</b></div>";
		        echo "<h1 style = \"text-align:center;\">&nbsp;&nbsp;&nbsp;&nbsp;" . $row["title"] . "</h1></br></br>" . $row["post_text"];
		        echo "<hr></br>";

		

		
	}

	else{

		echo "NOT POST";
	}
	
?>