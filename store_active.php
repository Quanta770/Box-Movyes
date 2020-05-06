<?php
	$sql_start = "SELECT staff.email FROM staff WHERE staff.staff_id = 3";
	$links = mysqli_connect('localhost','hfycb1_hfycb1','12345isint.','hfycb1_id13307643_assignment2') or die("Could not connect to database");
	$result_start = mysqli_query ($links,$sql_start);
	$staff_email = mysqli_fetch_assoc($result_start);
	$staff_email = $staff_email['email'];
	
	session_start();
	if(isset($_SESSION['customer_check']))
	{
		header("location:customer_page.php");
		//is customer
	}
	else if(!isset($_SESSION['email']))
	{
		//is guest
		header("location:staff_login.php");
	}
	else if ($_SESSION['email']!=$staff_email)
	{
		//is staff
		
		header("location:staff_page.php");
	}
	else if(!(isset($_POST['store_id'])&&isset($_POST['store_type'])))
	{
		header("location:admin_store.php");
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
<title>Processing request</title>
</head>
<body>
<?php
	$store_id = $_POST['store_id'];
	$store_type = $_POST['store_type'];
	if($store_type == "active")
	{
		$sql = "UPDATE `store` SET `active` = 0,`last_update` = current_timestamp() WHERE store.store_id = '$store_id'";
		$result = mysqli_query($links,$sql);
	}
	else
	{
		$sql = "UPDATE `store` SET `active` = 1,`last_update` = current_timestamp() WHERE store.store_id = '$store_id'";
		$result = mysqli_query($links,$sql);
	}
	if($result == 1)
	{
		echo("<script>alert('Successfully updated store status!');</script>");
		echo("
			<form method = 'post' action = 'admin_store.php' id = 'submit_form' style = 'display:none;'>
				<input type = 'text' value =1 name = 'success_active' />
			</form>
		");
		echo("<script>submit_fun()</script>");
	}
	else
	{
		echo("<script>alert('Error fetching data!');</script>");
		//header("location: admin_store.php");
		echo("<script>window.location.href = 'admin_store.php';</script>");
		
	}
	
	
	
	
	
	
	
	
	
	
?>
</body>
</html>