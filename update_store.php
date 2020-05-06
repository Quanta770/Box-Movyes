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
		//header("location:staff_login.php");
		echo("<script>window.location.href = 'staff_login.php';</script>");
	}
	else if ($_SESSION['email']!=$staff_email)
	{
		//is staff
		echo("<script>window.location.href = 'staff_page.php';</script>");
		//header("location:staff_page.php");
	}
	else if(!(isset($_POST['store_id']))&& !(isset($_POST['address']))&&!(isset($_POST['district'])))
	{
		echo("<script>window.location.href = 'admin_store.php';</script>");
		//header("location:admin_store.php");
	}
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
</script>
<title>Updating store...</title>
</head>
<body>
<?php
	
	$store_id = $_POST['store_id'];
	
		$sql_address_id = "SELECT store.address_id FROM store WHERE store.store_id = '$store_id'";
		$result = mysqli_query($links,$sql_address_id);
		$row = mysqli_fetch_assoc($result);
		$address_id = $row['address_id'];
		$address = $_POST['address'];
		$address2 = $_POST['address2'];
		$district = $_POST['district'];
		$postal_code = $_POST['postal_code'];
		$phone = $_POST['phone'];
		$city = $_POST['city'];
		$staff_id = $_POST['staff_id'];
		$store_id = $_POST['store_id'];
		$sql_store_update = "UPDATE `store` SET `manager_staff_id` ='$staff_id',`last_update` = current_timestamp() WHERE store.store_id = '$store_id'";
		mysqli_query($links, $sql_store_update);
		
		$sql_address = "UPDATE `address` SET `address` = '$address',`district` = '$district', `city_id` = '$city',`last_update` = current_timestamp() WHERE address.address_id = '$address_id'";
		mysqli_query($links, $sql_address);
		if($address2!="")
		{
			$sql_address2 = "UPDATE `address` SET `address2`='$address2',`last_update` = current_timestamp() WHERE address.address_id = '$address_id'";
			
			mysqli_query ($links,$sql_address2);
			
		}
		else
		{
			$sql_address2 = "UPDATE `address` SET `address2`=NULL,`last_update` = current_timestamp() WHERE address.address_id = '$address_id'";
			
			mysqli_query ($links,$sql_address2);
		}
		
		if($postal_code != "")
		{
			$sql_postal_code = "UPDATE `address` SET `postal_code`='$postal_code',`last_update` = current_timestamp() WHERE address.address_id = '$address_id'";
			mysqli_query ($links,$sql_postal_code);
		}
		else
		{
			$sql_postal_code = "UPDATE `address` SET `postal_code`=NULL,`last_update` = current_timestamp() WHERE address.address_id = '$address_id'";
			
			mysqli_query ($links,$sql_postal_code);
		}
		
		if($phone != "")
		{
			$sql_phone_number = "UPDATE `address` SET `phone`='$phone',`last_update` = current_timestamp() WHERE address.address_id = '$address_id'";
			mysqli_query ($links,$sql_phone_number);
		}
		else
		{
			$sql_phone_number = "UPDATE `address` SET `phone`=NULL,`last_update` = current_timestamp() WHERE address.address_id = '$address_id'";
			mysqli_query ($links,$sql_phone_number);
		}
		echo("
			<form method = 'post' action = 'edit_store_admin.php' id ='submit_form' style = 'display:none;'>
				<input type = 'text' value = 1 name=  'update_success' />
				<input type = 'text' value = '$store_id' name=  'store_id' />
			</form>
		");
		echo("<script>submit_fun();</script>");
	
	
	


?>
</body>
</html>