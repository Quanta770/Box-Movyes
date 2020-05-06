<?php
	
	session_start();
	$links = mysqli_connect('localhost','hfycb1_hfycb1','12345isint.','hfycb1_id13307643_assignment2') or die("Could not connect to database");
?>
<!DOCTYPE html>
<head>
<link rel = "shortcut icon" href = "img/fav.png" />
	<script>
		function success_function()
		{
			document.getElementById("sucess_delete").submit();
		}
	</script>
	<title>Deleting staff..</title>
</head>
<body>
<?php
	$staff_id = $_POST['staff_id'];
	
	$sql_delete2 = "DELETE FROM `address` WHERE address.address_id = (SELECT staff.address_id FROM  staff WHERE staff.staff_id = '$staff_id')";
	$result = mysqli_query($links,$sql_delete2);
	$result = 0;
	$sql_delete = "DELETE FROM `staff` WHERE staff.staff_id = '$staff_id'";
	
	$result = mysqli_query($links,$sql_delete);
	$sql_delete2 = "DELETE FROM `store` WHERE store.manager_staff_id = '$staff_id'";
	$result = mysqli_query($links,$sql_delete2);
	if($result==1)
	{
		echo("
			<form method = 'post' action = 'admin_staff.php' id = 'sucess_delete' style = 'display:none;'>
				<input type = 'text' value = 1  name = 'delete_success' />
		
			</form>
		");
		echo("<script>success_function();</script>");

	}
	else
	{
		echo("<script>alert('Error fetching data!')</script>");
		echo("window.location.href('admin_staff.php');");
	}

?>
</body>