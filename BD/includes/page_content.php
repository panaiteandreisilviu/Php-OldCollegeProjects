<div id  = "content_postari_sidebar">
	<div id = "content_top">Postari</div>

	<?php require 'includes/db_connect.php' ?>

	
	<?php

				$result = mysqli_query($database_connection, "SELECT id , title, author , post_date FROM blogposts ORDER BY id DESC");

				if (mysqli_num_rows($result) > 0) {
				    

				    while($row = mysqli_fetch_assoc($result)) 
				    {	
				    	echo "<div id = \" ". $row["id"] . " \" class = \"titluri_postari\" onclick = \" getPostFromDatabase(this) \">";
				        echo "<b>" . $row["title"] . "</b><br>by " . $row["author"] . "<br>" . $row["post_date"] ."</div>" ;

				        if(isset($_SESSION['PRIVILEGES']) && $_SESSION['PRIVILEGES'] == 0)
				        {
				        	echo "<br><button type=\"submit\" formaction=\"demo_admin.asp\" class=\"btn btn-default btn-xs\">Edit Post</button> ";
				        	echo "<button type=\"submit\" class=\"btn btn-default btn-xs\">Delete Post</button> ";
				        	
				        }
				        echo "<hr>";
					}


					if(isset($_SESSION['PRIVILEGES']) && $_SESSION['PRIVILEGES'] == 0)
					{
						echo "<a class=\"btn btn-default\" style = \"margin-left : -10px;\" href = \"/website/newblogpost.php\" role=\"button\">Add Post</a>";
					}

					
				}



			?>


			

</div>

<div class = "content" id = "content1">
    <div id = "content_top"></div>
    	
		
		<div id="content_text" >
        
        	

			<?php

				$result = mysqli_query($database_connection, "SELECT id , title, post_text , author , post_date FROM blogposts ORDER BY id DESC");

				if (mysqli_num_rows($result) > 0) {
				    

				    $row = mysqli_fetch_assoc($result);

			    	echo "<div class = \"post_information\">";
			        echo "<br>" . "posted by <b> " . $row["author"] . " </b> " . "on<b> " . $row["post_date"] . "</b></div>";
			        echo "<h1 style = \"text-align:center;\">&nbsp;&nbsp;&nbsp;&nbsp;" . $row["title"] . "</h1></br></br>" . $row["post_text"];
			        echo "<hr></br>";
				

				}

				 

			?>

	
		

			
		</div>



		
	

	</div>
	
</div>