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
<title>Category check</title>
<script>
  function inside_Inventory(){
	  document.getElementById("errorInven").submit();
	  
  }


</script>
</head>
<body>
<br /><br /><br />

<?php
	
	$film_idI = '';
	$store_idI = '';
	
	if(isset($_POST['filmS']) && isset($_POST['storeIn']))
	{		
		$film_idI = $_POST['filmS'];
		$store_idI = $_POST['storeIn'];
		$links = mysqli_connect('localhost','hfycb1_hfycb1','12345isint.','hfycb1_id13307643_assignment2') or die("Could not connect to database");
		
		$inInvenQuery = "INSERT INTO `inventory`(`inventory_id`, `film_id`, `store_id`, `inventory_status_id`, `last_update`) VALUES (NULL,$film_idI,'$store_idI','3',current_timestamp())";
		$run_inven_tb =  mysqli_query($links,$inInvenQuery);
		if($run_inven_tb){
			 echo("<script type='text/javascript'>
				alert('Successfully added into the inventory');
				window.location = 'inventory.php';
			 </script>");
			
		}else{
			echo("<script type='text/javascript'>
				alert('Insertion Error: Cannot be inserted into the database');
				
			</script>");
			
			echo ("<form id = 'errorInven' name = 'errorInven' method = 'POST' action = 'inventory.php'> <input type = 'text' value = '1' name = 'inside_Inven'/><input type = 'text' value = '$film_idI' name = 'backFilm' /><input type = 'text' value = '$store_idI' name = 'backStore' /></form>");
			echo ("<script>inside_Inventory();</script>");
			
		}
				
		
		
        	   
			
	  
	} 
	 else
	 {
				 echo("<script type='text/javascript'>
				alert('Value is not set');
				window.location = 'inventory.php';
			</script>");
	 }		 
	  
	  
  ?>
  
	
</body>
</html>