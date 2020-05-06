<?php
	session_start();
	if(!isset($_SESSION['email']))//restrict access if not login
	{
		header('location:login.php');
	}
	else if (isset($_SESSION['staff_check']))
	{
		header('location:staff_page.php');
	}
	else if (!isset($_POST['delete_rent_id']))
	{
		header('location:customer_unresolved_rental.php');
	}
	//conditon
	/*
	if the user is not logged in and come in this page, it will redirect you to login
	if youre staff, and you go to this page, youll be redirected to the staff page
	if youre customer, nothing happends
	*/
?>
<!DOCTYPE html>
<html>
<head>
<link rel = "shortcut icon" href = "img/fav.png" />
	<script>
		function submit_form()	
		{
			document.getElementById("success").submit();
			
		}
	</script>
</head>
<body>
<?php
	$rent_id = $_POST['delete_rent_id'];
	$sql = "UPDATE `rental` SET `status_id` = '4',`last_update` = current_timestamp() WHERE rental.rental_id = $rent_id";
	$links = mysqli_connect('localhost','hfycb1_hfycb1','12345isint.','hfycb1_id13307643_assignment2') or die("Could not connect to database");
	$resultqw = mysqli_query ($links,$sql);
	
	$sql = "SELECT payment.payment_id,payment.payment_status FROM payment WHERE payment.rental_id = '$rent_id' AND payment.payment_type_id = '1'";
	$result = mysqli_query($links,$sql);
	$result = mysqli_fetch_assoc($result);
	$payment_status = $result['payment_status'];
	$payment_id = $result['payment_id'];
	if($payment_status == 1)
	{
		$sql = "UPDATE `payment` SET `payment_status` = '2',`last_update` = current_timestamp() WHERE payment.payment_id = '$payment_id'";
		$result12 = mysqli_query($links,$sql);
		if($result12 == 1)
		{
			echo("<script>alert('Payment associated has been changed to refund.');</script>");
		}
		else
		{
			echo("<script>alert('Error setting payment to refund!');</script>");
		}
		
		//refund the 
	}
	else if($payment_status == 0)
	{
		$sql = "UPDATE `payment` SET `payment_status` = '3',`last_update` = current_timestamp() WHERE payment.payment_id = '$payment_id'";
		$resilt23 = mysqli_query($links,$sql);
		if($resilt23 == 1)
		{
			echo("<script>alert('Payment associated has been voided');</script>");
			
		}
		else
		{
			echo("<script>alert('Error setting payment to void!');</script>");
		}
		
	}
	
	
	if($resultqw ==1)
	{
		echo("<form action = 'customer_unresolved_rental.php' method = 'post' id = 'success' style = 'display:none;'>");
		echo("<input type = 'text' value = '1' name = 'delete_success' />");
		echo("</form>");
		echo("<script>submit_form();</script>");
	}
	else
	{
		echo("<script>alert('Error fetching data');</script>");
		echo("<script>window.location.href('customer_unresolved_rental.php');</script>");
	}
	
?>

<body>
</html>