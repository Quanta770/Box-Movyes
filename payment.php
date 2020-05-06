<!DOCTYPE html>
<html>
<head>
<link rel = "shortcut icon" href = "img/fav.png" />
<script>
	function back_fun()
	{
		document.getElementById("back_form").submit();
	}
</script>
<title>Processing Payment</title>
</head>
<body>

<?php
	if(isset($_POST['payment_id']))
	{
		$payment_id = $_POST['payment_id'];
	}
	else
	{
		$payment_id = $_POST['payment_id_out'];
	}
	
	$sql = "UPDATE `payment` SET `payment_status`  = '1',`staff_id` = '4',`payment_date` = current_timestamp(),`last_update` = current_timestamp() WHERE payment.payment_id = $payment_id";
	$links = mysqli_connect('localhost','hfycb1_hfycb1','12345isint.','hfycb1_id13307643_assignment2') or die("Could not connect to database");
	$result = mysqli_query ($links,$sql);
	if($result == 1)
	{
		echo("<script>alert('Successfully paid!')</script>");
		if(isset($_POST['payment_id']))
		{
			
			$where = "customer_other_unpaid.php";
		}
		else
		{
			
			$where = "customer_outstanding_payment.php";
		}
		echo("
			<form method ='post' action = '$where' style = 'display:none;' id = 'back_form'>
				<input type= 'text' value =1 name = 'success' />
			</form>
		
		");
		echo("<script>back_fun();</script>");
	}
	else
	{
		
	}
	
	
?>


</body>
</html>