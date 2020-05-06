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
	else if(!(isset($_POST['customer_id'])&&isset($_POST['customer_type'])))
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
		document.getElementById("form_submit").submit();
	}
</script>
<title>Processing request..</title>
</head>
<body>
<?php
	$links = mysqli_connect('localhost','hfycb1_hfycb1','12345isint.','hfycb1_id13307643_assignment2') or die("Could not connect to database");
	$customer_id = $_POST['customer_id'];
	$customer_type = $_POST['customer_type'];
	if($customer_type == "blacklist")
	{
		$sql_update ="UPDATE `customer` SET `active` = '1',`last_update` = current_timestamp() WHERE customer.customer_id = '$customer_id'";
		//active = 0
	}
	else
	{
		$sql_update ="UPDATE `customer` SET `active` = '0',`last_update` = current_timestamp() WHERE customer.customer_id = '$customer_id'";
		//active =1
	}
	$result = mysqli_query($links,$sql_update);
	if($result ==1)
	{
		echo("<script>alert('Successfully updated status!');</script>");
		echo("
			<form method = 'post' action = 'staff_view_customer.php' id='form_submit' style = 'display:none;'>
				<input type = 'text' value = 1 name = 'success_blacklist' />
			</form>
		");
		echo("<script>submit_fun()</script>");
		//success
	}
	else
	{
		echo("<script>alert('Error fetching data!');</script>");
		echo("<script>window.location.href = 'staff_view_customer.php'</script>");
		//failure
	}
?>
</body>
</html>