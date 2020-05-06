<?php
	$sql_start = "SELECT staff.email FROM staff WHERE staff.staff_id = 3";
	$links = mysqli_connect('localhost','hfycb1_hfycb1','12345isint.','hfycb1_id13307643_assignment2') or die("Could not connect to database");
	$result_start = mysqli_query ($links,$sql_start);
	$staff_email = mysqli_fetch_assoc($result_start);
	$staff_email = $staff_email['email'];
	
	session_start();
	if(isset($_SESSION['customer_check']))
	{
		//header("location:customer_page.php");
		echo("<script>window.location.href = 'customer_page.php';</script>");
		//is customer
	}
	else if(!isset($_SESSION['email']))
	{
		//is guest
		echo("<script>window.location.href = 'staff_login.php';</script>");
		//header("location:staff_login.php");
	}
	else if ($_SESSION['email']!=$staff_email)
	{
		//is staff
		echo("<script>window.location.href = 'staff_page.php';</script>");
		//header("location:staff_page.php");
	}
	else if(!(isset($_POST['store_id']))&& !(isset($_POST['address']))&&!(isset($_POST['district'])))
	{
		echo("<script>window.location.href = 'add_store_admin.php';</script>");
		//header("location:add_store_admin.php");
	}
?>
<!DOCTYPE html>
<html>
<head>
<link rel = "shortcut icon" href = "img/fav.png" />
<script>
	function send_fun()
	{
		document.getElementById("send_form").submit();
	}
</script>
<title>Adding store...</title>
</head>
<?php
	$staff_id = $_POST['staff_id'];
	
	$address = $_POST['address'];
	$address2 = $_POST['address2'];
	$district = $_POST['district'];
	$postal_code = $_POST['postal_code'];
	$phone = $_POST['phone'];
	$city = $_POST['city'];
	
	
	$sql_address = "INSERT INTO `address` (`address_id`, `address`, `address2`, `district`, `city_id`, `postal_code`, `phone`, `last_update`) VALUES (NULL, '$address', NULL, '$district', '$city',NULL, NULL, current_timestamp());";
	mysqli_query($links, $sql_address);
	
	$sql_address_id = "SELECT address.address_id FROM address WHERE address.address LIKE '$address' AND address.district LIKE '$district' AND address.city_id ='$city'";
	$result = mysqli_query($links, $sql_address_id);
	$address_id = mysqli_fetch_assoc($result);
	$address_id = $address_id['address_id'];
	if($address2!="")
	{
		$sql_address2 = "UPDATE `address` SET `address2`='$address2',`last_update` = current_timestamp() WHERE address.address_id = '$address_id'";
		
		mysqli_query ($links,$sql_address2);
		
	}
	if($postal_code != "")
	{
		$sql_postal_code = "UPDATE `address` SET `postal_code`='$postal_code',`last_update` = current_timestamp() WHERE address.address_id = '$address_id'";
		mysqli_query ($links,$sql_postal_code);
	}
	if($phone != "")
	{
		$sql_phone_number = "UPDATE `address` SET `phone`='$phone',`last_update` = current_timestamp() WHERE address.address_id = '$address_id'";
		mysqli_query ($links,$sql_phone_number);
	}
	$sql_address_id = "SELECT address.address_id FROM address WHERE address.address = '$address' && address.district = '$district' && address.city_id = '$city' ";
	$result = mysqli_query($links, $sql_address_id);
	$result = mysqli_fetch_assoc($result);
	$address_id = $result['address_id'];
	$sql_store = "INSERT INTO `store` (`store_id`, `manager_staff_id`, `address_id`, `active`, `last_update`) VALUES (NULL, $staff_id, $address_id, 1, current_timestamp());";
	mysqli_query($links,$sql_store);
	echo("
		<form method = 'post' action = 'add_store_admin.php' id='send_form'>
			<input type = 'text' value = 1 name = 'add_success'/>
		</form>
	
	");
	echo("<script>send_fun();</script>");
	
?>
</html>