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
  function inside_Ins(){
	  document.getElementById("trueValue").submit();
	  
  }


</script>
</head>
<body>
<br /><br /><br />

<?php
	
	$inventoryIDD = '';
	
	if(isset($_POST['filmChoices']))
	{		$inventoryIDD = $_POST['filmChoices'];
			
			echo ("<form id = 'trueValue' name = 'trueValue' method = 'POST' action = 'tables_inventory.php'><input type = 'text' value = '$inventoryIDD' name = 'value_toDis' /></form>");
			echo ("<script>inside_Ins();</script>");
		
	  
	} 
	 else
	 {
				 echo("<script type='text/javascript'>
				alert('Error in retriving the store id');
				window.location = 'tables_inventory.php';
			</script>");
	 }		 
	  
	  
  ?>
  
	
</body>
</html>