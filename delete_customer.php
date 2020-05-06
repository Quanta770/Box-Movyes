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
	else if(!isset($_POST['customer_id']))
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
			document.getElementById("submit_form").submit();
		}
	</script>
<title>Deleting customer...</title>

</head>
<body>
<?php
	$links = mysqli_connect('localhost','hfycb1_hfycb1','12345isint.','hfycb1_id13307643_assignment2') or die("Could not connect to database");
	$customer_id = $_POST['customer_id'];
	$sql2 = "DELETE FROM `address` WHERE address.address_id = (SELECT customer.address_id FROM customer WHERE customer.customer_id = '$customer_id')";
	$result = mysqli_query($links,$sql2);
	$result = "";
	$sql1 = "DELETE FROM `customer` WHERE customer.customer_id = '$customer_id'";
	$result = mysqli_query($links,$sql1);
	$result = "";
	
	if($result == 1)
	{
		echo("<script>echo('Success updating customer');</script>");
		echo("
			<form method = 'post' action = 'staff_view_customer.php' style = 'display:none;'id = 'submit_form'>
				<input type = 'text' value = 1 name = 'success_delete' />
			</form>
			
		");
		echo("<script>submit_fun();</script>");
		//success
	}
	else
	{
		echo("<script>echo('Error fetching data!');</script>");
		echo("<script>window.location.href = 'staff_view_customer.php'</script>");
		//failure
	}

?>
</body>
</html>