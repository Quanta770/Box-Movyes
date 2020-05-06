<?php
	$links = mysqli_connect('localhost','hfycb1_hfycb1','12345isint.','hfycb1_id13307643_assignment2') or die("Could not connect to database");
	$sql_start = "SELECT staff.email FROM staff WHERE staff.staff_id = 3";
	$result_start = mysqli_query ($links,$sql_start);
	$staff_email = mysqli_fetch_assoc($result_start);
	$staff_email = $staff_email['email'];
	
	session_start();
	if(!(isset($_SESSION['email'])))
	{
		//is guest
		header("location:staff_login.php");
		
	}
	else if(isset($_SESSION['customer_check']))
	{
		
		header("location:customer_page.php");
		//is customer
	}
	else if ($_SESSION['email']!=$staff_email)
	{
		
		//is staff
		header("location:staff_page.php");
	}
	else if (!(isset($_POST['first_name'])&&isset($_POST['last_name'])&&isset($_POST['address'])&&isset($_POST['district'])&&isset($_POST['email'])&&isset($_POST['city'])&&isset($_POST['store_id'])))//not coming from add staff page
	{
		//redirect to add staff_page
		header("location:staff_add.php");
		
	}

?>
<!DOCTYPE html>
<html>
<head>
<link rel = "shortcut icon" href = "img/fav.png" />
<script>
	function added_staff()
	{
		alert('Staff successfully added!');
		document.getElementById("form_back").submit();
	}
	function fail_submit()
	{
		document.getElementById("fail_back_form").submit();
		
	}
	function send_back_func($input)
	{
		document.getElementById($input).submit();
		
	}
