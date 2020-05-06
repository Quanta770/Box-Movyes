<?php
	session_start();
?>
<html>
<head>
<link rel = "shortcut icon" href = "img/fav.png" />
</head>
<body>
	<?php
		unset($_SESSION['email']);
		//session_destroy();
		if(isset($_SESSION['staff_check']))
		{
			
			unset($_SESSION['staff_check']);
			echo("<script>window.location.href = 'staff_login.php';</script>");
			//header('location:staff_login.php');
		}
		else if(isset($_SESSION['customer_check']))
		{
			unset($_SESSION['customer_check']);
			echo("<script>window.location.href = 'login.php';</script>");
			//header('location:login.php');
		}
		else if (!isset($_SESSION['email']))
		{
			echo("<script>window.location.href = 'index.php';</script>");
			//header('location:index.php');
		}
		else
		{
			header('location:index.php');
			echo("<script>window.location.href = 'index.php';</script>");
		}
		
		
		
	?>

</body>
</html>