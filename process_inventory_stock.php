<?php
	session_start();
	if(!isset($_SESSION['email']))//restrict access if not login
	{
		header('location:staff_login.php');
	}
	else if (isset($_SESSION['customer_check']))
	{
		header('location:customer_page.php');
	}
	
?>
<! DOCTYPE html >
<html lang = "en">
<head>
<link rel = "shortcut icon" href = "img/fav.png" />
<title>Actor check</title>
<script>
  function inside_In(){
	  document.getElementById("trueValue").submit();
	  
  }


</script>
</head>
<body>
<br /><br /><br />

<?php
	
	$storeIDD = '';
	
	if(isset($_POST['storeChoices']))
	{		$storeIDD = $_POST['storeChoices'];
			
			echo ("<form id = 'trueValue' name = 'trueValue' method = 'POST' action = 'view_inventory_stock.php'><input type = 'text' value = '$storeIDD' name = 'valuess' /></form>");
			echo ("<script>inside_In();</script>");
		
	  
	} 
	 else
	 {
				 echo("<script type='text/javascript'>
				alert('Error in retriving the store id');
				window.location = 'view_inventory_stock.php';
			</script>");
	 }		 
	  
	  
  ?>
  
	
</body>
</html>