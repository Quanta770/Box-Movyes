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
<title>Delete Payment</title>
<script>
  

</script>
</head>
<body>
<br /><br /><br />

<?php
   $paymentDelID = '';
  if(isset($_POST['deletePayment'])){
	 $paymentDelID = $_POST['deletePayment'];
	  
	  $sql_to_del_payment = "DELETE FROM `payment` WHERE payment_id = '$paymentDelID'";
	  $run_del_payment = mysqli_query($links,$sql_to_del_payment);
	  if($run_del_payment){
		  $_SESSION['messagePay'] = "Record has been deleted";
	           $_SESSION['msg_typePay'] = "danger";
	      echo("<script type='text/javascript'>
				alert('Successfully deleted');
				window.location = 'tables_payment.php';
			</script>");
		  
	  }else{
		   echo("<script type='text/javascript'>
				alert('Error : Selected rental is not deleted');
				window.location = 'tables_payment.php';
			</script>");
		  
	  }
	 
	 
	  
  }else{
	  echo("<script type='text/javascript'>
				alert('Error in Fetching Data');
				window.location = 'tables_payment.php';
			</script>");
	  
	  
  }

	
	
	
	
	
  
?>
</body>
</html>