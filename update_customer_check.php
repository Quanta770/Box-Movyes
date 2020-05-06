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
	else if(!(isset($_POST['customer_id'])&&isset($_POST['first_name'])&&isset($_POST['last_name'])&&isset($_POST['email'])&&isset($_POST['address'])&&isset($_POST['district'])&&isset($_POST['city'])))
	{
		header("Location:staff_view_customer.php");
	}
?>
<!DOCTYPE html>
<html>
<head>
<link rel = "shortcut icon" href = "img/fav.png" />
	<script>
		function submit_fun()
		{
			document.getElementById("submit_success_form").submit();
		}	
	</script>
	<title>Updating customer</title>
</head>
<body>
<?php
	$links = mysqli_connect('localhost','hfycb1_hfycb1','12345isint.','hfycb1_id13307643_assignment2') or die("Could not connect to database");
	$customer_id = $_POST['customer_id'];
	$first_name = $_POST['first_name'];
	$last_name = $_POST['last_name'];
	$email = $_POST['email'];
	$address = $_POST['address'];
	$address2 = $_POST['address2'];       //
	$district = $_POST['district'];
	$city_id = $_POST['city'];
	$postal_code = $_POST['postal_code'];//
	$phone =  $_POST['phone'];           //
	
	$sql_update = "UPDATE `customer` SET `first_name` = '$first_name', `last_name` = '$last_name', `email` = '$email',`last_update` = current_timestamp() WHERE customer.customer_id = '$customer_id'";
	$result = mysqli_query($links, $sql_update);
	$sql_address = "SELECT customer.address_id FROM customer WHERE customer.customer_id = '$customer_id'";
	$result2 = mysqli_query($links, $sql_address);
	$address_id = mysqli_fetch_assoc($result2);
	$address_id = $address_id['address_id'];
	$sql_update = "UPDATE `address` SET `address` = '$address', `district` = '$district', `city_id` = '$city_id',`last_update` = current_timestamp() WHERE address.address_id = '$address_id'";
	$result = mysqli_query($links, $sql_update);
	
	if($address2!="")
	{
		$sql_address2 = "UPDATE `address` SET `address2`='$address2',`last_update` = current_timestamp() WHERE address.address_id = '$address_id'";
		
		$result = mysqli_query ($links,$sql_address2);
		
	}
	else
	{
		$sql_address2 = "UPDATE `address` SET `address2`=NULL,`last_update` = current_timestamp() WHERE address.address_id = '$address_id'";
		
		$result = mysqli_query ($links,$sql_address2);
	}
	
	if($postal_code != "")
	{
		$sql_postal_code = "UPDATE `address` SET `postal_code`='$postal_code',`last_update` = current_timestamp() WHERE address.address_id = '$address_id'";
		$result = mysqli_query ($links,$sql_postal_code);
	}
	else
	{
		$sql_postal_code = "UPDATE `address` SET `postal_code`=NULL,`last_update` = current_timestamp() WHERE address.address_id = '$address_id'";
		$result = mysqli_query ($links,$sql_postal_code);
	}
	
	
	if($phone != "")
	{
		$sql_phone_number = "UPDATE `address` SET `phone`='$phone',`last_update` = current_timestamp() WHERE address.address_id = '$address_id'";
		$result = mysqli_query ($links,$sql_phone_number);
	}
	else
	{
		$sql_phone_number = "UPDATE `address` SET `phone`=NULL,`last_update` = current_timestamp() WHERE address.address_id = '$address_id'";
		$result = mysqli_query ($links,$sql_phone_number);
	}
	
	
	if($result == 1)
	{
		echo("<script>alert('Successfully updated customer!');</script>");
		echo("
			<form method = 'post' action = 'update_customer.php' style = 'display:none;' id = 'submit_success_form'>
				<input type = 'text' value = 1 name = 'update_success' />
				<input type = 'text' value = '$customer_id' name = 'customer_id' />
			</form>
		");
		echo("<script>submit_fun()</script>");
		//success!
	}
	else
	{
		echo("<script>alert('Error fetching data!');</script>");
		echo("<script>window.location.href('staff_view_customer.php');</script>");
		//error
	}
	
	
	
	
?>
</body>
</html>	