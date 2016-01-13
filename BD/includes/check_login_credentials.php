		<?php require 'db_connect.php' ?>

		<?php 
			
			session_start();

			function start_session($row){

						$_SESSION['LOGGED_IN'] = true;
						$_SESSION['NUME'] = $row[4];
						$_SESSION['PRENUME'] = $row[3];
						$_SESSION['PRIVILEGES'] = $row[5];
						$_SESSION['USERNAME'] = $row[1];

					}

			function register(){

				$register = true;
			}


		?>


		<?php


			$username = $password = "";
			$userError = $passwordError = "";
			$row = "";
			
			if ($_SERVER["REQUEST_METHOD"] == "POST")
			{
				if( empty($_POST["username"]))
				{
					echo  "Please input a username";
					die();
				}

				else if (empty($_POST["password"]))
				{

					echo  "Please input a password";
					die();

				}


				else{

					$username = clean_input( $_POST["username"] );
	      			$password = clean_input( md5($_POST["password"]) );


	      			$query = mysqli_query($database_connection, "SELECT * FROM userstable WHERE `username` = '$username' AND `password` = '$password' ");
					$row = mysqli_fetch_array($query);
	      			
	      			if($row)
	      			{
	      				start_session($row);
	      				echo "<br><br>",$_SESSION['LOGGED_IN'];
	      				
	      				header("Location: /website/");
	      				
	      			}

	      			else{

	      				
	      				echo 'LOGIN UNSUCCESSFUL';

	      			}
					
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