</script>
<title>Verifying information</title>
</head>
<body>
<?php
	function return_back($err_code,$first_name, $last_name, $address, $address2, $district,$postal_code, $city, $store_id, $email, $phone_number)
	{//add these input at the function call at the bottom HERERERRERERERERERERERERERER
		//try adding the function that send back information when stuff incorrect
		echo("<form id = 'fail_back_form' action = 'staff_add.php' method = 'post' style = 'display:none;'>
			<input type = 'text' value = '$first_name' name = 'first_name' />
			<input type = 'text' value = '$last_name' name = 'last_name' />
			<input type = 'text' value = '$address' name = 'address' />
			<input type = 'text' value = '$address2' name = 'address2' />
			<input type = 'text' value = '$district' name = 'district' />
			<input type = 'text' value = '$postal_code' name = 'postal_code' />
			<input type = 'text' value = '$city' name = 'city' />
			<input type = 'text' value = '$store_id' name = 'store' />
			<input type = 'text' value = '$email' name = 'email_address' />
			<input type = 'text' value = '$phone_number' name = 'phone_number' />");
		echo("<input type = 'text' value = '$err_code' name = 'password_err' />");
		
		
		
		echo("</form>");
		echo("<script>fail_submit();</script>");
		
	}
	function set_address($address2, $postal_code, $phone_number, $address_id,$links,$store_id,$staff_id)
	{
		
		
		if($store_id != 0)
		{
			$sql_not_null = "UPDATE `staff` SET `store_id` = '$store_id',`last_update` = current_timestamp() WHERE staff.staff_id = '$staff_id'";
			mysqli_query ($links,$sql_not_null);
			
			//normal, as previously it was set to NULL
		}
		
		if($address2!="")
		{
			$sql_address2 = "UPDATE `address` SET `address2`='$address2',`last_update` = current_timestamp() WHERE address.address_id = '$address_id'";
			
			mysqli_query ($links,$sql_address2);
			
		}
		else if(isset($_POST['old_staff']))
		{
			$sql_address2 = "UPDATE `address` SET `address2`=NULL,`last_update` = current_timestamp() WHERE address.address_id = '$address_id'";
			
			mysqli_query ($links,$sql_address2);
		}
		
		if($postal_code != "")
		{
			$sql_postal_code = "UPDATE `address` SET `postal_code`='$postal_code',`last_update` = current_timestamp() WHERE address.address_id = '$address_id'";
			mysqli_query ($links,$sql_postal_code);
		}
		else if(isset($_POST['old_staff']))
		{
			$sql_postal_code = "UPDATE `address` SET `postal_code`=NULL,`last_update` = current_timestamp() WHERE address.address_id = '$address_id'";
			mysqli_query ($links,$sql_postal_code);
			
		}
		
		if($phone_number != "")
		{
			$sql_phone_number = "UPDATE `address` SET `phone`='$phone_number',`last_update` = current_timestamp() WHERE address.address_id = '$address_id'";
			mysqli_query ($links,$sql_phone_number);
		}
		else if(isset($_POST['old_staff']))
		{
			$sql_phone_number = "UPDATE `address` SET `phone`=NULL,`last_update` = current_timestamp() WHERE address.address_id = '$address_id'";
			mysqli_query ($links,$sql_phone_number);
		}
		
		
	}
	function check_email_unique_old_staff($email,$old_email,$links)
	{
		//now, check if email is unique.
		$sql_check_cus_email = "SELECT customer.email FROM customer WHERE 1";
		$result = mysqli_query ($links,$sql_check_cus_email);
		
		while($row = mysqli_fetch_assoc($result))
		{
			if($email==$row['email'])
			{
				
				//break;
				return 1; //1 = error, 0 = no error
			}
			
		}
		
		
		//check if email repeat with staff...
		$sql_check_staff = "SELECT staff.email FROM staff WHERE staff.email<>'$old_email'";
		$result = mysqli_query ($links,$sql_check_staff);
		while($row = mysqli_fetch_assoc($result))
		{
			if($email == $row['email'])
			{
				
				//break;
				return 1;
			}
		}
		return 0;
		
	}
	$password = $_POST['password'];
	$password_confirm = $_POST['password_confirm'];
	if($password!=$password_confirm)
	{
		if(isset($_POST['old_staff']))
		{
			$staff_id = $_POST['staff_id'];
			echo("<form method = 'post' action = 'staff_add.php' id = 'err_old_staff' style = 'display:none;'>");
			echo("<input type = 'text' value = 1 name = 'password_err' />");
			echo("<input type = 'text' value = 1 name = 'old_staff' />");
			echo("<input type = 'text' value = '$staff_id' name = 'staff_id' />");
			echo("</form>");
			echo("<script>send_back_func('err_old_staff')</script>");
			
		}
		else
		{
			echo("<script>alert('Password does not match!');</script>");
			
			$address= $_POST['address'];
			$address2 = $_POST['address2'];
			$district = $_POST['district'];
			$city = $_POST['city'];
			$postal_code = $_POST['postal_code'];
			$phone_number = $_POST['phone_number'];
			$first_name = $_POST['first_name'];
			$last_name = $_POST['last_name'];
			$email = $_POST['email'];
			$store_id = $_POST['store_id'];
			return_back(1,$first_name, $last_name, $address, $address2, $district,$postal_code, $city, $store_id, $email, $phone_number);
		}
		//here we should have return, but nope its fine
		
	}
	else
	{
		if(isset($_POST['old_staff']))
		{//old staff, take that
			$staff_id = $_POST['staff_id'];
			$sql_check = "SELECT staff.address_id, staff.first_name, staff.last_name, address.address, address.address2, address.district, address.postal_code, address.city_id, address.postal_code, address.phone, staff.store_id, staff.email, staff.password FROM staff INNER JOIN address ON staff.address_id = address.address_id WHERE staff.staff_id = $staff_id";
			$result = mysqli_query($links, $sql_check);
			$row = mysqli_fetch_assoc($result);
			
			$first_name_d = $row['first_name'];
			$last_name_d = $row['last_name'];
			$address_d = $row['address'];
			$address2_d = $row['address2'];
			$district_d = $row['district'];
			$postal_code_d = $row['postal_code'];
			$city_d = $row['city_id'];
			$store_d = $row['store_id'];
			$email_address_d = $row['email'];
			$phone_number_d = $row['phone'];
			$password_d = $row['password'];
			$address_id = $row['address_id'];
			
			$address= $_POST['address'];
			$address2 = $_POST['address2'];
			$district = $_POST['district'];
			$city = $_POST['city'];
			$postal_code = $_POST['postal_code'];
			$phone_number = $_POST['phone_number'];
			$first_name = $_POST['first_name'];
			$last_name = $_POST['last_name'];
			$store_id = $_POST['store_id'];
			$password = $_POST['password'];
			$email = $_POST['email'];
			
			
			if($first_name_d==$first_name && $last_name_d == $last_name && $address_d == $address && $address2_d == $address2 && $district_d == $district && $email_address_d == $email && $postal_code_d == $postal_code && $city_d == $city && $store_d == $store_id && $phone_number_d == $phone_number && ($password_d == $password||$password == ""))
			{
				echo("
					<form method = 'post' action = 'staff_add.php' id = '0' style = 'display:none;'>
						<input type = 'text' value = 1 name = 'old_staff' />
						<input type = 'text' value = '$staff_id' name = 'staff_id' />
					</form>
				");
				echo("<script>send_back_func(0);</script>");
				
			}
			else
			{
				if($email != $email_address_d)
				{
					//update email
					//first, check if email repetition
					$error = check_email_unique_old_staff($email, $email_address_d,$links);
				}
				else
				{
					$error = 0;
					
				}
				if($error == 0)
				{
					if($password == "")
					{
						$sql_staff = "UPDATE `staff` SET `first_name` = '$first_name', `store_id` = NULL,`email` = '$email',`last_name` = '$last_name',`last_update` = current_timestamp() WHERE staff.staff_id = '$staff_id'";
					}
					else
					{
						$sql_staff = "UPDATE `staff` SET `first_name` = '$first_name', `store_id` = NULL,`email` = '$email',`last_name` = '$last_name',`password` = '$password',`last_update` = current_timestamp() WHERE staff.staff_id = $staff_id";
					}
					
					$sql_address = "UPDATE `address` SET `address` = '$address',`district` = '$district', `city_id` = '$city',`last_update` = current_timestamp() WHERE address.address_id = '$address_id'";
					mysqli_query($links, $sql_address);
					
					
					
					//settle address first
					mysqli_query($links, $sql_staff);	
					set_address($address2, $postal_code, $phone_number, $address_id,$links,$store_id,$staff_id);
					
					//updating email section
					
					
					echo("
						<form method = 'post' action = 'staff_add.php' id = '10' style = 'display:none;'>
							<input type = 'text' value = 1 name = 'old_staff' />
							<input type = 'text' value = '$staff_id' name = 'staff_id' />
							<input type = 'text' value = 1 name = 'success_update_staff' />
						</form>
					");
					echo("<script>send_back_func(10);</script>");
				}
				else
				{
					
					$staff_id = $_POST['staff_id'];
					echo("<form method = 'post' action = 'staff_add.php' id = 'err_old_staff'> style = 'display:none;'");
					echo("<input type = 'text' value = 2 name = 'password_err' />");
					echo("<input type = 'text' value = 1 name = 'old_staff' />");
					echo("<input type = 'text' value = '$staff_id' name = 'staff_id' />");
					echo("</form>");
					echo("<script>send_back_func('err_old_staff')</script>");
					
				}
				
				
			}
			
			
		}
		else
		{
			//adding the address and staff to the database for new staff
			$email = $_POST['email'];
			//now, check if email is unique.
			$sql_check_cus_email = "SELECT customer.email FROM customer WHERE 1";
			$result = mysqli_query ($links,$sql_check_cus_email);
			$error = 0;
			while($row = mysqli_fetch_assoc($result))
			{
				if($email==$row['email'])
				{
					$error = 1;
					break;
				}
				
			}
			if($error==0)
			{
				//check if email repeat with staff...
				$sql_check_staff = "SELECT staff.email FROM staff WHERE 1";
				$result = mysqli_query ($links,$sql_check_staff);
				while($row = mysqli_fetch_assoc($result))
				{
					if($email == $row['email'])
					{
						$error=1;
						break;
					}
				}
				
			}
			if($error==1)
			{
				//send data back, and tell error
				echo("<script>alert('Email has been used before!');</script>");
				$address= $_POST['address'];
				$address2 = $_POST['address2'];
				$district = $_POST['district'];
				$city = $_POST['city'];
				$postal_code = $_POST['postal_code'];
				$phone_number = $_POST['phone_number'];
				$first_name = $_POST['first_name'];
				$last_name = $_POST['last_name'];
				$store_id = $_POST['store_id'];
				return_back(2,$first_name, $last_name, $address, $address2, $district,$postal_code, $city, $store_id, $email, $phone_number);
				
			}
			else
			{
			
			
				//adding new staff
				$address= $_POST['address'];
				$address2 = $_POST['address2'];
				$district = $_POST['district'];
				$city = $_POST['city'];
				$postal_code = $_POST['postal_code'];
				$phone_number = $_POST['phone_number'];
				
				$mysql1 = "INSERT INTO `address` (`address_id`,`address`,`address2`,`district`,`city_id`,`postal_code`,`phone`,`last_update`) VALUES (NULL,'$address',NULL,'$district','$city',NULL,NULL,current_timestamp());";
				mysqli_query ($links,$mysql1);
				
				$mysql2 = "SELECT address.address_id FROM address WHERE address.address LIKE '$address' && address.address2 IS NULL && address.district LIKE '$district' && address.city_id LIKE '$city' && address.postal_code IS NULL && address.phone IS NULL";
				$result = mysqli_query ($links,$mysql2);
				$address_id = mysqli_fetch_assoc($result);
				$address_id = $address_id['address_id'];
				
				
				
				
				//proceed to add staff to the database, after the address of the staff is added.
				$first_name = $_POST['first_name'];
				$last_name = $_POST['last_name'];
				
				$store_id = $_POST['store_id'];
				$password = $_POST['password'];
				$sql_add_staff = "INSERT INTO `staff` (`staff_id`,`first_name`,`last_name`,`address_id`,`picture`,`email`,`store_id`,`active`,`password`,`last_update`) VALUES (NULL,'$first_name','$last_name','$address_id',NULL,'$email',NULL,'1','$password',current_timestamp());";
				$result = mysqli_query($links,$sql_add_staff);
				
				
				$sql_staff_id = "SELECT staff.staff_id FROM staff WHERE staff.address_id = '$address_id'";
				$result = mysqli_query($links, $sql_staff_id);
				$result = mysqli_fetch_assoc($result);
				$staff_id = $result['staff_id'];
				set_address($address2, $postal_code, $phone_number, $address_id,$links,$store_id,$staff_id);
				echo("
					<form id = 'form_back' action = 'staff_add.php' method = 'post' style = 'display:none;'>
						<input type = 'text' value = 1 name = 'success_add'/>
					</form>
				
				");
				echo("<script>added_staff();</script>");
				
			}
		}
		
	}

?>
</body>
</html>