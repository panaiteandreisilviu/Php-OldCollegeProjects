		<div id = "login_page">

			<div id = "login_page_text">Login</div>
		</br>
			<div id = "form">
				
				<form class="form-horizontal" action = "/website/includes/check_login_credentials.php" method = "POST">
		  <div class="form-group">
		    
		    <div class="col-sm-10">
		      <input type="text" class="form-control" name="username" placeholder="username" >
		    </div>
		  </div>
		  <div class="form-group">
		    <div class="col-sm-10">
		      <input type="password" class="form-control" name="password" placeholder="Password">
		    </div>
		  </div>
			<button type="submit" class="btn btn-default">Sign in</button>
	      	<a class="btn btn-default" href="register.php" role="button">Register</a>
	      	<br>
	      	<br>
		</form>		

		<form action = "includes/anonymous_login.php" method = "POST">
			<button type="submit" class="btn btn-primary">Login as Anonymous</button>
		</form>

	</div>

</div>

		




