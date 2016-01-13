<!--HOME-->
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
			include 'includes/collapsable_sidebar.php';
			include 'includes/header_navbar.php';
			include 'includes/page_content.php';
			include 'includes/javascript.php';
			include 'includes/footer.php';
		}

		else{


			include '\includes\login.php';
		}
	
	?>



	
	</div>
	
	
    
    
</div>
</body>
</html>