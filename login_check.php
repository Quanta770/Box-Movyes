<?php
	session_start();
	
?>
<! DOCTYPE html >
<html lang = "en">
<head>
<link rel = "shortcut icon" href = "img/fav.png" />
<script>

	function error_js()
	{
		
				
				
		
		document.getElementById("errorform").submit();
			
	}
	
</script>
<title>Login Check</title>
</head>
<body>
<br /><br /><br />

<?php
	echo("<script>console.log('login_check');</script>");
	$emails = '';
	$password = '';
	
	if(isset($_POST['InputEmail_customer'])&&isset($_POST['InputPassword_customer']))
		{		
		$emails=$_POST['InputEmail_customer']; //this is the name of the input.
		$password=$_POST['InputPassword_customer'];  //note that you use $_REQUEST to get data
				
				
		$sql = "SELECT customer.active,customer.email, customer.password FROM customer WHERE customer.email LIKE '$emails'";
		//put the sql query inside a string...
					
		$links = mysqli_connect('localhost','hfycb1_hfycb1','12345isint.','hfycb1_id13307643_assignment2') or die("Could not connect to database");
		//connect to the database....	
		//problem when upload, maybe
					
		$result = mysqli_query ($links,$sql);
		//make the query based on the connection to the database
		
					
		$test_pw = '';
				
					
		while($row = mysqli_fetch_assoc($result))  //fetch all the result into a variable, so
		//that they can be referred to based on array
		{
			$test_pw = $row['password'];
			$active = $row['active'];
		}
		//get the row called password onli
			
		if($active == 0)			
		{
			echo("<script>alert('Sorry, access is denied. If you think this is an error, please contact our database administrator.');</script>");
			echo("<form action = 'login.php' method = 'post' id = 'errorform' style = 'visibility:hidden'>");
			echo("<input type = 'text' value = '$emails' id = 'error1' name = 'error1'/>");
			echo("<input type = 'text' value = 1 name = 'blacklist' />");
			echo ("</form>");
			echo("<script>error_js()</script>");
		}
		else
		{
			if(($password == $test_pw)&&($test_pw!=''))
			{
				
				$_SESSION['email'] = $emails;
				$_SESSION['customer_check'] = 1;
				//header('Location: customer_page.php');
				echo("<script>window.location.href = 'customer_page.php';</script>");
				
						
			}
			else 
			{
					
						
							
				echo("<form action = 'login.php' method = 'post' id = 'errorform' style = 'visibility:hidden'>");
				echo("<input type = 'text' value = '$emails' id = 'error1' name = 'error1'/>");
							
				echo ("</form>");
				echo("<script>alert('Incorrect username or password! Please try again.');</script>");
				echo("<script>error_js()</script>");
							
			}
					
			unset($_POST['InputEmail_customer']);
			unset($_POST['InputPassword_customer']);
		}
		
			
		
	  
	} 
	 else
	 {
		//header('location:index.php');
		echo("<script>window.location.href = 'index.php';</script>");
	 }		 
	  
	  
  ?>
  
	
</body>
</html>