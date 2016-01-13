<script type="text/javascript">
		
		
		window.onscroll = scrollfunction;
		
		function scrollfunction(){
			
		    //document.getElementById("content_top").innerHTML = window.pageYOffset;
			
		    var offset = 100 - window.pageYOffset;
			
			if (window.pageYOffset <= 150)
			{
				document.getElementById("collapsable_sidebar").style.marginTop = offset + "px";
			}
			

            
			else
			{
			    document.getElementById("collapsable_sidebar").style.marginTop = 0 + "px";
			}
			
			
			

			if (window.pageYOffset < 200)
			{
			    document.getElementById("collapsable_sidebar").style.opacity = 1;

			}

			else {

			    document.getElementById("collapsable_sidebar").style.opacity = 1-window.pageYOffset / 700;
			}






			if (window.pageYOffset > 200 && window.pageYOffset < 250) {
			    document.getElementById("navbarMobile").style.opacity = window.pageYOffset % 50 / 100 * 2;

			}

		

			else if (window.pageYOffset >= 250)
			{

			    document.getElementById("navbarMobile").style.opacity = 1;
			}
			
			else{

			    document.getElementById("navbarMobile").style.opacity = 0;
			}
			
			
		}
		
		function getPostFromDatabase(post){
			
			var postid = post.id;


            var xmlhttp = new XMLHttpRequest();

            xmlhttp.open("POST", "/website/includes/get_blog_post.php", true);
            
            xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded")


            xmlhttp.onreadystatechange = function() {
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                    document.getElementById("content_text").innerHTML = xmlhttp.responseText
                }
            }
            
            xmlhttp.send("postid="+postid);

		}







		
	</script>