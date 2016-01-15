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

<?php  include 'includes/HTML_head.php';?>

<body>

	<div id = "wrapper">


	<?php include 'includes/navbar_mobile.php' ?>

	<?php 
	
	if(isset($_SESSION['LOGGED_IN']))
	{	
		include 'includes/login_header.php';
	}

	?>


	<?php

		if(isset($_SESSION['LOGGED_IN']))
		{	
			include 'includes/header_navbar.php';
			include 'includes/javascript.php';
		}

		else{


			include '\includes\login.php';
		}
	
	?>

		<div id = "post_to_blog">

			<h2>Add a blog post</h2>
			<form action = "includes/new_post_blog_script.php" method = "POST">
				
				<input type="text" style = "width:40%;" class="form-control" name="post_title" placeholder="Post Title" >
				</br>
				<textarea rows="10" name = "post_text"></textarea>
				</br>
				<button type="submit" class="btn btn-default">Post</button>
			</form>

		</div>

	</div>
	
	
    
    
</div>
</body>
</html>