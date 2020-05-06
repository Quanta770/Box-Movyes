<?php
	session_start();
	if(!isset($_SESSION['email']))
	{
		header("location:index.php");
	}
	else if (isset($_SESSION['customer_check']))
	{
		header("location:customer_page.php");
	}
	//if not logged in, go to home page
	//if staff logged in, go to staff page
	//else do nothing
	
?>
<!DOCTYPE html>
<html>
<head>
<link rel = "shortcut icon" href = "img/fav.png" />
	<script>
		function submit_to()
		{
			document.getElementById("submits").submit();
		}s
	</script>
	<title>Validating information....</title>
</head>
<body>
	<?php
		//MARY.SMITH@sakilacustomer.org
		$links = mysqli_connect('localhost','hfycb1_hfycb1','12345isint.','hfycb1_id13307643_assignment2') or die("Could not connect to database");

		$email = $_SESSION['email'];
		$email_sub = $_POST['cus_email'];
		$address_1 = $_POST['cus_address'];
		$address_2 = $_POST['cus_address2'];
		$district = $_POST['cus_district'];
		$postal_code = $_POST['cus_postal_code'];
		$city = $_POST['list'];
		$phone = $_POST['cus_phone_number'];
		$sql = "SELECT address.address,address.address2,address.district,address.postal_code,address.phone,city.city FROM staff INNER JOIN address ON staff.address_id = address.address_id INNER JOIN city ON address.city_id = city.city_id WHERE staff.email = '$email'";
		$result = mysqli_query($links,$sql);
		$final_result = mysqli_fetch_assoc($result);
		$test_address = $final_result['address'];
		$test_address_2 = $final_result['address2'];
		$test_district = $final_result['district'];
		$test_postal = $final_result['postal_code'];
		$test_phone = $final_result['phone'];
		$test_city = $final_result['city'];
		//step 0: check if the email is the same and not being updated
		if($email == $email_sub && $address_1 == $test_address && $address_2	 == $test_address_2 && $district==$test_district && $postal_code==$test_postal && $city==$test_city && $phone==$test_phone)
		{//this is when the user does not update any data at all
			//header("location:staff_page.php");
			echo("<script>window.location.href = 'staff_page.php';</script>");
		
		}
		else
		{//this is when at least one data is manipulated
			//step 1: check if the email submitted is same as any email in the database
			$mysql1 = "SELECT customer.email FROM customer WHERE 1";
			$mysql2 = "SELECT staff.email FROM staff WHERE staff.email <> '$email'";
			
			$result = mysqli_query($links,$mysql1);
			$return_message = "Sucessfully updated details!";
			$color = "#1cc88a";
			$check_1 = 0;
			while($final_result = mysqli_fetch_assoc($result))
			{
				
				if($final_result['email']==$email_sub)
				{//if there is an issue
					
					
					$return_message = "The email entered has been used before!";
					$color = "red";
					$check_1 = 1;
					
					break;
				}	
				
				
				
			}
			$result = mysqli_query($links,$mysql2);
			if($check_1 == 0)
			{
				while($final_result = mysqli_fetch_assoc($result))
				{
					if($final_result['email']==$email_sub)
					{//if there is an issue
						
						
						$return_message = "The email entered has been used before!";
						$color = "red";
						$check_1 = 1;
						
						break;
					}	
					
				}
				
			}
				
			if($check_1 ==0)
			{
				$mysql_update = "UPDATE `staff` SET `email` = '$email_sub',`last_update` = current_timestamp() WHERE staff.email = '$email'";
				mysqli_query($links,$mysql_update);
				$_SESSION['email'] = "$email_sub";
				//address2, postal_code, phone
				
				$mysql3 = "UPDATE `address` SET `address` = '$address_1',`district` = '$district',`city_id` = '$city',`last_update` = current_timestamp() WHERE address.address_id = (SELECT staff.address_id FROM staff WHERE staff.email LIKE '$email')";
				mysqli_query($links,$mysql3);
				
				if($address_2!="")
				{
					$sql_address2 = "UPDATE `address` SET `address2`='$address_2',`last_update` = current_timestamp() WHERE address.address_id = (SELECT staff.address_id FROM staff WHERE staff.email LIKE '$email')";
					
					$result = mysqli_query ($links,$sql_address2);
					
				}
				else
				{
					$sql_address2 = "UPDATE `address` SET `address2`=NULL,`last_update` = current_timestamp() WHERE address.address_id = (SELECT staff.address_id FROM staff WHERE staff.email LIKE '$email')";
					
					$result = mysqli_query ($links,$sql_address2);
				}
				
				if($postal_code != "")
				{
					$sql_postal_code = "UPDATE `address` SET `postal_code`='$postal_code',`last_update` = current_timestamp() WHERE address.address_id = (SELECT staff.address_id FROM staff WHERE staff.email LIKE '$email')";
					$result = mysqli_query ($links,$sql_postal_code);
				}
				else
				{
					$sql_postal_code = "UPDATE `address` SET `postal_code`=NULL,`last_update` = current_timestamp() WHERE address.address_id = (SELECT staff.address_id FROM staff WHERE staff.email LIKE '$email')";
					$result = mysqli_query ($links,$sql_postal_code);
				}
				
				
				if($phone != "")
				{
					$sql_phone_number = "UPDATE `address` SET `phone`='$phone',`last_update` = current_timestamp() WHERE address.address_id = (SELECT staff.address_id FROM staff WHERE staff.email LIKE '$email')";
					$result = mysqli_query ($links,$sql_phone_number);
				}
				else
				{
					$sql_phone_number = "UPDATE `address` SET `phone`=NULL,`last_update` = current_timestamp() WHERE address.address_id = (SELECT staff.address_id FROM staff WHERE staff.email LIKE '$email')";
					$result = mysqli_query ($links,$sql_phone_number);
				}
				
							
				
			}
			echo("<form id = 'submits'style = 'display:none;' method = 'post'action = 'staff_page.php'><input type = 'text' name = 'return_message2' value = '$return_message' /><input type = 'text' value = '$color' name = 'color2' /></form>");
			echo("<script>submit_to();</script>");
		}
		
		
		
	
	?>
</body>
</html>