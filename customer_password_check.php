<?php
	session_start();
	if(isset($_SESSION['customer_check']))
	{
		header("Location:customer_page.php");
	}
	else if(!isset($_SESSION['email']))
	{
		header("Location:staff_login.php");
	}//end of general staff login check
	else if(!(isset($_POST['customer_id'])&&isset($_POST['password'])))
	{
		header("Location:staff_view_customer.php");
	}
	$links = mysqli_connect('localhost','hfycb1_hfycb1','12345isint.','hfycb1_id13307643_assignment2') or die("Could not connect to database");
	
	
	$customer_id = $_POST['customer_id'];
	$password = $_POST['password'];
	
?>


<!DOCTYPE html>
<html>
<head>
<link rel = "shortcut icon" href = "img/fav.png" />
<script>
	function submit_fun()
	{
		document.getElementById("submit_form").submit();
	}
	function pass_zip_fun()
		{
			$passcode = document.getElementById("passme").innerHTML;
			$counters = 0;
			$output = "";
			
			$length = $passcode.length;
					
			while($counters<$length)
			{
				
				if($counters<=1)
				{
					
					$output +=$passcode[$counters];
					
				}
				else
				{
					$output+= '*';
				}
				$counters++;
			}
			document.getElementById("password_form").value = $output;
			
			document.getElementById("passme").innerHTML = "";
		}
</script>
<title>Processing Request</title>
</head>
<body>

<?php
	echo("<p id = 'passme'>$password</p>");
	
	$sql_update = "UPDATE `customer` SET `password`  = '$password',`last_update` = current_timestamp() WHERE customer.customer_id ='$customer_id'";
	$result = mysqli_query($links, $sql_update);
	if($result == 1)
	{
		echo("<script>alert('Success changing password!');</script>");
		echo("
			<form id = 'submit_form'method = 'post' action = 'staff_customer_password.php' style = 'display:none;'>
				<input type = 'text' value = 1 name = 'update_success' />
				<input type = 'text' value = '$customer_id' name = 'customer_id' />
				<input type = 'text' name = 'password_o' id= 'password_form'/>
			</form>
		");
		echo("<script>pass_zip_fun();</script>");
		echo("<script>submit_fun();</script>");
	}
	else
	{
		echo("<script>alert('Error fetching data!');</script>");
		echo("<script>window.location.href('staff_view_customer.php');</script>");
		//failure
	}
?>
</body>
</html>