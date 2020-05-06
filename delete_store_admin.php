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
	else if(!(isset($_POST['store_id'])))
	{
		//header("Location:admin_store.php");
		echo("<script>window.location.href = 'admin_store.php';</script>");
	}
?>
<!DOCTYPE html>
<html>
<head>
<link rel = "shortcut icon" href = "img/fav.png" />
<script>
	function submit_fun()
	{
		document.getElementById("to_submit_form").submit();
	}
</script>

<title>Deleting store...</title>
</head>
<body>
<?php
	$store_id = $_POST['store_id'];

	$sql_delete2 = "DELETE FROM `address` WHERE address.address_id = (SELECT store.address_id FROM store WHERE store.store_id = '$store_id')";
	$result = mysqli_query($links,$sql_delete2);
	
	$sql_delete = "DELETE FROM `store` WHERE store.store_id = '$store_id'";
	$result = mysqli_query($links,$sql_delete);
	
	if($result==1)
	{
		echo("<script>alert('Successfully deleted store!');</script>");
		echo("
			<form method = 'post' action = 'admin_store.php' style = 'display:none' id = 'to_submit_form'>
				<input type = 'text' value = 1 name = 'success_delete' />
			</form>
		");
		echo("<script>submit_fun();</script>");
		
	}
	else
	{
		echo("<script>alert('Error fetching data.');</script>");
		echo("<script>window.location.href = 'admin_store.php';</script>");
	}
	
	
?>
</body>
</html>