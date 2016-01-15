<div id = "login_header">
	<?php 

		$header_nume = $_SESSION['NUME'];
		$header_prenume = $_SESSION['PRENUME'];


	 	
		echo "Logged in as : <b>" . $header_nume . " " . $header_prenume . "</b>";
	
	?>
	 	
	 	<form action="/website/includes/logout.php">
	 		<button type="submit" class="btn btn-default btn-xs">Log Out</button>
	 		<button type="button" class="btn btn-info btn-xs">View Cart</button>
	 		<a class="btn btn-primary btn-xs" href="user_panel.php" role="button">View Profile</a>
	 	</form>


</div>