<!DOCTYPE html>
<html>

<?php  include 'includes/HTML_head.php';?>

<body>

		<div id = "login_page">

			<div id = "login_page_text">Registration</div>
		</br>
			<div id = "form">
				
			<form class="form-horizontal" action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method = "POST">

		  <div class="form-group">
		    <div class="col-sm-10">
		      <input type="text" class="form-control" name="register_lastname" placeholder="Last Name (exp Smith)">
		    </div>
		  </div>

		   <div class="form-group">
		    <div class="col-sm-10">
		      <input type="text" class="form-control" name="register_firstname" placeholder="First Name (exp John)">
		    </div>
		  </div>

		  <div class="form-group">   
		    <div class="col-sm-10">
		      <input type="text" class="form-control" name="register_username" placeholder="Select an username" >
		    </div>
		  </div>
		  
		  <div class="form-group">
		    <div class="col-sm-10">
		      <input type="password" class="form-control" name="register_password1" placeholder="Select a password">
		    </div>
		  </div>

		  <div class="form-group">
		    <div class="col-sm-10">
		      <input type="password" class="form-control" name="register_password2" placeholder="Confirm password">
		    </div>
		  </div>

			<button type="submit" class="btn btn-default">Register</button>
	      	<br>
	      	<br>
		</form>

	</div>



		

		<?php require 'includes/db_connect.php' ?>

		<?php


			$firstname = $lastname =$username = $password = $password_confirm = "";

			
			if ($_SERVER["REQUEST_METHOD"] == "POST")
			{
				if( empty($_POST["register_firstname"]))
				{
					$errors[] = "Please input a First Name";
				}

				if( empty($_POST["register_lastname"]))
				{
					$errors[] = "Please input a Last Name";
				}


				if( empty($_POST["register_username"]))
				{
					$errors[] = "Please input a username";
				}


				if (empty($_POST["register_password1"]))
				{

					$errors[] = "Please input a password";

				}

				if ( $_POST["register_password1"] != $_POST["register_password2"] )
				{

					$errors[] = "Passwords do not match";

				}

				if( isset($errors) )
				{
					foreach ($errors as $error)
					{
						echo $error , "<br>";
					}


				}

				else
				{

					$firstname = clean_input( $_POST["register_firstname"] );
					$lastname = clean_input( $_POST["register_lastname"] );
					$username = clean_input( $_POST["register_username"] );
	      			$password = clean_input( $_POST["register_password1"] );

	      			$password = md5($password);



	      			$query_check = mysqli_query($database_connection,"SELECT * FROM userstable WHERE `username` = '$username'");
	      			echo mysqli_error($database_connection);

	      			$row = mysqli_fetch_array($query_check); 
					
					if($row)
					{
						echo "User already exists";
						die();
					} 

					else{

						$query = mysqli_query($database_connection,"INSERT INTO userstable (`username`, `password`, `first_name`, `last_name`)
													VALUES ('$username', '$password', '$firstname', '$lastname')");

						echo "<script>window.location.href = 'index.php';</script>";
						
						
						//trebuie eliminat
						//echo mysqli_error($database_connection);

						



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

</div>

</body>
</html>