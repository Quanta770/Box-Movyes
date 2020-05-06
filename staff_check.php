<?php
	session_start();
	
?>
<!-DOCTYPE html>
<html lang = "en">
<head>
<link rel = "shortcut icon" href = "img/fav.png" />
	<title> Login Check</title>
	<script>

	function error_js()
	{
		
				
				
		alert("Incorrect username or password! Please try again.");
		document.getElementById("errorform").submit();
			

	}
	function error_js2()
	{
		document.getElementById("errorform").submit();
	}
	</script>
</head>
<body>

	<?php
		
		
	
		if(isset($_POST['staff_InputEmail'])&&isset($_POST['staff_InputPassword']))
		{	
			
			
			$emails=$_POST['staff_InputEmail']; //this is the name of the input.
			$password=$_POST['staff_InputPassword'];  //note that you use $_REQUEST to get data
			
				
			$sql = "SELECT staff.active,staff.password FROM staff WHERE staff.email = '$emails'";
			//put the sql query inside a string...
				
			$links = mysqli_connect('localhost','hfycb1_hfycb1','12345isint.','hfycb1_id13307643_assignment2') or die("Could not connect to database");
			//connect to the database....	
			//problem when upload, maybe
					
			$result = mysqli_query ($links,$sql);
			//make the query based on the connection to the database
					
					
			
			
					
			$row = mysqli_fetch_assoc($result);  //fetch all the result into a variable, so
			//that they can be referred to based on array
			$active = $row['active'];
			if($active == 0)
			{
				echo("<script>alert('Sorry, access is denied. If you think this is an error, please contact our database administrator.');</script>");
				echo("<form action = 'staff_login.php' method = 'post' id = 'errorform' style = 'display:none;'>");
				echo("<input type = 'text' value = '$emails' id = 'error1' name = 'error1'/>");
				echo("<input name = 'fired' type = 'text' value = 1 />");
				echo ("</form>");
				echo("<script>error_js2();</script>");
			}
			else
			{
				$testpw = $row['password'];
		
				//get the row called password onli
						
				
				if(($password == $testpw)&&($testpw!=''))
				{
					$_SESSION['email'] = $emails;
					$_SESSION['staff_check'] = 1;
					echo("<script>window.location.href='staff_page.php';</script>");
							
				}
				else 
				{
							
							
							
					echo("<form action = 'staff_login.php' method = 'post' id = 'errorform' style = 'display:none;'>");
					echo("<input type = 'text' value = '$emails' id = 'error1' name = 'error1'/>");
							
					echo ("</form>");
					echo("<script>error_js()</script>");
							
				}
			}
			
			
			
		}
		else
		 {
			 echo("<script>window.location.href = 'index.php';</script>");
			//header('location:home.php');
		 }	


	?>
	</body>

</html>