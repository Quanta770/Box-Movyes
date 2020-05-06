<?php
	session_start();
	if(!isset($_SESSION['email']))
	{
		header("location:index.php");
	}
	else if (isset($_SESSION['staff_check']))
	{
		header("location:staff_page.php");
	}
	
	//if not logged in, go to home page
	//if staff logged in, go to staff page
	//else do nothing
	
?>
<!DOCTYPE html>
<html lang = "en">
<head>
<link rel = "shortcut icon" href = "img/fav.png" />
	<title>Validating information....</title>
	<script>
		function submit_return()
		{
			document.getElementById("form_to").submit();
		}
	</script>
</head>
<body>
<?php
	//MARY.SMITH@sakilacustomer.org, mary smith
	$links = mysqli_connect('localhost','hfycb1_hfycb1','12345isint.','hfycb1_id13307643_assignment2') or die("Could not connect to database");
	$email = $_SESSION['email'];
	$sqlherealso = "SELECT customer.first_name, customer.password,customer.last_name FROM customer WHERE customer.email = '$email'";
	$result_here_bef = mysqli_query($links,$sqlherealso);
	$result_here = mysqli_fetch_assoc($result_here_bef);
	$first_name = $_POST['cus_first_name'];
	$last_name = $_POST['cus_last_name'];
	$first_compare = $result_here['first_name'];
	$last_compare = $result_here['last_name'];
	$compare_password = $result_here['password'];
	$return_this = "Sucessfully updated details!";
	$colors = "#1cc88a";
	$password = $_POST['cus_new_password'];
	if($first_name == $first_compare&&$last_name == $last_compare&&$password==$compare_password)
	{//this is when the user does not update any data at all
		echo("<script>window.location.href = 'customer_page.php';</script>");
		//header("location:customer_page.php");
	}
	else if($first_name == $first_compare&&$last_name == $last_compare&&$password=="")
	{//this is when the user does not update any data at all
		echo("<script>window.location.href = 'customer_page.php';</script>");
		//header("location:customer_page.php");
	}
	else
	{
		
		$repeat_password = $_POST['repeat_password'];
		if($password!=$repeat_password)
		{
			$return_this = "Data not updated, both password does not match!";
			$colors = "red";
			echo("<form id = 'form_to' style = 'display:none;'action = 'customer_page.php'method = 'post'> <input value = '$return_this'type = 'text' name = 'return_message' /><input type = 'text' value = '$colors'name = 'colors' /></form>");
			
			//$sqlhere = "UPDATE `customer` SET `first_name` = '$first_name',`last_name` = '$last_name' WHERE customer.email = '$email'";
		}
		else if ($password=="")
		{
			
			$sqlhere = "UPDATE `customer` SET `first_name` = '$first_name',`last_name` = '$last_name',`last_update` = current_timestamp() WHERE customer.email = '$email'";
			mysqli_query ($links,$sqlhere);
			echo("<form id = 'form_to' style = 'display:none;'action = 'customer_page.php'method = 'post'> <input value = '$return_this'type = 'text' name = 'return_message' /><input type = 'text' value = '$colors'name = 'colors' /></form>");
		}
		else
		{
			$sqlhere = "UPDATE `customer` SET `first_name` = '$first_name',`password` = '$password',`last_name` = '$last_name',`last_update` = current_timestamp() WHERE customer.email = '$email'";
			mysqli_query ($links,$sqlhere);
			echo("<form id = 'form_to' style = 'display:none;'action = 'customer_page.php'method = 'post'> <input value = '$return_this'type = 'text' name = 'return_message' /><input type = 'text' value = '$colors'name = 'colors' /></form>");
		}
		
		
		
		echo("<script>submit_return();</script>");
	}
	
	
	
	
	
	
	
	
	
	

?>
</body>
</html>