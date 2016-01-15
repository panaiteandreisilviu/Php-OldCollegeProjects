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



<!DOCTYPE html>
<html>

<?php  require '/includes/HTML_head.php';?>

<?php

	if(isset($_SESSION['LOGGED_IN']))
	{	
		include 'includes/login_header.php';
	}

?>



<body>


<div id = "wrapper">


	<?php require 'includes/navbar_mobile.php'; ?>

	<?php require 'includes/databaseConnect.php' ?>


	<?php

		if(isset($_SESSION['LOGGED_IN']))
		{	
			require 'includes/header_navbar.php';
			require 'includes/javascript.php';
		}


		else{

			echo "<script>window.location = \"index.php\"";
			require '\includes\login.php';
		}


	
	?>

		<div id = "user_panel">

			<div id = "user_panel_information">
				
				<div id = "user_panel_personal">

					<h3>Personal information</h3>
					</br>

					<h5>Update your information</h5>
					<div id = "form" style = "width:70%">
						
					<form class="form-horizontal" action = "/website/includes/update_names.php" method = "POST">

					  
					<div class="form-group">
					    <div class="col-sm-10">
					      <input type="text" class="form-control" name="change_lastname" placeholder="Last Name (exp Smith)">
					    </div>
				  	</div>

				   	<div class="form-group">
					    <div class="col-sm-10">
				 	     <input type="text" class="form-control" name="change_firstname" placeholder="First Name (exp John)">
					    </div>
				  	</div>

						<button type="submit" class="btn btn-default">Update Info</button>
				      	<br>
				      	<br>
					</form>
					</div>

					<div style = "color:#052EFF">
					
					<?php 
						
						if(isset($_SESSION['changeNamesError']))
						{
							echo "<b>" . $_SESSION['changeNamesError'] . "</b>";
						}
						

						$_SESSION['changeNamesError'] = "";

					?>

					</div>

				</div>

			

			<div id = "user_panel_security">

				<h3>Security</h3>
				</br>

				<h5>Change Password</h5>
				
				<div id = "form" style = "width:70%">
					
				<form class="form-horizontal" action = "/website/includes/change_password.php" method = "POST">

				  
				  <div class="form-group">
				    <div class="col-sm-10">
				      <input type="password" class="form-control" name="change_password1" placeholder="New password">
				    </div>
				  </div>

				  <div class="form-group">
				    <div class="col-sm-10">
				      <input type="password" class="form-control" name="change_password2" placeholder="Confirm password">
				    </div>
				  </div>

					<button type="submit" class="btn btn-default">Change Password</button>
			      	<br>
			      	<br>
					</form>

				</div>

				<div style = "color:#052EFF">
				<?php 
					
					if(isset($_SESSION['changePasswordError']))
					{
						echo "<b>" . $_SESSION['changePasswordError'] . "</b>";
					}
					

					$_SESSION['changePasswordError'] = "";

				?>

				</div>

			</div>
		</div>

			<br>
			<hr style = "width:100%;">

			<h3>Users</h3>
			<table style="width:100%;">
			  	<tr>
				    <th>ID</th>
				    <th>Username</th>
				    <th>First Name</th> 
				    <th>Last Name</th>
				    <th>Privileges</th>
			  	</tr>

			<?php
		
				$result = mysqli_query($database_connection, "SELECT userid , username, first_name , last_name , privileges FROM userstable");

				if (mysqli_num_rows($result) > 0) {
				    

				    while($row = mysqli_fetch_assoc($result)) {
				        echo "<tr><td>". $row["userid"] . "</td><td>" . $row["username"] . "</td><td>" . $row["first_name"] . "</td><td>" . $row["last_name"] . "</td><td>";
						    if( $row["privileges"] == 0)
						    {
						    	echo "administrator</td></tr>";

						    }

						    else{

						    	echo "user</td></tr>";

						    }

				    }

				    
				} 
				
				else {
				    echo "No users in database";
				}

			?>

			</table>
			
		</div>


</div>

<?php include 'includes/footer.php'; ?>


</body>
</html>