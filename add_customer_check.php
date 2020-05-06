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
	else if(!(isset($_POST['first_name'])&&isset($_POST['last_name'])&&isset($_POST['email'])&&isset($_POST['password'])&&isset($_POST['confirm_password'])&&isset($_POST['address'])&&isset($_POST['district'])))
	{
		header("Location:staff_view_customer.php");
	}
?>
<!DOCTYPE html>
<html>
<head>
<link rel = "shortcut icon" href = "img/fav.png" />
<script>
	function back_fun()
	{
		document.getElementById("back_form").submit();
	}
	function error_fun()
	{
		document.getElementById("error_form").submit();
	}
</script>
<title>Adding customer</title>
</head>
<body>
<?php
	//test if add store check works
	$password = $_POST['password'];
	$confirm_password = $_POST['confirm_password'];
	$email = $_POST['email'];	
	$links = mysqli_connect('localhost','hfycb1_hfycb1','12345isint.','hfycb1_id13307643_assignment2') or die("Could not connect to database");
	$address = $_POST['address'];
	$address2 = $_POST['address2'];        //
	$district = $_POST['district'];
	$city_id = $_POST['city'];
	$postal_code = $_POST['postal_code'];  //
	$phone = $_POST['phone'];              //
	
	$first_name = $_POST['first_name'];
	$last_name = $_POST['last_name'];
	if($password != $confirm_password)
	{
		echo("
			<form method = 'post' action = 'add_new_customer.php' id = 'error_form'>
				<input type = 'text' value = '$email' name = 'email' />
				<input type = 'text' value = '$address' name = 'address' />
				<input type = 'text' value = '$address2' name = 'address2' />
				<input type = 'text' value = '$district' name = 'district' />
				<input type = 'text' value = '$city_id' name = 'city' />
				<input type = 'text' value = '$postal_code' name = 'postal_code' />
				<input type = 'text' value = '$phone' name = 'phone' />
				<input type = 'text' value = '$first_name' name = 'first_name' />
				<input type = 'text' value = '$last_name' name = 'last_name' />
				<input type = 'text' value = 1 name = 'password_err' />
			</form>
		");
		echo("<script>error_fun();</script>");
		//error, go back
	}
	else
	{
		$sql_email_customer = "SELECT customer.email FROM customer WHERE 1";
		$result = mysqli_query($links, $sql_email_customer);
		$error = 0;
		while($row = mysqli_fetch_assoc($result))
		{
			if($email == $row['email'])
			{
				$error = 1;
				break;
			}
		}
		if($error == 0)
		{
			$sql_email_staff = "SELECT staff.email FROM staff WHERE 1";
			$result = mysqli_query($links, $sql_email_staff);
			while($row = mysqli_fetch_assoc($result))
			{
				if($email == $row['email'])
				{
					$error = 1;
					break;
				}
			}
			//check with staff email
		}
		if($error == 1)
		{
			echo("
				<form method = 'post' action = 'add_new_customer.php' id = 'error_form'>
					<input type = 'text' value = '$email' name = 'email' />
					<input type = 'text' value = '$address' name = 'address' />
					<input type = 'text' value = '$address2' name = 'address2' />
					<input type = 'text' value = '$district' name = 'district' />
					<input type = 'text' value = '$city_id' name = 'city' />
					<input type = 'text' value = '$postal_code' name = 'postal_code' />
					<input type = 'text' value = '$phone' name = 'phone' />
					<input type = 'text' value = '$first_name' name = 'first_name' />
					<input type = 'text' value = '$last_name' name = 'last_name' />
					<input type = 'text' value = 1 name = 'email_err' />
				</form>
			");
			echo("<script>error_fun();</script>");
			//redirect back, report error
		}
		else
		{
			$sql_address = "INSERT INTO `address` (`address_id`, `address`, `address2`, `district`, `city_id`, `postal_code`, `phone`, `last_update`) VALUES (NULL,'$address', NULL,'$district', '$city_id', NULL,NULL,current_timestamp());";
			$result = mysqli_query($links, $sql_address);
			
			$sql_address_id = "SELECT address.address_id FROM address WHERE address.address LIKE '$address' AND address.district LIKE '$district' AND address.city_id ='$city_id'";
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
			
			
			
			
			
			
			$sql_insert = "INSERT INTO `customer` (`customer_id`, `store_id`, `first_name`, `last_name`, `email`, `address_id`, `active`, `create_date`, `last_update`, `password`) VALUES (NULL, NULL, '$first_name', '$last_name', '$email', '$address_id','1',current_timestamp(), current_timestamp(), '$password')";
			$result = mysqli_query($links, $sql_insert);
			if($result ==1)
			{
				echo("<script>alert('Successfully added new customer!');</script>");
				echo("
					<form method = 'post' action = 'add_new_customer.php' style = 'display:none;' id = 'back_form'>
						<input type = 'text' name = 'insert_success' value = 1 />
					</form>
				
				");
				echo("<script>back_fun();</script>");
				//success
			}
			else
			{
				echo("<script>alert('Error fetching data!');</script>");
				echo("<script>window.location.href='add_new_customer.php';</script>");
				//fail
			}
		}
		
	}
?>
</body>

</html>