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
 <?php 


	
	$links = mysqli_connect('localhost','hfycb1_hfycb1','12345isint.','hfycb1_id13307643_assignment2') or die("Could not connect to database");
		
   
  
  
  ?>
<head>
<link rel = "shortcut icon" href = "img/fav.png" />
<title>Delete Rental</title>
<script>
  

</script>
</head>
<body>
<br /><br /><br />

<?php
   $rentalIDD = '';
  if(isset($_POST['deleteRental'])){
	 $rentalIDD = $_POST['deleteRental'];
	  
	  $sql_to_del = "DELETE FROM `rental` WHERE rental_id = '$rentalIDD'";
	  $run_del = mysqli_query($links,$sql_to_del);
	  if($run_del){
		  $_SESSION['messageR'] = "Record has been deleted";
	           $_SESSION['msg_typeR'] = "danger";
	      echo("<script type='text/javascript'>
				alert('Successfully deleted');
				window.location = 'tables_rental.php';
			</script>");
		  
	  }else{
		   echo("<script type='text/javascript'>
				alert('Error : Selected rental is not deleted');
				window.location = 'tables_rental.php';
			</script>");
		  
	  }
	 
	 
	  
  }else{
	  echo("<script type='text/javascript'>
				alert('Error in Fetching Data');
				window.location = 'tables_rental.php';
			</script>");
	  
	  
  }

	
	
	
	
	
  
?>
</body>
</html>