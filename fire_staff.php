<?php
	$links = mysqli_connect('localhost','hfycb1_hfycb1','12345isint.','hfycb1_id13307643_assignment2') or die("Could not connect to database");

?>
<!DOCTYPE html>
<html>
<head>
<link rel = "shortcut icon" href = "img/fav.png" />
<script>
	function submit_fun()
	{
		document.getElementById("submit_back_form").submit();
		
	}
</script>
<title>Processing request</title>
</head>
<body>
<?php
	$fire_type = $_POST['fire_type'];
	$staff_id = $_POST['staff_id'];
	if($fire_type==1)
	{
		$sql_fire = "UPDATE `staff` SET `active` = 0,`last_update` = current_timestamp() WHERE staff.staff_id = '$staff_id'";
		$return_value = 0;
	}
	else if($fire_type==0)
	{
		$return_value = 1;
		$sql_fire = "UPDATE `staff` SET `active` = 1,`last_update` = current_timestamp() WHERE staff.staff_id = '$staff_id'";
	}
		
	
	
	$result = mysqli_query($links,$sql_fire);
	if($result ==1)
	{
		echo("
			<form action = 'admin_staff.php' method = 'post' id = 'submit_back_form' style = 'display:none;'>
				<input type = 'text' name = 'success_fire' value = '$return_value'/>
			</form>
		");
		echo("<script>submit_fun();</script>");
	}
	else
	{
		echo("<script>alert('Error fetching data!');</script>");
		echo("<script>window.location.href('admin_staff.php');</script>");
	}
	
	//do a page where the staff can see fired staff
?>
</body>
</html>